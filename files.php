<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universit�t Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//**************************moodle files xml
$xmlfile2='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile2.="<files>";
$allfiles=count($arr_files);

//***************************************************
for($i=0; $i < count($arr_files); $i++)
{
	$fileid=$arr_files[$i]->getId();
	$filename=$arr_files[$i]->getName();

	$parentid=$arr_files[$i]->getParentId();
	$f2=$arr_files[$i]->getName2();//label NAME in .dat-Datei
	//$exportlogData.="filenamenew: " . $f2 ."\n";
	//kann sein, dass kein XID enthalten ist, sondern direkt der Dateiname angegeben ist. Dann befindet sich die Datei
	//in einem gleichnamigen RES-Ordner
	$section=$arr_files[$i]->getSection();
	$section=$section+$sectionstart;
	//***********************************************
	
	$result=VerzeichnisDurchsuchen3($dir, $f2);

	//********************************************

	$oldname=$result[0];
	$filename_new=$result[1];
//	$exportlogData.="filenamenew: " . $filename_new ."\n";
	
	$pdfcorrupt="0";
	$videocorrupt="0";


	//*********************************************
	$filename_separated=explode(".", $filename_new);
	//$dateiendung="." . $filename_separated[1];
	//************************************MIMETYPE
	if($filename_separated[1]=="pptx")
	{
		$mimetype="application/zip";
	}
	elseif($filename_separated[1]=="pdf")
	{
		$mimetype="application/pdf";
	}
	elseif($filename_separated[1]=="jpg")
	{
		$mimetype="image/jpeg";
	}
	elseif($filename_separated[1]=="mp4")
	{
		$mimetype="video/quicktime";
	}
	elseif($filename_separated[1]=="gif")
	{
		$mimetype="image/gif";
	}
	elseif($filename_separated[1]=="mp3")
	{
		$mimetype="audio/mp3";
	}
	elseif($filename_separated[1]=="png")
	{
		$mimetype="image/png";
	}

	//*********************************************************************************
	/*if(is_file($oldname) && $filename_separated[1]=="pdf")
	{
		/*$fp = fopen($oldname, 'r');

		// move to the 0th byte
		fseek($fp, 0);
		$data = fread($fp, 5);   // read 5 bytes from byte 0
		if(strcmp($data,"%PDF-")==0)
		{
			$pdfcorrupt="0";

		}
		else
		{
			$pdfcorrupt="1";
			$exportlogData.="The PDF File is  corrupted: " . $filename_new .". The file in the course is indicated as brokenfile.png.\n";
			//echo "<br>";
			
		}
		fclose($fp);
	}*/

	if(is_file($oldname) && $filename_separated[1]=="mp4")
	{
		$videocorrupt="1";
		
	}
	//*******************************************
	if(is_file($oldname) && $pdfcorrupt=="0" && $videocorrupt=="0" )
	{

		$temppath=$dir . "/temp/";

		$filename_new=xmlencoding($filename_new);

		//************************

		$newname= $temppath . $filename_new;


		if(is_dir($temppath)){
				
			if(isset($oldname)&&$oldname!=="")
			{
				copy($oldname, $newname);

				//******************************************************Kopieren in HASH-Ordner
				$filesize    = filesize($newname);
				$contenthash = sha1_file($newname);
				$hashpath    = substr($contenthash, 0, 2);
				$hashfilepath=$direxport . "/files/" .$hashpath;

				if(is_dir($hashfilepath))
				{
					 
				}
				else
				{
					mkdir($hashfilepath, 0700);
				}
				$hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
				//echo "hashpath " . $newname;
				//echo "<br>";
				//|| $filename_separated[1]=="pptx" ||$filename_separated[1]=="ppt" ||$filename_separated[1]=="jpg" ||$filename_separated[1]=="png"||$filename_separated[1]=="mp4"
				//if($filename_separated[1]=="pdf")
				copy($newname, $hashfilepath_mit_file);
			}//if isset oldname
		}//if dir temppath
	}
	elseif($videocorrupt=="1")
	{
		$videocorrupt=0;
	}
	else
	{
		$exportlogData.="The file is  not found in the archive: " . $filename_new .". The file in the course is indicated as brokenfile.png.\n";
$arrfiles_not[]=$filename;
		$filename_new="brokenfile.png";
		$oldname="brokenfile.png";
		$temppath=$dir . "/temp/";
		$newname= $temppath . "brokenfile.png";
		$mimetype="image/png";
	
		copy($oldname, $newname);
	 $filesize    = filesize($newname);
	 $contenthash = sha1_file($newname);
	 $hashpath    = substr($contenthash, 0, 2);
	 $hashfilepath=$direxport . "/files/" .$hashpath;

	 if(is_dir($hashfilepath))
	 {
	 	 $hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
	 	copy($newname, $hashfilepath_mit_file);
	 }
	 else
	 {
	 	mkdir($hashfilepath, 0700);
	 	$hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
	 	copy($newname, $hashfilepath_mit_file);
	 }
	
	}
	//************************************************
//***************geh�rt zu folder
if($modus=="onefolder" || $modus=="multiplefolders")
{

$j=0;
$n="";
$pfadvar="";
$pfad_arr=array();

if(isset($parentid))
{
	$p=$parentid;
	
if($parentid!=="")
{

while($p!=="")
{

if(isset($arr["$p"]))
{
	$n=$arr["$p"]->getName();//ArrayFolder mit Schl�ssel folderid;
// kann auch --TOP-- sein
	$pfad_arr[]=$n;
	$p=$arr["$p"]->getParentId();

}
else
{
	break;
}
	
}
//***********************

$s=0;
if(count($pfad_arr)>0)
{
	$s=count($pfad_arr)-1;
	for($j=$s; $j>=0; $j--)
{
	if( $pfad_arr[$j]=="--TOP--")
	{
		//if($j==$s)
		//echo "dsl";
		$pfadvar .="/";
		
	}
	else
	{
		if($j==0)
		{
			$pfadvar .="/" . $pfad_arr[$j] . "/" ;
		}
		else
		{
	$pfadvar .="/" . $pfad_arr[$j];
		}
	}//ende else
	
}//ende for
}//ende if count
}//ende if parent id
}//ende if isset parent id
}
//********************************************



			//**************************
			if($modus=="onefolder")
			{
		
			//foldereintrag
if($pfadvar!=="")
{
	//***********folderIDArray

$folderIDArray[]=$fileid;
	$xmlfile2 .="<file id=\"$fileid\">
    <contenthash>" . $contenthash . "</contenthash>
    <contextid>" . $foldercontextid . "</contextid>
    <component>mod_folder</component>
    <filearea>content</filearea>
    <itemid>0</itemid>
    <filepath>" . $pfadvar . "</filepath>
    <filename>" . $filename_new . "</filename>
    <userid>$@NULL@$</userid>
    <filesize>261002</filesize>
    <mimetype>". $mimetype . "</mimetype>
    <status>0</status>
    <timecreated>1407501144</timecreated>
    <timemodified>1407501146</timemodified>
    <source>$@NULL@$</source>
    <author>$@NULL@$</author>
    <license>$@NULL@$</license>
    <sortorder>1</sortorder>
     </file>";
	}
			}
	elseif($modus=="multiplefolders" && $videocorrupt=="0")
	{
		$mod="mod_folder";
		$contextid_help=$parentid;
		for($z=0;$z<count($helparray_nonfolderfiles); $z++)
		{
			/*echo "fileid " . $fileid;
			echo "<br>";
			echo "helparray " . $helparray_nonfolderfiles[$z];
			echo "<br>";
			*/
			
			
			if($fileid==$helparray_nonfolderfiles[$z])
			{
				
				$mod="mod_resource";
				$contextid_help=$fileid;
				break;
			}
			
		}
		
		//echo $filename_new;
		
		//echo "<br>";
$folderIDArray[]=$fileid;
			$xmlfile2 .="<file id=\"$fileid\">
			<contenthash>" . $contenthash . "</contenthash>
    <contextid>" . $contextid_help . "</contextid>
    <component>" . $mod . "</component>
    <filearea>content</filearea>
    <itemid>0</itemid>
    <filepath>/</filepath>
    <filename>" . $filename_new . "</filename>
    <userid>$@NULL@$</userid>
    <filesize>261002</filesize>
    <mimetype>". $mimetype . "</mimetype>
    <status>0</status>
    <timecreated>1407501144</timecreated>
    <timemodified>1407501146</timemodified>
    <source>$@NULL@$</source>
    <author>$@NULL@$</author>
    <license>$@NULL@$</license>
    <sortorder>1</sortorder>
     </file>";
		}

			
			else 
			{
				if($videocorrupt=="0")
				{
				$xmlfile2 .="<file id=\"$fileid\">
				<contenthash>" . $contenthash . "</contenthash>
    <contextid>" . $fileid . "</contextid>
    <component>mod_resource</component>
    <filearea>content</filearea>
    <itemid>0</itemid>
    <filepath>/</filepath>
    <filename>" . $filename_new . "</filename>
    <userid>$@NULL@$</userid>
    <filesize>" . $filesize . "</filesize>
    <mimetype>". $mimetype . "</mimetype>
    <status>0</status>
    <timecreated>" . $aktuellesdatum . "</timecreated>
    <timemodified>" . $aktuellesdatum . "</timemodified>
    <source>$@NULL@$</source>
    <author>$@NULL@$</author>
    <license>$@NULL@$</license>
    <sortorder>1</sortorder>
     </file>";
				}
			}
}
//*********************************logfiles

//make file, data should be available
$myFile = "exportlog.txt";
$fh = fopen($myFile, 'w') or die("can't open file");

fwrite($fh, $exportlogData);
fclose($fh);
 $filesize    = filesize($myFile);
	 $contenthash = sha1_file($myFile);
	 $hashpath    = substr($contenthash, 0, 2);
	 $hashfilepath=$direxport . "/files/" .$hashpath;

	
		 
	 	mkdir($hashfilepath, 0700);
	 	$hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
	 	copy($myFile, $hashfilepath_mit_file);
		//***************************file xml
	 $fileid="12335679";
	$mimetype="application/txt";
	 $xmlfile2 .="<file id=\"$fileid\">
				<contenthash>" . $contenthash . "</contenthash>
    <contextid>" . $fileid . "</contextid>
    <component>mod_resource</component>
    <filearea>content</filearea>
    <itemid>0</itemid>
    <filepath>/</filepath>
    <filename>" . $myFile . "</filename>
    <userid>$@NULL@$</userid>
    <filesize>" . $filesize . "</filesize>
    <mimetype>". $mimetype . "</mimetype>
    <status>0</status>
    <timecreated>" . $aktuellesdatum . "</timecreated>
    <timemodified>" . $aktuellesdatum . "</timemodified>
    <source>$@NULL@$</source>
    <author>$@NULL@$</author>
    <license>$@NULL@$</license>
    <sortorder>1</sortorder>
     </file>";
	 //**************************************************
	 
	 
//*********************************************************embedded files
//*********************************************************************
include ("fileembedded_label_xml.php");
include ("fileembedded_xml.php");
include ("fileembedded_quiz_xml.php");
include ("fileembedded_quiz_drag_xml.php");
include ("fileembedded_url_xml.php");
//**********************************************************
$xmlfile2.="</files>";
//************************
$file2 = fopen($direxport . "/files.xml","w");
fwrite($file2,$xmlfile2);
fclose($file2);
//*********************************************************************
?>