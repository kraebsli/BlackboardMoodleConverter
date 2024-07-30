<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 
 * */
//***********************************************ZIP
include("uploaddir.php");


$zipfile=$exportdir . $d;
$tozip = $direxport;
zipData($tozip, $zipfile);
echo 'Finished.';

?>