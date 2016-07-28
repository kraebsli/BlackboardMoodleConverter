<?php

$zaehler++;
				$questiontype="shortanswer";
				$sollsein=true;
				$shortanswerid++;
				$scorevalue="";
									//***************************
									//***************************Frageninhalte
			foreach ($question->presentation->flow->flow as $flow) {
				if($flow['class']=="QUESTION_BLOCK")//Fragetext
				{
					//Fragetext
	include("questiontext.php");
			
				}
				}//ende foreach question Frageninhalte
				//***********************Antworten
				foreach ($question->resprocessing->respcondition as $l) {
					$antwortid++;
					$antworttext=$l->conditionvar->varequal;
					$antworttext=strip_tags($antworttext);
					$antworttext=xmlencoding($antworttext);
					
					if(isset($l->conditionvar->varequal))
					{
					$case=$l->conditionvar->varequal['case'];
					
						//*******************************************************************
						foreach ($question->itemfeedback as $itemfeedback) {//feedback
						
							if($itemfeedback['ident']==$l['title'])
							{
								
								$feedback=$itemfeedback->solution->solutionmaterial->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
								$feedback=xmlencoding($feedback);
								
							}
							
							
						}//ende foreachfeedback*********************************************
					$richtigeantwort="";
					//*********************************************************************
						$antwort=new answer ($antwortid, $antworttext, $feedback, $richtigeantwort, $scorevalue);
						$answer_ar[]=$antwort;
						
					}//antworttext nicht leer
				}
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
									//echo $incorrectfeedback . "incorrallg<br>";
									$incorrectfeedback=xmlencoding($incorrectfeedback);
							}
							
						}//ende foreachfeedback*********************************************
			//**************************************

//echo "Fragentyp: " . $questiontype;
			$ques= new question($questiontype,$frageimSatz);
			$ques->shortanswer2($qt,$df, $quid, $shortanswerid,  $answer_ar, $questiontitle, $correctfeedback, $incorrectfeedback);
		
?>