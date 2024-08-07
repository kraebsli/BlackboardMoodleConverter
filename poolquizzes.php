<?php
//$contextid=10;
//$categoryid=1;
foreach ($daten->resources->resource as $res) {
	
	$resident=$res['identifier'];
	$resdat=$dir . "/" . $resident . ".dat";//directory
	$res_single=simplexml_load_file($resdat);
	$test=$res_single->assessment;
	$seltype="";
	$asstype=trim($test->assessmentmetadata->bbmd_assessmenttype);
	if($asstype=="Test" or $asstype=="Survey")
	{
	if(isset($test['title'])&& $test['title']!=="")
	{
		$quiz2=xmlencoding($test['title']);
		//***************************************************************
		$quizid=$test->assessmentmetadata->bbmd_asi_object_id;
		$asstype=$test->assessmentmetadata->bbmd_assessmenttype;
		$quizid=trim($quizid);
		$quizid=str_replace("_", "", $quizid);
	
		//***********************Quiztitel
		$ZahlRichtigerAntworten=0;
		$gesamtscore=$test->assessmentmetadata->qmd_absolutescore_max;

		if($gesamtscore=="-1")
			$gesamtscore="0";
		
		$beschreibung=$test->presentation_material->flow_mat->material->mat_extension->mat_formattedtext;
		$anweisung=$test->rubric->flow_mat->material->mat_extension->mat_formattedtext;
		$quizdescription=$beschreibung . "<br>" . $anweisung;
		$quizdescription=xmlencoding($quizdescription);
		
		
		//section->section->selection_ordering->selection->or_selection->selection_metadata
		//section->section->selection_ordering->selection
		$seltype=$test->section->section->selection_ordering->selection;
		if(isset($seltype))
		{
			$quiz_p= new quiz($quiz2,$quizid,$contextid, $categoryid, $gesamtscore, $quizdescription);
			$categoryid++;
			$quiz2="";
			$sollsein=false;
			//$fraction="0.0000000";
			$richtigeantwort="0";
			$truefalseid=0;
			$essayid=0;
			$multianswerid=0;
			$scorevalue="0";
		$seltype=trim($seltype['seltype']);
		if($seltype!=="All" || $seltype!=="")
		{
			
			
		//echo $test['title'] . "enthaelt unsymmetrisches Verhaeltnis von Zahl der Fragen zu Anzahl anzuzeigener Fragen im Fragensatz.";
		
		}
	//***********************************************************
	foreach ($test->section->section->selection_ordering->selection->or_selection->selection_metadata as $s) {
//$s2=$s->selection_ordering->selection->or_selection->selection_metadata;
$s=trim($s);
$quids=str_replace("_", "", $s);
//echo "sdkfjsdlfj" . $quids;
//echo "<br>";
		if(isset($questions_ar["$quids"]))
		{
	
		$quiz_p->setPoolQuestions($questions_ar["$quids"]);//Frage in Quiz einf�gen
		}
		//********************************************************
	}//foreach
	
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
		;
		//***********Multiple Choice*****************************************
		if($q=="Multiple Choice" or $q=="Multiple Answer")
		{
			
			include("multiplechoice_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
			
	
		}//***************************ende if q multiple choice
		//********TRUEFALSE EITHER OR
		//****************************************************
		//***************************************************
		else if($q=="True/False" or $q=="Either/Or")//**************************************
		//************************************************************
		{
			include("truefalse_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
		}
		//ende elseiftruefalse//***************************************************************
		else if($q=="Short Response")//************SHORTANSWER**************************
		//************************************************************
		{
	
			include("shortresponse_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
	
		}
		else if($q=="Essay" or $q=="File Upload")//************ESSAY**************************
		//************************************************************
		{
			//echo $quid;
			//echo "<br>";
			include("essay-fileupload_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
		}
	
		else if($q=="Matching")//************MATCHING**************************
		//************************************************************
		{
			include("match_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
		}//ende matching*********************************************
		//**********************************************Fill in the Blank Plus
		else if($q=="Fill in the Blank Plus")//**************************************
		//************************************************************
		{
			include("fillintheblankplus_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
	
		}//ende if multianswer***************************************************************
		//*****************************fillintheblank einfach************************************
		else if($q=="Fill in the Blank")//**************************************
		//************************************************************
		{
			include("fillintheblank_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
			
	
		}//ende l�ckentext einfach/Shortanswer
		//****************************************************************************************************
		else if($q=="Jumbled Sentence")//**************************************
		//************************************************************
		{
			include("jumbledsentence_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
	
		}//ende if multianswer***************************************************************
		else if($q=="Ordering")//************ORDERING**************************
		//************************************************************
		{
			include("ordering_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
		}//ende matching*********************************************
		//************************Opinion Scale***********************************
		else if($q=="Opinion Scale")
		{
			include("opinionscale_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
		}//***************************ende if q opinion scale
		else if($q=="Numeric")//********************************numeric
		{
			include("numeric_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
		}
		else if($q=="Hot Spot")
		{
			include("hotspot_bbm.php");
			$quiz_p->setQuestions($ques);//Frage in Quiz einf�gen
			$questions_ar["$quid"]=$ques;
	
		}
		//ende hotspot
		else
		{
	
			//echo "<br>";
			//echo "<br>";
			//echo "Question " . $questiontitle . " (Question type ". $q . " not converted.)";
			//echo "<br>";
			$exportlogData.="\n";
			$exportlogData.="Question " . $questiontitle . " (Question type ". $q . " not converted.\n)";
			$exportlogData.="\n";
		}
	}//foreach question
	}
	//********************************************************************************
	$quiz_ar2[]=$quiz_p;//Quiz in array einf�gen
	}//seltype
	}//title
	}
}//foreach
//echo "<br>";
//echo "<br>";
//echo $zaehler . " questions converted.";
exportlogData.="\n";
$exportlogData.=$zaehler . " questions converted.\n";
$exportlogData.="\n";
echo "<br>";
echo "<br>";
?>