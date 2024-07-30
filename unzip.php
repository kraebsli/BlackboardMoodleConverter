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

// $files = scandir($dir);
  //  $files_n = count($files);
$ndtime=false;
if($bigfiles==false)
{
$exported="exports/".$file;
$limit=5000;
if(is_file($exported))
	//if($assess==false)
{
	echo "already exported.";
	//echo "no questions.";
}
else
{
$uploadfile = "uploads/".$file;

$filesize=filesize($uploadfile);
$filesize2=formatBytes($filesize, $precision = 2);


//**************************************************
//********************************
$dateiname= $file; 
//var_dump ($dateiname);
//$neuerpfad=$file->getFilename();
//if(is_dir($neuerpfad))
//{

	//rmr($neuerpfad);//
	//unlink($file);
//}

$neuerpfad="uploads/unzip/" . $file2;
$neuerpfadexport= $neuerpfad . "/export";
$destination_dir= $neuerpfad;
$stamprand=mt_rand();
$versionrand=mt_rand();
$stamp=$moodleidentifier .$stamprand;
$version=$moodleidentifier .$versionrand;



	//echo "new: " . $file;
	if($ndtime==true)
	{
		rrmdir($neuerpfadexport);

mkdir($neuerpfadexport, 0700);//Export directory erzeugen
parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, "multiplefolders");
	}
	else
	{
		//rrmdir($neuerpfad);
mkdir($neuerpfad, 0700);//wird nach export gelöscht
mkdir($neuerpfadexport, 0700);//Export directory erzeugen

$zip = new ZipArchive;
$res = $zip->open($uploadfile);
if ($res === TRUE) {
   
    $zip->extractTo($destination_dir);
    $zip->close();
	parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, "multiplefolders");
} else {
   $myFile = "logs_notok/".basename($file, ".zip"). ".log";
	$fh = fopen($myFile, 'w') or die("can't open file");

fwrite($fh, "Unzip could not be done.");
fclose($fh);
	
}//ifrestrue
	}


//	$files = scandir($neuerpfad);
  //$files_n = count($files);
  /*if($files_n>4)
  {
	parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, "multiplefolders");
  }
  else
  {
	/*  $zip = new ZipArchive;
$res = $zip->open($uploadfile);
if ($res === TRUE) {
   
    $zip->extractTo($destination_dir);
    $zip->close();
	parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, "multiplefolders");
} else {
      $myFile = "logs_notok/".basename($file, ".zip"). ".log";
	$fh = fopen($myFile, 'w') or die("can't open file");

fwrite($fh, "Unzip could not be done.");
fclose($fh);
}
  }*/



//if else
//**********************************************
}//if is file exported
}//end big files false


//******************************************
/*if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	echo "Datei ist valide und wurde erfolgreich hochgeladen.\n";
} else {
	echo "Kein Dateiupload\n";
}
echo "<br>";*/
//*********************************************
//*****************************************************



//$archive = new PclZip($uploadfile);
/*if ($archive->extract(PCLZIP_OPT_PATH, $destination_dir) == 0) {
	$myFile = "logs_notok/".basename($file, ".zip"). ".log";
	$fh = fopen($myFile, 'w') or die("can't open file");

fwrite($fh, "Unzip could not be done.");
fclose($fh);
	die("Unzip failed. Error : ".$archive->errorInfo(true));
	

}
else
{
	// echo "Successfully extracted files to ".$destination_dir;
parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, "multiplefolders");
	
}*/
//**************************************************
if($bigfiles==true)
{
$exported="exports/".$file .".zip";

if(is_file($exported))
{
	echo "already exported bigfiles.";
}
else
{
	
$uploadfile = "uploads/".$file;


//**************************************************
//********************************
$dateiname= $file .".zip"; 

$neuerpfad="uploads/unzip/" . $file;
$neuerpfadexport= $neuerpfad . "/export";
$destination_dir= $neuerpfad;
$stamprand=mt_rand();
$versionrand=mt_rand();
$stamp=$moodleidentifier .$stamprand;
$version=$moodleidentifier .$versionrand;

if($ndtime==true)
	{
		rrmdir($neuerpfadexport);

mkdir($neuerpfadexport, 0700);//Export directory erzeugen
parse($neuerpfad, $neuerpfadexport, $uploadfile, $dateiname, $stamp, $version, "multiplefolders");
	}



}
}//end big files false
function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
}

function formatBytes($size, $precision = 2)
{
    $base = $size/1024;
	$base=$base/1024;
    $suffixes = array('', 'K', 'M', 'G', 'T');   
	return round($base, $precision);

   // return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}
?>