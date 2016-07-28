<?php
$zaehler++;
//$questiontype="shortanswer";
//$sollsein=true;
//$shortanswerid++;
$questiontype="essay";
$sollsein=true;
$essayid++;
$attachment="0";
$scorevalue="";
//***************************
//***************************Frageninhalte
foreach ($question->presentation->flow->flow as $flow) {
	if($flow['class']=="QUESTION_BLOCK")//Fragetext
	{
		//Fragetext
		include("questiontext.php");
			
	}
	else //Antworten
	{

			


		//feedback schleife***************************************************
		//*******************************************************************
		foreach ($question->itemfeedback as $itemfeedback) {//feedback

			if($itemfeedback['ident']=="solution")
			{
				$feedback="";
				$richtigeantwort="";
				$antworttext=$itemfeedback->solution->solutionmaterial->flow_mat->material->mat_extension->mat_formattedtext;
				$antworttext=xmlencoding($antworttext);

			}
				
				
		}//ende foreachfeedback*********************************************
		//*********************************************************************
		$antwortid++;
		$antwort=new answer ($antwortid, $antworttext, $feedback, $richtigeantwort, $scorevalue);
		$answer_ar[]=$antwort;

	}//ende else antworten

	//**************************************
}//ende foreach question Frageninhalte
//echo "Fragentyp: " . $questiontype;
$ques= new question($questiontype,$frageimSatz);
$ques->essay($qt,$df, $quid, $essayid, $antworttext, $answer_ar, $questiontitle, $attachment);

//ende short answer*********************************************

?>