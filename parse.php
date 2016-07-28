<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$modus1= $_POST['var'];
@ini_set("memory_limit",'4116M');
set_time_limit (0);
include("uploaddir.php");
include("functions.php");
echo "<h1>Convert BB TO MOODLE - no way back</h1>";
echo "<br>";
include("unzip.php");
//*****************************************************************
 function parse($dir, $direxport, $ulf, $d, $stamp, $version, $modus)
 {
 	echo "<form method=\"post\" action=\"parse.php\">";
 	echo "<input type=\"hidden\" name=\"nochmal\" value=\"1\">";
 	echo "<input type=\"hidden\" name=\"neuerpfad\" value=\"" . $dir . "\">";
 	echo "<input type=\"hidden\" name=\"neuerpfadexport\" value=\"" . $direxport . "\">";
 	echo "<input type=\"hidden\" name=\"uploadfile\" value=\"" . $ulf . "\">";
 	echo "<input type=\"hidden\" name=\"dateiname\" value=\"" . $d . "\">";
 	echo "<input type=\"hidden\" name=\"modus1\" value=\"" . $modus . "\">";
 	
 	
include("config.php");
include("folder.php");
include("file.php");
include("fileembedded.php");
include("fileembedded_quiz.php");
include("fileembedded_quiz_drag.php");
include("page.php");
include("label.php");
include("link.php");
include("sectiondata.php");
include("regex.php");
//*******************************************************************************
include("manifest-bb-data.php");

//coursetitle
//***********************************************************
$datfiletitle= $dir . "/res00001.dat"; //title
$res_title=simplexml_load_file($datfiletitle);
$title=$res_title->LABEL;
$title=$title['value'];
if($title!="")
{
	$coursetitle=$title;
	$courseshortname=$coursetitle;
	$coursecontextid=$original_course_contextid;
}
else
{
	$coursecontextid=$original_course_contextid;
	$coursetitle=$neuerpfad;
	$courseshortname=$coursetitle;
}
include("banner.php");
include("files-bb-data.php");

//******************************************************
//***********************************************Questions
 include("questions.php");
 include("poolquizzes.php");
//*********************************************************
 include("pages-links-bb-data.php");
 //***********************************
$filenumber= count($arr_files);

		//**************************************

	
include("moodle-backup.php");
 
        
include("files.php");
//ACTIVITIES****************************************************************
//***********************directories für activities*************************
mkdir($direxport . "/activities", 0700);
if($modus == "onefolder")
{
	
	include("activity-folder.php");
}
elseif($modus=="multiplefolders")
{

	include("activity-folders.php");
}
else 
{
	include("activity-resource.php");
}

include("questions_xml.php");
include("quiz_xml.php");

//****************************************************
include("activity-page.php");
//*********************links
include("link_xml.php");
//******************************labels
include("label_xml.php");

//******************************
//Sections
recurse_copy("moodle_src/sections",$direxport . "/sections");
include("section.php");
//**************************************************************
//Course
recurse_copy("moodle_src/course",$direxport . "/course");

  copy("moodle_src/gradebook.xml",$direxport . "/gradebook.xml" );
  copy("moodle_src/groups.xml",$direxport . "/groups.xml" );
  copy("moodle_src/outcomes.xml",$direxport . "/outcomes.xml");
   
  copy("moodle_src/roles.xml",$direxport . "/roles.xml");
  copy("moodle_src/scales.xml",$direxport . "/scales.xml");
 //***********************************************************

include("zip.php");
echo "<br>";
echo "<INPUT TYPE=\"submit\" name=\"submit\" />";
echo "</form>";
   }//ende function parse
   
   //**************************************************
   //***************************************************
   //****************************************************

?>
