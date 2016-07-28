<?php 
$quessayid=$questions[$j]->getShortanswerId();//ist korrekt
$quattach=$questions[$j]->getAttachment();
$quantworten=$questions[$j]->getAntworten();
$quanswertext=$quantworten[0]->getAnswertext();
echo $quname . "und ". $quid;
echo "<br>";
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