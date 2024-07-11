<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//***********************************************ZIP
include("uploaddir.php");


$zipfile="exports/". $d;
$tozip = $direxport;
zipData($tozip, $zipfile);

	echo "<br><br><br><br>";
	echo "Download: <a href=\"". $downloadlink . $d . "\">" . $d . "</a>";
	echo "<br>";
	echo "This file can be restored as a Moodle course.";

	rmr($dir);
	unlink($ulf);
	// rmr("bb-kurs/export/activities");
	//rmr("bb-kurs/temp");
//ende else
?>