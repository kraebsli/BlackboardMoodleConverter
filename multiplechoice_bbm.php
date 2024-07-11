<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$zaehler++;
				$questiontype="multichoice";
				$partialcredit=$question->itemmetadata->bbmd_partialcredit;
				$scorevalue="";
				$sollsein=true;
				$ZahlRichtigerAntworten=0;
				$loesungen_ar=array();
				$arrmitembeddedfiles=array();
				$multichoiceid++;
				if($q=="Multiple Choice")
				{
					$single="1";
					
				}
				else 
				{
					$single="0";
				}
	
	
			//***************************richtige Lösung
		
			foreach ($question->resprocessing->respcondition as $l) {
				if($l['title']=="correct")
				{
					if($q=="Multiple Answer")
					{
					foreach($l->conditionvar->and->varequal as $l2)
					{
					//nochmal schleife für mehrfachantworten
					 $l2=xmlencoding($l2);
					$loesungen_ar[]=trim($l2);
				
					//echo "loesungid: " . $loesung;
					}
					}
					else 
					{
					foreach($l->conditionvar->varequal as $l2)
					{
					//nochmal schleife für mehrfachantworten
				
				  $l2=xmlencoding($l2);
					$loesungen_ar[]=trim($l2);
					//echo "loesungid: " . $loesung;
					}
					}//if else multiple answer
				}//title correct
}//ende richtige Lösung
			//**********************************************************
			
			//***************************Frageninhalte
			foreach ($question->presentation->flow->flow as $flow) {
				if($flow['class']=="QUESTION_BLOCK")//Fragetext
				{

			include("questiontext.php");
	
			//***********************************************

//bild[3] array mit fileitems

//**********************************************

				}
				else //Antworten
				{
	$response=$flow->response_lid->render_choice;
					foreach($response->flow_label as $resp)
					{
						
						//***************************************************************************
						/*$antwortid_temp=trim($resp->response_label['ident']);
						$antwortid=trim($resp->response_label['ident']);
						$antwortid = preg_replace('![^0-9]!', '', $antwortid);
						$antwortid=substr($antwortid,0,5);*/
						$antwortid++;
						
						//*********************************************************************************
						$antworttext= $resp->response_label->flow_mat->material->mat_extension->mat_formattedtext;

	
						//antworttext nach IMG parsen************************************************************
						$filearea="answer";
						
						$antworttext2=bild2($antworttext, $dir, $antwortid, $resident, $direxport, $contextid, $filearea);//array mit img-infos
						
						
						//das muss bei moodle stehen: ><img src="@@PLUGINFILE@@/tab2.jpg" width="300" height="200" /
						
						if(isset($antworttext2[1]) && $antworttext2!=="")
						{
							
						
							$arrmitembeddedfiles=$antworttext2[3];
							for($i=0;$i<count($antworttext2[3]); $i++)
							{
								
								$arr_files_embedded_quiz[]=$arrmitembeddedfiles[$i];
						}
						$antworttext=$antworttext2[1];
						//$antworttext=strip_tags($antworttext);
						$antworttext=xmlencoding($antworttext);
			
						}
						else
						{
							$antworttext=strip_tags($antworttext);
							$antworttext=xmlencoding($antworttext);
							
						}
						
					
						
						
						//****************************************************************************************
					
		
						if($b==count($loesungen_ar))
						{
							$b=0;
						}
						//schleife abgleich lösungen mit antwort, ids*******************************
						for($b=0;$b<count($loesungen_ar); $b++)
{

					if(trim($resp->response_label['ident'])==$loesungen_ar[$b])
						{
			
							$richtigeantwort="1";
							$ZahlRichtigerAntworten++;
						$b=count($loesungen_ar);
						break;
						}
						else 
						{
							
							$richtigeantwort="0";
							
						}
}//ende for loesungen_ar
						//**********************************************
						
					
						//************************scores
						//foreach ($question->resprocessing->respcondition  as $score) {
							
		
							//$scoreid=trim($score->conditionvar->varequal['respident']);
							//if($scoreid==$antwortid_temp)
							//{
							//	$scorevalue=$score->setvar;
							
							//	break;
							//}
							//else 
							//{
								//$scorevalue="0";
							//}
					
							
						
						//}
						//*********************************************
						
						
						//****************************************
						//echo "antwortid: " . $resp->response_label['ident'];
						//echo "<br>";
						//mit identifier, für bezug zu feedback notwendig
						//feedback schleife***************************************************
						//*******************************************************************
						foreach ($question->itemfeedback as $itemfeedback) {//feedback
							//echo "feedbaid: " .  $itemfeedback['ident'];
							//echo "<br>";
							//echo $antwortid;
							//echo "<br>";
						//echo "<br>";
							$ifb=trim($itemfeedback['ident']);
							$ifb_temp=trim($itemfeedback['ident']);
							$ifb = preg_replace('![^0-9]!', '', $ifb); 
							$ifb=substr($ifb,0,5);
							if($ifb==$antwortid)
							{
								//feedback zu einzelnen Antwortoptionen nur bei Single Choice
								if($single=="1")
								{
								$feedback=$itemfeedback->solution->solutionmaterial->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
								$feedback=strip_tags($feedback);
								$feedback=xmlencoding($feedback);
								}
								else 
								{
									$feedback="";
								}
								//echo $feedback . "<br>";
							}
							else if($ifb_temp=="correct" && $correctfeedback=="")
							{
								$correctfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
									$correctfeedback=xmlencoding($correctfeedback);
								//echo $correctfeedback . "corrallg<br>";
							}
						else if($ifb_temp=="incorrect" && $incorrectfeedback=="")
							{
								$incorrectfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
								$incorrectfeedback=xmlencoding($incorrectfeedback);
									//echo $incorrectfeedback . "incorrallg<br>";
							}
							
						}//ende foreachfeedback*********************************************
						//*********************************************************************
						$antwort=new answer ($antwortid, $antworttext, $feedback, $richtigeantwort, $scorevalue);
						$answer_ar[]=$antwort;
						}//ende foreach antworten
				}//ende else antworten

				//**************************************
}//ende foreach question Frageninhalte

			$ques= new question($questiontype, $frageimSatz);
			$ques->multichoice($qt,$df, $quid, $multichoiceid, $correctfeedback, $incorrectfeedback, $loesung, $answer_ar, $ZahlRichtigerAntworten, $questiontitle, $single);
			
			
			$r++;
?>