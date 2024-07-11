<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//directories für page
//grades, roles, inforef, module, page
////////////////
if($iter==false)
{
if(count($arr_pages)>0)
{
	
	for($i=0; $i<count($arr_pages); $i++)
	{
		$indent=$arr_pages[$i]->getIndent();
		$available=$arr_pages[$i]->getAvailable();
		$pageid=$arr_pages[$i]->getId();
		$pagetitle=$arr_pages[$i]->getTitle();
		$pagetext=$arr_pages[$i]->getText();
		$pagedescription=$arr_pages[$i]->getDescription();
		$pagefiles=$arr_pages[$i]->getAr();
		$section=$arr_pages[$i]->getSection();
		$section=$section+$sectionstart;
		$pagepfad=$direxport . "/activities/page_" . $pageid;
		if(is_dir($pagepfad))
		{

		}
		else
		{
		mkdir($pagepfad, 0700);
}
$pfad3= $pagepfad . "/grades.xml";//grades
copy("activities_src/grades.xml", $pfad3);
$pfad4= $pagepfad . "/roles.xml";//roles
copy("activities_src/roles.xml", $pfad4);
		//$pfad5= $pagepfad . "/inforef.xml";//inforef
		//copy("activities_src/inforef.xml", $pfad5);

		//********************************************************
		//**********************************************module.xml
$xmlfile13='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile13.="<module id=\"" . $pageid . "\" version=\"" . $pagemoduleversion . "\">
  <modulename>page</modulename>
  <sectionid>" . $section . "</sectionid>
  <sectionnumber>" .  $section . "</sectionnumber>
  <idnumber></idnumber>
  <added>0</added>
  <score>0</score>
  <indent>" . $indent . "</indent>
  <visible>". $available . "</visible>
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
  <showdescription>0</showdescription>
  <availability_info>
  </availability_info>
  </module>";
$file13 = fopen($pagepfad . "/module.xml","w");
fwrite($file13,$xmlfile13);
fclose($file13);
//*************************************************page.xml
$xmlfile14='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile14.="<activity id=\"" . $pageid . "\" moduleid=\"" . $pageid . "\" modulename=\"page\" contextid=\"" . $pageid . "\">
<page id=\"" . $pageid . "\">
<name>". $pagetitle . "</name>
<intro>" . $pagedescription . "</intro>
<introformat>1</introformat>
<content>" . $pagetext . "</content>
<contentformat>1</contentformat>
<legacyfiles>0</legacyfiles>
<legacyfileslast>$@NULL@$</legacyfileslast>
<display>5</display>
<displayoptions>a:1:{s:10:\"printintro\";s:1:\"0\";}</displayoptions>
<revision>1</revision>
<timemodified>" . $aktuellesdatum . "</timemodified>
</page>
</activity>";
$file14 = fopen($pagepfad . "/page.xml","w");
fwrite($file14,$xmlfile14);
fclose($file14);
//***********************************************************
//**********************************************inforef.xml
$xmlfile15='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile15.="<inforef>";
	if(count($pagefiles)>0)
	{
	$xmlfile15.="<fileref>";
	//echo "count pagefiles " . count($pagefiles);
	for ($b=0; $b < count($pagefiles); $b++)
	{
	$fileid=$pagefiles[$b]->getId();
	$xmlfile15.="<file>";
	$xmlfile15.=" <id>" . $fileid . "</id>";
	$xmlfile15.="</file>";
}
			$xmlfile15.="</fileref>";
}
 $xmlfile15.="</inforef>";
 $file15 = fopen($pagepfad . "/inforef.xml","w");
 fwrite($file15,$xmlfile15);
 fclose($file15);
 //**************************************************

//**************************************************
}
}//ende pages
//***********************************************************************************************
}
else 
{
if(count($arr_pages2)>0)
{

	foreach($arr_pages2 as $arp)
	{

		$pageid=$arp->getId();
	
		$pagetitle=$arp->getTitle();

		$pagetext=trim($arp->getText());
		//if($pagetext!=="")
		///{
			
			$pagedescription=$arp->getDescription();
			$pagefiles=$arp->getAr();
$indent=$arp->getIndent();
		$available=$arp->getAvailable();
			$section=$arp->getSection();
			$section=$section+$sectionstart;
			$pagepfad=$direxport . "/activities/page_" . $pageid;
			if(is_dir($pagepfad))
			{

			}
			else
			{
				mkdir($pagepfad, 0700);
			}
			$pfad3= $pagepfad . "/grades.xml";//grades
			copy("activities_src/grades.xml", $pfad3);
			$pfad4= $pagepfad . "/roles.xml";//roles
			copy("activities_src/roles.xml", $pfad4);
			//$pfad5= $pagepfad . "/inforef.xml";//inforef
			//copy("activities_src/inforef.xml", $pfad5);

			//********************************************************
			//**********************************************module.xml
			$xmlfile13='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
			$xmlfile13.="<module id=\"" . $pageid . "\" version=\"" . $pagemoduleversion . "\">
  <modulename>page</modulename>
  <sectionid>" . $section . "</sectionid>
  <sectionnumber>" .  $section . "</sectionnumber>
  <idnumber></idnumber>
  <added>0</added>
  <score>0</score>
  <indent>" . $indent. "</indent>
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
  <showdescription>0</showdescription>
  <availability_info>
  </availability_info>
  </module>";
			$file13 = fopen($pagepfad . "/module.xml","w");
			fwrite($file13,$xmlfile13);
			fclose($file13);
			//*************************************************page.xml
			$xmlfile14='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
			$xmlfile14.="<activity id=\"" . $pageid . "\" moduleid=\"" . $pageid . "\" modulename=\"page\" contextid=\"" . $pageid . "\">
<page id=\"" . $pageid . "\">
<name>". $pagetitle . "</name>
<intro>Beschreibung</intro>
<introformat>1</introformat>
<content>" . $pagetext . "</content>
<contentformat>1</contentformat>
<legacyfiles>0</legacyfiles>
<legacyfileslast>$@NULL@$</legacyfileslast>
<display>5</display>
<displayoptions>a:1:{s:10:\"printintro\";s:1:\"0\";}</displayoptions>
<revision>1</revision>
<timemodified>" . $aktuellesdatum . "</timemodified>
</page>
</activity>";
			$file14 = fopen($pagepfad . "/page.xml","w");
			fwrite($file14,$xmlfile14);
			fclose($file14);
			//***********************************************************
			//**********************************************inforef.xml
			$xmlfile15='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
			$xmlfile15.="<inforef>";
			if(isset($pagefiles) && count($pagefiles)>0 && $pagefiles!=="")
			{
				$xmlfile15.="<fileref>";
				for ($b=0; $b < count($pagefiles); $b++)
				{
					$fileid=$pagefiles[$b]->getId();
					$xmlfile15.="<file>";
					$xmlfile15.=" <id>" . $fileid . "</id>";
	$xmlfile15.="</file>";
			}
			$xmlfile15.="</fileref>";
//}
 $xmlfile15.="</inforef>";
 $file15 = fopen($pagepfad . "/inforef.xml","w");
 fwrite($file15,$xmlfile15);
 fclose($file15);
 //**************************************************

 //**************************************************
}
	}
}//ende pages
}
?>