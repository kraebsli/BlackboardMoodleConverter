<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universit‰t Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$zaehler++;
//$multianswerid=0;
$questiontype="multianswer";
$sollsein=true;
$multianswerid++;
$fragen=array();
$antworten=array();
$scorevalue="";

//***************************Frageninhalte
foreach ($question->presentation->flow->flow as $flow) {
	if($flow['class']=="QUESTION_BLOCK")//Fragetext
	{
		//Fragetext ¸bergeordnete Frage
		include("questiontext.php");
		//*aus qt [...] herausfiltern
		//p>Bochum liegt in {#1} und ist auﬂerdem eine Stadt des {#2}.<
		$qt=lueckentextfrage($qt);//moodlestring

	}
	elseif($flow['class']=="RESPONSE_BLOCK")
	{
		
		foreach ($flow->response_lid as $l) {
			$z=0;
			$answer_ar=array();
			$subfrage="{1:MULTICHOICE:";
			$multichoiceid++;
			$richtigeantwort="0";
			//questionid f¸r multiplechoice

			$questionid_sh++;
			$frageblockid=trim($l['ident']);
				
			//***************************************************antworten
			foreach($l->render_choice->flow_label->response_label as $resps)
			{
				$respid=trim($resps['ident']);
				//******************************************
				//lˆsung*******************************************
				foreach ($question->resprocessing->respcondition as $l) {
					if($l['title']=="correct")
					{
						foreach ($l->conditionvar->and->varequal as $ra) {
								
								
							//$test=trim($identifier);
								
							$ra2=trim($ra['respident']);
							$ra=trim($ra);
							if($ra2==$frageblockid)
							{
								if($respid==$ra)
								{


									$richtigeantwort="1";
									break;
								}

							}
								
								
						}//ende foreach $ra
							
					}//ende if title

				}	//ende foreach resprocessing
				//*******************************************

			
				if($z==0)
				{
					if($richtigeantwort=="1")
					{
						$subfrage.= "%100%" .$resps->flow_mat->material->mattext;
						$subfrage=xmlencoding($subfrage);
						$subfrage.="#OK";
					}
					else
					{
						$subfrage.= $resps->flow_mat->material->mattext;
						$subfrage=xmlencoding($subfrage);
						$subfrage.="#Falsch";
					}
				}
				else
				{
					if($richtigeantwort=="1")
					{
						$subfrage.= "~%100%" . $resps->flow_mat->material->mattext;
						$subfrage=xmlencoding($subfrage);
						$subfrage.="#OK";
					}
					else
					{
						$subfrage.= "~" . $resps->flow_mat->material->mattext;
						$subfrage=xmlencoding($subfrage);
						$subfrage.="#Falsch";
					}
				}
				$antworttext=$resps->flow_mat->material->mattext;
				$antworttext=strip_tags($antworttext);
				$antworttext=xmlencoding($antworttext);
				
				$feedback="";
				$scorevalue="";
				$antwortid++;
				$antwort=new answer ($antwortid, $antworttext, $feedback, $richtigeantwort, $scorevalue);
				$answer_ar[]=$antwort;

				$richtigeantwort="0";
				$z++;
				//*************************************************

			}
			//***************************************************
			$subfrage.= "}";
				
			$mcanswer= new multiplechoice($quid,$questionid_sh,$answer_ar, $subfrage, $multichoiceid );
			$fragen[]=$mcanswer;

				
			$subfrage="";
				
				
		}//foreach responselid
	}//responseblock
	//*********************************************
	//new shortanswer
		

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
	//**************************************ende Jumblesentence
		

}
//********************************************Frage//ende foreach Frage
$ques= new question($questiontype, $frageimSatz);
$ques->multianswer($qt,$df, $quid, $multianswerid,  $fragen, $questiontitle, $correctfeedback, $incorrectfeedback,  "false");

?>