<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//directories für quizzes

 	 for($i=0; $i<count($survey_ar); $i++)
{
	//*************************************************
	//**************************
	
	$surveyid=$survey_ar[$i]->getId();
	$surveyname=$survey_ar[$i]->getName();
	$contextid=$survey_ar[$i]->getContextId();
	//echo "contextid         " . $contextid . "   categoryid " . $categoryid . "<br><br>";
	
	
	$surveydescription=$survey_ar[$i]->getDescription();
	$surveysectionid=$survey_ar[$i]->getSectionid();
	$surveysectionid=$surveysectionid+$sectionstart;
		//*****************************************************
	$surveypfad=$direxport . "/activities/feedback_" . $surveyid;
	mkdir($surveypfad, 0700);
	//$pfad2= $pfad . "/grades.xml";
	$pfad3= $surveypfad . "/roles.xml";
	//copy("activities_src/grades.xml", $pfad2);
	copy("activities_src/roles.xml", $pfad3);
//****************survey.xml*****************************
	$xmlfile9='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
	$xmlfile9.="<activity id=\"" . $surveyid . "\" moduleid=\"" . $contextid . "\" modulename=\"feedback\" contextid=\"" . $contextid . "\">
  <feedback id=\"" . $surveyid . "\">
    <name>" . $surveyname .  "</name>
    <intro>" . $surveydescription . "</intro>
    <introformat>1</introformat>
 <anonymous>1</anonymous>
<email_notification>0</email_notification>
<multiple_submit>0</multiple_submit>
<autonumbering>0</autonumbering>
<site_after_submit/>
<page_after_submit/>
<page_after_submitformat>1</page_after_submitformat>
<publish_stats>0</publish_stats>
<timeopen>0</timeopen>
<timeclose>0</timeclose>
<timemodified>0</timemodified>
<completionsubmit>0</completionsubmit>
    <items>";
	$surveyitems=$survey_ar[$i]->getItems();
	$zahlderItems=count($surveyitems);
	
	//echo $quizname  . ": " . $zahlderFragen . "<br><br>";
for($j=0;$j<$zahlderItems; $j++)
{
	$surveyantworten=$surveyitems[$j]->getAntworten();
	$surveyitemid=$surveyitems[$j]->getId();
	
	$surveyitemname=$surveyitems[$j]->getQuestiontext();
	$surveyitemname=html_entity_decode ($surveyitemname);
	$surveyitemname=strip_tags($surveyitemname);

	$surveytype=$surveyitems[$j]->getQuestiontype();
	
	if($surveytype=="multichoice")
	{
		$surveytype_single=$surveyitems[$j]->getSingle();
		$ZahlSurveyAntworten=count($surveyantworten);
		if($surveytype_single=="1")
		{
			$surveytext="r>>>>>";
		}
		else
		{
			$surveytext="c>>>>>";
		}
		for($m=0; $m<count($surveyantworten); $m++)
		{
			$surveyantwort=$surveyantworten[$m]->getAnswertext();
			$surveyantwort=html_entity_decode($surveyantwort);
			$surveyantwort=strip_tags($surveyantwort);
			if($m==($ZahlSurveyAntworten-1))
					{
						$surveytext.= $surveyantwort;
					}
					else 
					{
			$surveytext.= $surveyantwort . " |";
					}
		}
	}
	elseif ($surveytype=="essay")
	{
		
		
		$surveytype="textarea";
		$surveytext="30|5";
		
	}
	elseif ($surveytype=="numerical")
	{
	
		$surveytext="30|255";
		$surveytype="textfield";
	
	}
	$xmlfile9.="<item id=\"" . $surveyitemid . "\">
	<template>0</template>
	<name>$surveyitemname</name>
	<label/>
	<presentation>$surveytext</presentation>
	<typ>$surveytype</typ>
	<hasvalue>1</hasvalue>
	<position>1</position>
	<required>0</required>
	<dependitem>0</dependitem>
	<dependvalue/>
	<options>h</options>
	</item>";
}
$xmlfile9.= "</items></feedback><completeds> </completeds></activity>";
$file9 = fopen($surveypfad . "/feedback.xml","w");
fwrite($file9,$xmlfile9);
fclose($file9);


//**********************************************grades.xml
$xmlfile10='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile10.="<activity_gradebook>
 <grade_items> </grade_items>
<grade_letters> </grade_letters>
</activity_gradebook>";
$file10 = fopen($surveypfad . "/grades.xml","w");
fwrite($file10,$xmlfile10);
fclose($file10);
//**************************************************
//**********************************************inforef.xml
$xmlfile11='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile11.="<inforef> </inforef>";
$file11 = fopen($surveypfad . "/inforef.xml","w");
fwrite($file11,$xmlfile11);
fclose($file11);
//**************************************************
//**************************************************
//**********************************************module.xml
$xmlfile12='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile12.="<module id=\"" . $contextid . "\" version=\"" . $surveymoduleversion . "\">
  <modulename>feedback</modulename>
  <sectionid>" . $surveysectionid . "</sectionid>
  <sectionnumber>" . $surveysectionid . "</sectionnumber>
  <idnumber></idnumber>
  <added>0</added>
  <score>0</score>
  <indent>0</indent>
  <visible>1</visible>
  <visibleold>1</visibleold>
  <groupmode>0</groupmode>
  <groupingid>0</groupingid>
 <completion>0</completion>
<completiongradeitemnumber>$@NULL@$</completiongradeitemnumber>
<completionview>0</completionview>
<completionexpected>0</completionexpected>
<availability>$@NULL@$</availability>
<showdescription>1</showdescription>
<tags> </tags>
</module>";
$file12 = fopen($surveypfad . "/module.xml","w");
fwrite($file12,$xmlfile12);
fclose($file12);
}
//******************************************

//******************************************
?>