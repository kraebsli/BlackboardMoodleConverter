<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//$modus1= $_POST['var'];

//@ini_set("memory_limit",'8232M');
set_time_limit (0);
error_reporting(E_ALL & ~E_NOTICE);
include("uploaddir.php");
include("functions.php");

$bigfiles=false;

if($bigfiles==false)
{
$file = $argv[1];
$file2=basename($file, ".zip");
register_shutdown_function('shutdownFunction', $file2);
}
else{
		$file = basename($argv[1]);
		register_shutdown_function('shutdownFunction', $file);
}
//$manifest = "uploads/unzip/" . $file2 ."/imsmanifest.xml"; //directory
/*$daten2 = simplexml_load_file($manifest, "SimpleXMLIterator");//run through all .dat files
$sxi = new RecursiveIteratorIterator(
		$daten2,
		RecursiveIteratorIterator::SELF_FIRST);

$assess=false;
foreach($sxi as $resource) {
	if($resource['type']=="assessment/x-bb-qti-pool" || $resource['type']=="assessment/x-bb-qti-test")
	{
		$assess=true;
	break;
	
	}
}*/
		

//echo "<h1>Convert BB TO MOODLE - no way back</h1>";
//echo "<br>";

include_once("unzip.php");

//*****************************************************************
 function parse($dir, $direxport, $ulf, $d, $stamp, $version, $modus)
 {
 	/*echo "<form method=\"post\" action=\"parse.php\">";
 	echo "<input type=\"hidden\" name=\"nochmal\" value=\"1\">";
 	echo "<input type=\"hidden\" name=\"neuerpfad\" value=\"" . $dir . "\">";
 	echo "<input type=\"hidden\" name=\"neuerpfadexport\" value=\"" . $direxport . "\">";
 	echo "<input type=\"hidden\" name=\"uploadfile\" value=\"" . $ulf . "\">";
 	echo "<input type=\"hidden\" name=\"dateiname\" value=\"" . $d . "\">";
 	echo "<input type=\"hidden\" name=\"modus1\" value=\"" . $modus . "\">";*/
 	
 	$modus="multiplefolders";
include("config.php");
include_once("folder.php");
include_once("file.php");
include_once("fileembedded.php");
include_once("fileembedded_quiz.php");
include_once("fileembedded_quiz_drag.php");
include_once("page.php");
include_once("wiki.php");
include_once("wikipage.php");
include_once("label.php");
include_once("link.php");
include_once("survey.php");
include_once("sectiondata.php");
include_once("regex.php");
//*******************************************************************************
include("manifest-bb-data.php");

if($iter==true){
	
	//$modus="multiplefolders";
}
//coursetitle
//***********************************************************
$datfiletitle= $dir . "/res00001.dat"; //title
$res_title=simplexml_load_file($datfiletitle);
$title=$res_title->TITLE;
$title=$title['value'];
	//Shortname
	$shortname=$res_title->COURSEID;
	$shortname=$shortname['value'];
	//$exportlogData.= $aktuellesdatum ."\n";
$exportlogData.= $title ."\n";
if($title!="")
{
	$coursetitle=$title;
	$courseshortname=$shortname;
	$coursecontextid=$original_course_contextid;

}
else
{
	$coursecontextid=$original_course_contextid;
	$coursetitle=$neuerpfad;
	$courseshortname=$coursetitle;
}
//***************************************************
include("banner.php");
//include_once("files-bb-data.php");

//******************************************************
//***********************************************Questions
 include("questions.php");
 include("questions2.php");
 include("surveyitems.php");
//*********************************************************
 include("pages-links-bb-data.php");
include("quiz_options.php");
 //***********************************
$filenumber= count($arr_files);

		//**************************************

	
include("moodle-backup.php");
 $exportlogData.= "You  get " . $sectionzaehler . " sections in Moodle with this course and " . $filenumber . " files.\n";

     

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
include("activity-wiki.php");
//*********************links
include("link_xml.php");
//******************************labels
include("label_xml.php");
include("survey_xml.php");
//******************************

//Sections
//recurse_copy("moodle_src/sections",$direxport . "/sections");
include("section.php");
//**************************************************************
//Course
recurse_copy("moodle_src/course",$direxport . "/course");

  copy("moodle_src/gradebook.xml",$direxport . "/gradebook.xml" );
  copy("moodle_src/groups.xml",$direxport . "/groups.xml" );
  copy("moodle_src/outcomes.xml",$direxport . "/outcomes.xml");
   
  copy("moodle_src/roles.xml",$direxport . "/roles.xml");
  copy("moodle_src/scales.xml",$direxport . "/scales.xml");
  copy("moodle_src/users.xml",$direxport . "/users.xml" );
 //***********************************************************
 //echo "<br>";
//echo "you will get " . $sectionzaehler . " sections in Moodle with this course and " . $allfiles . " files.";
include("files.php");
include("logdata.php"); 
include("activity-resource-log.php");  
include("zip.php");
//**************************************


//*****************************************************
/*echo "<br>";
echo "<br>";
echo "<br>";
echo "Submit only if you corrected matching questions.";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<INPUT TYPE=\"submit\" name=\"submit\" />";
echo "</form>";*/
//**************************************


   }//ende function parse
   
   //**************************************************
   //***************************************************
   //****************************************************

?>
