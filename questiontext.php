<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
foreach ($flow->flow as $flow2) {
	$arrmitembeddedfiles=array();
	if($flow2['class']=="FORMATTED_TEXT_BLOCK")
	{
	$qt=$question->presentation->flow->flow->flow->material->mat_extension->mat_formattedtext;

		//$qt=strip_tags($qt, "<img>");
		 //**********************************************
		$filearea="questiontext";
$questiontext=bild2($qt, $dir, $quid, $resident, $direxport, $contextid, $filearea);//array mit img-infos
//das muss bei moodle stehen: ><img src="@@PLUGINFILE@@/tab2.jpg" width="300" height="200" /

if(isset($questiontext[1]) && $questiontext!=="")
{
$qt=$questiontext[1];

$arrmitembeddedfiles=$questiontext[3];
for($i=0;$i<count($questiontext[3]); $i++)
{
	$arr_files_embedded_quiz[]=$arrmitembeddedfiles[$i];
}
}
else 
{
	
}
	}
	elseif($flow2['class']=="FILE_BLOCK")
	{
	
	$fileblock=$flow2->material->matapplication['label'];
	
	$dateibeifrage2=dateibeifrage($fileblock, $dir, $quid, $resident, $direxport, $contextid, "questiontext");
	$arrmitembeddedfiles=$dateibeifrage2[2];
	for($i=0;$i<count($dateibeifrage2[2]); $i++)
{
	$arr_files_embedded_quiz[]=$arrmitembeddedfiles[$i];
}
}//ende elseif

}
//**********************************
if($questiontitle=="")
{
	$qt2=$qt;
	$suchmuster='/<img[^>]+>/i';
	preg_match($suchmuster, $qt2, $treffer);
	if(count($treffer)>0)
	{
		//echo $treffer[0];
		//echo "<br>";
		$qt2=str_replace($treffer[0], "", $qt2);
	}

	$questiontitle=strip_tags($qt2);

	$questiontitle_ar=explode(" ", $questiontitle);
	for($i=0;$i<6;$i++)
	{
		$questiontitle_new .= $questiontitle_ar[$i] . " ";
	}
	
	//$questiontitle=substr($questiontitle_new,0,30);
	
	$questiontitle=xmlencoding($questiontitle_new);
	//echo "sdkfsdlkfjsdf" . $questiontitle;
	$questiontitle_new="";
	}

//*****************************************
if(isset($dateibeifrage2[1])&& $dateibeifrage2[1]!=="")
{
$qt = $qt . "   " . $dateibeifrage2[1];
$qt=xmlencoding($qt);
$dateibeifrage2=array();
}
else 
{
	$qt=xmlencoding($qt);
}
//******************************************************************

?>