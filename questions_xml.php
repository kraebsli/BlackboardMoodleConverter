<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//*******************questions.xml
//*************************************************************************
$stamp= make_unique_id_code();

$xmlfileques="<question_categories>";
for($i=0; $i<count($quiz_ar); $i++)
{
	$quizid=$quiz_ar[$i]->getId();
	$categoryname=$quiz_ar[$i]->getName();
$categoryid=$quiz_ar[$i]->getCategoryId();
	$contextid=$quiz_ar[$i]->getContextId();
	$quizdescription=$quiz_ar[$i]->getDescription();
	$xmlfileques.="<question_category id=\"" . $categoryid . "\">
<name>" . $categoryname . "</name>
<contextid>" . $contextid . "</contextid>";
	$xmlfileques.="<contextlevel>50</contextlevel>
<contextinstanceid>999</contextinstanceid>
<info>" . $quizdescription. "</info>
<infoformat>1</infoformat>
<stamp>". $stamp . "</stamp>
<parent>0</parent>
<sortorder>999</sortorder>";

	//**************************************questions************************
	//**************************************************************************
	$questions=$quiz_ar[$i]->getQuestions();
	if(count($questions)>0)
	{
	$xmlfileques.="
<questions>";
	

	for($j=0;$j<count($questions); $j++)
	{
		$quid=$questions[$j]->getId();
		$quname=$questions[$j]->getQuestiontext();
		$qutype=$questions[$j]->getQuestiontype();
		$qutitle=$questions[$j]->getTitle();
	
		$qudefaultmark=sprintf("%1\$.7f", $questions[$j]->getDefaultmark());
		//***************************************************************
		//******************Fragetypen************************************
if($qutype=="multichoice")
{
include("multichoice_xml.php");
	}//ifqtype
	elseif ($qutype=="truefalse")
{
	include("truefalse_xml.php");
	}//ifqtype
	//*****************************************
elseif ($qutype=="shortanswer")
{
	include("shortanswer_xml.php");
	}//ifqtype
	//****************************************************
elseif ($qutype=="essay")
{

	include("essay_xml.php");
	}//ifqtype
	//****************************************************
elseif ($qutype=="match")
{
		include("match_xml.php");
	}//ifqtype
	//****************************************************
	//****************************************************
elseif ($qutype=="multianswer")
{
	include("multianswer_xml.php");
	}//ifqtype
	elseif ($qutype=="ddmarker")
	{
	include("hotspot_xml.php");
	}
	//************************************************************************
	elseif ($qutype=="numerical")
	{
	include("numerical_xml.php");
}
}//ende for questions
//****************************************************
//****************************************************
//****************************************************
$xmlfileques.= "</questions>";
	}
	else 
	{
		$xmlfileques.="
<questions></questions>";
	}
$xmlfileques.="</question_category>";
}
//*********************Fragen aus poolmix*****************************************
//********************************************************************************
if(count($quiz_ar2)>0){

for($i=0; $i<count($quiz_ar2); $i++)
{
	//$frageimSatz=false;

	$questions=$quiz_ar2[$i]->getQuestions();
	/*for($j=0;$j<count($questions); $j++)
	{
		$frageimSatz=$questions[$j]->getFrageimSatz();
		if($frageimSatz==true)
		{
			$j=count($questions);
		}
	}*/
	//if($frageimSatz==true){
	$quizid=$quiz_ar2[$i]->getId();
	$categoryname=$quiz_ar2[$i]->getName();
	$categoryid=$quiz_ar2[$i]->getCategoryId();
	echo "ssss" . $i;
	echo "<br>";
	$contextid=$quiz_ar2[$i]->getContextId();
	$quizdescription=$quiz_ar2[$i]->getDescription();
	$xmlfileques.="<question_category id=\"" . $categoryid . "\">
<name>" . $categoryname . "</name>
<contextid>" . $contextid . "</contextid>";
	$xmlfileques.="<contextlevel>50</contextlevel>
<contextinstanceid>999</contextinstanceid>
<info>" . $quizdescription. "</info>
<infoformat>1</infoformat>
<stamp>". $stamp . "</stamp>
<parent>0</parent>
<sortorder>999</sortorder>";
	if(count($questions)>0)
	{
$xmlfileques.="
<questions>";
	//}//if frageimSatz
	//**************************************questions************************
	//**************************************************************************
$j=0;

	for($j=0;$j<count($questions); $j++)
	{
		if($questions[$j]->getFrageimSatz()==true)
		{
		$quid=$questions[$j]->getId();
		$quname=$questions[$j]->getQuestiontext();
		
		$qutype=$questions[$j]->getQuestiontype();
		$qutitle=$questions[$j]->getTitle();

		$qudefaultmark=sprintf("%1\$.7f", $questions[$j]->getDefaultmark());
		//***************************************************************
		//******************Fragetypen************************************
		if($qutype=="multichoice")
		{
			include("multichoice_xml.php");
		}//ifqtype
		elseif ($qutype=="truefalse")
		{
			include("truefalse_xml.php");
		}//ifqtype
		//*****************************************
		elseif ($qutype=="shortanswer")
		{
			include("shortanswer_xml.php");
		}//ifqtype
		//****************************************************
		elseif ($qutype=="essay")
		{

			include("essay_xml.php");
		}//ifqtype
		//****************************************************
		elseif ($qutype=="match")
		{
			include("match_xml.php");
		}//ifqtype
		//****************************************************
		//****************************************************
		elseif ($qutype=="multianswer")
		{
			include("multianswer_xml.php");
		}//ifqtype
		elseif ($qutype=="ddmarker")
		{
			include("hotspot_xml.php");
		}
		//************************************************************************
		elseif ($qutype=="numerical")
		{
			include("numerical_xml.php");
		}
	}//ende if
	//****************************************************
	//****************************************************
	//****************************************************
	
	}//ende for questions
	//if($frageimSatz==true){
	$xmlfileques.= "</questions>";
	}
	else 
	{
		$xmlfileques.="
<questions></questions>";
	}
	$xmlfileques.="</question_category>";
	//}
}//for quiz pool
}
//*********************************************************************************
$xmlfileques.="</question_categories>";
//******************************************
//************************
$filequ = fopen($direxport . "/questions.xml","w");//directory
fwrite($filequ,$xmlfileques);
fclose($filequ);

?>