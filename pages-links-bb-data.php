<?php
//*****************************************************
$descr_var=true;

foreach ($daten->resources->resource as $res) {
	
	$countfiles=0;
	$resident=$res['identifier'];
	$residentcontenthandler=$res['type'];
	
	//******************************************************
	$resdat=$dir . "/" . $resident . ".dat";//directory
	$res_single=simplexml_load_file($resdat);
	$contenthandler=$res_single->CONTENTHANDLER;
	$contenthandler=trim($contenthandler['value']);
	$mod_label="";
	$parentid=$res_single->PARENTID;
	$parentid=trim($parentid['value']);
	//**************************************************
	foreach ($res_single->FILES->FILE as $file) {
		$countfiles++;
		$allfiles++;
			}
	if($contenthandler=="resource/x-bb-file")
	{
	//************************************************************
	if(isset($res_single->FILES->FILE->LINKNAME))
	{
		$title=$res_single->TITLE;
		$title=$title['value'];
		//**************************************************
		
		//**************************************************
		/*
         foreach ($res_single->FILES->FILE->LINKNAME as $file) {
         $countfiles++;
         }
         if($countfiles>1)
		{
			$parentid=$res_single->PARENTID;
			$parentid=trim($parentid['value']);
			
			if(	$parentid!=="{unset id}")
			{
				$parentid = preg_replace('![^0-9]!', '', $parentid); //ersetze alles au�er 0 bis 9
				//*****************
				$available=$res_single->FLAGS->ISAVAILABLE;
				$available=$available['value'];
				//**************************************************
			if($iter==false)
			{
				$section=checkParentid($parentid, $arr_parentids, $arr);//gibt sectionid zur�ck
			}
			else 
			{
				$section=checkParentid2($parentid, $arr_parentids_3);//gibt sectionid zur�ck
			}
			//**************************************************
			$arrtemp=array();
			$htmltitle="<h4><span class=\"\" style=\"color: rgb(141, 174, 16);\">" . $title .  "</span></h4>";
			$htmltitle=xmlencoding($htmltitle);
			$labelitem= new label ($labelid, "Headline", $htmltitle,  $section, $arrtemp, $labelid);
			$arr_labels[]=$labelitem;
			$labelid++;
			$order++;
			$arr_allItems[$order]=$labelitem;
		}//**************************************************parentunsetid
		}//countfiles> 1*/
		//******************************************************
		//******************************************************
		//******************************************************
		foreach ($res_single->FILES->FILE->LINKNAME as $file) {
			$parentid=$res_single->PARENTID;
			$parentid=trim($parentid['value']);
			
			if(	$parentid!=="{unset id}")
			{
				$parentid = preg_replace('![^0-9]!', '', $parentid); //ersetze alles au�er 0 bis 9
				//*****************
				$available=$res_single->FLAGS->ISAVAILABLE;
				$available=$available['value'];
				//**************************************************
			if($iter==false)
			{
				$section=checkParentid($parentid, $arr_parentids, $arr);//gibt sectionid zur�ck
			}
			else 
			{
				$section=checkParentid2($parentid, $arr_parentids_3);//gibt sectionid zur�ck
			}
			//**************************************************
			}//**************************************************ifparentunsetid
			$filename=$file['value']; //richtiger Dateiname
		
			//************************************************************************
			if(preg_match("`^.*\.(htm|html)$`", $filename)){
				//******************
				$indexhtmtext="<p>HTML-Dateien werden nicht uebernommen. Exportieren Sie diese aus Ihrem Blackboard-Kurs separat.</p>";
				$arrtemp=array();
				//************************************************************************
				$labelitem= new label ($labelid, "htm", "HTML-Dateien werden nicht uebernommen.",  $section, $arrtemp, $labelid);
				$order++;
				//$labelitem->setOrder($order);
				$arr_allItems[$order]=$labelitem;
				$arr_labels[]=$labelitem;
				if(isset($arr_parentids_3["$parentid"]))
				{
					$arr_parentids_3["$parentid"]->setSectionorder($labelid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$labelid);
			}
				$labelid++;
				
			}//************************************************************************
			else
			{
				//$parentid=$res_single->PARENTID;
				//$parentid=trim($parentid['value']);
	
				if(	$parentid!=="{unset id}")
				{
	
					$parentid = preg_replace('![^0-9]!', '', $parentid); //ersetze alles au�er 0 bis 9
	
					//*****************
					$available=$res_single->FLAGS->ISAVAILABLE;
					$available=$available['value'];
					// echo $filename;
					// echo "<br>";
					// echo $filename2;
					// echo "<br>";
					//**************************************************
				if($iter==false)
			{
				$section=checkParentid($parentid, $arr_parentids, $arr);//gibt sectionid zur�ck
			}
			else 
			{
				$section=checkParentid2($parentid, $arr_parentids_3);//gibt sectionid zur�ck
			}
			//**************************************************
					$fileid=$res_single->FILES->FILE;
					$title=$res_single->TITLE;
					$title=$title['value'];
					$fileid=$fileid['id'];
					$fileid = str_replace( "_", "", $fileid );
					$filename2=$res_single->FILES->FILE->NAME; // mit xid kein Dateiname
					$zeichen=strpos($filename2, "/");
					//**************************************************
					if($zeichen=== false)
					{
	
					}
					else
					{
						$filename2=substr($filename2, 1);//ohne "/" vor dem Dateinamen
					}
					//**************************************************
		
					//************************************************************************
					$fileitem= new file ($filename, $fileid,$filename2, $title, $resident, $parentid, $section);
					$order++;
					$fileitem->setOrder($order);
				if(isset($arr_parentids_3["$parentid"]))
				{
					$arr_parentids_3["$parentid"]->setSectionorder($fileid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$fileid);
			}
					$arr_allItems[$order]=$fileitem;
					$arr_files[]=$fileitem;
					$allfiles++;
					//$helparray_nonfolderfiles[]=$fileid;
					//**************************************************
					if($parentid=="{unset id}")
					{
					}
					else
					{
						$f=$arr["$parentid"];//Folder wird identifiziert
						$f->setFiles($fileitem);//dem Folder wird das File zugeordnet
						
					}
					//**************************************************
					//echo "<br>";
					//$pagedescription=$title;
				}//**************************************************if parentunsetid
			}//if filename
	
		
		}//ende foreach
	
	}//ende if isset
}
	//*****************************************************************************************************
	elseif($contenthandler=="resource/x-bb-document")
	{
		$arr_all=array();//takes embedded images and embedded files
		$arrmitembeddedfiles=array();
		$bild=array();
		$pageid=$res_single['id'];
		$pageid = preg_replace('![^0-9]!', '', $pageid); //ersetze alles au�er 0 bis 9
		$parentid = preg_replace('![^0-9]!', '', $parentid); //ersetze alles au�er 0 bis 9
		//****************************************************************************************
		if($iter==false){
			$section=checkParentid($parentid, $arr_parentids, $arr);//gibt sectionid zur�ck
		}
		else
		{
			$section=checkParentid2($parentid, $arr_parentids_3);//gibt sectionid zur�ck
		}
		
		//****************************************************************************************
		$title=$res_single->TITLE;
		$pagetitle=xmlencoding($title['value']);
		
		$pagetext=$res_single->BODY->TEXT;
		$pagetext=trim($pagetext);
		//$pagetext=strip_tags($pagetext);
		//echo "**************************************************";
		//echo "<br>";
		if(strlen($pagetext)>500)
		{
			$mod_label=false;
			
			if(isset($arr_pages2["$parentid"]))
			{
				$pageid2=$arr_pages2["$parentid"]->getId();
				$bild=bild($pagetext, $dir, $pageid2, $resident, $direxport, $mod_label);//array mit img-infos
			}
			else
			{
				$bild=bild($pagetext, $dir, $pageid, $resident, $direxport, $mod_label);//array mit img-infos
				//das muss bei moodle stehen: ><img src="@@PLUGINFILE@@/tab2.jpg" width="300" height="200" />
			}
			//das muss bei moodle stehen: ><img src="@@PLUGINFILE@@/tab2.jpg" width="300" height="200" />
		}//pagetext >500
		else//label
		{
			if($iter==false)
			{
				$mod_label=true;
			}
			else
			{
				$mod_label=true;//other variant
			}
			if(isset($arr_pages2["$parentid"]))
			{
				$pageid2=$arr_pages2["$parentid"]->getId();
				$bild=bild($pagetext, $dir, $pageid2, $resident, $direxport, $mod_label);//array mit img-infos
			}
			else
			{
				$bild=bild($pagetext, $dir, $pageid, $resident, $direxport, $mod_label);//array mit img-infos
				//das muss bei moodle stehen: ><img src="@@PLUGINFILE@@/tab2.jpg" width="300" height="200" />
			}
		
		}//if pagetext>500
		//************************************************************************************
		if(count($bild)>0)//nur wenn eingebettete Dateien vorhanden sind
		{
			$pagetext=$bild[1];
		}
		//bild[3] array mit fileitems
		if(isset($bild[3]) && count($bild[3]>0))
		{
			$arrmitembeddedfiles=$bild[3];//die elemente des zur�ckgegebenen arrays werden in hauptarray eingef�gt
			for($i=0;$i<count($bild[3]); $i++)
			{
			if($mod_label==false)
			{
			$arr_files_embedded[]=$arrmitembeddedfiles[$i];
			$arr_all[]=$arrmitembeddedfiles[$i];
			}
			else
			{
			$arr_all[]=$arrmitembeddedfiles[$i];
			$arr_files_embedded_label[]=$arrmitembeddedfiles[$i];
			}
		
		
			}//for
			}//if
			//**********************************************only FILES**************************************
			//**********************************************************************************************

			if($modus=="multiplefolders"  && $countfiles>1)
			{
			$folderitem=new folder($pagetitle, $pageid, $parentid);

			$arr["$pageid"]=$folderitem;
			$arr_folder_simple[]=$folderitem;
			$order++;
			$arr_allItems[$order]=$folderitem;
			
			if(isset($arr_parentids_3["$parentid"]))
				{
					$arr_parentids_3["$parentid"]->setSectionorder($pageid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$pageid);
			}
        }
			foreach($res_single->FILES->FILE as $pfile)//******************************************************
			{
		
			$fileid = str_replace( "_", "", $pfile['id'] );
			$filename2=$pfile->NAME; // mit xid kein Dateiname, auch ohne xid
			
			$filename3=$pfile->LINKNAME; // mit xid kein Dateiname, auch ohne xid
			
			$filename3=$filename3['value'];
			
			$zeichen=strpos($filename2, "/");
			if($zeichen=== false)
			{
		
			}
			else
			{
			$filename2=substr($filename2, 1);//ohne "/" vor dem Dateinamen
			}
			$fname=VerzeichnisDurchsuchen3($dir, $filename2);
			$fname[1]=trim($fname[1]);
		
			if($fname[1]=="")
			{
		
			$fname=VerzeichnisDurchsuchen3($dir, $filename3);
			}
			$fname[1]=trim($fname[1]);
			//$htmlzeichen=strpos($fname[1], ".htm");
			if(preg_match("`^.*\.(htm|html)$`", $fname[1])){//**************************************************
$textlabel=$fname[1] . ": HTML-Dateien werden aus Blackboard nicht in Moodle uebernommen .";
$topitemid1="";
$arrmitembeddedfiles2=array();
		$textlabel=xmlencoding($textlabel);
		$labelitem= new label ($labelid, "Info", $textlabel,  $section, $arrmitembeddedfiles2, $topitemid1);
		$order++;
			$arr_allItems[$order]=$labelitem;
			$arr_labels[]=$labelitem;
				if(isset($arr_parentids_3["$parentid"]))
				{
					$arr_parentids_3["$parentid"]->setSectionorder($labelid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$labelid);
			}
			$labelid++;
			}//**************************************************
			elseif(isset($fname[1]) && $fname[1]!=="")
			{
		
			
			if($modus=="multiplefolders" && $countfiles>1)
			{
				
				$fileitem= new file ($fname[1], $fileid,$filename2, $title['value'], $resident, $pageid, $section);
				$fileitem->setOrder($order);
				$arr_files[]=$fileitem;
				$f=$arr["$pageid"];
				$f->setFiles($fileitem);//dem Folder wird das File zugeordnet
			
			}
			else //single file
			{
				
				$fileitem= new file ($fname[1], $fileid,$filename2, $title['value'], $resident, $parentid, $section);
				$arr_files[]=$fileitem;
               //$helparray_nonfolderfiles[]=$fileid;
				
			$f=$arr["$parentid"];//Folder wird identifiziert
			$f->setFiles($fileitem);//dem Folder wird das File zugeordnet
			//*************************************************************
				if(isset($arr_parentids_3["$parentid"]))
				{
					$arr_parentids_3["$parentid"]->setSectionorder($fileid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$fileid);
			}
				//**************************************
                $order++;
                $fileitem->setOrder($order);
                $arr_allItems[$order]=$fileitem;
			}//else
			//$pagedescription=$pagetitle;
			
			
			}// else (isset($fname[1]) && $fname[1]!=="")
			else
			{
			$textlabel=$pagetitle . ": Datei konnte nicht wiederhergestellt werden.";
			$topitemid1="";
			$arrmitembeddedfiles2=array();
			$textlabel=xmlencoding($textlabel);
			$labelitem= new label ($labelid, "Info", $textlabel,  $section, $arrmitembeddedfiles2, $topitemid1);
			$arr_labels[]=$labelitem;
				if(isset($arr_parentids_3["$parentid"]))
				{
					$arr_parentids_3["$parentid"]->setSectionorder($labelid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$labelid);
			}
			$labelid++;
			$order++;
			$arr_allItems[$order]=$labelitem;
			}//************************(isset($fname[1]) && $fname[1]!=="")
			//}
			//else
				//{//label erzeugen
		
			//$indexhtmtext="<p>HTMLDateien werden nicht uebernommen. Exportieren Sie diese aus Ihrem Blackboard-Kurs separat.</p>";
			//$pagedescription="nicht uebernommen.";
			//$pagetitle.=" " . $pagedescription;
			//}
			//*****************************************************
			//*****************************************************
		
			}//************FILESforeach
			//**********************************************************************************************
			//**********************************************************************************************
			//pagetext with files not images*****************************************************************
			if(isset($pagetext) && $pagetext!=="")
			{
		
			$pagetext2=internerlink($pagetext, $parentid, $resident, $section, $dir);
		
			$arrmitembeddedfiles=array();
		
			if(count($pagetext2)>0)//nur wenn eingebettete Dateien vorhanden sind
			{
				
			$pagetext=$pagetext2[1];
			}
			$pagetext=xmlencoding($pagetext);
				//************************************************
				if(isset($pagetext2[3]) && count($pagetext2[3])>0)
			{
		
			$arrmitembeddedfiles=$pagetext2[3];//die elemente des zur�ckgegebenen arrays werden in hauptarray eingef�gt
			$f=$arr["$parentid"];//Folder wird identifiziert
			for($i=0;$i<count($pagetext2[3]); $i++)
				{
		
			$arr_files[]=$arrmitembeddedfiles[$i];
			$arr_all[]=$arrmitembeddedfiles[$i];
		
			$f->setFiles($arrmitembeddedfiles[$i]);//dem Folder wird das File zugeordnet
			}
			}//if isset pagetext
			//***********************************************************
			//***********************************************************
			if($descr_var==true)//description with item
			{
			if($countfiles>0 && $countfiles <2)
			{
				
			$fileitem->setDescription($pagetext);
}
elseif($countfiles>=2 )
			{
				
				if(isset($folderitem))
				{
					
				$folderitem->setDescription($pagetext);
				}
			}			
			else
			{
				
			//***************************************************** if description is not in description
			if($mod_label==false)
			{
				
			//id, title, text, description
			if($iter==true){
				$pageitem= new page ($pageid, $pagetitle, $pagetext, $pagedescription, $arr_all, $section);
				
				$arr_pages[]=$pageitem;
				$arr_pages2["$pageid"]=$pageitem;
					$order++;
					$arr_allItems[$order]=$pageitem;
			if(isset($arr_parentids_3["$parentid"]))
				{
					$arr_parentids_3["$parentid"]->setSectionorder($pageid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$pageid);
			}
					}
					else//iter false
					{
					/*$pagetext=xmlencoding("<h4><span class=\"\" style=\"color: rgb(141, 174, 16);\">" . $pagetitle .  "</span></h4>" . $pagetext);
					//id, title, text, description
					//$pageitem= new page ($pageid, $pagetitle, $pagetext, $pagedescription, $arr_all, $section);
				//$arr_pages[]=$pageitem;
					//*****************************************************
					if(isset($arr_pages2["$parentid"]))
					{
					$arr_pages2["$parentid"]->addElement($pagetext);
					$arr_pages2["$parentid"]->addFile($arr_all);
					}
					else
					{
		
					$pageitem= new page ($pageid, $pagetitle, $pagetext, $pagedescription, $arr_all, $section);
					$arr_pages2["$pageid"]=$pageitem;
					$arr_pages[]=$pageitem;
					$order++;
					$arr_allItems[$order]=$pageitem;
					if(otherSection($parentid, $arr_parentids_3, $arr_interheadlines)!=="")
				{
				$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$pageid);
				}
				else
				{
					$arr_parentids_3["$parentid"]->setSectionorder($pageid);
				}//othersection
					}*/
					//*****************************************************//else arrpages2
					}//***************************************************** if iter false
					}//if modlabel false
					else
					{
					//if-else*************************************************************
					if($iter==false){
					/*$pagetext=xmlencoding("<h4><span class=\"\" style=\"color: rgb(141, 174, 16);\">" . $pagetitle .  "</span></h4>" . $pagetext);
						$labelitem= new label ($labelid, $pagetitle, $pagetext, $section, $arr_all, $pageid);
			$arr_labels[]=$labelitem;
					if(otherSection($parentid, $arr_parentids_3, $arr_interheadlines)!=="")
				{
				$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$labelid);
				}
				else
				{
					$arr_parentids_3["$parentid"]->setSectionorder($labelid);
				}
			$labelid++;
								$order++;
								$arr_allItems[$order]=$labelitem;
					*/}
					else //else****************************************************************
					{
					$pagetext=$pagetitle . ": " . $pagetext;
					$pagetext=xmlencoding("<h4><span class=\"\" style=\"color: rgb(141, 174, 16);\">" . $pagetitle .  "</span></h4>" . $pagetext);
					//******************************************************
					if(isset($arr_pages2["$parentid"]))
				{
		
					$arr_pages2["$parentid"]->addElement($pagetext);
					}
							else
								{
									
					$labelitem= new label ($labelid, $pagetitle, $pagetext,  $section, $arr_all, $pageid);
					$arr_labels[]=$labelitem;
					$order++;
					$arr_allItems[$order]=$labelitem;
					
					if(isset($arr_parentids_3["$parentid"]))
					{
						$arr_parentids_3["$parentid"]->setSectionorder($labelid);
					
					}
					else
					{
						$otherSectionid=otherSection($parentid, $arr_parentids_3, $arr_interheadlines);
						$othersectionid_p=$otherSectionid[1];
						if(isset($othersectionid_p)&& $otherSectionid!=="")
							$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$labelid);
					}
					$labelid++;
					
					}
					//*****************************************************************
					}//else iter****************************************************************
					//*******************************************************************************************************
			}//else modlabel
			}//else descrvar
			}
			//**********************************************
			}//if isset pagetext
		
	}//*********************************************************************************
	elseif($contenthandler=="resource/x-bb-externallink")
	{

		$linkid=$res_single['id'];
		$linkid = preg_replace('![^0-9]!','', $linkid); //ersetze alles au�er 0 bis 9
		$parentlinkid=$res_single->PARENTID;
		$parentlinkid=$parentlinkid['value'];
		$parentlinkid = preg_replace('![^0-9]!', '', $parentlinkid); //ersetze alles au�er 0 bis 9
		if($iter==false)
		{
		$section_link=checkParentid($parentlinkid, $arr_parentids, $arr);//gibt sectionid zur�ck
		}
		else 
		{
		$section_link=checkParentid2($parentlinkid, $arr_parentids_3);//gibt sectionid zur�ck
		}
		$linktitle=$res_single->TITLE;
		$linktitle=strip_tags($linktitle['value']);
		$linktitle=xmlencoding($linktitle);
		$linktext=$res_single->BODY->TEXT;
		$linktext=strip_tags($linktext);
		$linkurl=$res_single->URL;
		$linkurl=$linkurl['value'];
		$linkurl=xmlencoding($linkurl);
		$arrmitembeddedfiles=array();


		//************************************
		$bild=bild($linktext, $dir, $linkid, $resident, $direxport, true);//array mit img-infos
		//das muss bei moodle stehen: ><img src="@@PLUGINFILE@@/tab2.jpg" width="300" height="200" />

		if(count($bild)>0)//nur wenn eingebettete Dateien vorhanden sind
		{
			$linktext=$bild[1];
		}
		//***********************************************

		//bild[3] array mit fileitems
		if(count($bild[3])>0)
		{
			$arrmitembeddedfiles=$bild[3];//die elemente des zur�ckgegebenen arrays werden in hauptarray eingef�gt
			for($i=0;$i<count($bild[3]); $i++)
			{

				$arr_files_embedded_url[]=$arrmitembeddedfiles[$i];
	}
	}
	//***********************************************
	//$linktext=internerlink($linktext);
	if($iter==false)
	{
	$linktext=xmlencoding($linktext);
	
	$linkitem= new link ($linkid, $linktitle,$linktext, $linkurl, $section_link, $arrmitembeddedfiles);
	$order++;
	$arr_allItems[$order]=$linkitem;
	//************************************************
	$arr_links[]=$linkitem;
	if(isset($arr_parentids_3["$parentlinkid"]))
				{
					$arr_parentids_3["$parentlinkid"]->setSectionorder($linkid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentlinkid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$linkid);
			}
	
	}
	else 
	{
		if (isset($arr_pages2["$parentlinkid"]))
		
		{
			$linktext2=xmlencoding("<a href=\"" . $linkurl . "\">" . $linkurl . "</a><br>" . $linktext . "<br>");
			$arr_pages2["$parentlinkid"]->addElement($linktext2);
			if(count($arr_files_embedded_url)>0)
				$arr_pages2["$parentlinkid"]->addFile($arr_files_embedded_url);
		
		}
		else
		{
			$linktext=xmlencoding($linktext);
			$linkitem= new link ($linkid, $linktitle,$linktext, $linkurl, $section_link, $arrmitembeddedfiles);
			$arr_links[]=$linkitem;
			$order++;
			$arr_allItems[$order]=$linkitem;
		if(isset($arr_parentids_3["$parentlinkid"]))
				{
					$arr_parentids_3["$parentlinkid"]->setSectionorder($linkid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentlinkid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$linkid);
			}
			
		}
	}
	
	//*******************************************************************************
}//ende if links
elseif($contenthandler=="resource/x-bb-youtube-mashup")
{
	$ytid=$res_single['id'];
	$ytid = preg_replace('![^0-9]!','', $ytid); //ersetze alles au�er 0 bis 9
	$parentytid=$res_single->PARENTID;
	$parentytid=$parentytid['value'];
	$parentytid = preg_replace('![^0-9]!', '', $parentytid); //ersetze alles au�er 0 bis 9
	if($iter==false)
	{
	$section_yt=checkParentid($parentytid, $arr_parentids, $arr);//gibt sectionid zur�ck
	}
	else 
	{
		
		$section_yt=checkParentid2($parentytid, $arr_parentids_3);//gibt sectionid zur�ck
	}
	$yt_title=$res_single->TITLE;
	$yt_title=strip_tags($yt_title['value']);
	$yt_title=xmlencoding($yt_title);
	$yt_text=$res_single->BODY->TEXT;
	//$yt_text=internerlink($yt_text);
	$yt_text=xmlencoding($yt_text);
		//vermutlich ohne Bilder
	//Youtube-Mashup als Textfeld
	//Youtube-Url: URL value, nicht voreingestellt
	//FILES
	//verschiedene Arten des Einbettens
	$arrmitembeddedfiles=array();
	if($iter==false)
	{
	$ytitem= new page ($ytid, $yt_title, $yt_text, "", $arrmitembeddedfiles, $section_yt);
	$arr_pages[]=$ytitem;
	$order++;
	$arr_allItems[$order]=$ytitem;
	}
	else 
	{
		if(isset($arr_pages2["$parentytid"]))
		{
			$arr_pages2["$parentytid"]->addElement($yt_text);
		}
		else
		{
			$ytitem= new page ($ytid, $yt_title, $yt_text, "", $arrmitembeddedfiles, $section_yt);
		
			$arr_pages2["$ytid"]=$ytitem;
			$arr_pages[]=$ytitem;
			$order++;
			$arr_allItems[$order]=$ytitem;
		if(isset($arr_parentids_3["$parentytid"]))
				{
					$arr_parentids_3["$parentytid"]->setSectionorder($ytid);
				
			}
			else
			{
				$otherSectionid=otherSection($parentlinkid, $arr_parentids_3, $arr_interheadlines);
				$othersectionid_p=$otherSectionid[1];
				if(isset($othersectionid_p)&& $otherSectionid!=="")
				$arr_parentids_3["$othersectionid_p"]->insertSection($otherSectionid[0],$ytid);
			}
		}
		
		
	}
}
elseif($residentcontenthandler=="resource/x-bb-staffinfo")
{
	
	$contactid=$res_single['id'];
	$contactid = preg_replace('![^0-9]!','', $contactid); //ersetze alles au�er 0 bis 9
	/*$parentcontactid=$res_single->PARENTID;
	$parentcontactid=$parentcontactid['value'];
	$parentcontactid = preg_replace('![^0-9]!', '', $parentcontactid); //ersetze alles au�er 0 bis 9
	$section_contact=checkParentid($parentcontactid, $arr_parentids, $arr);//gibt sectionid zur�ck*/
	$contact_title=$res_single->TITLE;
	$contact_title=$contact_title['value'];
	$contact_title=xmlencoding($contact_title);
	$contact_bio=$res_single->BIOGRAPHY->TEXT;
	$contact_bio=strip_tags($contact_bio);
	$contact_bio=xmlencoding($contact_bio);
	$contact_tit=$res_single->CONTACT->NAME->FORMALTITLE;
	$contact_tit=$contact_tit['value'];
	$contact_tit=xmlencoding($contact_tit);
	$contact_giv=$res_single->CONTACT->NAME->GIVEN;
	$contact_giv=$contact_giv['value'];
	$contact_giv=xmlencoding($contact_giv);
	$contact_fam=$res_single->CONTACT->NAME->FAMILY;
	$contact_fam=$contact_fam['value'];
	$contact_fam=xmlencoding($contact_fam);
	$contact_mail=$res_single->CONTACT->EMAIL;
	$contact_mail=$contact_mail['value'];
	$contact_mail=xmlencoding($contact_mail);
	$contact_phone=$res_single->CONTACT->PHONE;
	$contact_phone=$contact_phone['value'];
	$contact_phone=xmlencoding($contact_phone);
	$contact_hours=$res_single->CONTACT->OFFICE->HOURS;
	$contact_hours=$contact_hours['value'];
	$contact_hours=xmlencoding($contact_hours);
	$contact_adr=$res_single->CONTACT->OFFICE->ADDRESS;
	$contact_adr=$contact_adr['value'];
	$contact_adr=xmlencoding($contact_adr);
	$contact_hp=$res_single->CONTACT->HOMEPAGE;
	$contact_hp=$contact_hp['value'];
	$contact_hp=xmlencoding($contact_hp);
$contact_all.="<h3>" . $contact_title . "</h3><br>" .$contact_bio . "<br>". $contact_tit . " " . $contact_giv . " " . $contact_fam;
$contact_all.="<br>E-Mail: " . $contact_mail .  "<br>Telefon: " . $contact_phone . "<br>Sprechzeiten: " . $contact_hours . "<br>Buero: " . $contact_adr . "<br>" . $contact_hp . "<br><br>";
$contact_all=xmlencoding($contact_all);

$order++;
$contactorder=$order;


}
elseif($residentcontenthandler=="resource/x-bb-wiki")
{
	$mod_label=false;
	$wiki_id++;
		$wiki_title=$res_single->name;
	$wiki_title=strip_tags($wiki_title);
	$wiki_title=xmlencoding($wiki_title);
		$wiki_des=$res_single->descriptionText;
	//$yt_text=internerlink($yt_text);
	$wiki_des=xmlencoding($wiki_des);

	$wikiitem= new wiki ($wiki_id, $wiki_title, $wiki_des, "1");
$arr_wikis[]=$wikiitem;
	$wikipageid=0;
foreach($res_single->pages->page as $wikipage)
{
	$versions= count($wikipage->versions->version);
	$v=0;
	$wikipageid++;
	foreach($wikipage->versions->version as $version)
	{
		$arr_all=array();//takes embedded images and embedded files
		$arrmitembeddedfiles=array();
		$bild=array();
		$v++;
		if($v==$versions){
		$wikipagetitle= xmlencoding($version->name);
		
		$timestamp=$version->createdOn;
$dtime=preg_replace("/MESZ/", "", $timestamp);
$dtime=trim($dtime);
	
		$timestamp_new = strtotime($dtime);
		
		
	$wikipagetext=$version->contentText;
	$bild=bild($wikipagetext, $dir, $wikipageid, $resident, $direxport, $mod_label);
	if(count($bild)>0)//nur wenn eingebettete Dateien vorhanden sind
	{
		$wikipagetext=$bild[1];
	}
	//bild[3] array mit fileitems
	if(isset($bild[3]) && count($bild[3]>0))
	{
		$arrmitembeddedfiles=$bild[3];//die elemente des zur�ckgegebenen arrays werden in hauptarray eingef�gt
		for($i=0;$i<count($bild[3]); $i++)
		{
	
		$arr_files_embedded_wiki[]=$arrmitembeddedfiles[$i];
		$arr_all[]=$arrmitembeddedfiles[$i];
	
		
		}//for
		}//if
		$wikipagetext=xmlencoding($wikipagetext);
		$wikipage= new wikipage ($wikipageid, $wikipagetitle, $wikipagetext, $timestamp_new);
		$wikiitem->setPages($wikipage);
		}//if
		
	}//foreach
}//foreach
	//$wikiitem= new wiki ($wikid, $wiki_title, $wiki_text, "", $section_wiki, $linkrefwiki);
	//$arr_wikis[]=$wikiitem;
	
}
elseif($residentcontenthandler=="resource/x-bb-discussionboard")//
{
$mod_label=false;
$messagetext_all="";
$arr_all=array();//takes embedded images and embedded files
$arrmitembeddedfiles=array();
$bild=array();
$forumid=$res_single['id'];
$forumid = preg_replace('![^0-9]!', '', $forumid); //ersetze alles au�er 0 bis 9
//****************************************************************************************
$title=$res_single->TITLE;
$forumtitle=xmlencoding($title['value']);
$forumdescription=$res_single->DESCRIPTION->TEXT;
$forumdescription=xmlencoding($forumdescription);
//*****************************************************
$daten2 = simplexml_load_file($resdat, "SimpleXMLIterator");//run through all .dat files
$sxi2 = new RecursiveIteratorIterator(
		$daten2,
		RecursiveIteratorIterator::SELF_FIRST);

foreach($sxi2 as $mess )
{

	$messagetitle=$mess->MSG->TITLE;
	
	$messagetitle=xmlencoding($messagetitle['value']);

	
	$messagetext=$mess->MSG->MESSAGETEXT->TEXT;

	if(isset($messagetitle) && $messagetitle!=="")
	{
		
	$zwischen=xmlencoding("<h3>" . $messagetitle .  "</h3>" . $messagetext . "<br><br>");
	$messagetext_all.=$zwischen;
	}
	$messagetext="";
	$messagetitle="";
}
		//*****************************************************************

//************************************************************************************

		/*$forumitem= new page ($forumid, $forumtitle, $messagetext_all, $forumdescription, $arr_all, "1");
		$arr_pages[]=$forumitem;
		$order++;
		$arr_allItems[$order]=$forumitem;*/
	
}
elseif($residentcontenthandler=="resource/x-bb-link")//Verlinkung von Tests
{
	
	$referrer=$res_single->REFERRER;
	$referrerid=$referrer['id'];

	$resdat2=$dir . "/" . $referrerid . ".dat";//directory
	$res_single2=simplexml_load_file($resdat2);
	$parentquid=$res_single2->PARENTID;
	$parentquid=$parentquid['value'];
	$referrertext=$res_single2->BODY->TEXT;

if(isset($parentquid) && $parentquid!=="")
		{
	$parentquid = preg_replace('![^0-9]!', '', $parentquid); //ersetze alles au�er 0 bis 9
	if($iter==false)
	{
	$section_qu=checkParentid($parentquid, $arr_parentids, $arr);//gibt sectionid zur�ck
	}
	else 
	{
		$section_qu=checkParentid2($parentquid, $arr_parentids_3);//gibt sectionid zur�ck
	}

	//*****************************
	$referrerto=$res_single->REFERREDTO;
	$referrertoid=$referrerto['id'];
	
	$resdat3=$dir . "/" . $referrertoid . ".dat";//directory
	$res_single3=simplexml_load_file($resdat3);
	//***************************************************
	$res_quiz=$res_single3->ASMTID;
	$res_quizid=$res_quiz['value'];

	$resdat4=$dir . "/" . $res_quizid . ".dat";//directory

	$res_single4=simplexml_load_file($resdat4);
	$resquizid=$res_single4->assessment->assessmentmetadata->bbmd_asi_object_id;
	
	$resquizid=trim($resquizid);
	$resquizid=str_replace("_", "", $resquizid);
	//$t2=$res_single4->assessment;
	//echo $t2['title'];
	//echo "<br>";
	
	//*******************************************************
	for($i=0; $i<count($quiz_ar2); $i++)
	{
		//*************************************************
		//**************************
		$quizidtemp=$quiz_ar2[$i]->getId();
	
		if($quizidtemp==$resquizid)
		{
	//$t1=$res_single4->assessment;
	//echo $t1['title'];
	//echo "<br>";
			//echo $quiz_ar[$i]->getName();
			//echo "<br>";
		
			$quiz_ar2[$i]->setSectionid($section_qu);
			if($referrertext!=="")
			$quiz_ar2[$i]->updateDescription($referrertext);
		}
	}
//content-dat
//*************************************************

	for($i=0; $i<count($quiz_ar); $i++)
	{
			$quizidtemp=$quiz_ar[$i]->getId();

		if($quizidtemp==$resquizid)
		{
	
			$quiz_ar[$i]->setSectionid($section_qu);
		}
	
	}

	for($i=0; $i<count($survey_ar); $i++)
	{
	$quizidtemp=$survey_ar[$i]->getContextId();
	
	if($quizidtemp==$resquizid)
	{
	
	$survey_ar[$i]->setSectionid($section_qu);
	
	}
	
	}
	//**********************************************
		}//if isset
}//elseif

}//foreach
//**************************************************
if(isset($contactid)&& $contactid!=="")
{
$contactitem= new page ($contactid, "Kontakt", $contact_all, "", "", "1");
$arr_pages2["$contactid"]=$contactitem;
$arr_pages[]=$contactitem;
$arr_allItems[$contactorder]=$contactitem;
$arr_parentids_3["1"]->setSectionorder($contactid);



}
//****************************************************
echo "Wikis: " . count($arr_wikis);

?>