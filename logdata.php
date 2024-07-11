<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
 $exportlogData.= "\n";
 $exportlogData.="\n Modules not imported:\n";
for($i=0;$i<count($allresources); $i++)
{
	
$exportlogData.=$allresources[$i] . "\n";
}
$exportlogData.= "\n";
if(count($arrfiles_not)>0)
{
$exportlogData.="Files not imported:\n";
for($i=0;$i<count($arrfiles_not); $i++)
{
	
$exportlogData.=$arrfiles_not[$i] . "\n";
}
}
$exportlogData.= "\n";
 /*$exportlogData.="Imported:\n";
 $exportlogData.= "\n";
 if(count($allresources_ok)>0)
{
$exportlogData.="Modules imported:\n";
for($i=0;$i<count( $allresources_ok); $i++)
{
	
$exportlogData.= $allresources_ok[$i] . "\n";
}
}
 $exportlogData.= "\n";
  $exportlogData.="Files:\n";
  $exportlogData.= "\n";
 for($i=0;$i<count($arr_files); $i++)
{
	$name=$arr_files[$i]->getTitle();
$exportlogData.=$name;
$exportlogData.= "\n";
}
$exportlogData.= "\n";
  $exportlogData.="Folder:\n";
 for($i=0;$i<count($arr_folder_simple); $i++)
{
	$name=$arr_folder_simple[$i]->getName(); 
$exportlogData.=$name;
$exportlogData.= "\n";
}*/
if (count($arr_scorm)>0)
{
	$exportlogData.="Scorm:\n";
	 for($i=0;$i<count($arr_scorm); $i++)
{
	$name=$arr_scorm[$i];
$exportlogData.=$name;
$exportlogData.= "\n";
}
}

if (count($arr_assignment)>0)
{
	$exportlogData.="Assignments:\n";
		 for($i=0;$i<count($arr_assignment); $i++)
{
	$name=$arr_assignment[$i];
$exportlogData.=$name;
$exportlogData.= "\n";
}
}

?>