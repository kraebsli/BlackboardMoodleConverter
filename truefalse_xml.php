<?php 
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$quantworten=$questions[$j]->getAntworten();
$qutruefalseid=$questions[$j]->getTruefalseId();
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
<generalfeedback></generalfeedback>
<generalfeedbackformat>1</generalfeedbackformat>
<defaultmark>" . $qudefaultmark . "</defaultmark>
<penalty>1.0000000</penalty>
<qtype>" . $qutype . "</qtype>
<length>1</length>
<stamp>". $stamp . "</stamp>
<version>" . $version . "</version>
<hidden>0</hidden>
<timecreated>" . $aktuellesdatum . "</timecreated>
<timemodified>" . $aktuellesdatum . "</timemodified>
<createdby>$@NULL@$</createdby>
<modifiedby>$@NULL@$</modifiedby>
<plugin_qtype_truefalse_question>
<answers>";
$quanswerid=$quantworten[0]->getId();
	//$qufraction=$quantworten[$k]->getFraction();
	//fraction muss ermittelt werden
	$quanswerrichtigeantwort=$quantworten[0]->getRichtigeAntwort();
	
	if($quanswerrichtigeantwort=="true")
	{
		$qufraction="1.00000000";
$trueanswerid=$quanswerid;
$quanswertext="Wahr";
$quanswertext2="Falsch";
$falseanswerid=$quanswerid+1;
$quanswerid2=$quanswerid+1;
$qufraction2="0.00000000";
		
	}
	else if($quanswerrichtigeantwort=="false")
	{
		$qufraction="1.00000000";
$falseanswerid=$quanswerid;
$quanswertext="Falsch";
$quanswertext2="Wahr";
$trueanswerid=$quanswerid+1;
$quanswerid2=$quanswerid+1;
		$qufraction2="0.00000000";
	}
	else 
	{
		
	}

$xmlfileques.="
            <answer id=\"" . $quanswerid . "\">
              <answertext>" . $quanswertext . "</answertext>
              <answerformat>1</answerformat>
              <fraction>" . $qufraction . "</fraction>
              <feedback>" . $qucorrfeedback . "</feedback>
              <feedbackformat>1</feedbackformat>
            </answer>";
           $xmlfileques.="
            <answer id=\"" . $quanswerid2 . "\">
              <answertext>" . $quanswertext2 . "</answertext>
              <answerformat>1</answerformat>
              <fraction>" . $qufraction2 . "</fraction>
              <feedback>" . $quincorrfeedback . "</feedback>
              <feedbackformat>1</feedbackformat>
            </answer>";
            //************************************
          $xmlfileques.="</answers>
          <truefalse id=\"" . $qutruefalseid. "\">
     <trueanswer>" . $trueanswerid . "</trueanswer>
     <falseanswer>" . $falseanswerid . "</falseanswer>
          </truefalse>
        </plugin_qtype_truefalse_question>
        <question_hints>
        </question_hints>
        <tags>
        </tags>
      </question>";
      ?>