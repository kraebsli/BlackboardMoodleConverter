<?php
/*
 * Created on 15.08.2014
  */
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
  //***********************************************Questions
include("quiz.php");
include("question.php");
include("answer.php");
include("shortanswer.php");
include("multiplechoice.php");
$questions_ar=array();
$quiz_ar=array();
$r=0;
$answers_counter=0;
$loesung="";
$contextid=10;
$categoryid=1;
$loesung="";
$zaehler=0;
$questionid_sh=0;
$questionid_mc=0;
$matchid=0;
$multichoiceid=0;
$draganddropid=0;
$numericalid=0;
$antwortid=0;
$seltype="";
$zahlmatches=0;
foreach ($daten->resources->resource as $res) {
$resident=$res['identifier'];
$seltype="";
	//************************ein Test pro .dat-Datei
	$resdat=$dir . "/" . $resident . ".dat";//directory
	
	$res_single=simplexml_load_file($resdat);
	
    $test=$res_single->assessment;
    $asstype=trim($test->assessmentmetadata->bbmd_assessmenttype);//Pool or Test

    if($asstype=="Pool")
    {
    if(isset($test['title']))
	$quiz2=xmlencoding($test['title']);
    $quiz2=$quiz2 . "(Pool)";
	$quiz2_demo=xmlencoding($test['title']);
	$shortanswerid=0;
	if(isset($quiz2)&& $quiz2!="")
	{
		//->bbmd_asi_object_id
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
$seltype=$test->section->section->selection_ordering->selection;
$seltype=trim($seltype['seltype']);
if($seltype!=="All")
{
$quiz= new quiz($quiz2,$quizid,$contextid, $categoryid, $gesamtscore, $quizdescription);
$categoryid++;
		$quiz2="";
		$sollsein=false;
		//$fraction="0.0000000";
		$richtigeantwort="0";
		$truefalseid=0;
		$essayid=0;
		$multianswerid=0;
$scorevalue="0";
$frageimSatz=false;
	//***********************Quiztitel
		//***********************Fragen
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
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
					
				$questions_ar["$quid"]=$ques;
				
			}//***************************ende if q multiple choice
			//********TRUEFALSE EITHER OR
			//****************************************************
			//***************************************************
			else if($q=="True/False" or $q=="Either/Or")//**************************************
			//************************************************************
			{
				include("truefalse_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
			}
			//ende elseiftruefalse//***************************************************************
				else if($q=="Short Response")//************SHORTANSWER**************************
			//************************************************************
			{
				
				include("shortresponse_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
				
			}
			else if($q=="Essay" or $q=="File Upload")//************ESSAY**************************
			//************************************************************
			{
				
				include("essay-fileupload_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
			}
				
	else if($q=="Matching")//************MATCHING**************************
			//************************************************************
			{
				echo "<h3>Es kann bei Zuordnungsaufgaben zu Fehlern kommen, bitte nachkorrigieren.</h3>";
				include("match_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
}//ende matching*********************************************
			//**********************************************Fill in the Blank Plus
else if($q=="Fill in the Blank Plus")//**************************************
			//************************************************************
			{
				include("fillintheblankplus_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
		
			}//ende if multianswer***************************************************************
			//*****************************fillintheblank einfach************************************
			else if($q=="Fill in the Blank")//**************************************
			//************************************************************
			{
				include("fillintheblank_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
				
}//ende lückentext einfach/Shortanswer
//****************************************************************************************************
else if($q=="Jumbled Sentence")//**************************************
			//************************************************************
			{
				include("jumbledsentence_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
		
			}//ende if multianswer***************************************************************
				else if($q=="Ordering")//************ORDERING**************************
			//************************************************************
			{
				
				include("ordering_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
}//ende matching*********************************************
//************************Opinion Scale***********************************
	else if($q=="Opinion Scale")
			{
				include("opinionscale_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
			}//***************************ende if q opinion scale
			else if($q=="Numeric")//********************************numeric
			{
				include("numeric_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
			}
	else if($q=="Hot Spot")
			{
				include("hotspot_bbm.php");
				$quiz->setQuestions($ques);//Frage in Quiz einfügen
				$questions_ar["$quid"]=$ques;
				
			}
			//ende hotspot
			else 
			{
				
				echo "<br>";
				echo "<br>";
				echo "Frage " . $questiontitle . " (Fragetyp ". $q . " nicht konvertiert)";
				echo "<br>";
			}
}//foreach question
}
if($sollsein=="true")
		{
		$quiz_ar[]=$quiz;//Quiz in array einfügen
		$quiz_ar_ids["$quizid"]=$quiz;//Quiz in array einfügen
		$sollsein=false;
		}
		$contextid++;
}
}//if isset quiz2
    }//asstype
}//ende foreach .dat 
//************************************************
//************************************************
		echo "<br>";
				echo "<br>";
				echo $zaehler . " Pool-Fragen konvertiert.";
				echo "<br>";
				echo "<br>";


?>
