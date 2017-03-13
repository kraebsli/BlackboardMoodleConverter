<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$zaehler++;
$questiontype="match";
$sollsein=true;
$matchid++;
$fragen=array();
$antworten=array();
$scorevalue="";
$orderids=array();
//***************************Frageninhalte
foreach ($question->presentation->flow->flow as $flow) {
	if($flow['class']=="QUESTION_BLOCK")//Fragetext
	{
		//Fragetext
		include("questiontext.php");
	}
	elseif($flow['class']=="RESPONSE_BLOCK")//Antworten
	{


		//*****************************************
		/*foreach($flow->flow as $flow2)
		 {
		 $frage=$flow2->flow->material->mat_extension->mat_formattedtext;
		 $frage=xmlencoding($frage);
		 $fragen[]=$frage;
		 }

			*/
		//*********************************************************************
		$t=1;
		foreach($flow->response_lid->render_choice->flow_label as $flow3)
		{

			$orderingid=trim($flow3->response_label['ident']);

			$antwort=$flow3->response_label->flow_mat->material->mat_extension->mat_formattedtext;
			$antwort=strip_tags($antwort);
			$antwort=xmlencoding($antwort);
			$antworten[]=$antwort;
			$orderids[]=$orderingid;
			//*****************************************
				
			$fragen[]=$t . ".";
			$t++;

			//*********************************************
		}//foreach
	}//ende else antworten
	//**************************************
}//ende foreach question Frageninhalte
//**********************************
$b=0;
foreach ($question->resprocessing->respcondition->conditionvar->and->varequal as $respid) {
	/*echo $respid;
	echo "<br>";
	echo $orderids[$b];
	echo "<br>";
	echo "<br>";*/
	for($i=0; $i<count($orderids); $i++)
	{
	if($respid==$orderids[$i]){
		
		$richtigeantwort="";
		$antworttext=$fragen[$b];//hier frage
		
		
		$feedback=$antworten[$i];//hier antwort
		
		$antwortid++;
		$antwort=new answer ($antwortid, $antworttext, $feedback, $richtigeantwort, $scorevalue);
		$answer_ar[]=$antwort;
	}
	}
$b++;
}




//************************************
/*for($i=0; $i<count($fragen); $i++)
{
	$richtigeantwort="";
	$antworttext=$fragen[$i];//hier frage
	$feedback=$antworten[$i];//hier antwort
		$antwortid++;
	$antwort=new answer ($antwortid, $antworttext, $feedback, $richtigeantwort, $scorevalue);
	$answer_ar[]=$antwort;


}*/
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

$ques= new question($questiontype,$frageimSatz);

$ques->match($qt,$df, $quid, $matchid,  $answer_ar, $questiontitle, $correctfeedback, $incorrectfeedback);

?>