<?php

$questiontype="ddmarker";

$sollsein=true;

$zaehler++;
$draganddropid++;

foreach ($question->presentation->flow->flow as $flow) {
	if($flow['class']=="QUESTION_BLOCK")//Fragetext
	{

		include("questiontext.php");
		//***********************************************
	}
	else
	{
		$hotspotfile=$flow->flow->material->matapplication['label'];//ergibt den richtigen Dateinamen
		$arr_files_embedded_quiz_drag[]=draganddropbild($hotspotfile, $dir, $quid, $resident, $direxport, $contextid);
	}
}
//******************************
$ko=false;
foreach ($question->resprocessing->respcondition as $l) {
	//
	$koordinaten=$l->conditionvar->varinside;
	if($ko==false)
	{
		$resultKoordinaten=$koordinaten;
		// left, top, width, height
		//Koordinaten oben links 102, 80
		//Koordinaten unten rechts	154, 128
		$resultKoordinaten_temp=explode(",", $resultKoordinaten);
		$null=trim($resultKoordinaten_temp[0]);
		$eins=trim($resultKoordinaten_temp[1]);
		$zwei=trim($resultKoordinaten_temp[2]);
		$drei=trim($resultKoordinaten_temp[3]);
		$width=$drei-$eins;
		$height=$zwei - $null;
		$coords=$null . "," . $eins . ";" . $height . "," . $width;
		$ko=true;
	}
}
//******************************************
//*******************************************************************
foreach ($question->itemfeedback as $itemfeedback) {//feedback
		
	$ifb=trim($itemfeedback['ident']);
		
	if($ifb=="correct" && $correctfeedback=="")
	{
		$correctfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
		$correctfeedback=xmlencoding($correctfeedback);

	}
	else if($ifb=="incorrect" && $incorrectfeedback=="")
	{
		$incorrectfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
		$incorrectfeedback=xmlencoding($incorrectfeedback);
			
	}
		
}//ende foreachfeedback*********************************************
//*******************************************
$ques= new question($questiontype,$frageimSatz);
$ques->draganddrop($qt,$df, $quid, $draganddropid, $correctfeedback, $incorrectfeedback, $coords,  $questiontitle);


//***************************************************
?>