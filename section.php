<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universit�t Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$sectionpfad=$direxport . "/sections";
mkdir($sectionpfad, 0700);

 for($i=0; $i < count($arr_parentids); $i++)
{
	$sequence="";
			$sectionid=$arr_parentids[$i]->getId();
			$sectionheadline=$arr_parentids[$i]->getName();
			$sectionavailable=$arr_parentids[$i]->getVisible();
			$sectionorder=$arr_parentids[$i]->getSectionorder();
			$t=0;
			for($j=0; $j< count($sectionorder); $j++)
			{
				$t=$j+1;
			if($t==count($sectionorder))
			{
				$sequence.=$sectionorder[$j];
	
			}
			else 
			{
				if($sectionorder[$j]!=="")
				{
			$sequence.=$sectionorder[$j].",";
				}
			}
			}
			
		/*	for($j=0; $j <= count($arr_allItems); $j++)
			
	{
		if ($arr_allItems[$j]  instanceof file ||$arr_allItems[$j] instanceof label ||$arr_allItems[$j] instanceof page ||$arr_allItems[$j] instanceof link) {
		
$itemsec=$arr_allItems[$j]->getSection();

		if($itemsec==$sectionid)
		{
			if($j==count($arr_allItems))
			{
				$sequence.=$arr_allItems[$j]->getId();
		
			}
			else 
			{
			$sequence.=$arr_allItems[$j]->getId().",";
			}
		}
	
	}
	
	}*/
			
		/*	if($sectionavailable=="true")
			{
				$sectionavailable="1";
				
			}
			else 
			{
				$sectionavailable="0";
			}
			}*/
			$sectionheadline=xmlencoding($sectionheadline);
		$sectionid=$sectionid+$sectionstart;

$sectionpfad=$direxport . "/sections/section_" . $sectionid;

	if(is_dir($sectionpfad))
	{
		
	}
	else 
	{
		
		if($modus=="multiplefolders")
		{
			//$sequence="";
		}
mkdir($sectionpfad, 0700);
	$pfad_section_inforef= $sectionpfad . "/inforef.xml";
	$visibility=1;
	if($sectionheadline=="Extra")
		$visibility=0;
	copy("activities_src/inforef.xml", $pfad_section_inforef);
	
	$xmlfile_section='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
	$xmlfile_section.="<section id=\"" . $sectionid . "\">
<number>" . $sectionid . "</number>
<name>" . $sectionheadline . "</name>
<summary/>
<summaryformat>1</summaryformat>
<sequence>". $sequence . "</sequence>
<visible>".$visibility . "</visible>
<availablefrom>0</availablefrom>
<availableuntil>0</availableuntil>
<showavailability>0</showavailability>
<groupingid>0</groupingid>
</section>";
 $file_section = fopen($sectionpfad . "/section.xml","w");
fwrite($file_section,$xmlfile_section);
fclose($file_section);
	}
}
	?>
