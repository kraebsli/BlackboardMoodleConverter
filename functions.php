<?php

/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
/**
 * Try to generates cryptographically secure pseudo-random bytes.
 *
 * Note this is achieved by fallbacking between:
 *  - PHP 7 random_bytes().
 *  - OpenSSL openssl_random_pseudo_bytes().
 *  - In house random generator getting its entropy from various, hard to guess, pseudo-random sources.
 *
 * @param int $length requested length in bytes
 * @return string binary data
 */
function random_bytes_emulate($length) {
	global $CFG;
	if ($length <= 0) {
		debugging('Invalid random bytes length', DEBUG_DEVELOPER);
		return '';
	}
	if (function_exists('random_bytes')) {
		// Use PHP 7 goodness.
		$hash = @random_bytes($length);
		if ($hash !== false) {
			return $hash;
		}
	}
	if (function_exists('openssl_random_pseudo_bytes')) {
		// For PHP 5.3 and later with openssl extension.
		$hash = openssl_random_pseudo_bytes($length);
		if ($hash !== false) {
			return $hash;
		}
	}

	// Bad luck, there is no reliable random generator, let's just hash some unique stuff that is hard to guess.
	$hash = sha1(serialize($CFG) . serialize($_SERVER) . microtime(true) . uniqid('', true), true);
	// NOTE: the last param in sha1() is true, this means we are getting 20 bytes, not 40 chars as usual.
	if ($length <= 20) {
		return substr($hash, 0, $length);
	}
	return $hash . random_bytes_emulate($length - 20);
}

function random_string($length=15) {
	$randombytes = random_bytes_emulate($length);
	$pool  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$pool .= 'abcdefghijklmnopqrstuvwxyz';
	$pool .= '0123456789';
	$poollen = strlen($pool);
	$string = '';
	for ($i = 0; $i < $length; $i++) {
		$rand = ord($randombytes[$i]);
		$string .= substr($pool, ($rand%($poollen)), 1);
	}
	return $string;
}
function make_unique_id_code($extra = '') {

	$hostname = 'unknownhost';
	if (!empty($_SERVER['HTTP_HOST'])) {
		$hostname = $_SERVER['HTTP_HOST'];
	} else if (!empty($_ENV['HTTP_HOST'])) {
		$hostname = $_ENV['HTTP_HOST'];
	} else if (!empty($_SERVER['SERVER_NAME'])) {
		$hostname = $_SERVER['SERVER_NAME'];
	} else if (!empty($_ENV['SERVER_NAME'])) {
		$hostname = $_ENV['SERVER_NAME'];
	}

	$date = gmdate("ymdHis");

	$random =  random_string(6);

	if ($extra) {
		return $hostname .'+'. $date .'+'. $random .'+'. $extra;
	} else {
		return $hostname .'+'. $date .'+'. $random;
	}
}

function rmr($dir) {
    // Wenn der Input ein Ordner ist, dann ÃœberprÃ¼fung des Inhaltes beginnen
    if (is_dir($dir)) {
        // Ordnerinhalt auflisten und jedes Element nacheinander Ã¼berprÃ¼fen
        $dircontent=scandir($dir);
        foreach ($dircontent as $c) {
            // Wenn es sich um einen Ordner handelt, die Funktion rmr(); aufrufen
            if ($c!='.' and $c!='..' and is_dir($dir.'/'.$c)) {
                rmr($dir.'/'.$c);
            // Wenn es eine Datei ist, diese lÃ¶schen
            } else if ($c!='.' and $c!='..') {
                unlink($dir.'/'.$c);
            }
        }
        // Den nun leeren Ordner lÃ¶schen
        rmdir($dir);
    // Wenn es sich um eine Datei handelt, diese lÃ¶schen
    } else {
        unlink($dir);
    }
}
//********************************
function VerzeichnisDurchsuchen($f2, $dir)
{

	if ($handle = opendir("$dir")) {
   

    /* Das ist der korrekte Weg, ein Verzeichnis zu durchlaufen. */
    while (false !== ($file = readdir($handle))) {
   
      $pos1 = strpos($file, "xml");
      if($pos1===false)
        	{
        		{
        		
        	$pos = strpos($file, $f2);
        	if($pos===false)
        	{
        		
        	}
        	else
        	
        		return $file;
        		break;
        	}
        	}
    }

 

    closedir($handle);
}
	

}
//*********************************************
function VerzeichnisDurchsuchen2($dir, $xid)
{
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::SELF_FIRST);
$names=array();
foreach($objects as $name => $object){
	if($object->isDir())
	{
		
	}
	else 
	{
		 $pos1 = strpos($name, "xml");
      if($pos1===false)
      {
		 //echo "$name\n";
		  $pos2 = strpos($name, $xid);
		    if($pos2===false)
      {
      	
      }
      else 
      {
		$xid="__" . $xid;
         $filename_new=str_replace ($xid, "", $object->getFilename());
         $path=$object->getPath();
         
         $path2=explode("home_dir/",$path);//für dateien, die in einem weiteren verzeichnis liegen
         if(isset($path2[1]) && $path2[1]!=="")
         {
         	 //echo "path. " . $path2[1];
         	 $t1=$object->getFilename();//mit xid
         	 $names[0]=$path2[1] . "/" . $t1; //am anfang auch mit slash
         	 $names[1]=$filename_new;
         }
         else 
         {
        
       
         $names[0]=$object->getFilename();
        
          $names[1]=$filename_new;
         
         }
       
         break;
         
      }
      }
	}
   
}
return $names;
}
//************************************************
function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
function getParentid($id, $ar)
{
	
	$p=$ar["$id"]->getParentId();
	$n=$ar["$id"]->getName();
	//$ar2[]=$n;
	
	if( $n !=="--TOP--" && $p!=="")
	{
		//echo "parentid: " . $p;
		//echo "<br>";
		getParentid($p, $ar);
	}
	return $n;
}

function mainfolders($p)
{

if($p =="--TOP--")
{
return true;
	
}
}
function checkParentid($parentid, $ar, $arfolder)//ar mit sectionobjects
{

	$ptrue=false;
	for($i=0; $i<count($ar); $i++)
	{
		
		$parentid2=trim($ar[$i]->getParentId());
		
		$parentid=trim($parentid);
			if($parentid==$parentid2)
		{
		
			$p=$parentid;
			$ptrue=true;
			$sectionid=$ar[$i]->getId();
			break;
		}
		
	}
	$p=$parentid;
		
	while($ptrue!==true)
{

		$p=trim($arfolder["$p"]->getParentId());
for($i=0; $i<count($ar); $i++)
	{
		$parentid2=$ar[$i]->getParentId();
		if($p==$parentid2)
		{
			$ptrue=true;
			$sectionid=$ar[$i]->getId();
			break;
		}
				
	}
	
}
	//****************sectionobject finden

	return $sectionid;
}
function xmlencoding($var)
{

$var=preg_replace('/&nbsp;/', " ", $var);
$var=preg_replace('/&(?!apos;)(?!#39;)(?!lt;)(?!gt;)(?!quot;)/', 'und', $var);
$var=preg_replace("/'/", "&apos;", $var);
$var=preg_replace('/"/', "&quot;", $var);
$var=preg_replace('/</', "&lt;", $var);
$var=preg_replace('/>/', "&gt;", $var);

return $var;
}
//******************************durchsuchen des gesamten verzeichnisbaums, xid- und non-xid-dateien
function VerzeichnisDurchsuchen3($dir, $xid)
{

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::SELF_FIRST);
$names=array();
foreach($objects as $name => $object){
	if($object->isDir())
	{
		
	}
	else 
	{
		//****************************

	$pos1 = strpos($name, "xml");//ohne endung xml
      if($pos1===false)
      {
      	
		$xid=trim($xid);
		  
		$pos2 = strpos($name, $xid);//kommt dateiname vor?
	
		    if($pos2===false)
      {
      	  
      }
      else 
      {

      	$pos3= strpos($name, "__");//ist xidzusatz enthalten?
      	if($pos3===false)
      	{
        
         $names[0]=$name;//pfad zur originaldatei
        
          $names[1]=$object->getFilename();
      	
      	  break;
      	}
      	else 
      	{
      	$xid="__" . $xid;
      
         $filename_new=str_replace ($xid, "", $object->getFilename());//xid-zusatz wird entfernt
        $filename_new=trim($filename_new);
  
        	 $names[0]=$name;//pfad zur originaldatei
        
         	 $names[1]=$filename_new;//Dateiname
         //************************************************
      break;
         //*****************************************************
       
         
      	}
      }
}
}
}
//$names[1]=utf8_decode($names[1]);
/*$names[1]=utf8_decode($names[1]);
$names[1]=str_replace("ä", "ae", $names[1]);
$names[1]=str_replace("ü", "ue", $names[1]);
$names[1]=str_replace("ö", "oe", $names[1]);
$names[1]=str_replace("Ä", "Ae", $names[1]);
$names[1]=str_replace("Ü", "Ue", $names[1]);
$names[1]=str_replace("Ö", "Oe", $names[1]);
$names[1]=str_replace("ß", "ss", $names[1]);*/
//echo $names[1];
//echo "<br>";
return $names;
}
//***********************************************************

function items($it, $di, $arr_p, $arr_p2,$secz,$start)
{
	
	$returnarray=array();
	if($start!=="")
	{
		$item=$it->item;
		
	}
	else 
	{
		$item=$it->children();
	}
	//********************************************
	$dir=$di;
	//global $arr_parentids;
	//global $arr_parentids_2;
	//global $sectionzaehler;
	foreach ($item as $item1)
	{
		$itemident=trim($item1['identifierref']);
		if(isset($itemident) && $itemident!=="")
		{
			
			$itemdat=$dir . "/" . $itemident . ".dat"; //directory
			$item_single=simplexml_load_file($itemdat);
			$folderflag=$item_single->FLAGS->ISFOLDER;
			$available=$item_single->FLAGS->ISAVAILABLE;
			$available=$available['value'];
			if($folderflag['value']=="true")
			{
	if($start!=="")
	{
		$foldertitle=$start;
		$start="";
	}
	else 
	{
				$foldertitle=$item_single->TITLE;
				$foldertitle=$foldertitle['value'];
	}
	//*********************************************
				if(preg_match("`^.*(http|//|<).*`", $foldertitle)){
						
				}
				elseif(preg_match("`^(divider|placeholder).*`", $foldertitle))
				{
						
				}//if pregmatch
				else
				{
					$contentid=$item_single['id'];
					$contentid = preg_replace('![^0-9]!', '', $contentid); //ersetze alles außer 0 bis 9
					//$hasfolder=true;
					//*******************************************
					
					$sectionitem= new sectiondata($secz, $foldertitle, $contentid);
					
					 $arr_p[]=$sectionitem;
					$arr_p2[]=$contentid;
				
					// $returnarray[0]=$arr_p;
 					 //$returnarray[1]=$arr_p2;
					 //$returnarray[2]=$secz;
					 $secz++;
					
				}//if pregmatch
			}//folderflag
			
		}//itemident
		//*************************************************
		if(count($item1->children())>0)
		{
			
			//$r=items($item1, $dir, $arr_p, $arr_p2,$secz, "");
			
			
				/*if(count($r)>0)
				{
					
				$arr_p=$r[0];
				$arr_p2=$r[1];
				$secz=$r[2];
				$returnarray[0]=$arr_p;
				$returnarray[1]=$arr_p2;
				$returnarray[2]=$secz;
				$r="";
				}*/
				
			
		}
		
			
		
		
	}//foreach
	//$returnarray=array();
	$returnarray[0]=$arr_p;
	$returnarray[1]=$arr_p2;
	$returnarray[2]=$secz;
	return $returnarray;
}
function singleItem($item2, $di, $arr_p, $arr_p2,$secz,$start)
{
	$foldertitle=$start;
	$dir=$di;
	foreach ($item2 as $item1)
	{
	$itemident=trim($item1['identifierref']);
	if(isset($itemident) && $itemident!=="")
	{
			
		$itemdat=$dir . "/" . $itemident . ".dat"; //directory
		$s=loadItem($itemdat, $secz);
		$contentid=$s->getParentId();
				$arr_p[]=$s;
				$arr_p2[]=$contentid;
				$returnarray[0]=$arr_p;
				$returnarray[1]=$arr_p2;
				$returnarray[2]=$secz;
				
			
		}//folderflag
			
	}//itemident
	//*************************************************

	
	return $returnarray;
}

function loadItem($itemdat, $secz)
{
	$item_single=simplexml_load_file($itemdat);
	$folderflag=$item_single->FLAGS->ISFOLDER;
	$available=$item_single->FLAGS->ISAVAILABLE;
	$available=$available['value'];
	if($folderflag['value']=="true")
	{
	
		$foldertitle=$item_single->TITLE;//ist auf der ersten Ebene TOP
		$foldertitle=$foldertitle['value'];
		if(preg_match("`^.*(http|//|<).*`", $foldertitle)){
		
		}
		elseif(preg_match("`^(divider|placeholder).*`", $foldertitle))
		{
		
		}//if pregmatch
		else
		{
		//*********************************************
	
		$contentid=$item_single['id'];
		$contentid = preg_replace('![^0-9]!', '', $contentid); //ersetze alles außer 0 bis 9
		//$hasfolder=true;
		//*******************************************
			
		$sectionitem= new sectiondata($secz, $foldertitle, $contentid);

		return $sectionitem;
		}
	}
}
function checkParentid2($parentid,  $arfolder)//ar mit sectionobjects
{



	if(isset($arfolder["$parentid"]))
	{
			
		$sectionid=$arfolder["$parentid"]->getId();
			
			
	}
	else
	{
		foreach($arfolder as $value)
		{
			$p2=$value->getOtherSections();
			for($i=0;$i<count($p2);$i++)
			{
			if($p2[$i][0]==$parentid)
			{

			$sectionid=$value->getId();
			break;
			}
			}
			}
				
				



	}
	//****************sectionobject finden

	return $sectionid;
}
function otherSection($parentid,  $arfolder, $arrinter)//ar mit sectionobjects
{

$ids=array();

	if(isset($arfolder["$parentid"]))
	{
			
		$ids="";
			
		
	}
	else
	{
		
		foreach($arfolder as $value)//value is section
		{
			
			$p2=$value->getOtherSections();
			for($i=0;$i<count($p2);$i++)
			{
				if($p2[$i][0]==$parentid)//new section identified
				{
					
				for($t=0;$t<count($arrinter); $t++)
				{
					
					$parentid_inter=$arrinter[$t]->getParentid();//parentid of new headline
					if($parentid_inter==$parentid)
					{
				
					$id_inter=$arrinter[$t]->getId();
					$ids[]=	$id_inter;
					//echo "idinter" . $id_inter;
					//echo "<br>";
					$parentid_section=$value->getParentId();
					$ids[]=	$parentid_section;
					//echo "        parentid_section" . $parentid_section;
					//echo "<br>";
					break;
					}
				}
				}
			}
		}
}
	//****************sectionobject finden

	return $ids;
}
?>