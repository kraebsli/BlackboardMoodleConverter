<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 
 * */
// three components form bb: manifest file, dat-files, files
$xml_feed_url = $dir . "/imsmanifest.xml"; //directory
$bbfilepath=$dir . "/csfiles/home_dir/";
$temppath=$dir . "/temp/";
mkdir($temppath, 0700);
mkdir($direxport . "/files", 0700);
//****************************
/*if($modus=="iter")
{
	
	$iter=true;
}
else 
{
$iter=false;
}
*/
$iter=true;
$daten = simplexml_load_file($xml_feed_url, "SimpleXMLIterator");//run through all .dat files
//$xmlIterator = new SimpleXMLIterator($xml_feed_url);
$arr=array();//Folder with key folderid;
$arr_folder_simple=array();//Folder per integer
    $arr_folder_simple2=array();//Folder per integer
$arr_files=array();//Files
   
$arr_files_embedded=array();//Files
$arr_files_embedded_quiz=array();//Files
$arr_files_embedded_quiz_drag=array();//Files
$arr_files_embedded_url=array();//Files
$arr_files_embedded_label=array();//Files
$arr_files_embedded_wiki=array();//Files
$helparray_nonfolderfiles=array();
$arr_pages=array();
$arr_wikis=array();
$arr_forums=array();
$arr_links=array();
$arr_labels=array();
$folderIDArray=array();
$arr_parentids=array();//sections
$arr_parentids_2=array();//for parentids
$arr_allItems=array();//for parentids
$arr_interheadlines=array();//
$sectionzaehler=1;
$sectionstart=0;//
$labelid=0;
$wiki_id=0;
$allfiles=0;
$fileslimit=10;
$extrasection="";
//*********************************************
$arr_pages2=array();
$arr_parentids_3=array();//for parentids
//*******************************************
$hier=array();
$depth=3;
$v=0;
$v1=0;
$v2=0;
$v3=0;
$v4=0;
$v5=0;
$v6=0;
$v7=0;
//************************
$order=0;
//************************
/*$sectionitem= new sectiondata("1", "Extra", "1");
$arr_parentids[]=$sectionitem;
$arr_parentids_2[]="1";
$arr_parentids_3["1"]=$sectionitem;*/
echo "<h3>Course structure</h3>";
//***********************************************
$sxi = new RecursiveIteratorIterator(
		$daten,
		RecursiveIteratorIterator::SELF_FIRST);
$depth=3;

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
	
		/*$sectionitem= new sectiondata($sectionzaehler, $title, $topitemid1);
		$arr_parentids[]=$sectionitem;
		$arr_parentids_2[]=$topitemid1;*/
		$contact_title=$topitem_single1->TITLE;
		//echo $contact_title['value'];
	
		//*****************textlabel dabei
		/*$textlabel="Diese Funktion kann aus Blackboard nicht in Moodle uebernommen werden.";
		$textlabel=xmlencoding($textlabel);
		$labelitem= new label ($labelid, "Info", $textlabel,  $sectionzaehler, $arrmitembeddedfiles, $topitemid1);
		$arr_labels[]=$labelitem;
		$labelid++;
		//********************************************************************************************
		$sectionzaehler++;
		$topitemid1="";*/
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
			/*$sectionitem= new sectiondata($sectionzaehler, $title, $topitemid1);
			$arr_parentids[]=$sectionitem;
			$arr_parentids_2[]=$topitemid1;
			$textlabel="Diese Funktion kann aus Blackboard nicht in Moodle uebernommen werden.";
			$textlabel=xmlencoding($textlabel);
			$topitemid1="";
			//*****************textlabel dabei
	
			$labelitem= new label ($labelid, "Info", $textlabel,  $sectionzaehler, $arrmitembeddedfiles, $topitemid1);
			$arr_labels[]=$labelitem;
			$labelid++;
			$sectionzaehler++;*/
		}//if pregmatch
	}
	else //if targettype application
	{
	
		if($title!=="--TOP--")
		{
		$folderflag=$topitem_single1->FLAGS->ISFOLDER;

		

		if($folderflag['value']=="true")
		{
			//echo "folderflag " . $folderflag . "   " . $folderflag['value'] . "  " . $title;
			//echo "<br>";
			//echo "<br>";
			$title=strip_tags($title);
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
			//echo $textbeifolder;
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
						
						//$f->setFiles($arrmitembeddedfiles[$i]);//dem Folder wird das File zugeordnet
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
				//*****************************************************
				$order++;
						$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
						$arr_labels[]=$labelitem;
						$labelid++;
						$arr_allItems[$order]=$labelitem;
						}
						//$arr_files_embedded_label[]=$bild[1];//nur ein Element, kein Array
						//************************************************************
						
					//************************************************************
						
					if($iter==true)
					{
						if($sxi->getDepth()>$depth && $sxi->getDepth()=="3")
						{
							$hier[$v]=$title;
							echo "<h3>";
							echo $sxi->getDepth() . " " . $title;
							echo "</h3>";
							echo "<br>";
							$v++;
							//********************************************
							
							//********************************************
							$sectionitem= new sectiondata($sectionzaehler, $title, $topitemid1);
							$arr_parentids[]=$sectionitem;
							$arr_parentids_2[]=$topitemid1;
							$arr_parentids_3["$topitemid1"]=$sectionitem;
							$sectionzaehler_par=$sectionzaehler;
							$sectionzaehler++;
							$topitemid1_par=$topitemid1;
							//*****************************************************************
						
							//********************************************************************************
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1"]->setSectionorder($folderid);
						}
						elseif($sxi->getDepth()==$depth && $sxi->getDepth()=="3")
						{
							$hier[$v]=$title;
							echo "<h3>";
							echo $sxi->getDepth() . " " . $title;
							echo "</h3>";
							echo "<br>";
							$v++;
							//********************************************
							
							//********************************************
							$sectionitem= new sectiondata($sectionzaehler, $title, $topitemid1);
							$arr_parentids[]=$sectionitem;
							$arr_parentids_2[]=$topitemid1;
							$arr_parentids_3["$topitemid1"]=$sectionitem;
							$sectionzaehler_par=$sectionzaehler;
							$sectionzaehler++;
							$topitemid1_par=$topitemid1;
							
							//********************************************************************************
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1"]->setSectionorder($folderid);
						}
						elseif($sxi->getDepth()<$depth && $sxi->getDepth()=="3")
						{
							$hier[$v]=$title;
							echo "<h3>";
							echo $sxi->getDepth() . " " . $title;
							echo "</h3>";
							echo "<br>";
							$v++;
							//********************************************
							
							//********************************************
							$sectionitem= new sectiondata($sectionzaehler, $title, $topitemid1);
							$arr_parentids[]=$sectionitem;
							$arr_parentids_2[]=$topitemid1;
							$arr_parentids_3["$topitemid1"]=$sectionitem;
							$sectionzaehler_par=$sectionzaehler;
							$sectionzaehler++;
							$topitemid1_par=$topitemid1;
							//*****************************************************************
						
							//********************************************************************************
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1"]->setSectionorder($folderid);
						}
						elseif($sxi->getDepth()>$depth && $sxi->getDepth()=="4")//Unterebene
						{
							$v_next=$v-1;
							$hier['$v_next']['$v1']=$title;
							echo $sxi->getDepth() . " " . "+" . $title;
							echo "<br>";
							$v1++;
					//********************************************
							$arr_parentids_2[]=$topitemid1;
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							//*****************************************************************
							/*$textbeifolder_n= $title .  $textbeifolder;
								$labelitem= new label ($labelid, $title, $textbeifolder_n,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								$labelid++;*/
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							
							$labelid++;
								//******************************sonderpage
							//$title=$sxi->getDepth() . ": " . $title;
								/*$pageitem= new page ($topitemid1, $title, " ", $textbeifolder, "", $sectionzaehler_par);
								$arr_pages[]=$pageitem;
								$arr_pages2["$topitemid1"]=$pageitem;
								$order++;
								$arr_allItems[$order]=$pageitem;*/
							if($textbeifolder!=="")
							{
								//*****************************************************
								$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
								$arr_interheadlines[]=$labelitem;//for ordering
					$labelid++;
							}
							else
							{
								$arr_interheadlines[]=$labelitem;
							}
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
						}
						elseif($sxi->getDepth()==$depth && $sxi->getDepth()=="4")//gleiche Ebene
						{
							
							$hier['$v_next']['$v1']=$title;
							echo "++" . $sxi->getDepth() . " " . $title;
							echo "<br>";
							$v1++;
					//********************************************
							$arr_parentids_2[]=$topitemid1;
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							//*****************************************************************
							/*$textbeifolder_n= $title .  $textbeifolder;
								$labelitem= new label ($labelid, $title, $textbeifolder_n,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								$labelid++;*/
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							
							$labelid++;
								//******************************sonderpage
							//$title=$sxi->getDepth() . ": " . $title;
								/*$pageitem= new page ($topitemid1, $title, " ", $textbeifolder, "", $sectionzaehler_par);
								$arr_pages[]=$pageitem;
								$arr_pages2["$topitemid1"]=$pageitem;
								$order++;
								$arr_allItems[$order]=$pageitem;*/
							if($textbeifolder!=="")
							{
								//*****************************************************
								$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
								$arr_interheadlines[]=$labelitem;//for ordering
					$labelid++;
							}
							else
							{
								$arr_interheadlines[]=$labelitem;
							}
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
						}
						elseif($sxi->getDepth()<$depth && $sxi->getDepth()=="4")//gleiche Ebene
						{
								
							$hier['$v_next']['$v1']=$title;
							echo "++" . $sxi->getDepth() . " " . $title;
							echo "<br>";
							$v1++;
							//********************************************
							
							//********************************************
							//********************************************
							$arr_parentids_2[]=$topitemid1;
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							//*****************************************************************
							/*$textbeifolder_n= $title .  $textbeifolder;
								$labelitem= new label ($labelid, $title, $textbeifolder_n,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								$labelid++;*/
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							//arr_interheadlines[]=$labelitem;
							$labelid++;
								//******************************sonderpage
							//$title=$sxi->getDepth() . ": " . $title;
								/*$pageitem= new page ($topitemid1, $title, " ", $textbeifolder, "", $sectionzaehler_par);
								$arr_pages[]=$pageitem;
								$arr_pages2["$topitemid1"]=$pageitem;
								$order++;
								$arr_allItems[$order]=$pageitem;*/
							if($textbeifolder!=="")
							{
								//*****************************************************
								$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
								$arr_interheadlines[]=$labelitem;//for ordering
					$labelid++;
							}
														else
							{
								$arr_interheadlines[]=$labelitem;
							}
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
						}
						elseif($sxi->getDepth()>$depth && $sxi->getDepth()=="5")//Unterebene
						{
							$v_next1=$v1-1;
					
							$hier['$v_next']['$v_next1']['$v2']=$title;
							echo $sxi->getDepth() . " " . "+++" . $title . " section " . $sectionzaehler;
							echo "<br>";
							$v2++;
							//********************************************
							
							//********************************************
							$arr_parentids_2[]=$topitemid1;
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							//*****************************************************************
							/*$textbeifolder_n= $title .  $textbeifolder;
								$labelitem= new label ($labelid, $title, $textbeifolder_n,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								$labelid++;*/
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							//$arr_interheadlines[]=$labelitem;
							$labelid++;
								//******************************sonderpage
							//$title=$sxi->getDepth() . ": " . $title;
								/*$pageitem= new page ($topitemid1, $title, " ", $textbeifolder, "", $sectionzaehler_par);
								$arr_pages[]=$pageitem;
								$arr_pages2["$topitemid1"]=$pageitem;
								$order++;
								$arr_allItems[$order]=$pageitem;*/
							if($textbeifolder!=="")
							{
								//*****************************************************
								$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
								$arr_interheadlines[]=$labelitem;//for ordering
					$labelid++;
							}
														else
							{
								$arr_interheadlines[]=$labelitem;
							}
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
						}
						elseif($sxi->getDepth()==$depth && $sxi->getDepth()=="5")//gleiche Ebene
						{
							
							$hier['$v_next']['$v_next1']['$v2']=$title;
							echo $sxi->getDepth() . " " . "+++" . $title . " section " . $sectionzaehler;
							echo "<br>";
							$v2++;
						
							//******************************************
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							$arr_parentids_2[]=$topitemid1;
						
							//*****************************************************************
							//********************************************************************************
							$titel2=xmlencoding("" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							//$arr_interheadlines[]=$labelitem;
							$labelid++;
							//**************************************************************************
							if($textbeifolder!=="")
							{
								//*****************************************************
						$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
								$arr_interheadlines[]=$labelitem;//for ordering
					$labelid++;
							}
														else
							{
								$arr_interheadlines[]=$labelitem;
							}
							//********************************************************************
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
								/*$textbeifolder_n= $title .  $textbeifolder;
								$labelitem= new label ($labelid, $title, $textbeifolder_n,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								$labelid++;*/
							//********************************************************************************
								//******************************sonderpage
							//$title=$sxi->getDepth() . ": " . $title;
								/*$pageitem= new page ($topitemid1, $title, " ", $textbeifolder, "", $sectionzaehler_par);
								$arr_pages[]=$pageitem;
								$arr_pages2["$topitemid1"]=$pageitem;
								$order++;
								$arr_allItems[$order]=$pageitem;*/
						}
						elseif($sxi->getDepth()<$depth && $sxi->getDepth()=="5")//gleiche Ebene
						{
								
							$hier['$v_next']['$v_next1']['$v2']=$title;
							echo $sxi->getDepth() . " " . "+++" . $title . " section " . $sectionzaehler;
							echo "<br>";
							$v2++;
							//********************************************
						
							//********************************************
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							$arr_parentids_2[]=$topitemid1;
							//*****************************************************************
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							//$arr_interheadlines[]=$labelitem;
							$labelid++;
							if($textbeifolder!=="")
							{
								//*****************************************************
								$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
								$arr_interheadlines[]=$labelitem;//for ordering
					$labelid++;
							}
														else
							{
								$arr_interheadlines[]=$labelitem;
							}
							//********************************************************************
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
							/*	$textbeifolder_n= $title .  $textbeifolder;
								$labelitem= new label ($labelid, $title, $textbeifolder_n,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								$labelid++;*/
							//********************************************************************************
								//******************************sonderpage
							//$title=$sxi->getDepth() . ": " . $title;
							/*	$pageitem= new page ($topitemid1, $title, " ", $textbeifolder, "", $sectionzaehler_par);
								$arr_pages[]=$pageitem;
								$arr_pages2["$topitemid1"]=$pageitem;
								$order++;
								$arr_allItems[$order]=$pageitem;*/
						}
						elseif($sxi->getDepth()>$depth && $sxi->getDepth()=="6")//Unterebene
						{
							$v_next2=$v2-1;
						
							$hier['$v_next']['$v_next1']['$v_next2']['$v3']=$title;
							echo $sxi->getDepth() . " " . "++++" . $title;
							echo "<br>";
							$v3++;
							//********************************************
							
							//********************************************
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							$arr_parentids_2[]=$topitemid1;
							//*****************************************************************
							//********************************************************************************
						$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							//$arr_interheadlines[]=$labelitem;
							$labelid++;
							if($textbeifolder!=="")
							{
								//*****************************************************
								$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
								$arr_interheadlines[]=$labelitem;//for ordering
					$labelid++;
							}
							else
							{
								$arr_interheadlines[]=$labelitem;
							}
							//********************************************************************
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
								/*$textbeifolder_n= $title .  $textbeifolder;
								$labelitem= new label ($labelid, $title, $textbeifolder_n,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								$labelid++;*/
							//********************************************************************************
								//******************************sonderpage
							//$title=$sxi->getDepth() . ": " . $title;
								/*$pageitem= new page ($topitemid1, $title, " ", $textbeifolder, "", $sectionzaehler_par);
								$arr_pages[]=$pageitem;
								$arr_pages2["$topitemid1"]=$pageitem;
								$order++;
								$arr_allItems[$order]=$pageitem;*/
						}
						elseif($sxi->getDepth()==$depth && $sxi->getDepth()=="6")//gleiche Ebene
						{
								
								$hier['$v_next']['$v_next1']['$v_next2']['$v3']=$title;
							echo $sxi->getDepth() . " " . "++++" . $title;
							echo "<br>";
							//********************************************
					
							//********************************************
							$v3++;
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							$arr_parentids_2[]=$topitemid1;
							//*****************************************************************
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							//$arr_interheadlines[]=$labelitem;
							$labelid++;
							if($textbeifolder!=="")
							{
								//*****************************************************
								$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
					$labelid++;
					$arr_interheadlines[]=$labelitem;//for ordering
							}
							else
							{
								$arr_interheadlines[]=$labelitem;
							}
							//********************************************************************
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
								/*$textbeifolder_n= $title .  $textbeifolder;
								$labelitem= new label ($labelid, $title, $textbeifolder_n,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								$labelid++;*/
							//********************************************************************************
								//******************************sonderpage
							//$title=$sxi->getDepth() . ": " . $title;
							/*	$pageitem= new page ($topitemid1, $title, " ", $textbeifolder, "", $sectionzaehler_par);
								$arr_pages[]=$pageitem;
								$arr_pages2["$topitemid1"]=$pageitem;
								$order++;
								$arr_allItems[$order]=$pageitem;*/
						}
						elseif($sxi->getDepth()<$depth && $sxi->getDepth()=="6")//gleiche Ebene
						{
						
							$hier['$v_next']['$v_next1']['$v_next2']['$v3']=$title;
							echo $sxi->getDepth() . " " . "++++" . $title;
							echo "<br>";
							//********************************************
						
							//********************************************
							$v3++;
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							$arr_parentids_2[]=$topitemid1;
							//*****************************************************************
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							//$arr_interheadlines[]=$labelitem;
							$labelid++;
							if($textbeifolder!=="")
							{
								//*****************************************************
							$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
					$labelid++;
					$arr_interheadlines[]=$labelitem;//for ordering
							}
							else
							{
								$arr_interheadlines[]=$labelitem;
							}
							//********************************************************************
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
						/*	$textbeifolder_n= $title .  $textbeifolder;
								$labelitem= new label ($labelid, $title, $textbeifolder_n,  $sectionzaehler, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								$labelid++;*/
							//********************************************************************************
								//******************************sonderpage
							//$title=$sxi->getDepth() . ": " . $title;
								/*$pageitem= new page ($topitemid1, $title, " ", $textbeifolder, "", $sectionzaehler_par);
								$arr_pages[]=$pageitem;
								$arr_pages2["$topitemid1"]=$pageitem;
								$order++;
								$arr_allItems[$order]=$pageitem;*/
						}
						elseif($sxi->getDepth()<$depth && $sxi->getDepth()=="7")//gleiche Ebene
						{
							echo $sxi->getDepth() . " " . "++++" . $title;
							echo "<br>";
							if($textbeifolder!=="")
							{
								//*****************************************************
							$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
					$labelid++;
							}
							//********************************************
							
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							$arr_parentids_2[]=$topitemid1;
							//*****************************************************************
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
								
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							$arr_interheadlines[]=$labelitem;
							$labelid++;
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
							
						}
						elseif($sxi->getDepth()>$depth && $sxi->getDepth()=="7")//Unterebene
						{
							echo $sxi->getDepth() . " " . "++++" . $title;
							echo "<br>";
							if($textbeifolder!=="")
							{
								//*****************************************************
								$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
					$labelid++;
							}
							//********************************************
								
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							$arr_parentids_2[]=$topitemid1;
							//*****************************************************************
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							$arr_interheadlines[]=$labelitem;
							$labelid++;
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
						}
						elseif($sxi->getDepth()==$depth && $sxi->getDepth()=="7")//Unterebene
						{
							echo $sxi->getDepth() . " " . "++++" . $title;
							echo "<br>";
							if($textbeifolder!=="")
							{
								//*****************************************************
								$order++;
								$labelitem= new label ($labelid, $title, $textbeifolder,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
								$arr_labels[]=$labelitem;
								
								$arr_allItems[$order]=$labelitem;
								$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
					$labelid++;
							}
							//********************************************
								
							$arr_parentids_3["$topitemid1_par"]->setOtherSections($topitemid1, $title);
							$arr_parentids_2[]=$topitemid1;
							//*****************************************************************
							//********************************************************************************
							$titel2=xmlencoding("<h4>" . $title .  "</h4>");
							$labelitem= new label ($labelid, $title, $titel2,  $sectionzaehler_par, $arrmitembeddedfiles, $folderid);
							$arr_labels[]=$labelitem;
							
							$order++;
							$arr_allItems[$order]=$labelitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($labelid);
							$arr_interheadlines[]=$labelitem;
							$labelid++;
							$order++;
							$arr_allItems[$order]=$folderitem;
							$arr_parentids_3["$topitemid1_par"]->setSectionorder($folderid);
						}
						//*****************************
						$depth=$sxi->getDepth();
					}
						//**********************************************
						if($iter==false)
						{
				$sectionitem= new sectiondata($sectionzaehler, $title, $topitemid1);
				$arr_parentids[]=$sectionitem;
				$arr_parentids_2[]=$topitemid1;
				$sectionzaehler++;
						}
				//**********************
			}//else pregmatch
		}//if folderflag
	
		}//if title
		}
	}//else
	}
}
}//foreach

//extra section
$sectionitem= new sectiondata(0, "General", 0);
							 $arr_parentids[]=$sectionitem;
							 $arr_parentids_2[]=0;
							 $arr_parentids_3[0]=$sectionitem;
							$sectionitem= new sectiondata($sectionzaehler, "Extras-Section", $sectionzaehler);
							$extrasection=$sectionzaehler;
							 $arr_parentids[]=$sectionitem;
							 $arr_parentids_2[]=$sectionzaehler;
							 $arr_parentids_3[$sectionzaehler]=$sectionitem;
							$sectionzaehler++;
							 //***********************************************************************
?>