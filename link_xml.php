<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universit�t Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
if(count($arr_links)>0)
{
	 for($i=0; $i<count($arr_links); $i++)
{
$linkid=$arr_links[$i]->getId();
$linktitle=$arr_links[$i]->getTitle();
if(strlen($linktitle)>240)
		{
			$exportlogData.= "Original link name  " . $linktitle . "too long. It had to be shortened. Here the original text: " . $linktitle ."\n";
			$linktitle=substr($linktitle,0,250);
			
		}
$linktext=$arr_links[$i]->getText();
$linkurl=$arr_links[$i]->getUrl();
$indent=$arr_links[$i]->getIndent();
$available=$arr_links[$i]->getAvailable();
$section=$arr_links[$i]->getSection();
$section=$section+$sectionstart;
$urlfiles=$arr_links[$i]->getAr();
$linkpfad=$direxport . "/activities/url_" . $linkid;
if(is_dir($linkpfad))
{
	
}
else 
{
mkdir($linkpfad, 0700);
}
$pfad3= $linkpfad . "/grades.xml";//grades
copy("activities_src/grades.xml", $pfad3);
$pfad4= $linkpfad . "/roles.xml";//roles
copy("activities_src/roles.xml", $pfad4);
$pfad5= $linkpfad . "/inforef.xml";//inforef
copy("activities_src/inforef.xml", $pfad5);

//********************************************************
//**********************************************module.xml
$xmlfile16='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile16.="<module id=\"" . $linkid . "\" version=\"" . $linkmoduleversion . "\">
  <modulename>url</modulename>
  <sectionid>" . $section . "</sectionid>
  <sectionnumber>" .  $section . "</sectionnumber>
  <idnumber></idnumber>
  <added>0</added>
  <score>0</score>
  <indent>" . $indent . "</indent>
  <visible>" . $available . "</visible>
  <visibleold>1</visibleold>
  <groupmode>1</groupmode>
  <groupingid>0</groupingid>
  <groupmembersonly>0</groupmembersonly>
  <completion>0</completion>
  <completiongradeitemnumber>$@NULL@$</completiongradeitemnumber>
  <completionview>0</completionview>
  <completionexpected>0</completionexpected>
  <availablefrom>0</availablefrom>
  <availableuntil>0</availableuntil>
  <showavailability>1</showavailability>
  <showdescription>1</showdescription>
  <availability_info>
  </availability_info>
</module>";
$file16 = fopen($linkpfad . "/module.xml","w");
fwrite($file16,$xmlfile16);
fclose($file16);
//*************************************************url.xml
$xmlfile17='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile17.="<activity id=\"" . $linkid . "\" moduleid=\"" . $linkid . "\" modulename=\"url\" contextid=\"" . $linkid . "\">
<url id=\"" . $linkid . "\">
<name>". $linktitle . "</name>
<intro>" . $linktext . "</intro>
<introformat>1</introformat>
<externalurl>" . $linkurl . "</externalurl>
<contentformat>1</contentformat>
<legacyfiles>0</legacyfiles>
<legacyfileslast>$@NULL@$</legacyfileslast>
<display>3</display>
<displayoptions>a:0:{}</displayoptions>
<parameters>a:0:{}</parameters>
<timemodified>0</timemodified>
</url>
</activity>";
$file17 = fopen($linkpfad . "/url.xml","w");
fwrite($file17,$xmlfile17);
fclose($file17);
//***********************************************************
$xmlfile17a='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile17a.="<inforef>";
if(count($urlfiles)>0)
{
$xmlfile17a.="<fileref>";
for ($b=0; $b < count($urlfiles); $b++)
{
	$fileid=$urlfiles[$b]->getId();
   $xmlfile17a.="<file>";
     $xmlfile17a.=" <id>" . $fileid . "</id>";
    $xmlfile17a.="</file>";
}
    $xmlfile17a.="</fileref>";
}
 $xmlfile17a.="</inforef>";
$file17a = fopen($linkpfad . "/inforef.xml","w");
fwrite($file17a,$xmlfile17a);
fclose($file17a);

//**************************************************
}
}//ende 
?>