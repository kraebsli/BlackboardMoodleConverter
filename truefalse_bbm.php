<?php
$zaehler++;
$questiontype="truefalse";
$sollsein=true;
$truefalseid++;
$scorevalue="";

//***************************Frageninhalte
foreach ($question->presentation->flow->flow as $flow) {
	if($flow['class']=="QUESTION_BLOCK")//Fragetext
	{

		include("questiontext.php");
	}

		
	//****************************************************************
	//***************************richtige Lösung
		
	$feedback="";
	if($asstype=="Survey")//Either/or erzeugt Fehlermeldung bei Survey
	{
		$loesung="";
		$antwortid++;
		$antwort=new answer ($antwortid, $loesung, $feedback, $loesung, $scorevalue);
		$answer_ar[]=$antwort;

	}
	else
	{
		foreach ($question->resprocessing->respcondition as $l) {
			if($l['title']=="correct")
			{
				//true oder false
				$loesung=$l->conditionvar->varequal;
					
					
				$pos = strpos($loesung, "true");
				if ($pos === false) {
					$loesung="false";
					$antwort=new answer ($antwortid, $loesung, $feedback, $loesung, $scorevalue);
					$answer_ar[]=$antwort;
					$antwortid++;
				}
					
				else
				{
					$loesung="true";
					$antwort=new answer ($antwortid, $loesung, $feedback, $loesung);
					$answer_ar[]=$antwort;
					$antwortid++;
				}
					
			}//title correct

		}//ende richtige Lösung
	}
		
		
	//**********************************************************

		
	//*******************************************************************
	foreach ($question->itemfeedback as $itemfeedback) {//feedback
			
		$ifb=trim($itemfeedback['ident']);
			
		if($ifb=="correct" && $correctfeedback=="")
		{
			$correctfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
			$correctfeedback=strip_tags($correctfeedback);
			$correctfeedback=xmlencoding($correctfeedback);
			//echo $correctfeedback . "corrallg<br>";
		}
		else if($ifb=="incorrect" && $incorrectfeedback=="")
		{
			$incorrectfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
			$incorrectfeedback=strip_tags($incorrectfeedback);
			$incorrectfeedback=xmlencoding($incorrectfeedback);
			//echo $incorrectfeedback . "incorrallg<br>";
		}
			
	}//ende foreachfeedback*********************************************
	//*********************************************************************





	//**************************************
}//ende foreach question Frageninhalte
//questiontype, questiontext, defaultmark, questionid, truefalseid, feedbackcorrect, feedbackincorrect, questiontitle

$ques= new question($questiontype,$frageimSatz);
$ques->truefalse($qt, $df, $quid, $truefalseid, $correctfeedback, $incorrectfeedback, $loesung, $questiontitle, $answer_ar);

$r++;
?>