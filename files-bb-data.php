<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//******************************************************DATEIEN
//****************************************************************

foreach ($daten->resources->resource as $res) {
	$countfiles=0;
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
			$title=$res_single->TITLE;
			$title=$title['value'];
			
			foreach ($res_single->FILES->FILE->LINKNAME as $file) {
				$countfiles++;
				$filename=$file['value']; //richtiger Dateiname

				if(preg_match("`^.*\.(htm|html)$`", $filename)){
					//******************
					$indexhtmtext="<p>HTML files are not converted.</p>";
					$exportlogData.=$indexhtmtext;
					$arrtemp=array();
					$labelitem= new label ($labelid, "htm", "HTML files are not converted.",  $section, $arrtemp, $labelid);
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
	   // echo $filename;
	   // echo "<br>";
	   // echo $filename2;
	   // echo "<br>";
	  
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
			if($countfiles>1)
			{
			$arrtemp=array();
			$htmltitle="<h4><span class=\"\" style=\"color: rgb(141, 174, 16);\">" . $title .  "</span></h4>";
			$htmltitle=xmlencoding($htmltitle);
			$labelitem= new label ($labelid, "Headline", $htmltitle,  $section, $arrtemp, $labelid);
			$arr_labels[]=$labelitem;
			$labelid++;
			}
		}//ende if isset
	}
	}
}//ende foreach dateien
?>