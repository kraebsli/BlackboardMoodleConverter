<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universitšt Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//**********************************************************************
for($i=0; $i < count($arr_files); $i++)
{
	//**************************
	$fileid=$arr_files[$i]->getId();
	$filename=$arr_files[$i]->getName();
	$title=$arr_files[$i]->getTitle();
	$description=$arr_files[$i]->getDescription();

if($title==$filename){
	$title="";
	$showfileandtitle=$filename;
	
}
else 
{
	if($title!=="")
	{
//$showfileandtitle=$title . ": " . $filename;
$showfileandtitle=$title;
if(strlen($showfileandtitle)>220)
{
	
	$showfileandtitle=$filename;
}
else 
{
	
}
	}
	else 
	{
		$showfileandtitle=$filename;
	}
}
	//**************************************
	/*if ($filename=="PDF")
	{
		$filename=$title;
		$title="";
	}
	if(preg_match("`^.*\.(mp3|pdf|doc|gif|jpg|ppt|pptx)$`", $filename)){
		$filename=$title;
		$title="";

	}*/
	//$filename=$title;
	

	$section=$arr_files[$i]->getSection();
	$section=$section+$sectionstart;
	//*****************************************************
	if(isset($fileid) && $fileid!=="")
	{

		$pfad=$direxport . "/activities/resource_" . $fileid;
		mkdir($pfad, 0700);
		$pfad2= $pfad . "/grades.xml";
		$pfad3= $pfad . "/roles.xml";
		copy("activities_src/grades.xml", $pfad2);
		copy("activities_src/roles.xml", $pfad3);
	}
	//****************inforef.xml*****************************
	$xmlfile3='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
	$xmlfile3.="<inforef>";
	$xmlfile3.="<fileref>";

	$xmlfile3.="<file>";
	$xmlfile3.="<id>";
	$xmlfile3.= $fileid;
	$xmlfile3.="</id>";
	$xmlfile3.="</file>";
	$xmlfile3.="</fileref>";
	$xmlfile3.="</inforef>";
	//************************
	$file3 = fopen($pfad . "/inforef.xml","w");
	fwrite($file3,$xmlfile3);
	fclose($file3);
	//***************************************************************
	//****************module.xml*****************************
	$xmlfile4='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
	$xmlfile4.="<module version=\"" . $filemoduleversion. "\" id=\"" . $fileid . "\">";
	$xmlfile4.="<availablefrom>0</availablefrom><groupmembersonly>0</groupmembersonly>
<availability_info/><completiongradeitemnumber>$@NULL@$</completiongradeitemnumber>
<completionexpected>0</completionexpected><completion>0</completion><groupmode>0</groupmode>
<indent>0</indent><modulename>resource</modulename>
<score>0</score>
<visible>1</visible>
<showdescription>1</showdescription><availableuntil>0</availableuntil>
<sectionnumber>" . $section . "</sectionnumber>";
	$xmlfile4.="<groupingid>0</groupingid><showavailability>0</showavailability>
<sectionid>" . $section . "</sectionid>
<added>" . $aktuellesdatum . "</added><idnumber/><visibleold>1</visibleold>
<completionview>0</completionview>
</module>";
	//************************
	$file4 = fopen($pfad . "/module.xml","w");
	fwrite($file4,$xmlfile4);
	fclose($file4);

	//***************************************************************
	//****************resource.xml*****************************
	$xmlfile5='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
	$xmlfile5.="<activity id=\"" . $i . "\" modulename=\"resource\" contextid=\"" . $fileid . "\" moduleid=\"" . $fileid ."\">";
	$xmlfile5.="<resource id=\"" . $i . "\"><displayoptions>a:2:{s:10:\"printintro\";i:1;s:12:\"printheading\";i:0;}</displayoptions>
<introformat>1</introformat>" .
"<intro>".$description ."</intro>
<timemodified>" . $aktuellesdatum . "</timemodified>
<revision>0</revision>
<legacyfileslast>$@NULL@$</legacyfileslast>
<display>3</display>
<legacyfiles>2</legacyfiles>
<tobemigrated>0</tobemigrated>
<name>" . $showfileandtitle . "</name><filterfiles>0</filterfiles><intro/></resource></activity>";
	$title="";
	//************************
	$file5 = fopen($pfad . "/resource.xml","w");
	fwrite($file5,$xmlfile5);
	fclose($file5);
	//***************************************************************
}//ende for schleife


?>