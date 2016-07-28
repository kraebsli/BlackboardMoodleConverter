<?php
 for($i=0; $i < count($arr_parentids); $i++)
{
	
			$sectionid=$arr_parentids[$i]->getId();
			$sectionheadline=$arr_parentids[$i]->getName();
			$sectionavailable=$arr_parentids[$i]->getVisible();
		/*	if($sectionavailable=="true")
			{
				$sectionavailable="1";
				
			}
			else 
			{
				$sectionavailable="0";
			}*/
			$sectionheadline=xmlencoding($sectionheadline);
		$sectionid=$sectionid+$sectionstart;
	
$sectionpfad=$direxport . "/sections/section_" . $sectionid;

	if(is_dir($sectionpfad))
	{
		
	}
	else 
	{
mkdir($sectionpfad, 0700);
	$pfad_section_inforef= $sectionpfad . "/inforef.xml";
	
	copy("activities_src/inforef.xml", $pfad_section_inforef);
	
	$xmlfile_section='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
	$xmlfile_section.="<section id=\"" . $sectionid . "\">
<number>" . $sectionid . "</number>
<name>" . $sectionheadline . "</name>
<summary/>
<summaryformat>1</summaryformat>
<sequence></sequence>
<visible>1</visible>
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
