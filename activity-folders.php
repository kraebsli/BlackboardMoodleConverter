<?php
//directories für folder
for($i=0; $i < count($arr_folder_simple); $i++)
{
$folderid=$arr_folder_simple[$i]->getId();//????
$folderfiles=$arr_folder_simple[$i]->getFiles();

if (count($folderfiles)>0)
{



$foldername=$arr_folder_simple[$i]->getName();


		$parentid2=$arr_folder_simple[$i]->getParentId();
	
		$section=checkParentid($folderid, $arr_parentids, $arr);
		$section=$section+$sectionstart;
		$folderpfad=$direxport . "/activities/folder_". $folderid;

		mkdir($folderpfad, 0700);
		$pfad2= $folderpfad . "/grades.xml";
		$pfad3= $folderpfad . "/roles.xml";
		copy("activities_src/grades.xml", $pfad2);
		copy("activities_src/roles.xml", $pfad3);
		$xmlfile6='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
		$xmlfile6.="<activity id=\"" . $folderid . "\" moduleid=\"" . $folderid . "\" modulename=\"folder\" contextid=\"" . $section . "\">
		<folder id=\"" . $folderid . "\">
		<name>" . $foldername . "</name>
		<intro></intro>
    <introformat>1</introformat>
    <revision>4</revision>
    <timemodified>" . $aktuellesdatum . "</timemodified>
    <display>0</display>
    <showexpanded>0</showexpanded>
  </folder>
</activity>";
		$file6 = fopen($folderpfad . "/folder.xml","w");
		fwrite($file6,$xmlfile6);
		fclose($file6);



		//****************folder.xml*****************************

		//***************************************
		//****************inforef.xml*****************************
		$xmlfile7='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
		$xmlfile7.="<inforef><fileref>";
	for($j=0; $j<count($folderfiles); $j++)
	{

	$folderID=$folderfiles[$j]->getId();
	$xmlfile7.="<file><id>" . $folderID . "</id> </file>";
		}
	$xmlfile7.="</fileref></inforef>";
	 $file7 = fopen($folderpfad . "/inforef.xml","w");
 fwrite($file7,$xmlfile7);
 fclose($file7);
 //**************************************

 //****************************module.xml
 $xmlfile8='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
 $xmlfile8.="<module id=\"" . $folderid . "\" version=\"2013110500\"><modulename>folder</modulename>
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
 //***************************************
 $xmlfile6="";
 $xmlfile7="";
 $xmlfile8="";
}
}

?>