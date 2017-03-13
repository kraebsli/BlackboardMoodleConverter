<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universitšt Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
for($i=0; $i < count($arr_files_embedded_label); $i++)
{

	$fileid=$arr_files_embedded_label[$i]->getId();
		$filename_new=$arr_files_embedded_label[$i]->getName();
		$parentid=$arr_files_embedded_label[$i]->getParentId();
		$contenthash=$arr_files_embedded_label[$i]->getContentHash();
		$filesize=$arr_files_embedded_label[$i]->getFilesize();
		//*********************************************
		$filename_separated=explode(".", $filename_new);
		//$dateiendung="." . $filename_separated[1];
		//************************************MIMETYPE
		if($filename_separated[1]=="pptx")
		{
			$mimetype="application/zip";
		}
		elseif($filename_separated[1]=="pdf")
		{
			$mimetype="application/pdf";
		}
		elseif($filename_separated[1]=="jpg")
		{
			$mimetype="image/jpeg";
		}
		elseif($filename_separated[1]=="mp4")
		{
			$mimetype="video/quicktime";
		}
		elseif($filename_separated[1]=="gif")
		{
			$mimetype="image/gif";
		}
	
		
		
      
        //******************************************
        $xmlfile2 .="<file id=\"$fileid\">
    <contenthash>" . $contenthash . "</contenthash>
    <contextid>" . $parentid . "</contextid>
    <component>mod_label</component>
    <filearea>intro</filearea>
    <itemid>0</itemid>
    <filepath>/</filepath>
    <filename>" . $filename_new . "</filename>
    <userid>$@NULL@$</userid>
    <filesize>" . $filesize . "</filesize>
    <mimetype>". $mimetype . "</mimetype>
    <status>0</status>
    <timecreated>" . $aktuellesdatum . "</timecreated>
    <timemodified>" . $aktuellesdatum . "</timemodified>
    <source>" . $filename_new . "</source>
    <author>$@NULL@$</author>
    <license>$@NULL@$</license>
    <sortorder>1</sortorder>
    <repositorytype>$@NULL@$</repositorytype>
<repositoryid>$@NULL@$</repositoryid>
<reference>$@NULL@$</reference>
     </file>";
}
        ?>