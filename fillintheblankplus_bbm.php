<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$zaehler++;
$questiontype="multianswer";
$sollsein=true;
$multianswerid++;
$fragen=array();
$antworten=array();
$cfeedback=array();
$incfeedback=array();
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
		$qt=xmlencoding($qt);
		//echo $questiontitle;
		//echo "<br>";
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
			$or2=xmlencoding($or2);
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

		$ifb2=$or2['respident'];
			
			
			//**************feedback
			foreach ($question->itemfeedback as $itemfeedback) {//feedback
					
				$ifb=trim($itemfeedback['ident']);
					
				$abgleich="correct-" . trim($ifb2);
				$abgleich2="incorrect-" . trim($ifb2);
								
				if($ifb==$abgleich && $ifb!=="")
				{
					
					$correctfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
					
					$correctfeedback=str_replace("Richtig.", "Richtig ist: ", $correctfeedback);
					$correctfeedback=xmlencoding($correctfeedback);
					$cfeedback[]=$correctfeedback;
					
					$subfrage.="#" . $correctfeedback;
					//echo "pro Item korrekt: " . $correctfeedback;
					//echo "<br>";
					//echo "<br>";
				}
				elseif($abgleich2==$ifb)
				{
					$incorrectfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
					$incorrectfeedback=xmlencoding($incorrectfeedback);
					$incfeedback[]=$incorrectfeedback;
					//echo "pro Item inkorrekt: " . $incorrectfeedback;
					//echo "<br>";
				}
			}
				
			//***********************feedback
			}
			$subfrage.="}";
			$subfrage=xmlencoding($subfrage);
		
			//new shortanswer
			$shanswer= new shortanswer($quid,$questionid_sh,$antworten,$cfeedback,$incfeedback, $subfrage, $shortanswerid, $questiontitle );
			$fragen[]=$shanswer;
			//$shortanswerid=0;
			$antworten=array();
			$cfeedback=array();
			$incfeedback=array();
			$subfrage="";
			$ifb="";
			$abgleich="";
			$abgleich2="";
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
		
		//echo $correctfeedback . "corrallg<br>";
		$correctfeedback=str_replace("Richtig.", "Richtig ist: ", $correctfeedback);
		$correctfeedback=xmlencoding($correctfeedback);
		echo "Gesamt korrekt: " . $correctfeedback;
		echo "<br>";
		echo "<br>";
	}
	else if($ifb=="incorrect" && $incorrectfeedback=="")
	{
		$incorrectfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
		$incorrectfeedback=xmlencoding($incorrectfeedback);
		echo "Gesamt nicht korrekt: " . $incorrectfeedback;
		echo "<br>";
		echo "<br>";
		//echo $incorrectfeedback . "incorrallg<br>";
	}
		
}//ende foreachfeedback*********************************************
//**************************************ende Fill in the Blank Plus
$ques= new question($questiontype,$frageimSatz);
$ques->multianswer($qt,$df, $quid, $multianswerid,  $fragen, $questiontitle, $correctfeedback, $incorrectfeedback , "true");

//********************************************Frage//ende foreach Frage

?>