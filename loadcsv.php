<?php
header('Content-type: text/xml; charset=UTF-8');
		 echo'<?xml version="1.0" encoding="utf-8"?>';
		 echo "<GLOSSARY>";
				 echo "<INFO>";
		 echo "<ENTRIES>";
include("functions.php");


if (($handle = fopen("glossar.csv", "r")) !== FALSE) {
	
	while (($data = fgetcsv($handle, 3000, ";")) !== FALSE) {
		echo "<ENTRY>";
		$data[0]=xmlencoding($data[0]);
		echo "<CONCEPT>";
		echo $data[0];
		echo "</CONCEPT>";
		$new2=strip_tags($data[1]);
		$new2=xmlencoding($new2);
		echo "<DEFINITION>";
		echo $new2;
		echo "</DEFINITION>";
		echo "<FORMAT>1</FORMAT>";
		echo "<USEDYNALINK>0</USEDYNALINK>";
		echo "<CASESENSITIVE>0</CASESENSITIVE>";
		echo "<FULLMATCH>0</FULLMATCH>";
		echo "<TEACHERENTRY>1</TEACHERENTRY>";
		echo "</ENTRY>";
	}
	
}
fclose($handle);
echo "</ENTRIES>";
echo "</INFO>";

echo "</GLOSSARY>";
//**********************************

?>