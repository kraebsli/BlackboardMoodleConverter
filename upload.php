<?php
/*
 * Created on 13.08.2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-EN"/> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>Blackboard-Moodle-Converter</title>
</head> 
<body>
<h2>Blackboard->Moodle Converter 2.1 BETA</h2>
<h3>Export and convert Blackboard courses</h3>
<p>Source: Blackboard 9.1 SP 14</p>
<p>Target: Moodle 3.1.1</p>
<p>Converted are documents, content from text elements, links, YouTube mashups and tests.</p>
<p>All question types are converted except for: Calculated Formula, Quiz Bowl.</p>
<p>Details for the question types (in German): <a href="fragetypen.pdf">Question types - PDF</a></p>
<p>In Blackboard:<br>Control Panel -> Packages and Utilities -> Export/Archive Course -> Export Package</p>


<p>Upload Blackboard zip file (folders are converted to sections):</p>
<form enctype="multipart/form-data" action="parse.php" method="POST">
       
   
    <input name="bbzipfile" type="file" />
    <br><input type="submit" value="Upload file" />
</form>
<h4>For big courses with many folders/subfolders and files:</h4>
<p>Upload Blackboard zip file  (all files are converted to a Moodle folder in one section):</p>
<form enctype="multipart/form-data" action="parse.php" method="POST">

    <input name="bbzipfile" type="file" />
    <input type='hidden' name='var' value="onefolder"/> 
    <br><input type="submit" value="Upload file" />
</form>
<p>Upload Blackboard zip file (files in each section are converted to a Moodle folder):</p>
<form enctype="multipart/form-data" action="parse.php" method="POST">

    <input name="bbzipfile" type="file" />
     <input type='hidden' name='var' value="multiplefolders"/> 
    <br><input type="submit" value="Upload file" />
</form>
<p>Last update: 28.7.2016</p>
</body>
</html>