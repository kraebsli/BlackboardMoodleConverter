<?php 
$qudraganddropid=$questions[$j]->getDragandDropId();
$qucoords=$questions[$j]->getCoords();
$qucorrfeedback=strip_tags($questions[$j]->getFeedbackCorrect());
$quincorrfeedback=strip_tags($questions[$j]->getFeedbackInCorrect());
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
            <partiallycorrectfeedback>&lt;p&gt;Die Antwort ist teilweise richtig.&lt;/p&gt;</partiallycorrectfeedback>
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