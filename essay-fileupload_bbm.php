<?php

$zaehler++;
$questiontype="essay";
$sollsein=true;
$essayid++;
$scorevalue="";
if($q=="File Upload")
{
	$attachment="1";
}
else
{
	$attachment="0";
}
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
		if($q=="Essay")
		{
			
			foreach ($question->itemfeedback as $itemfeedback) {//feedback

				if($itemfeedback['ident']=="solution")
				{
					$feedback="";
					$richtigeantwort="";
					$antworttext=$itemfeedback->solution->solutionmaterial->flow_mat->material->mat_extension->mat_formattedtext;
					$antworttext=xmlencoding($antworttext);
					//echo $feedback . "<br>";
				}



			}//ende foreachfeedback*********************************************
		}
		else
		{
			$feedback="";
			$richtigeantwort="";
			$antworttext="";
		}
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

?>