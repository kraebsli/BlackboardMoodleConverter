<?php 
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$qunumericalid=$questions[$j]->getNumericalId();
$quanswer=$questions[$j]->getLoesungId();
$stamp= make_unique_id_code();
$version= make_unique_id_code();
$qutolerance=$questions[$j]->getFehler();
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
<qtype>numerical</qtype>
<length>1</length>
<stamp>". $stamp . "</stamp>
<version>" . $version . "</version>
<hidden>0</hidden>
<timecreated>" . $aktuellesdatum . "</timecreated>
<timemodified>" . $aktuellesdatum . "</timemodified>
<createdby>$@NULL@$</createdby>
<modifiedby>$@NULL@$</modifiedby>";
//**************************************
$xmlfileques.=" <plugin_qtype_numerical_question>
<answers>
<answer id=\"" . $qunumericalid . "\">
<answertext>" . $quanswer . "</answertext>
<answerformat>0</answerformat>
<fraction>1.0000000</fraction>
<feedback/>
<feedbackformat>1</feedbackformat>
</answer>
</answers>
<numerical_units> </numerical_units>
<numerical_options>
<numerical_option id=\"" . $qunumericalid . "\">
<showunits>3</showunits>
<unitsleft>0</unitsleft>
<unitgradingtype>0</unitgradingtype>
<unitpenalty>0.1000000</unitpenalty>
</numerical_option>
</numerical_options>
<numerical_records>
<numerical_record id=\"" . $qunumericalid . "\">
<answer>" . $qunumericalid . "</answer>
<tolerance>" . $qutolerance . "</tolerance>
</numerical_record>
</numerical_records>
</plugin_qtype_numerical_question>
<question_hints> </question_hints>
<tags> </tags>
</question>";



?>