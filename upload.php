<?php
/*
 * Created on 13.08.2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de-DE"/> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>Blackboard-Moodle-Converter Test</title>
</head> 
<body>
<body>
<h2>Blackboard->Moodle Converter 1.2 BETA</h2>
<h3>Export and convert Blackboard courses</h3>
<p>Source: Blackboard 9.1 SP 14</p>
<p>Target: Moodle 2.9</p>
<p>In Blackboard:<br>Control Panel -> Packages and Utilities -> Export/Archive Course -> Export Package</p>

<p>Upload zip file from Blackboard:</p>
<form enctype="multipart/form-data" action="parse.php" method="POST">
       <input name="bbzipfile" type="file" />
    <br><input type="submit" value="Upload file" />
</form>
<h4>For big courses with many folders</h4>
<p>Upload zip file from Blackboard (all files go into one folder in one section):</p>
<form enctype="multipart/form-data" action="parse.php" method="POST">
     <input name="bbzipfile" type="file" />
    <input type='hidden' name='var' value="onefolder"/> 
    <br><input type="submit" value="Upload file" />
</form>
<p>Upload zip file from Blackboard (Files are put in a folder per section):</p>
<form enctype="multipart/form-data" action="parse.php" method="POST">

    <input name="bbzipfile" type="file" />
     <input type='hidden' name='var' value="multiplefolders"/> 
    <br><input type="submit" value="Upload file" />
</form>
<p></p>
</body>
</html>