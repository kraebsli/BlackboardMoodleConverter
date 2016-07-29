<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
// three components form bb: manifest file, dat-files, files
$xml_feed_url = $dir . "/imsmanifest.xml"; //directory
$bbfilepath=$dir . "/csfiles/home_dir/";
$temppath=$dir . "/temp/";
mkdir($temppath, 0700);
mkdir($direxport . "/files", 0700);
//****************************
$daten = simplexml_load_file($xml_feed_url, "SimpleXMLIterator");//run through all .dat files
//$xmlIterator = new SimpleXMLIterator($xml_feed_url);
$arr=array();//Folder with key folderid;
$arr_folder_simple=array();//Folder per integer
$arr_files=array();//Files
$arr_files_embedded=array();//Files
$arr_files_embedded_quiz=array();//Files
$arr_files_embedded_quiz_drag=array();//Files
$arr_files_embedded_url=array();//Files
$arr_files_embedded_label=array();//Files
$arr_pages=array();
$arr_links=array();
$arr_labels=array();
$folderIDArray=array();
$arr_parentids=array();
$arr_parentids_2=array();//for parentids
$sectionzaehler=1;
$sectionstart=2;//
$labelid=0;
//*********************************************


$sxi = new RecursiveIteratorIterator(
		$daten,
		RecursiveIteratorIterator::SELF_FIRST);

foreach($sxi as $item) {
	//****************************************************************
	$title=$item->title;//title normal

	if($title=="--TOP--" && $toptitle!=="")
	{
		$title=$toptitle;
		$toptitle="";
	}
	else 
	{
	$title2=$item->item->title;//unter title
	if ($title2=="--TOP--")
	{
	
$toptitle=$title;
	}

	}
	//********************************************************************
$topitemref1=$item['identifierref'];
if($topitemref1!="")
{
	$topitemdat1=$dir . "/" . $topitemref1 . ".dat"; //directory
	$topitem_single1=simplexml_load_file($topitemdat1);
	//**************************************
	if($topitem_single1!==FALSE)
	{
	$topitemid1=$topitem_single1['id'];
	$topitemid1 = preg_replace('![^0-9]!', '', $topitemid1); //replace all except for 0 - 9
	$targettype=$topitem_single1->TARGETTYPE;
	$targettype=$targettype['value'];
	$arrmitembeddedfiles=array();
	if($targettype=="STAFF_INFO")
	{
	
		$sectionitem= new sectiondata($sectionzaehler, $title, $topitemid1);
		$arr_parentids[]=$sectionitem;
		$arr_parentids_2[]=$topitemid1;
	
	
		//*****************textlabel dabei
		$textlabel="Diese Funktion kann aus Blackboard nicht in Moodle uebernommen werden.";
		$textlabel=xmlencoding($textlabel);
		$labelitem= new label ($labelid, "Info", $textlabel,  $sectionzaehler, $arrmitembeddedfiles, $topitemid1);
		$arr_labels[]=$labelitem;
		$labelid++;
		$sectionzaehler++;
		$topitemid1="";
	}//***************************************************************
	else if($targettype=="APPLICATION")
	{
		if(preg_match("`^.*(http|//|<).*`", $title)){
	
		}
		elseif(preg_match("`^(divider|placeholder).*`", $title))
		{
	
		}
		else
		{
			$sectionitem= new sectiondata($sectionzaehler, $title, $topitemid1);
			$arr_parentids[]=$sectionitem;
			$arr_parentids_2[]=$topitemid1;
			$textlabel="Diese Funktion kann aus Blackboard nicht in Moodle uebernommen werden.";
			$textlabel=xmlencoding($textlabel);
			$topitemid1="";
			//*****************textlabel dabei
	
			$labelitem= new label ($labelid, "Info", $textlabel,  $sectionzaehler, $arrmitembeddedfiles, $topitemid1);
			$arr_labels[]=$labelitem;
			$labelid++;
			$sectionzaehler++;
		}//if pregmatch
	}
	else //if targettype application
	{
	
		if($title!=="--TOP--")
		{
		$folderflag=$topitem_single1->FLAGS->ISFOLDER;

		if($folderflag['value']=="true")
		{
		
			
			if(preg_match("`^.*(http|//|<).*`", $title)){
		
			}
			elseif(preg_match("`^(divider|placeholder).*`", $title))
			{
		
			}//if pregmatch
			else
			{
				//*********************************************
		
				$bild=array();
				
				$title=trim($title);
				$title=xmlencoding($title);
				$parentid=$topitem_single1->PARENTID;
				
				$parentid=trim($parentid['value']);
				if(isset($parentid) && $parentid!=="")
				{
				
					$parentid = preg_replace('![^0-9]!', '', $parentid); //ersetze alles außer 0 bis 9
					$contentid=$topitem_single1['id'];
					$contentid = preg_replace('![^0-9]!', '', $contentid); //ersetze alles außer 0 bis 9
					if($parentid=="{unset id}")
					{
						$parentid="";
					}
				//**********************************
				$folderid=$topitem_single1['id'];
				$folderid = preg_replace('![^0-9]!', '', $folderid); //ersetze alles außer 0 bis 9
				
				$folderitem=new folder($title, $folderid, $parentid);
							$arr["$folderid"]=$folderitem;
				$arr_folder_simple[]=$folderitem;
				//*******************************************
				//*********************************text bei folder
		
					//$section=checkParentid($folderid, $arr_parentids, $arr);//gibt sectionid zurück
					$textbeifolder=$topitem_single1->BODY->TEXT;
					$textbeifolder=trim($textbeifolder);
				
					//************************************
					$bild=bild($textbeifolder, $dir, $folderid, $topitemref1, $direxport, true);//array mit img-infos
					//das muss bei moodle stehen: ><img src="@@PLUGINFILE@@/tab2.jpg" width="300" height="200" />
				
					if(count($bild)>0)//nur wenn eingebettete Dateien vorhanden sind
					{
						
						$textbeifolder=$bild[1];
					}
					//***********************************************
					$textbeifolder2=internerlink($textbeifolder, $parentid, $topitemref1, $sectionzaehler,$dir);
					if(count($textbeifolder2)>0)//nur wenn eingebettete Dateien vorhanden sind
					{
					
						$textbeifolder=$textbeifolder2[1];
					}
					$textbeifolder=xmlencoding($textbeifolder);
					//************************************************
					if(isset($textbeifolder2[3]) && count($textbeifolder2[3])>0)
					{
						$arrmitembeddedfiles=$textbeifolder2[3];//die elemente des zurückgegebenen arrays werden in hauptarray eingefügt
						$f=$arr["$folderid"];//Folder wird identifiziert
						for($i=0;$i<count($textbeifolder2[3]); $i++)
						{
						$arr_files[]=$arrmitembeddedfiles[$i];
						
						$f->setFiles($arrmitembeddedfiles[$i]);//dem Folder wird das File zugeordnet
						}
						}//if isset
						//***********************************************************
					//*************************************************Bilder***********************************
						$arrmitembeddedfiles=array();
					//bild[3] array mit fileitems
					if(isset($bild[3]) && count($bild[3])>0)
					{
						$arrmitembeddedfiles=$bild[3];//die elemente des zurückgegebenen arrays werden in hauptarray eingefügt
						for($i=0;$i<count($bild[3]); $i++)
						{
						$arr_files_embedded_label[]=$arrmitembeddedfiles[$i];
						}
						}//if isset
						//***********************************************************
						
						if($textbeifolder!=="")
						{
				
						$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
						$arr_labels[]=$labelitem;
						$labelid++;
						}
						//$arr_files_embedded_label[]=$bild[1];//nur ein Element, kein Array
						//************************************************************

				$sectionitem= new sectiondata($sectionzaehler, $title, $topitemid1);
				$arr_parentids[]=$sectionitem;
				$arr_parentids_2[]=$topitemid1;
				$sectionzaehler++;
			}//else pregmatch
		}//if folderflag
	
		}//if title
		}
	}//else
	}
}
}//foreach


?>