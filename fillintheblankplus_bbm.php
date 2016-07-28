<?php

$zaehler++;
$questiontype="multianswer";
$sollsein=true;
$multianswerid++;
$fragen=array();
$antworten=array();
$scorevalue="";
//$multichoiceid=0;
$optionenzaehler=0;
//***************************Frageninhalte
foreach ($question->presentation->flow->flow as $flow) {
	if($flow['class']=="QUESTION_BLOCK")//Fragetext
	{
			
		//Fragetext
		include("questiontext.php");
		$qt=lueckentextfrage($qt);//moodlestring
	}
}
//**************************************************

foreach ($question->resprocessing->respcondition as $l) {
	if($l['title']=="correct")
	{
		foreach ($l->conditionvar->and->or as $or) {
			$shortanswerid++;
			$questionid_sh++;
			$optionenzaehler=0;
			$subfrage="{:SHORTANSWER:";
			//$auswahl=$or->varequal['respident'];//id
			//$auswahl_hash=hash('md5',$auswahl);
			//$nr = preg_replace('![^0-9]!', '', $auswahl_hash);
			//$nr=substr($nr, 0, 7);//questionid
			//$nr=ltrim($nr, "0");
				
			//***********************
			//*******aus den antworten den fragetext generieren***********
			foreach ($or->varequal as $or2) {
		
			$antworten[]=$or2;//array
			if($optionenzaehler=="0")
			{
				$subfrage.="%100%" . $or2;
				$optionenzaehler=1;
			}
			else
			{
				$subfrage.="~%100%" . $or2;
			}

		
			}
			$subfrage.="}";
			
			//**************feedback
			foreach ($question->itemfeedback as $itemfeedback) {//feedback
					
				$ifb=trim($itemfeedback['ident']);
					
				$abgleich="correct-" . $auswahl;
				$abgleich2="incorrect-" . $auswahl;
				if($ifb==$abgleich)
				{
					$correctfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
					$correctfeedback=xmlencoding($correctfeedback);
				}
				elseif($abgleich2==$ifb)
				{
					$incorrectfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
					$incorrectfeedback=xmlencoding($incorrectfeedback);
				}
			}
				
			//***********************feedback
			
			//new shortanswer
			$shanswer= new shortanswer($quid,$questionid_sh,$antworten,$correctfeedback,$incorrectfeedback, $subfrage, $shortanswerid, $questiontitle );
			$fragen[]=$shanswer;
			//$shortanswerid=0;
			$antworten=array();
			$subfrage="";
		}//ende foreach or
	}//ende title correct

}//ende foreach resprocessing
$correctfeedback="";
$incorrectfeedback="";

//feedback schleife***************************************************
//*******************************************************************
foreach ($question->itemfeedback as $itemfeedback) {//feedback
		
	$ifb=trim($itemfeedback['ident']);
		
	if($ifb=="correct" && $correctfeedback=="")
	{
		$correctfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
		$correctfeedback=xmlencoding($correctfeedback);
		//echo $correctfeedback . "corrallg<br>";
	}
	else if($ifb=="incorrect" && $incorrectfeedback=="")
	{
		$incorrectfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
		$incorrectfeedback=xmlencoding($incorrectfeedback);
		//echo $incorrectfeedback . "incorrallg<br>";
	}
		
}//ende foreachfeedback*********************************************
//**************************************ende Fill in the Blank Plus
$ques= new question($questiontype,$frageimSatz);
$ques->multianswer($qt,$df, $quid, $multianswerid,  $fragen, $questiontitle, $correctfeedback, $incorrectfeedback , "true");

//********************************************Frage//ende foreach Frage

?>