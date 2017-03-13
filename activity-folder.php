<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
* makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
* */
$folderpfad=$direxport . "/activities/folder_1";
mkdir($folderpfad, 0700);
$pfad2= $folderpfad . "/grades.xml";
$pfad3= $folderpfad . "/roles.xml";
copy("activities_src/grades.xml", $pfad2);
copy("activities_src/roles.xml", $pfad3);
//****************folder.xml*****************************
$xmlfile6='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile6.="<activity id=\"1\" moduleid=\"1\" modulename=\"folder\" contextid=\"" . $foldercontextid . "\">
  <folder id=\"1\">
    <name>Verzeichnis</name>
    <intro>test</intro>
    <introformat>1</introformat>
    <revision>4</revision>
    <timemodified>" . $aktuellesdatum . "</timemodified>
    <display>1</display>
    <showexpanded>1</showexpanded>
  </folder>
</activity>";
$file6 = fopen($folderpfad . "/folder.xml","w");
fwrite($file6,$xmlfile6);
fclose($file6);
//***************************************
//****************inforef.xml*****************************
$xmlfile7='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile7.="<inforef><fileref>";
for($i=0; $i<count($folderIDArray); $i++)
{
$xmlfile7.="<file><id>" . $folderIDArray[$i] . "</id> </file>";
}
$xmlfile7.="</fileref></inforef>";
	 $file7 = fopen($folderpfad . "/inforef.xml","w");
	 fwrite($file7,$xmlfile7);
	 fclose($file7);
	 //**************************************

	 //****************************module.xml
	 $xmlfile8='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
	 $xmlfile8.="<module id=\"1\" version=\"2013110500\"><modulename>folder</modulename>
  <sectionid>" . $section . "</sectionid><sectionnumber>" . $section . "</sectionnumber>
  <idnumber></idnumber> <added>1408009994</added><score>0</score>
  <indent>0</indent>
  <visible>1</visible>
  <visibleold>1</visibleold>
  <groupmode>0</groupmode>
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
  </availability_info></module>";
	 $file8 = fopen($folderpfad . "/module.xml","w");
	 fwrite($file8,$xmlfile8);
	 fclose($file8);
	 ?>