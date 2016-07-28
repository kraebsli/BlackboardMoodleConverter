<?php
$zaehler++;
$questiontype="multichoice";
$partialcredit=$question->itemmetadata->bbmd_partialcredit;
$scorevalue="";
$single="1";
$sollsein=true;

$loesungen_ar=array();
$multichoiceid++;

//***************************richtige Lösung

foreach ($question->resprocessing->respcondition as $l) {
	if($l['title']=="correct")
	{
		$l2=$l->conditionvar->varequal;
		$l2=trim($l2);
			

	}//title correct
}//ende richtige Lösung
//**********************************************************
	
//***************************Frageninhalte
foreach ($question->presentation->flow->flow as $flow) {
	if($flow['class']=="QUESTION_BLOCK")//Fragetext
	{

		include("questiontext.php");
		//***********************************************
	}
	else //Antworten
	{
		$response=$flow->response_lid->render_choice;
		foreach($response->flow_label as $resp)
		{
			$antworttext= $resp->response_label->flow_mat->material->mat_extension->mat_formattedtext;
			$antworttext=xmlencoding($antworttext);
			if(trim($resp->response_label['ident'])==$l2)
			{
					
				$richtigeantwort="1";
					

			}
			else
			{
					
				$richtigeantwort="0";
					
			}

			//**********************************************

			$antwortid_temp=trim($resp->response_label['ident']);
			$antwortid2=trim($resp->response_label['ident']);
			$antwortid2 = preg_replace('![^0-9]!', '', $antwortid);
			$antwortid2=substr($antwortid,0,5);
			$antwortid++;
				
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
				if($ifb==$antwortid2)
				{

					$feedback=$itemfeedback->solution->solutionmaterial->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
					$feedback=xmlencoding($feedback);
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
//echo "Fragentyp: " . $questiontype;
$ques= new question($questiontype,$frageimSatz);
$ZahlRichtigerAntworten=1;
$ques->multichoice($qt,$df, $quid, $multichoiceid, $correctfeedback, $incorrectfeedback, $loesung, $answer_ar, $ZahlRichtigerAntworten, $questiontitle, $single);

$r++;

?>