<?php 
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$quessayid=$questions[$j]->getShortanswerId();//ist korrekt
$quattach=$questions[$j]->getAttachment();
$quantworten=$questions[$j]->getAntworten();
$quanswertext=$quantworten[0]->getAnswertext();
$stamp= make_unique_id_code();
$version= make_unique_id_code();
$xmlfileques.="
<question id=\"" . $quid . "\">
<parent>0</parent>
<name>" . $qutitle . "</name>
<questiontext>" . $quname . "</questiontext>
<questiontextformat>1</questiontextformat>
<generalfeedback>" . $quanswertext . "</generalfeedback>
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
        <plugin_qtype_essay_question>";
$xmlfileques.="<essay id=\"" . $quessayid. "\">
<responseformat>editor</responseformat>
<responsefieldlines>15</responsefieldlines>
<attachments>" . $quattach . "</attachments><graderinfo/>
<graderinfoformat>1</graderinfoformat>
<responsetemplate></responsetemplate>
<responsetemplateformat>1</responsetemplateformat>
</essay>
</plugin_qtype_essay_question>
        <question_hints>
        </question_hints>
        <tags>
        </tags>
      </question>";



?>