<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$quantworten=$questions[$j]->getAntworten();
$qumultichoiceid=$questions[$j]->getMultichoiceId();
$qucorrfeedback=$questions[$j]->getFeedbackCorrect();
$quincorrfeedback=$questions[$j]->getFeedbackInCorrect();
$generalfeedback = "";
$summeRichtigerAntworten=$questions[$j]->getZahlRichtigerAntworten();
$qusingle=$questions[$j]->getSingle();

if($summeRichtigerAntworten>1)
{
	$zahlAntwortengesamt=count($quantworten);
	$zahlFalscherAntworten=$zahlAntwortengesamt-$summeRichtigerAntworten;
	if($summeRichtigerAntworten!==0)
	{
$fraction=1/$summeRichtigerAntworten;//fraction einfach automatisch
	}
	else 
	{
		$fraction=0;
	}
	//********************************
	if($zahlFalscherAntworten!==0)
	{
		$fraction2="-" . 1/$zahlFalscherAntworten;
	}
	else 
	{
		$fraction2=0;
	}

}
else 
{
$fraction=1.0000000;
$fraction2=0.0000000;
}
$stamp= make_unique_id_code();

$version= make_unique_id_code();
//wert oder nicht wert
$xmlfileques.="
<question id=\"" . $quid . "\">
<parent>0</parent>
<name>" . $qutitle . "</name>
<questiontext>" . $quname . "</questiontext>
<questiontextformat>1</questiontextformat>
<generalfeedback>" . $generalfeedback . "</generalfeedback>
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
        <plugin_qtype_multichoice_question>
          <answers>";
for($k=0;$k<count($quantworten);$k++)
{
	$quanswerid=$quantworten[$k]->getId();
	//$qufraction=$quantworten[$k]->getFraction();
	//fraction muss ermittelt werden
	$quanswerrichtigeantwort=$quantworten[$k]->getRichtigeAntwort();
	$quanswerscorevalue=$quantworten[$k]->getScorevalue();
	//if($quanswerscorevalue=="0")
	//{
	if($quanswerrichtigeantwort=="1")
	{
		$qufraction=sprintf("%1\$.7f", $fraction);
	
	}
	else 
	{
		$qufraction=sprintf("%1\$.7f", $fraction2);
			
	}
	//}
	//else 
	//{
		//$fraction=(1*$quanswerscorevalue)/100;
		//$qufraction=sprintf("%1\$.7f", $fraction);
		
	//}
	//100 geteilt durch Zahl richtiger Antworten
	$quanswertext=$quantworten[$k]->getAnswertext();
	if($quantworten[$k]->getFeedback()!="")
	{
	$qufeedbacktext=$quantworten[$k]->getFeedback();
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
            }//ende for k
          $xmlfileques.="</answers>
          <multichoice id=\"" . $qumultichoiceid. "\">
            <layout>0</layout>
            <single>" . $qusingle . "</single>
            <shuffleanswers>1</shuffleanswers>
            <correctfeedback>" . $qucorrfeedback . "</correctfeedback>
            <correctfeedbackformat>1</correctfeedbackformat>
            <partiallycorrectfeedback></partiallycorrectfeedback>
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
?>