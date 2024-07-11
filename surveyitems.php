<?php
//$contextid=10;
//$categoryid=1;
$i=0;
$zaehler=0;
foreach ($daten->resources->resource as $res) {
	
	$resident=$res['identifier'];
	$resdat=$dir . "/" . $resident . ".dat";//directory
	$res_single=simplexml_load_file($resdat);
	$test=$res_single->assessment;
	$seltype="";
	if(isset($test->assessmentmetadata->bbmd_assessmenttype))
	$asstype=trim($test->assessmentmetadata->bbmd_assessmenttype);
	if($asstype=="Survey")
	{
	if(isset($test['title'])&& $test['title']!=="")
	{
		$i++;
		$survey2=xmlencoding($test['title']);
		$survey2_demo=xmlencoding($test['title']);
		//***************************************************************
		$surveyid=$test->assessmentmetadata->bbmd_asi_object_id;
		$asstype=$test->assessmentmetadata->bbmd_assessmenttype;
		$surveyid=trim($surveyid);
		$surveyid=str_replace("_", "", $surveyid);
	
		//***********************Quiztitel
		$ZahlRichtigerAntworten=0;
		$gesamtscore=$test->assessmentmetadata->qmd_absolutescore_max;

		if($gesamtscore=="-1")
			$gesamtscore="0";
		
		$beschreibung=$test->presentation_material->flow_mat->material->mat_extension->mat_formattedtext;
		$anweisung=$test->rubric->flow_mat->material->mat_extension->mat_formattedtext;
		$surveydescription=$beschreibung . "<br>" . $anweisung;
		$surveydescription=strip_tags($surveydescription);
		$surveydescription=xmlencoding($surveydescription);
		
	
		//section->section->selection_ordering->selection->or_selection->selection_metadata
		//section->section->selection_ordering->selection
		$seltype=$test->section->section->selection_ordering->selection;
$seltype=trim($seltype['seltype']);
//if($seltype!=="All")//??????????????????
//{

			$survey_p= new survey($survey2,$i,$surveyid,$surveydescription);
			//$categoryid++;
			$survey2="";
			//$sollsein=false;
			//$fraction="0.0000000";
			$richtigeantwort="0";
			$truefalseid=0;
			$essayid=0;
			$multianswerid=0;
			$scorevalue="0";
		$seltype=trim($seltype['seltype']);
		/*if($seltype!=="All" || $seltype!=="")
		{
			
			
		//echo $test['title'] . "enthaelt unsymmetrisches Verhaeltnis von Zahl der Fragen zu Anzahl anzuzeigener Fragen im Fragensatz.";
		
		}*/
	//***********************************************************

	$frageimSatz=true;
	//weitere Fragen, nicht aus Fragensatz
	//********************************************************************************
	foreach ($test->section as $s) {
		foreach ($s->item as $question) {
			
		$correctfeedback="";
		$incorrectfeedback="";
		$feedback="";
		$antworttext="";
		$loesung="";
		$qt="";
		//***************qutypeids*******************************
			
		//*************************************************************
		$answer_ar=array();
		$q= $question->itemmetadata->bbmd_questiontype;//Fragetyp
		$q=trim($q);
		$questiontitle=trim($question['title']);
	
		$questiontitle=xmlencoding($questiontitle);
		
		$quid= trim($question->itemmetadata->bbmd_asi_object_id);//FrageID
		$quid=str_replace("_", "", $quid);
			
		$df= $question->itemmetadata->qmd_absolutescore_max;
		if($df=="-1")
		{
			$df="";
		}
		
		//***********Multiple Choice*****************************************
		if($q=="Multiple Choice" or $q=="Multiple Answer")
		{
			
			include("multiplechoice_bbm.php");
			
			$survey_p->setItems($ques);//Frage in Survey einfügen
			
	
		}//***************************ende if q multiple choice
		//********TRUEFALSE EITHER OR
	
		else if($q=="Short Response")//************SHORTANSWER**************************
		//************************************************************
		{
	
			include("shortresponse_bbm.php");
				$survey_p->setItems($ques);//Frage in Survey einfügen
			
	
		}
		
		//************************Opinion Scale***********************************
		else if($q=="Opinion Scale")
		{
			include("opinionscale_bbm.php");
				$survey_p->setItems($ques);//Frage in Survey einfügen
			
		}//***************************ende if q opinion scale
		else if($q=="Numeric")//********************************numeric
		{
			include("numeric_bbm.php");
			$survey_p->setItems($ques);//Frage in Survey einfügen
		}
		else if($q=="Essay")//************ESSAY**************************
		//************************************************************
		{
				
			include("essay-fileupload_bbm.php");
			$survey_p->setItems($ques);//Frage in Survey einfügen
		}
		else
		{
	
			//echo "<br>";
			//echo "<br>";
			//$exportlogData.= "Question " . $questiontitle . " (question type ". $q . " not converted)";
			//echo "<br>";
			$exportlogData.="\n";
			$exportlogData.= "Question " . $questiontitle . " of question type ". $q . " not converted.";
			$exportlogData.="\n";
		}
	}//foreach question
	}
	
	//********************************************************************************
	$survey_ar[]=$survey_p;//Quiz in array einfügen
	
	//$quiz_ar_ids["$quizid"]=$quiz_p;//Quiz in array einfügen
	//}//seltype
	}//title
	}//asstype
}//foreach
//echo "<br>";
//echo "<br>";
//echo $zaehler . " questions converted.";
//echo "<br>";
//echo "<br>";
$exportlogData.="\n";
$exportlogData.=$zaehler . "  survey questions converted.\n";
$exportlogData.="\n";
$i=0;
?>