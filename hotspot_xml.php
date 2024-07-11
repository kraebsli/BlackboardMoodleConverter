<?php 
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$qudraganddropid=$questions[$j]->getDragandDropId();
$qucoords=$questions[$j]->getCoords();
$qucorrfeedback=strip_tags($questions[$j]->getFeedbackCorrect());
$quincorrfeedback=strip_tags($questions[$j]->getFeedbackInCorrect());
$stamp= make_unique_id_code();
$version= make_unique_id_code();
$xmlfileques.="
<question id=\"" . $quid . "\">
<parent>0</parent>
<name>" . $qutitle . "</name>
<questiontext>" . $quname . "</questiontext>
<questiontextformat>1</questiontextformat>
<generalfeedback></generalfeedback>
<generalfeedbackformat>1</generalfeedbackformat>
<defaultmark>" . $qudefaultmark . "</defaultmark>
<penalty>0.3333333</penalty>
<qtype>ddmarker</qtype>
<length>1</length>
<stamp>". $stamp . "</stamp>
<version>" . $version . "</version>
<hidden>0</hidden>
<timecreated>" . $aktuellesdatum . "</timecreated>
<timemodified>" . $aktuellesdatum . "</timemodified>
<createdby>$@NULL@$</createdby>
<modifiedby>$@NULL@$</modifiedby>";
//**************************************
$xmlfileques.=" <plugin_qtype_ddmarker_question>
 <ddmarker id=\"" . $qudraganddropid. "\">
  <shuffleanswers>0</shuffleanswers>
            <correctfeedback>" . $qucorrfeedback . "</correctfeedback>
            <correctfeedbackformat>1</correctfeedbackformat>
            <partiallycorrectfeedback></partiallycorrectfeedback>
            <partiallycorrectfeedbackformat>1</partiallycorrectfeedbackformat>
            <incorrectfeedback>" . $quincorrfeedback . "</incorrectfeedback>
            <incorrectfeedbackformat>1</incorrectfeedbackformat>
      <showmisplaced>0</showmisplaced>
            <shownumcorrect>1</shownumcorrect>
 </ddmarker>
 <drags>
 <drag id=\"" . $qudraganddropid. "\">
 <no>1</no>
 <infinite>0</infinite>
 <label>mk1</label>
 <noofdrags>1</noofdrags>
 </drag>
 </drags>
 <drops>
<drop id=\"" . $qudraganddropid. "\">
<no>1</no>
<shape>rectangle</shape>
<coords>" . $qucoords . "</coords>
<choice>1</choice>
</drop>
</drops>
</plugin_qtype_ddmarker_question>
<question_hints> </question_hints>
<tags> </tags>
</question>";


?>