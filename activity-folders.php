<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//directories für folder
if($allfiles>$fileslimit)
{
 for($i=0; $i < count($arr_parentids); $i++)
	{
		$sectionsequence=$arr_parentids[$i]->getSectionorder();
		for($j=0;$j < count($sectionsequence); $j++)
		{
			
//****************************************************
				for($k=0; $k <= $order; $k++)
				{
			
					if(isset($arr_allItems[$k]))
					{
				if($arr_allItems[$k]->getId()==$sectionsequence[$j])
				{
					if ($arr_allItems[$k] instanceof folder) {
						
						$foldername=$arr_allItems[$k]->getName();
						
						$folderid=$arr_allItems[$k]->getId();
						
						$folderfiles=$arr_allItems[$k]->getFiles();
						$description=$arr_allItems[$k]->getDescription();
						$parentid2=$arr_allItems[$k]->getParentId();
						     $section=$arr_parentids[$i]->getId();
						$section=$section+$sectionstart;
						if(count($folderfiles)>1)
						{
$folderpfad=$direxport . "/activities/folder_". $folderid;

		mkdir($folderpfad, 0700);
		$pfad2= $folderpfad . "/grades.xml";
		$pfad3= $folderpfad . "/roles.xml";
		copy("activities_src/grades.xml", $pfad2);
		copy("activities_src/roles.xml", $pfad3);
		$xmlfile6='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
		$xmlfile6.="<activity id=\"" . $folderid . "\" moduleid=\"" . $folderid . "\" modulename=\"folder\" contextid=\"" . $folderid . "\">
		<folder id=\"" . $folderid . "\">
		<name>" . $foldername . "</name>
		<intro>" . $description ."</intro>
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
	for($m=0; $m<count($folderfiles); $m++)
	{

	$folderID=$folderfiles[$m]->getId();
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
  <showdescription>1</showdescription>
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
}
					}
				}
		}
	}
}
//files as resources
	//*******************************************************************************************
 for($i=0; $i < count($arr_parentids); $i++)
	{
		$sectionsequence=$arr_parentids[$i]->getSectionorder();
		for($j=0;$j < count($sectionsequence); $j++)
		{
			
//****************************************************
				for($k=0; $k <= $order; $k++)
				{
					if(isset($arr_allItems[$k]))
					{
				if($arr_allItems[$k]->getId()==$sectionsequence[$j])
				{
					if ($arr_allItems[$k] instanceof file) {
							
						
						$fileid=$arr_allItems[$k]->getId();
						for($f=0;$f<count($helparray_nonfolderfiles); $f++)
						{
						if($helparray_nonfolderfiles[$f]==$fileid)
						{
						$filename=$arr_allItems[$k]->getName();
						//$filename=xmlencoding($filename);
						$title=$arr_allItems[$k]->getTitle();
						$description=$arr_allItems[$k]->getDescription();
						$section=$arr_allItems[$k]->getSection();
						$section=$section+$sectionstart;
						//**************************************
	if($title==$filename){
		$title="";
		$showfileandtitle=$title;
	}
	else
	{
		if($title!=="")
		{
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
			$showfileandtitle=$title;
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
	
	
	//$section=$folderfiles[$j]->getSection();
	//$section=$section+$sectionstart;
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
	$xmlfile5.="<activity id=\"" . $k . "\" modulename=\"resource\" contextid=\"" . $fileid . "\" moduleid=\"" . $fileid ."\">";
	$xmlfile5.="<resource id=\"" . $k . "\"><displayoptions>a:2:{s:10:\"printintro\";i:1;s:12:\"printheading\";i:0;}</displayoptions>
<introformat>1</introformat>" .
	"<intro>" . $description . "</intro>
<timemodified>" . $aktuellesdatum . "</timemodified>
<revision>0</revision>
<legacyfileslast>$@NULL@$</legacyfileslast>
<display>3</display>
<legacyfiles>2</legacyfiles>
<tobemigrated>0</tobemigrated>
<name>" . $showfileandtitle . "</name><filterfiles>0</filterfiles></resource></activity>";
	$title="";
	//************************
	$file5 = fopen($pfad . "/resource.xml","w");
	fwrite($file5,$xmlfile5);
	fclose($file5);
	//***************************************************************
}
}
					}
				}
					}
				}
		}
	}


?>