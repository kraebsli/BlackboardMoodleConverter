<?php
$qumatchid=$questions[$j]->getMatchId();
$qucorrfeedback=strip_tags($questions[$j]->getFeedbackCorrect());
$quincorrfeedback=strip_tags($questions[$j]->getFeedbackInCorrect());
$quantworten=$questions[$j]->getAntworten();
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
<qtype>" . $qutype . "</qtype>
<length>1</length>
        <stamp>". $stamp . "</stamp>
        <version>" . $version . "</version>
        <hidden>0</hidden>
        <timecreated>" . $aktuellesdatum . "</timecreated>
        <timemodified>" . $aktuellesdatum . "</timemodified>
        <createdby>$@NULL@$</createdby>
        <modifiedby>$@NULL@$</modifiedby>
        <plugin_qtype_match_question>";
$xmlfileques.="<matchoptions id=\"" . $qumatchid. "\">
<shuffleanswers>1</shuffleanswers>
<correctfeedback>" . $qucorrfeedback . "</correctfeedback>
<correctfeedbackformat>1</correctfeedbackformat>
<partiallycorrectfeedback>&lt;p&gt;Die Antwort ist teilweise richtig.&lt;/p&gt;</partiallycorrectfeedback>
<partiallycorrectfeedbackformat>1</partiallycorrectfeedbackformat>
<incorrectfeedback>" . $quincorrfeedback . "</incorrectfeedback>
<incorrectfeedbackformat>1</incorrectfeedbackformat>
<shownumcorrect>1</shownumcorrect>
</matchoptions>
<matches>";
for($k=0;$k<count($quantworten);$k++)
{
	$quanswerid=$quantworten[$k]->getId();
	$quanswertext=$quantworten[$k]->getAnswertext();
	$qufeedbacktext=$quantworten[$k]->getFeedback();
	$xmlfileques.=" <match id=\"" . $quanswerid . "\">
    <questiontext>" . $quanswertext . "</questiontext>
    <questiontextformat>1</questiontextformat>
    <answertext>" . $qufeedbacktext . "</answertext>
  </match>";
}
$xmlfileques.="</matches>
 </plugin_qtype_match_question>
        <question_hints>
        </question_hints>
        <tags>
        </tags>
      </question>";

?>