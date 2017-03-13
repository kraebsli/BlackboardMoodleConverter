<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universit‰t Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//****************************************************BANNER


//********************************************************
foreach ($daten->resources->resource as $res) {

	$resident=$res['identifier'];
	$type=$res['type'];
	if($type=="course/x-bb-coursesetting")
	{

	$resdat=$dir . "/" . $resident . ".dat"; //directory
	$res_single=simplexml_load_file($resdat);
	$banner=trim($res_single->BANNER['value']);
	if($banner!=="")
	{
		
	$zeichen=strpos($banner, "/");
		if($zeichen=== false)
		{
		
		}
		else
		{
			$banner=substr($banner, 1);//ohne "/" vor dem Dateinamen
			$banner=trim($banner);
		}
	//$result=VerzeichnisDurchsuchen2($bbfilepath, $banner);
	//$banner_filename=$result[1];
//	$bild=array();
$fileid = preg_replace('![^0-9]!', '', $banner); //ersetze alles auﬂer 0 bis 9
$bild=bildinlabel($banner, $dir, $labelid, $resident, $direxport);//
$arrmitembeddedfiles=array();
$arrmitembeddedfiles[]=$bild[1];
$labelitem= new label ($labelid, "Banner", $bild[0],  "1", $arrmitembeddedfiles, $labelid);
$arr_labels[]=$labelitem;
$labelid++;
$arr_files_embedded_label[]=$bild[1];//nur ein Element, kein Array
$order++;
$arr_allItems[$order]=$labelitem;

	}
else 
{
/*$bannertext="<p>Ihr Blackboard-Kurs wurde erfolgreich in Moodle wiederhergestellt. Bitte
beachten Sie, dass nicht alle Elemente aus Blackboard uebernommen werden koennen.</p>";
$arrmitembeddedfiles=array();
$labelitem= new label ($labelid, "Start", $bannertext,  "-2", $arrmitembeddedfiles, $labelid);
$arr_labels[]=$labelitem;
$labelid++;*/

}
}
	
}
?>