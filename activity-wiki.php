<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//directories für page
//grades, roles, inforef, module, page
////////////////

if(count($arr_wikis)>0)
{
	
	for($i=0; $i<count($arr_wikis); $i++)
	{
		$wikiid=$arr_wikis[$i]->getId();

		$wikititle=$arr_wikis[$i]->getTitle();
		//$wikitext=$arr_wikis[$i]->getText();
		$wikidescription=$arr_wikis[$i]->getDescription();
		$wikipages=$arr_wikis[$i]->getPages();
		//********************************************************************
		//$pagefiles=$arr_pages[$i]->getAr();
		$section=$arr_wikis[$i]->getSection();
		$section=$section+$sectionstart;
		$wikipfad=$direxport . "/activities/wiki_" . $wikiid;
		if(is_dir($wikipfad))
		{

		}
		else
		{
		mkdir($wikipfad, 0700);
}
$pfad3= $wikipfad . "/grades.xml";//grades
copy("activities_src/grades.xml", $pfad3);
$pfad4= $wikipfad . "/roles.xml";//roles
copy("activities_src/roles.xml", $pfad4);
$userspfad=$direxport ."/users.xml";
copy("users.xml", $userspfad);
		//$pfad5= $pagepfad . "/inforef.xml";//inforef
		//copy("activities_src/inforef.xml", $pfad5);

		//********************************************************
		//**********************************************module.xml
$xmlfile13='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile13.="<module id=\"" . $wikiid . "\" version=\"" . $wikimoduleversion . "\">
  <modulename>wiki</modulename>
  <sectionid>" . $section . "</sectionid>
  <sectionnumber>" .  $section . "</sectionnumber>
  <idnumber></idnumber>
  <added>0</added>
  <score>0</score>
  <indent>0</indent>
  <visible>1</visible>
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
$file13 = fopen($wikipfad . "/module.xml","w");
fwrite($file13,$xmlfile13);
fclose($file13);
//*************************************************wiki.xml
$xmlfile14='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile14.="<activity id=\"" . $wikiid . "\" moduleid=\"" . $wikiid . "\" modulename=\"wiki\" contextid=\"" . $wikiid . "\">
<wiki id=\"" . $wikiid . "\">
<name>". $wikititle . "</name>
<intro>" . $wikidescription . "</intro>
<introformat>1</introformat>
<timecreated>0</timecreated>
<timemodified>" . $aktuellesdatum . "</timemodified>
<firstpagetitle>Start</firstpagetitle>
<wikimode>collaborative</wikimode>
<defaultformat>html</defaultformat>
<forceformat>0</forceformat>
<editbegin>0</editbegin>
<editend>0</editend>
<subwikis>
<subwiki id=\"1\">
<groupid>0</groupid>
<userid>0</userid>
<pages>";
$xmlfile14.= "<page id=\"" . $wikipageid . "\">";
$xmlfile14.= "<title>Start</title>";
$xmlfile14.= "<cachedcontent> </cachedcontent>";
$xmlfile14.= "<timecreated>" . $aktuellesdatum  . "</timecreated>";
$xmlfile14.= "<timemodified>" . $aktuellesdatum  . "</timemodified>";
$xmlfile14.= "<timerendered>" . $aktuellesdatum . "</timerendered>";
$xmlfile14.= "<userid>22</userid>";
$xmlfile14.= "<pageviews>1</pageviews>";
$xmlfile14.= "<readonly>0</readonly>";
	$xmlfile14.= "<versions>";
			$xmlfile14.= "<version id=\"1\">";
 $xmlfile14.= "<content> </content>";
 $xmlfile14.= "<contentformat>html</contentformat>";
 $xmlfile14.= "<version>0</version>";
 $xmlfile14.= "<timecreated>" . $aktuellesdatum . "</timecreated>";
 $xmlfile14.= "<userid>22</userid>";
 $xmlfile14.= "</version>";
$xmlfile14.=" </versions>";
$xmlfile14.= "<tags></tags>";
$xmlfile14.= "</page>";
		for($w=0; $w< count($wikipages); $w++)
		{
			$wikipageid=$wikipages[$w]->getId();
			$wikipagetitle=$wikipages[$w]->getTitle();;
			$wikipagecontent=$wikipages[$w]->getText();;
			$wikipagedate=$wikipages[$w]->getDatum();;
			$xmlfile14.= "<page id=\"" . $wikipageid . "\">";
			$xmlfile14.= "<title>" . $wikipagetitle . "</title>";
			$xmlfile14.= "<cachedcontent>" . $wikipagecontent . "</cachedcontent>";
			$xmlfile14.= "<timecreated>" . $wikipagedate  . "</timecreated>";
			$xmlfile14.= "<timemodified>" . $wikipagedate  . "</timemodified>";
			$xmlfile14.= "<timerendered>" . $wikipagedate . "</timerendered>";
			$xmlfile14.= "<userid>22</userid>";
			$xmlfile14.= "<pageviews>1</pageviews>";
			$xmlfile14.= "<readonly>0</readonly>";
			$xmlfile14.= "<versions>";
			$xmlfile14.= "<version id=\"1\">";
 $xmlfile14.= "<content>$wikipagecontent</content>";
 $xmlfile14.= "<contentformat>html</contentformat>";
 $xmlfile14.= "<version>0</version>";
 $xmlfile14.= "<timecreated>" . $wikipagedate . "</timecreated>";
 $xmlfile14.= "<userid>22</userid>";
 $xmlfile14.= "</version>";
$xmlfile14.=" </versions>";
			$xmlfile14.= "<tags></tags>";
			$xmlfile14.= "</page>";
			
		}

$xmlfile14.= "</pages></subwiki></subwikis></wiki></activity>";
$file14 = fopen($wikipfad . "/wiki.xml","w");
fwrite($file14,$xmlfile14);
fclose($file14);
//***********************************************************
//**********************************************inforef.xml
$xmlfile15='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile15.="<inforef>";

 $xmlfile15.="</inforef>";
 $file15 = fopen($wikipfad . "/inforef.xml","w");
 fwrite($file15,$xmlfile15);
 fclose($file15);
 //**************************************************

//**************************************************
	}
}//ende wikis
//***********************************************************************************************


?>