<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
//directories für quizzes

 	 for($i=0; $i<count($quiz_ar); $i++)
{
	//*************************************************
	//**************************
	$qudefaultmark=0;
	$quizid=$quiz_ar[$i]->getId();
	$quizname=$quiz_ar[$i]->getName();
	$contextid=$quiz_ar[$i]->getContextId();
	//echo "contextid         " . $contextid . "   categoryid " . $categoryid . "<br><br>";
	
	$categoryid=$quiz_ar[$i]->getCategoryId();
	$gesamtscore=$quiz_ar[$i]->getGesamtscore();
	$quizdescription=$quiz_ar[$i]->getDescription();
	$quizsectionid=$quiz_ar[$i]->getSectionid();
	$quizsectionid=$quizsectionid+$sectionstart;
	//$title=$arr_files[$i]->getTitle();
	$deliverytype=$quiz_ar_ids["$quizid"]->getDeliveryType();
	$timelimit=$quiz_ar_ids["$quizid"]->getTimeLimit();
	$attemptcount=$quiz_ar_ids["$quizid"]->getAttemptCount();
	if($attemptcount>0)
	{
		
	}
	else 
	{
		$attemptcount=0;
	}
	if($timelimit>0)
	{
		
	}
	else 
	{
		$timelimit=0;
	}
	if($deliverytype=="QUESTION_BY_QUESTION")
	{
		$deliverytype="1";
		$navmethod="sequential";
	}
	else 
	{
		$deliverytype="0";
		$navmethod="free";
	}
	//*****************************************************
	$quizpfad=$direxport . "/activities/quiz_" . $quizid;
	mkdir($quizpfad, 0700);
	//$pfad2= $pfad . "/grades.xml";
	$pfad3= $quizpfad . "/roles.xml";
	//copy("activities_src/grades.xml", $pfad2);
	copy("activities_src/roles.xml", $pfad3);
//****************quiz.xml*****************************
	$xmlfile9='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
	$xmlfile9.="<activity id=\"" . $quizid . "\" moduleid=\"" . $quizid . "\" modulename=\"quiz\" contextid=\"" . $contextid . "\">
  <quiz id=\"" . $quizid . "\">
    <name>" . $quizname . "</name>
    <intro>" . $quizdescription . "</intro>
    <introformat>1</introformat>
    <timeopen>0</timeopen>
    <timeclose>0</timeclose>
    <timelimit>" . $timelimit . "</timelimit>
    <overduehandling>autosubmit</overduehandling>
    <graceperiod>0</graceperiod>
    <preferredbehaviour>deferredfeedback</preferredbehaviour>
    <attempts_number>" . $attemptcount . "</attempts_number>
    <attemptonlast>0</attemptonlast>
    <grademethod>1</grademethod>
    <decimalpoints>2</decimalpoints>
    <questiondecimalpoints>-1</questiondecimalpoints>
    <reviewattempt>69904</reviewattempt>
    <reviewcorrectness>0</reviewcorrectness>
    <reviewmarks>0</reviewmarks>
    <reviewspecificfeedback>0</reviewspecificfeedback>
    <reviewgeneralfeedback>0</reviewgeneralfeedback>
    <reviewrightanswer>0</reviewrightanswer>
    <reviewoverallfeedback>0</reviewoverallfeedback>
    <questionsperpage>" . $deliverytype . "</questionsperpage>
    <navmethod>" . $navmethod . "</navmethod>
    <shufflequestions>0</shufflequestions>
    <shuffleanswers>1</shuffleanswers>
    <questions>";
	$questions=$quiz_ar[$i]->getQuestions();
	$zahlderFragen=count($questions);
	//echo $quizname  . ": " . $zahlderFragen . "<br><br>";
for($j=0;$j<count($questions); $j++)
{
	$z=count($questions)-1;
	$quid=$questions[$j]->getId();
	$qudefaultmark=$qudefaultmark+$questions[$j]->getDefaultmark();
	if($j!==$z)
	{
		$xmlfile9.=$quid . ",";
	}
	else 
	{
		$xmlfile9.=$quid;
	}
}
	$xmlfile9.="</questions>
    <sumgrades>" . $gesamtscore . "</sumgrades>
    <grade>" . $gesamtscore . "</grade>
    <timecreated>0</timecreated>
    <timemodified>0</timemodified>
    <password></password>
    <subnet></subnet>
    <browsersecurity>-</browsersecurity>
    <delay1>0</delay1>
    <delay2>0</delay2>
    <showuserpicture>0</showuserpicture>
    <showblocks>0</showblocks>
    <question_instances>";
	for($j=0;$j<count($questions); $j++)
{
	$quid=$questions[$j]->getId();
	$grade=$questions[$j]->getDefaultmark();
      $xmlfile9.="<question_instance id=\"" . $j . "\">
        <question>" . $quid . "</question>
        <grade>" . $grade . "</grade>
      </question_instance>";
}
    $xmlfile9.="</question_instances>
    <feedbacks>
      <feedback id=\"12223\">
        <feedbacktext></feedbacktext>
        <feedbacktextformat>1</feedbacktextformat>
        <mingrade>0.00000</mingrade>
        <maxgrade>101.00000</maxgrade>
      </feedback>
    </feedbacks>
    <overrides>
    </overrides>
    <grades>
    </grades>
    <attempts>
    </attempts>
  </quiz>
</activity>";
$file9 = fopen($quizpfad . "/quiz.xml","w");
fwrite($file9,$xmlfile9);
fclose($file9);


//**********************************************grades.xml
$xmlfile10='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile10.="<activity_gradebook>
  <grade_items>
    <grade_item id=\"" . $quizid . "\">
      <categoryid>" . $categoryid ."</categoryid>
      <itemname>" . $quizname . "</itemname>
      <itemtype>mod</itemtype>
      <itemmodule>quiz</itemmodule>
      <iteminstance>3462</iteminstance>
      <itemnumber>0</itemnumber>
      <iteminfo>$@NULL@$</iteminfo>
      <idnumber></idnumber>
      <calculation>$@NULL@$</calculation>
      <gradetype>1</gradetype>
      <grademax>" . $gesamtscore . "</grademax>
      <grademin>0.00000</grademin>
      <scaleid>$@NULL@$</scaleid>
      <outcomeid>$@NULL@$</outcomeid>
      <gradepass>0.00000</gradepass>
      <multfactor>1.00000</multfactor>
      <plusfactor>0.00000</plusfactor>
      <aggregationcoef>0.00000</aggregationcoef>
      <sortorder>28</sortorder>
      <display>0</display>
      <decimals>$@NULL@$</decimals>
      <hidden>0</hidden>
      <locked>0</locked>
      <locktime>0</locktime>
      <needsupdate>0</needsupdate>
      <timecreated>0</timecreated>
      <timemodified>0</timemodified>
      <grade_grades>
      </grade_grades>
    </grade_item>
  </grade_items>
  <grade_letters>
  </grade_letters>
</activity_gradebook>";
$file10 = fopen($quizpfad . "/grades.xml","w");
fwrite($file10,$xmlfile10);
fclose($file10);
//**************************************************
//**********************************************inforef.xml
$xmlfile11='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile11.="<inforef>
  <grade_itemref>
    <grade_item>
      <id>" . $quizid . "</id>
    </grade_item>
  </grade_itemref>
  <question_categoryref>
    <question_category>
      <id>" . $categoryid . "</id>
    </question_category>
     </question_categoryref>
</inforef>";
$file11 = fopen($quizpfad . "/inforef.xml","w");
fwrite($file11,$xmlfile11);
fclose($file11);
//**************************************************
//**************************************************
//**********************************************module.xml
$xmlfile12='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile12.="<module id=\"" . $quizid . "\" version=\"" . $quizmoduleversion . "\">
  <modulename>quiz</modulename>
  <sectionid>" . $quizsectionid . "</sectionid>
  <sectionnumber>" . $quizsectionid . "</sectionnumber>
  <idnumber></idnumber>
  <added>0</added>
  <score>0</score>
  <indent>0</indent>
  <visible>1</visible>
  <visibleold>1</visibleold>
  <groupmode>0</groupmode>
  <groupingid>0</groupingid>
  <groupmembersonly>0</groupmembersonly>
  <completion>0</completion>
  <completiongradeitemnumber>$@NULL@$</completiongradeitemnumber>
  <completionview>0</completionview>
  <completionexpected>0</completionexpected>
  <availablefrom>0</availablefrom>
  <availableuntil>0</availableuntil>
  <showavailability>1</showavailability>
  <showdescription>0</showdescription>
  <availability_info>
  </availability_info>
</module>";
$file12 = fopen($quizpfad . "/module.xml","w");
fwrite($file12,$xmlfile12);
fclose($file12);
}
//******************************************
//directories für quizzes

for($i=0; $i<count($quiz_ar2); $i++)
{
	$qudefaultmark=0;
	//*************************************************
	//**************************
	$quizid=$quiz_ar2[$i]->getId();
	$quizname=$quiz_ar2[$i]->getName();
	$contextid=$quiz_ar2[$i]->getContextId();
	$categoryid=$quiz_ar2[$i]->getCategoryId();
	//echo "contextid         " . $contextid . "   categoryid " . $categoryid . "<br><br>";
	$gesamtscore=$quiz_ar2[$i]->getGesamtscore();
	$quizdescription=$quiz_ar2[$i]->getDescription();
	$quizsectionid=$quiz_ar2[$i]->getSectionid();
	$quizsectionid=$quizsectionid+$sectionstart;
	//$title=$arr_files[$i]->getTitle();
	$deliverytype=$quiz_ar_ids["$quizid"]->getDeliveryType();
	$timelimit=$quiz_ar_ids["$quizid"]->getTimeLimit();
	$attemptcount=$quiz_ar_ids["$quizid"]->getAttemptCount();
	if($attemptcount>0)
	{
	
	}
	else
	{
		$attemptcount=0;
	}
	if($timelimit>0)
	{
	
	}
	else
	{
		$timelimit=0;
	}
	if($deliverytype=="QUESTION_BY_QUESTION")
	{
		$deliverytype="1";
		$navmethod="sequential";
	}
	else
	{
		$deliverytype="0";
		$navmethod="free";
	}
	//*****************************************************
	//*****************************************************
	$quizpfad=$direxport . "/activities/quiz_" . $quizid;
	mkdir($quizpfad, 0700);
	//$pfad2= $pfad . "/grades.xml";
	$pfad3= $quizpfad . "/roles.xml";
	//copy("activities_src/grades.xml", $pfad2);
	copy("activities_src/roles.xml", $pfad3);
	//****************quiz.xml*****************************
	$xmlfile9='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
	$xmlfile9.="<activity id=\"" . $quizid . "\" moduleid=\"" . $quizid . "\" modulename=\"quiz\" contextid=\"" . $contextid . "\">
  <quiz id=\"" . $quizid . "\">
    <name>" . $quizname . "</name>
    <intro>" . $quizdescription . "</intro>
    <introformat>1</introformat>
    <timeopen>0</timeopen>
    <timeclose>0</timeclose>
    <timelimit>" . $timelimit . "</timelimit>
    <overduehandling>autosubmit</overduehandling>
    <graceperiod>0</graceperiod>
    <preferredbehaviour>deferredfeedback</preferredbehaviour>
    <attempts_number>0</attempts_number>
    <attemptonlast>0</attemptonlast>
    <grademethod>1</grademethod>
    <decimalpoints>2</decimalpoints>
    <questiondecimalpoints>-1</questiondecimalpoints>
    <reviewattempt>69904</reviewattempt>
    <reviewcorrectness>0</reviewcorrectness>
    <reviewmarks>0</reviewmarks>
    <reviewspecificfeedback>0</reviewspecificfeedback>
    <reviewgeneralfeedback>0</reviewgeneralfeedback>
    <reviewrightanswer>0</reviewrightanswer>
    <reviewoverallfeedback>0</reviewoverallfeedback>
 <questionsperpage>" . $deliverytype . "</questionsperpage>
     <navmethod>" . $navmethod . "</navmethod>
    <shufflequestions>0</shufflequestions>
    <shuffleanswers>1</shuffleanswers>
    <questions>";
	$questions=$quiz_ar2[$i]->getQuestions();
	for($j=0;$j<count($questions); $j++)
	{
		$z=count($questions)-1;
		$quid=$questions[$j]->getId();
		$qudefaultmark=$qudefaultmark+$questions[$j]->getDefaultmark();
		if($j!==$z)
			{
			$xmlfile9.=$quid . ",";
	}
	else
		{
		$xmlfile9.=$quid;
}
}
//***********************************************poolquestions
$poolquestions=$quiz_ar2[$i]->getPoolQuestions();
if(count($poolquestions)>0)
{
for($j=0;$j<count($poolquestions); $j++)
{
$z=count($poolquestions)-1;
$quid=$poolquestions[$j]->getId();
$qudefaultmark=$qudefaultmark+$poolquestions[$j]->getDefaultmark();
if($j!==$z)
{
$xmlfile9.=$quid . ",";
}
else
	{
		$xmlfile9.=$quid;
		}
		}

}

//****************************************************************
$xmlfile9.="</questions>
    <sumgrades>" . $gesamtscore . "</sumgrades>
    <grade>" . $gesamtscore . "</grade>
    <timecreated>0</timecreated>
    <timemodified>0</timemodified>
    <password></password>
    <subnet></subnet>
    <browsersecurity>-</browsersecurity>
    <delay1>0</delay1>
    <delay2>0</delay2>
    <showuserpicture>0</showuserpicture>
    <showblocks>0</showblocks>
    <question_instances>";
    for($j=0;$j<count($questions); $j++)
    {
    $quid=$questions[$j]->getId();
    $grade=$questions[$j]->getDefaultmark();
      $xmlfile9.="<question_instance id=\"" . $j . "\">
        <question>" . $quid . "</question>
        <grade>" . $grade . "</grade>
      </question_instance>";
}
if(count($poolquestions)>0)
{
for($j=0;$j<count($poolquestions); $j++)
{
$quid=$poolquestions[$j]->getId();
$grade=$poolquestions[$j]->getDefaultmark();
$xmlfile9.="<question_instance id=\"" . $j . "\">
		<question>" . $quid . "</question>
		<grade>" . $grade . "</grade>
      </question_instance>";
}
}
    $xmlfile9.="</question_instances>
    <feedbacks>
      <feedback id=\"12223\">
        <feedbacktext></feedbacktext>
        <feedbacktextformat>1</feedbacktextformat>
        <mingrade>0.00000</mingrade>
        <maxgrade>101.00000</maxgrade>
      </feedback>
    </feedbacks>
    <overrides>
    </overrides>
    <grades>
    </grades>
    <attempts>
    </attempts>
  </quiz>
  </activity>";
  $file9 = fopen($quizpfad . "/quiz.xml","w");
  fwrite($file9,$xmlfile9);
  fclose($file9);


  //**********************************************grades.xml
$xmlfile10='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile10.="<activity_gradebook>
  <grade_items>
  <grade_item id=\"" . $quizid . "\">
  <categoryid>" . $categoryid ."</categoryid>
  <itemname>" . $quizname . "</itemname>
      <itemtype>mod</itemtype>
      <itemmodule>quiz</itemmodule>
      <iteminstance>3462</iteminstance>
      <itemnumber>0</itemnumber>
      <iteminfo>$@NULL@$</iteminfo>
      <idnumber></idnumber>
      <calculation>$@NULL@$</calculation>
      <gradetype>1</gradetype>
  <grademax>" . $gesamtscore . "</grademax>
      <grademin>0.00000</grademin>
      <scaleid>$@NULL@$</scaleid>
      <outcomeid>$@NULL@$</outcomeid>
      <gradepass>0.00000</gradepass>
      <multfactor>1.00000</multfactor>
      <plusfactor>0.00000</plusfactor>
      <aggregationcoef>0.00000</aggregationcoef>
      <sortorder>28</sortorder>
      <display>0</display>
      <decimals>$@NULL@$</decimals>
      <hidden>0</hidden>
      <locked>0</locked>
      <locktime>0</locktime>
      <needsupdate>0</needsupdate>
      <timecreated>0</timecreated>
      <timemodified>0</timemodified>
      <grade_grades>
      </grade_grades>
    </grade_item>
  </grade_items>
  <grade_letters>
  </grade_letters>
</activity_gradebook>";
$file10 = fopen($quizpfad . "/grades.xml","w");
fwrite($file10,$xmlfile10);
fclose($file10);
//**************************************************
//**********************************************inforef.xml
$xmlfile11='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile11.="<inforef>
  <grade_itemref>
    <grade_item>
    <id>" . $quizid . "</id>
    </grade_item>
  </grade_itemref>
  <question_categoryref>
    <question_category>
    <id>" . $categoryid . "</id>
    </question_category>
     </question_categoryref>
</inforef>";
$file11 = fopen($quizpfad . "/inforef.xml","w");
fwrite($file11,$xmlfile11);
fclose($file11);
//**************************************************
//**************************************************
//**********************************************module.xml
$xmlfile12='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile12.="<module id=\"" . $quizid . "\" version=\"" . $quizmoduleversion . "\">
  <modulename>quiz</modulename>
  <sectionid>" . $quizsectionid . "</sectionid>
  <sectionnumber>" . $quizsectionid . "</sectionnumber>
  <idnumber></idnumber>
  <added>0</added>
  <score>0</score>
  <indent>0</indent>
  <visible>1</visible>
  <visibleold>1</visibleold>
  <groupmode>0</groupmode>
  <groupingid>0</groupingid>
  <groupmembersonly>0</groupmembersonly>
  <completion>0</completion>
  <completiongradeitemnumber>$@NULL@$</completiongradeitemnumber>
  <completionview>0</completionview>
  <completionexpected>0</completionexpected>
  <availablefrom>0</availablefrom>
  <availableuntil>0</availableuntil>
  <showavailability>1</showavailability>
  <showdescription>0</showdescription>
  <availability_info>
  </availability_info>
</module>";
$file12 = fopen($quizpfad . "/module.xml","w");
fwrite($file12,$xmlfile12);
fclose($file12);
}
//******************************************
?>