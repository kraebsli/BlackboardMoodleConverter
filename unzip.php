<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later

 * */

if ($_POST['nochmal']=="1")
{
	$stamprand=mt_rand();
	$versionrand=mt_rand();
	$stamp=$moodleidentifier .$stamprand;
	$version=$moodleidentifier .$versionrand;
	parse($_POST['neuerpfad'], $_POST['neuerpfadexport'], $_POST['uploadfile'], $_POST['dateiname'], $stamp, $version, $_POST['modus1']);
}
else 
{

$dateiname=  $_FILES['bbzipfile']['name'];
$uploadfile = "uploads/" . basename($_FILES['bbzipfile']['name']);
//wird nach exportieren gelöscht
//achtung absolute pfade beim zippen
//echo "Dateiname: " . $_FILES['bbzipfile']['name'];
//echo "<br>";
$dateiname2= explode(".", $dateiname);
$neuerpfad="uploads/" . $dateiname2[0];
if(is_dir($neuerpfad))
{

	rmr($neuerpfad);//
	unlink($uploadfile);
}
mkdir($neuerpfad, 0700);//wird nach export gelöscht
$neuerpfadexport= $neuerpfad . "/export";
mkdir($neuerpfadexport, 0700);//Export directory erzeugen
//**********************************************
$stamprand=mt_rand();
$versionrand=mt_rand();
$stamp=$moodleidentifier .$stamprand;
$version=$moodleidentifier .$versionrand;
//******************************************
if (move_uploaded_file($_FILES['bbzipfile']['tmp_name'], $uploadfile)) {
	echo "Datei ist valide und wurde erfolgreich hochgeladen.\n";
} else {
	echo "Kein Dateiupload\n";
}
echo "<br>";
//*********************************************
//*****************************************************
$destination_dir= $uploaddir .  $neuerpfad;
$zip = new ZipArchive;
$res = $zip->open($uploadfile);
if ($res === TRUE) {
   
    $zip->extractTo($destination_dir);
    $zip->close();
parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, $modus1);
} 
else {
		$myFile = "logs_notok/".basename($file, ".zip"). ".log";
	$fh = fopen($myFile, 'w') or die("can't open file");
$message="Unzip could not be done." . $res;
fwrite($fh, $message);
fclose($fh);
}
/*$archive = new PclZip($uploadfile);
if ($archive->extract(PCLZIP_OPT_PATH, $destination_dir) == 0) {
	die("Unzip failed. Error : ".$archive->errorInfo(true));
}
else
{
	// echo "Successfully extracted files to ".$destination_dir;
	parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, $modus1);
}*/
}
//**************************************************
?>