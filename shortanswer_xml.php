<?php 

$quantworten=$questions[$j]->getAntworten();
$qushortanswerid=$questions[$j]->getShortanswerId();
$qucorrfeedback=$questions[$j]->getFeedbackCorrect();
$quincorrfeedback=$questions[$j]->getFeedbackInCorrect();
$xmlfileques.="
<question id=\"" . $quid . "\">
<parent>0</parent>
<name>" . $qutitle . "</name>
<questiontext>" . $quname . "</questiontext>
<questiontextformat>1</questiontextformat>
<generalfeedback>" . $qucorrfeedback . "</generalfeedback>
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
        <plugin_qtype_shortanswer_question>
          <answers>";
for($k=0;$k<count($quantworten);$k++)
{
	$quanswerid=$quantworten[$k]->getId();
	$quanswertext=$quantworten[$k]->getAnswertext();
	$quanswerfeedback=$quantworten[$k]->getFeedback();
	$qufraction="1.00000000";
	$xmlfileques.="
            <answer id=\"" . $quanswerid . "\">
              <answertext>" . $quanswertext . "</answertext>
              <answerformat>1</answerformat>
              <fraction>" . $qufraction . "</fraction>
              <feedback>" . $quanswerfeedback . "</feedback>
              <feedbackformat>1</feedbackformat>
            </answer>";
}//ende for k
$xmlfileques.="</answers>
             <shortanswer id=\"" . $qushortanswerid. "\">
     <usecase>0</usecase>
</shortanswer>
               </plugin_qtype_shortanswer_question>
        <question_hints>
        </question_hints>
        <tags>
        </tags>
      </question>";


?>