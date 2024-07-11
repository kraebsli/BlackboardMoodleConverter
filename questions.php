<?php
/*
 * Created on 15.08.2014
  */
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
  //***********************************************Pool Questions
include_once("quiz.php");
include_once("question.php");
include_once("answer.php");
include_once("shortanswer.php");
include_once("multiplechoice.php");
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
	//echo $resdat;
	//echo "<br>";
	$res_single=simplexml_load_file($resdat);
	
    $test=$res_single->assessment;
	if(isset($test->assessmentmetadata->bbmd_assessmenttype))
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
$frageimSatz=true;
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
			//echo $q;
			//echo "<br>";
			
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
				$exportlogData.= "There may be errors in matching questions, it may be necessary to correct them:\n";
				include("match_bbm.php");
				for($i=0;$i<count($ques);$i++)
				{
					$questemp=$ques->getTitle();
					$exportlogData.=$questemp;
					$exportlogData.="\n";
				}
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
				
				//echo "<br>";
				//echo "<br>";
				//echo "Question " . $questiontitle . " of question type ". $q . " not converted.";
				$exportlogData.="\n";
				$exportlogData.="Question " . $questiontitle . "  of question type ". $q . "is not converted.\n";
				$exportlogData.="\n";
				//echo "<br>";
			}
}//foreach question
}
			//********************************************************************************
			
		foreach ($test->section->section as $sec){
		$selectionnumber=$sec->selection_ordering->selection->selection_number;
		
	foreach ($sec->selection_ordering->selection->or_selection->selection_metadata as $s) {
//$s2=$s->selection_ordering->selection->or_selection->selection_metadata;
$s=trim($s);

$quids=str_replace("_", "", $s);

		if(isset($questions_ar["$quids"]))
		{
	//$exportlogData.="Quiz " . $quids . " dfff.\n";
		$quiz_p->setPoolQuestions($questions_ar["$quids"]);//Frage in Quiz einfügen
		}
		else
		{
			$exportlogData.="This random question not integrated.\n";
			
		}
		//********************************************************
	}//foreach
	}	

	if($selectionnumber>0)
	{
	
	$aleat=true;
	}
if($sollsein=="true")
		{
		$quiz_ar[]=$quiz;//Quiz in array einfügen
		$quiz_ar_ids["$quizid"]=$quiz;//Quiz in array einfügen
		$sollsein=false;
		}
		$contextid++;
		if($aleat==true)
{
	
	$exportlogData.="Quiz " . $quiz2_demo . " contains random questions.\n";
}
}
}//if isset quiz2
    }//asstype
}//ende foreach .dat 
//************************************************
//************************************************
		//echo "<br>";
				//echo "<br>";
				//echo $zaehler . " Pool questions converted.";
				$questionsnum=count($quiz_ar);
if(count($questionsnum)>0)
{
$exportlogData.="\n";
$exportlogData.=$questionsnum . "  pool quizzes converted.\n";
$exportlogData.="\n";

$exportlogData.="\n";

}
$exportlogData.=$zaehler . "  pool questions converted.\n";
				//echo "<br>";
				//echo "<br>";


?>
