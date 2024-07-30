<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//$quantworten=$questions[$j]->getAntworten();
$qurandomid=$questions[$j]->getId();

$stamp= make_unique_id_code();

$version= make_unique_id_code();
//wert oder nicht wert
$xmlfileques.="
<question id=\"" . $qurandomid . "\">
<parent>0</parent>
<name>" . $qutitle . "</name>
<questiontext>Random" . $qurandomid . "</questiontext>
<questiontextformat>0</questiontextformat>
<generalfeedback>0</generalfeedback>
<generalfeedbackformat>1</generalfeedbackformat>
<defaultmark>" . $qudefaultmark . "</defaultmark>
<penalty>0.3333333</penalty>
<qtype>" . $qutype . "</qtype>
<length>1</length>
         <stamp>". $stamp . "</stamp>
        <version>" . $version . "</version>
        <hidden>0</hidden>
        <timecreated>" . $aktuellesdatum . "</timecreated>
        <timemodified>" . $aktuellesdatum . "</timemodified>
        <createdby>$@NULL@$</createdby>
        <modifiedby>$@NULL@$</modifiedby>
       
        <question_hints>
        </question_hints>
        <tags>
        </tags>
      </question>";
?>