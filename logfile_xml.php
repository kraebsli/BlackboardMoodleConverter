<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//*********************************logfiles
//make file, data should be available
$myFile = "exportlog.txt";
$fh = fopen($myFile, 'w') or die("can't open file");

fwrite($fh, $exportlogData);
fclose($fh);
 $filesize    = filesize($myFile);
	 $contenthash = sha1_file($myFile);
	 $hashpath    = substr($contenthash, 0, 2);
	 $hashfilepath=$direxport . "/files/" .$hashpath;

	
		 
	 	mkdir($hashfilepath, 0700);
	 	$hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
	 	copy($myFile, $hashfilepath_mit_file);
		//***************************file xml
	 $fileid="12335679";
	$mimetype="application/txt";
	 $xmlfile2 .="<file id=\"$fileid\">
				<contenthash>" . $contenthash . "</contenthash>
    <contextid>" . $fileid . "</contextid>
    <component>mod_resource</component>
    <filearea>content</filearea>
    <itemid>0</itemid>
    <filepath>/</filepath>
    <filename>" . $myFile . "</filename>
    <userid>$@NULL@$</userid>
    <filesize>" . $filesize . "</filesize>
    <mimetype>". $mimetype . "</mimetype>
    <status>0</status>
    <timecreated>" . $aktuellesdatum . "</timecreated>
    <timemodified>" . $aktuellesdatum . "</timemodified>
    <source>$@NULL@$</source>
    <author>$@NULL@$</author>
    <license>$@NULL@$</license>
    <sortorder>1</sortorder>
     </file>";
	 //**************************************************
	 ?>