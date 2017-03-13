<?php
include("functions.php");
echo "Course name: ";
echo "<form action=\"updatequestions.php\" method=\"POST\">";
echo "<input name=\"coursename\"  />";
echo "<br><input type=\"submit\" value=\"Submit\" />";
echo "</form>"; 
if ($_POST['coursename']!=="")
{
$coursename=$_POST['coursename'];
mysql_connect("localhost", "kb", "kathrin") or die(mysql_error());
mysql_select_db("fbc") or die(mysql_error());
$result = mysql_query("SELECT id FROM mdl_course WHERE fullname='$coursename'")or die(mysql_error());
$ergebnis = mysql_num_rows($result);
while($row = mysql_fetch_array($result))
{
	$courseid=$row['id'];

}
}/*SELECT * FROM dbname.mdl_question q
join mdl_question_categories qc on qc.id = q.category
join mdl_context c on c.id = qc.contextid
join mdl_course cr on cr.id = qc.contextid
*/
$result2 = mysql_query("SELECT * FROM mdl_context WHERE instanceid='$courseid' AND contextlevel='50'") or die(mysql_error());
$ergebnis2 = mysql_num_rows($result2);
while($row2 = mysql_fetch_array($result2))
{
	$contextid=$row2['id'];

	$result3 = mysql_query("SELECT id FROM mdl_question_categories WHERE contextid='$contextid'") or die(mysql_error());
	$ergebnis3 = mysql_num_rows($result3);
	while($row3 = mysql_fetch_array($result3))
	{
	$categoryid=$row3['id'];
		echo $row3['id'];
		echo "<br>";
		$stamp= make_unique_id_code();
		$version= make_unique_id_code();
		mysql_query("UPDATE mdl_question_categories SET stamp='$stamp' WHERE id='$categoryid'") or die(mysql_error());
		//$result4 = mysql_query("UPDATE mdl_question SET stamp='$stamp', version='$version' WHERE category='$categoryid'") or die(mysql_error());
		$result4 = mysql_query("SELECT * FROM mdl_question WHERE category='$categoryid'") or die(mysql_error());
		while($row4 = mysql_fetch_array($result4))
		{
			$stamp= make_unique_id_code();
			$version= make_unique_id_code();
			$id=$row4['id'];
			mysql_query("UPDATE mdl_question SET stamp='$stamp', version='$version' WHERE id='$id'") or die(mysql_error());
			echo $id;
			echo "<br>";
		}
		
	
	}
}

?>