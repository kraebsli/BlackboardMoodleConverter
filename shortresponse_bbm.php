<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
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