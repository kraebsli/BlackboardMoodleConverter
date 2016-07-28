<?php
if(count($arr_files_embedded_quiz_drag)>0)
{
for($i=0; $i < count($arr_files_embedded_quiz_drag); $i++)
{

	$fileid=$arr_files_embedded_quiz_drag[$i]->getId();
		$filename_new=$arr_files_embedded_quiz_drag[$i]->getName();
		$parentid=$arr_files_embedded_quiz_drag[$i]->getParentId();
		$contenthash=$arr_files_embedded_quiz_drag[$i]->getContentHash();
		$contextid=$arr_files_embedded_quiz_drag[$i]->getContextid();
		$filesize=$arr_files_embedded_quiz_drag[$i]->getFilesize();
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
    <contextid>" . $contextid . "</contextid>
    <component>qtype_ddmarker</component>
    <filearea>bgimage</filearea>
    <itemid>" . $parentid . "</itemid>
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
}
        ?>