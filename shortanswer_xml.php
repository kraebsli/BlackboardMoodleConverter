<?php 
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$quantworten=$questions[$j]->getAntworten();
$qushortanswerid=$questions[$j]->getShortanswerId();
$qucorrfeedback=$questions[$j]->getFeedbackCorrect();
$quincorrfeedback=$questions[$j]->getFeedbackInCorrect();
$stamp= make_unique_id_code();
$version= make_unique_id_code();
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