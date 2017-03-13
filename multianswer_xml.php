<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$qumultianswerid=$questions[$j]->getMultianswerId();
$quantworten=$questions[$j]->getAntworten();
$whichmultianswer=$questions[$j]->getShortanswer();
$multianswerfeedback=$questions[$j]->getFeedbackCorrect();
$stamp= make_unique_id_code();
$version= make_unique_id_code();
$xmlfileques.="
<question id=\"" . $quid . "\">
<parent>0</parent>
<name>" . $qutitle . "</name>
<questiontext>" . $quname . "</questiontext>
<questiontextformat>1</questiontextformat>
<generalfeedback>" . $multianswerfeedback . "</generalfeedback>
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
        <plugin_qtype_multianswer_question>
        <answers></answers>";
$xmlfileques.="<multianswer id=\"" . $qumultianswerid. "\">
<question>". $quid . "</question>
<sequence>";
for($k=0;$k<count($quantworten);$k++)
{
	$quid2=$quantworten[$k]->getId();
	if($k!==0)
	{
		$xmlfileques.="," . $quid2;
	}
	else
	{
		$xmlfileques.= $quid2;
	}

}//ende quantworten
$xmlfileques.="</sequence>
</multianswer>
</plugin_qtype_multianswer_question>
<question_hints> </question_hints>
<tags> </tags>
</question>";
//**************************************************Bestandteile von
//multianswer, eigene Fragen als shortanswer
if($whichmultianswer=="true")
{
	for($k=0;$k<count($quantworten);$k++)
	{
		$quid=$quantworten[$k]->getId();
		$qushortanswerid=$quantworten[$k]->getShortanswerId();
		$quparentid=$quantworten[$k]->getParentId();
		$quname=$quantworten[$k]->getFragetext();
		$quantworten2=$quantworten[$k]->getAnswers();
$qufeedback=$quantworten[$k]->getCorrectFeedback();
$stamp= make_unique_id_code();
$version= make_unique_id_code();
		$xmlfileques.="
<question id=\"" . $quid . "\">
<parent>" . $quparentid . "</parent>
<name>" . $qutitle . "</name>
<questiontext>" . $quname . "</questiontext>
<questiontextformat>1</questiontextformat>
<generalfeedback>" . $multianswerfeedback . "</generalfeedback>
<generalfeedbackformat>1</generalfeedbackformat>
<defaultmark>1.0000000</defaultmark>
<penalty>0.0000000</penalty>
<qtype>shortanswer</qtype>
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
          for($s=0;$s<count($quantworten2);$s++)
          {
          $quanswertext=$quantworten2[$s];
         $qufeedback=$qufeedback[$s];
          $qufraction="1.00000000";
          		$xmlfileques.="
            <answer id=\"" . $s . "\">
              <answertext>" . $quanswertext . "</answertext>
              <answerformat>1</answerformat>
              <fraction>" . $qufraction . "</fraction>
              <feedback>" . $qufeedback ."</feedback>
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
          		}//for antworten
          		}//ende if
          		else //multianswer mit mc****************************************************************************************
          		{
          		for($k=0;$k<count($quantworten);$k++)
          		{
          		$quid=$quantworten[$k]->getId();
          		$qumultichoiceid=$quantworten[$k]->getMultiplechoiceId();
          		$quparentid=$quantworten[$k]->getParentId();
          		$quname=$quantworten[$k]->getFragetext();
$quantworten2=$quantworten[$k]->getAnswers();
$qucorrfeedback=$quantworten[$k]->getCorrectFeedback();
		$quincorrfeedback=$quantworten[$k]->getInCorrectFeedback();
		$fraction="1.0000000";
$fraction2="0.0000000";
$stamp= make_unique_id_code();
$version= make_unique_id_code();
$xmlfileques.="
<question id=\"" . $quid . "\">
<parent>" . $quparentid . "</parent>
<name>" . $qutitle . "</name>
<questiontext>" . $quname . "</questiontext>
<questiontextformat>1</questiontextformat>
<generalfeedback></generalfeedback>
<generalfeedbackformat>1</generalfeedbackformat>
<defaultmark>1.0000000</defaultmark>
		<penalty>0.0000000</penalty>
<qtype>multichoice</qtype>
		<length>1</length>
 <stamp>". $stamp . "</stamp>
<version>" . $version . "</version>
<hidden>0</hidden>
<timecreated>" . $aktuellesdatum . "</timecreated>
<timemodified>" . $aktuellesdatum . "</timemodified>
<createdby>$@NULL@$</createdby>
<modifiedby>$@NULL@$</modifiedby>";
$xmlfileques.=" <plugin_qtype_multichoice_question>
<answers>";
for($s=0;$s<count($quantworten2);$s++)
{
$quanswerid=$quantworten2[$s]->getId();
$quanswerrichtigeantwort=$quantworten2[$s]->getRichtigeAntwort();

if($quanswerrichtigeantwort=="1")
{
$qufraction=$fraction;

          		}
          		else
	{
	$qufraction=$fraction2;
		
}
//100 geteilt durch Zahl richtiger Antworten
$quanswertext=$quantworten2[$s]->getAnswertext();
	if($quantworten2[$s]->getFeedback()!="")
	{
	$qufeedbacktext=$quantworten2[$s]->getFeedback();
	}
	else
	{
		$qufeedbacktext="";
	}
            $xmlfileques.="
			<answer id=\"" . $quanswerid . "\">
              <answertext>" . $quanswertext . "</answertext>
              <answerformat>1</answerformat>
              <fraction>" . $qufraction . "</fraction>
	<feedback>" . $qufeedbacktext . "</feedback>
			<feedbackformat>1</feedbackformat>
            </answer>";
            }//ende for s
          $xmlfileques.="</answers>
          <multichoice id=\"" . $qumultichoiceid. "\">
          <layout>0</layout>
            <single>1</single>
            <shuffleanswers>1</shuffleanswers>
            <correctfeedback>" . $qucorrfeedback . "</correctfeedback>
            <correctfeedbackformat>1</correctfeedbackformat>
            <partiallycorrectfeedback>&lt;p&gt;Die Antwort ist teilweise richtig.&lt;/p&gt;</partiallycorrectfeedback>
            <partiallycorrectfeedbackformat>1</partiallycorrectfeedbackformat>
            <incorrectfeedback>" . $quincorrfeedback . "</incorrectfeedback>
            <incorrectfeedbackformat>1</incorrectfeedbackformat>
            <answernumbering>none</answernumbering>
            <shownumcorrect>1</shownumcorrect>
          </multichoice>
            		</plugin_qtype_multichoice_question>
        <question_hints>
        </question_hints>
        <tags>
        </tags>
      </question>";
	}//ende for antworten

}//ende else

?>