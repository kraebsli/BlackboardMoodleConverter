<?php
//*****************************************************Texte
foreach ($daten->resources->resource as $res) {

	$resident=$res['identifier'];
	$residentcontenthandler=$res['type'];
	//******************************************************
	$resdat=$dir . "/" . $resident . ".dat";//directory
	$res_single=simplexml_load_file($resdat);
	$contenthandler=$res_single->CONTENTHANDLER;
	$contenthandler=trim($contenthandler['value']);
	$mod_label="";
	$parentid=$res_single->PARENTID;
	$parentid=$parentid['value'];
	
	if($contenthandler=="resource/x-bb-document")
	{
$arr_all=array();//for page activity
		$arrmitembeddedfiles=array();
		$bild=array();
		$pageid=$res_single['id'];
		$pageid = preg_replace('![^0-9]!', '', $pageid); //ersetze alles außer 0 bis 9
		
		$parentid = preg_replace('![^0-9]!', '', $parentid); //ersetze alles außer 0 bis 9
		$section=checkParentid($parentid, $arr_parentids, $arr);//gibt sectionid zurück
		$title=$res_single->TITLE;
		
		$pagetitle=xmlencoding($title['value']);

		$pagetext=$res_single->BODY->TEXT;
		$pagetext=trim($pagetext);
		//echo "**************************************************";
		//echo "<br>";
		if(strlen($pagetext)>500)
		{
		$mod_label=false;
		$bild=bild($pagetext, $dir, $pageid, $resident, $direxport, $mod_label);//array mit img-infos
		//das muss bei moodle stehen: ><img src="@@PLUGINFILE@@/tab2.jpg" width="300" height="200" />
		}
		else 
		{
			
			$mod_label=true;
			$bild=bild($pagetext, $dir, $pageid, $resident, $direxport, $mod_label);
		
		}
		//************************************************************************************
		if(count($bild)>0)//nur wenn eingebettete Dateien vorhanden sind
		{
			$pagetext=$bild[1];

			
			
		}
		//bild[3] array mit fileitems
		if(isset($bild[3]) && count($bild[3]>0))
		{
			$arrmitembeddedfiles=$bild[3];//die elemente des zurückgegebenen arrays werden in hauptarray eingefügt
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


	}//if
	}//for
	//**********************************************only FILES**************************************
	//**********************************************************************************************
	foreach($res_single->FILES->FILE as $pfile)
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
if(preg_match("`^.*\.(htm|html)$`", $fname[1])){
$textlabel=$fname[1] . ": HTML-Dateien werden aus Blackboard nicht in Moodle uebernommen .";
$topitemid1="";
$arrmitembeddedfiles2=array();
	$textlabel=xmlencoding($textlabel);
	$labelitem= new label ($labelid, "Info", $textlabel,  $section, $arrmitembeddedfiles2, $topitemid1);
	$arr_labels[]=$labelitem;
	$labelid++;
	}
	elseif(isset($fname[1]) && $fname[1]!=="")
	{
		//if($htmlzeichen===false)
			//{

		$fileitem= new file ($fname[1], $fileid,$filename2, $title['value'], $resident, $parentid, $section);
		$arr_files[]=$fileitem;
		$f=$arr["$parentid"];//Folder wird identifiziert
		$f->setFiles($fileitem);//dem Folder wird das File zugeordnet
		$pagedescription=$pagetitle;
	}
	else
	{
		$textlabel=$pagetitle . ": Datei konnte nicht wiederhergestellt werden.";
		$topitemid1="";
		$arrmitembeddedfiles2=array();
		$textlabel=xmlencoding($textlabel);
		$labelitem= new label ($labelid, "Info", $textlabel,  $section, $arrmitembeddedfiles2, $topitemid1);
		$arr_labels[]=$labelitem;
		$labelid++;
	}
	//}
		//else
			//{//label erzeugen

			//$indexhtmtext="<p>HTMLDateien werden nicht uebernommen. Exportieren Sie diese aus Ihrem Blackboard-Kurs separat.</p>";
			//$pagedescription="nicht uebernommen.";
			//$pagetitle.=" " . $pagedescription;
			//}
		//*****************************************************
		//*****************************************************

	}//************FILES
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
						$arrmitembeddedfiles=$pagetext2[3];//die elemente des zurückgegebenen arrays werden in hauptarray eingefügt
						$f=$arr["$folderid"];//Folder wird identifiziert
						for($i=0;$i<count($pagetext2[3]); $i++)
						{
						$arr_files[]=$arrmitembeddedfiles[$i];
						$arr_all[]=$arrmitembeddedfiles[$i];
						
						$f->setFiles($arrmitembeddedfiles[$i]);//dem Folder wird das File zugeordnet
						}
						}//if isset
						//***********************************************************

		if($mod_label==false)
		{
			//id, title, text, description
			$pageitem= new page ($pageid, $pagetitle, $pagetext, $pagedescription, $arr_all, $section);
			$arr_pages[]=$pageitem;
		}
		else
		{
			
			$pagetext=$pagetitle . ": " . $pagetext;
			$labelitem= new label ($labelid, $pagetitle, $pagetext,  $section, $arr_all, $pageid);
			$arr_labels[]=$labelitem;
			$labelid++;
		}
	}
	//**********************************************
	}//*********************************************************************************
	elseif($contenthandler=="resource/x-bb-externallink")
	{
		$linkid=$res_single['id'];
		$linkid = preg_replace('![^0-9]!','', $linkid); //ersetze alles außer 0 bis 9
		$parentlinkid=$res_single->PARENTID;
		$parentlinkid=$parentlinkid['value'];
		$parentlinkid = preg_replace('![^0-9]!', '', $parentlinkid); //ersetze alles außer 0 bis 9
		$section_link=checkParentid($parentlinkid, $arr_parentids, $arr);//gibt sectionid zurück
		$linktitle=$res_single->TITLE;
		$linktitle=strip_tags($linktitle['value']);
		$linktitle=xmlencoding($linktitle);
		$linktext=$res_single->BODY->TEXT;
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
		if(count($bild[3]))
		{
			$arrmitembeddedfiles=$bild[3];//die elemente des zurückgegebenen arrays werden in hauptarray eingefügt
			for($i=0;$i<count($bild[3]); $i++)
			{

				$arr_files_embedded_url[]=$arrmitembeddedfiles[$i];
	}
	}
	//***********************************************
	//$linktext=internerlink($linktext);
	$linktext=xmlencoding($linktext);
	
	$linkitem= new link ($linkid, $linktitle,$linktext, $linkurl, $section_link, $arrmitembeddedfiles);
	//************************************************
	$arr_links[]=$linkitem;
	//*******************************************************************************
}//ende if links
elseif($contenthandler=="resource/x-bb-youtube-mashup")
{
	$ytid=$res_single['id'];
	$ytid = preg_replace('![^0-9]!','', $ytid); //ersetze alles außer 0 bis 9
	$parentytid=$res_single->PARENTID;
	$parentytid=$parentytid['value'];
	$parentytid = preg_replace('![^0-9]!', '', $parentytid); //ersetze alles außer 0 bis 9
	$section_yt=checkParentid($parentytid, $arr_parentids, $arr);//gibt sectionid zurück
	$yt_title=$res_single->TITLE;
	$yt_title=strip_tags($yt_title['value']);
	$yt_title=xmlencoding($yt_title);
	$yt_text=$res_single->BODY->TEXT;
	$yt_text=internerlink($yt_text);
	$yt_text=xmlencoding($yt_text);
	//vermutlich ohne Bilder
	//Youtube-Mashup als Textfeld
	//Youtube-Url: URL value, nicht voreingestellt
	//FILES
	//verschiedene Arten des Einbettens
	$arrmitembeddedfiles=array();
	$ytitem= new page ($ytid, $yt_title, $yt_text, "", $arrmitembeddedfiles, $section_yt);
	$arr_pages[]=$ytitem;
}
elseif($residentcontenthandler=="resource/x-bb-link")//Verlinkung von Tests
{
	$referrer=$res_single->REFERRER;
	$referrerid=$referrer['id'];
	$resdat2=$dir . "/" . $referrerid . ".dat";//directory
	$res_single2=simplexml_load_file($resdat2);
	$parentquid=$res_single2->PARENTID;
	$parentquid=$parentquid['value'];
if(isset($parentquid) && $parentquid!=="")
		{
	$parentquid = preg_replace('![^0-9]!', '', $parentquid); //ersetze alles außer 0 bis 9
	$section_qu=checkParentid($parentquid, $arr_parentids, $arr);//gibt sectionid zurück

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
	for($i=0; $i<count($quiz_ar); $i++)
	{
		//*************************************************
		//**************************
		$quizidtemp=$quiz_ar[$i]->getId();

		if($quizidtemp==$resquizid)
		{
	//$t1=$res_single4->assessment;
	//echo $t1['title'];
	//echo "<br>";
			//echo $quiz_ar[$i]->getName();
			//echo "<br>";
			$quiz_ar[$i]->setSectionid($section_qu);
		}
	}
//content-dat
//*************************************************

	for($i=0; $i<count($quiz_ar2); $i++)
	{
			$quizidtemp=$quiz_ar2[$i]->getId();

		if($quizidtemp==$resquizid)
		{
	
			$quiz_ar2[$i]->setSectionid($section_qu);
		}
	
	}
	
	//**********************************************
		}
}
}
//**************************************************
?>