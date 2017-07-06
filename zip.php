<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//***********************************************ZIP
include("uploaddir.php");
$exportpfad="exports/" . $d;
if ($_POST['nochmal']=="1")
{
	require_once('pclzip.lib.php');	

}

$archive = new PclZip("$exportpfad");
$v_dir = $uploaddir . $direxport; // or dirname(__FILE__);

$v_remove = $v_dir;
// To support windows and the C: root you need to add the
// following 3 lines, should be ignored on linux

$v_list = $archive->create($v_dir, PCLZIP_OPT_REMOVE_PATH, $v_remove);

if ($v_list == 0) {
	die("Error : ".$archive->errorInfo(true));
}
else
{
	echo "<br><br><br><br>";
	echo "Download: <a href=\"". $downloadlink . $d . "\">" . $d . "</a>";
	echo "<br>";
	echo "Diese Datei kann in Moodle wiederhergestellt werden, entweder in einem bestehenden oder einem neuen Kurs.";

	rmr($dir);
	unlink($ulf);
	// rmr("bb-kurs/export/activities");
	//rmr("bb-kurs/temp");
}//ende else
?>