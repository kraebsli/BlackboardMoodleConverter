<?php
//******************************************************DATEIEN
//****************************************************************
foreach ($daten->resources->resource as $res) {

	//echo $res['identifier'];
	//	echo "<br>";
	$resident=$res['identifier'];//
	//******************************************************
	if($resident!=="")
	{
		$resdat=$dir . "/" . $resident . ".dat";//directory
		$res_single=simplexml_load_file($resdat);
		if($res_single!==false)
		{
		if(isset($res_single->FILES->FILE->LINKNAME))
		{
			foreach ($res_single->FILES->FILE->LINKNAME as $file) {
				$filename=$file['value']; //richtiger Dateiname

				if(preg_match("`^.*\.(htm|html)$`", $filename)){
					//******************
					$indexhtmtext="<p>HTML-Dateien werden nicht uebernommen. Exportieren Sie diese aus Ihrem Blackboard-Kurs separat.</p>";
					$arrtemp=array();
					$labelitem= new label ($labelid, "htm", "HTML-Dateien werden nicht uebernommen.",  $section, $arrtemp, $labelid);
					$arr_labels[]=$labelitem;
					$labelid++;
				}
				else
				{
					$parentid=$res_single->PARENTID;
					$parentid=trim($parentid['value']);
				
					if(	$parentid!=="{unset id}")
					{
					
					$parentid = preg_replace('![^0-9]!', '', $parentid); //ersetze alles außer 0 bis 9
				
					//*****************
		$available=$res_single->FLAGS->ISAVAILABLE;
	    $available=$available['value'];

	    $section=checkParentid($parentid, $arr_parentids, $arr);//gibt sectionid zurück
	    $fileid=$res_single->FILES->FILE;
	    $title=$res_single->TITLE;
	    $title=$title['value'];
	    
	    //$title=xmlencoding($title);
	    $fileid=$fileid['id'];
	    $fileid = str_replace( "_", "", $fileid );
	    $filename2=$res_single->FILES->FILE->NAME; // mit xid kein Dateiname
		$zeichen=strpos($filename2, "/");
	    if($zeichen=== false)
	    {

	    }
	    else
	    {
	    	$filename2=substr($filename2, 1);//ohne "/" vor dem Dateinamen
	    }

	    $fileitem= new file ($filename, $fileid,$filename2, $title, $resident, $parentid, $section);
	    $arr_files[]=$fileitem;
	    if($parentid=="{unset id}")
	    {
	    }
	    else
	    {
	    	$f=$arr["$parentid"];//Folder wird identifiziert
	    	$f->setFiles($fileitem);//dem Folder wird das File zugeordnet
	    }
	    //***************************
	    //echo "<br>";
	    $pagedescription=$title;
				}
				}//if filename

				//label erzeugen


				

			}//ende foreach
		}//ende if isset
	}
	}
}//ende foreach dateien
?>