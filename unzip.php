<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 
 * */


//$dateiname=  $_FILES['bbzipfile']['name'];
//$uploadfile = "uploads/" . basename($_FILES['bbzipfile']['name']);
//wird nach exportieren gelöscht
//achtung absolute pfade beim zippen
//echo "Dateiname: " . $_FILES['bbzipfile']['name'];
//echo "<br>";
$v=0;
rmr("upload2/");
mkdir("upload2/", 0755);
foreach(glob('uploads/'.'*.*') as $file) {
$v++;
$uploadfile = $file;


$dateiname= basename($file); 
//var_dump ($dateiname);
//$neuerpfad=$file->getFilename();
//if(is_dir($neuerpfad))
//{

	//rmr($neuerpfad);//
	//unlink($file);
//}

$neuerpfad="upload2/" . $v;
$neuerpfadexport= $neuerpfad . "/export";
mkdir($neuerpfad, 0700);//wird nach export gelöscht
mkdir($neuerpfadexport, 0700);//Export directory erzeugen
//**********************************************
$stamprand=mt_rand();
$versionrand=mt_rand();
$stamp=$moodleidentifier .$stamprand;
$version=$moodleidentifier .$versionrand;
//******************************************
/*if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	echo "Datei ist valide und wurde erfolgreich hochgeladen.\n";
} else {
	echo "Kein Dateiupload\n";
}
echo "<br>";*/
//*********************************************
//*****************************************************
$destination_dir= $neuerpfad;
//***************************************************
$zip = new ZipArchive;
$res = $zip->open($uploadfile);
if ($res === TRUE) {
   
    $zip->extractTo($destination_dir);
    $zip->close();
	parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, "multiplefolders");
} else {
		$myFile = "logs_notok/".basename($file, ".zip"). ".log";
	$fh = fopen($myFile, 'w') or die("can't open file");
$message="Unzip could not be done." . $res;
fwrite($fh, $message);
fclose($fh);
    //echo 'failed, code:' . $res;
}//*********************************************************
/*$archive = new PclZip($uploadfile);
if ($archive->extract(PCLZIP_OPT_PATH, $destination_dir) == 0) {
	die("Unzip failed. Error : ".$archive->errorInfo(true));
}
else
{
	// echo "Successfully extracted files to ".$destination_dir;
	
parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, "multiplefolders");
	
}*/
//**************************************************
}

?>