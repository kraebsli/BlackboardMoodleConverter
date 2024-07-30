<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$ab="";
$zaehler++;
$questiontype="match";
$sollsein=true;
$matchid++;
$fragen=array();
$antworten=array();
$scorevalue="";
//echo "<br>";
//echo $quiz2_demo;
//echo "<br>";
//***************************Frageninhalte
foreach ($question->presentation->flow->flow as $flow) {
	if($flow['class']=="QUESTION_BLOCK")//Fragetext
	{
		//Fragetext
		include("questiontext.php");
		
		//echo $qt;
		//echo "<br>";
	}
	elseif($flow['class']=="RESPONSE_BLOCK")//Antworten
	{
		foreach($flow->flow as $flow3)
		{
			$t1=$flow3->response_lid;
			$quident=trim($t1['ident']);
		$quidents[]=$quident;//left identifiers
		/*$resplabel_ids=array();
		foreach($flow3->response_lid->render_choice->flow_label->response_label as $resplabel)
		{
			$resplabel_id=$resplabel['ident'];
			$resplabel_ids[]=$resplabel_id;
		}
		$quidents2[]=$resplabel_ids;//answerids*/
		}
		//*****************************************
		foreach($flow->flow as $flow2)
		{
			$frage=$flow2->flow->material->mat_extension->mat_formattedtext;
			
			$frage=strip_tags($frage);
			$frage=xmlencoding($frage);
	
			$fragen[]=$frage;

		}

			
		//*********************************************************************

	}//ende else antworten
	elseif($flow['class']=="RIGHT_MATCH_BLOCK")//Antworten
	{
		$f=0;
		foreach($flow->flow as $flow3)
		{
			$antwort=$flow3->flow->material->mat_extension->mat_formattedtext;
			$antwort=strip_tags($antwort);
			$antwort=xmlencoding($antwort);
		
			if(isset($fragen[$f]))
			{
				
			}
			else {
				$fragen[]="";
			}
			$antworten[]=$antwort;
			$f++;
		}
	}

	//**************************************
}//ende foreach question Frageninhalte

for($i=0; $i<count($fragen); $i++)
{
	
	
	if(isset($_POST[$zahlmatches]) && $_POST[$zahlmatches]!=="" )
	{
		
	$richtigeantwort="";
	$antworttext=$fragen[$i];//hier frage
	for($k=0; $k<count($fragen); $k++)
	{
		if($_POST[$zahlmatches]==$quidents[$k])
		{
			$feedback=$antworten[$k];//hier antwort
			//echo $antworttext . "    " . $feedback;
			//echo "<br><br>";
			$antwortid++;
			$antwort=new answer ($antwortid, $antworttext, $feedback, $richtigeantwort, $scorevalue);
			$answer_ar[]=$antwort;
			//echo "korr: " . $fragen[$i] . ": " . $antworten[$k];
			//echo "&nbsp;&nbsp;&nbsp;";
			//echo "<select name=\"" . $zahlmatches . "\">";
			//**************************************************************
			for($m=0; $m<count($antworten); $m++)
			{
			if($_POST[$zahlmatches]==$quidents[$m])
			{
			//echo "<option value=\"" .  $quidents[$m] .  "\"selected>";
					//echo $feedback;
					//echo "</option>";
			}
			}
			for($m=0; $m<count($antworten); $m++)
			{
			if($_POST[$zahlmatches]==$antworten[$m])
			{
			
			}
			else
			{
			//echo "<option value=\"" .  $quidents[$m] .  "\">";
					//echo $antworten[$m];
							//echo "</option>";
			}
			}
							//*************************************************
		}
		
	}
   
					//echo "</select>";
					//echo "<br>";
					$_POST[$zahlmatches]="";
	}
	else 
	{
		$richtigeantwort="";
		$antworttext=$fragen[$i];//hier frage
		
		$feedback=$antworten[$i];//hier antwort
		//echo $antworttext . "    " . $feedback;
		//echo "<br><br>";
		$antwortid++;
		$antwort=new answer ($antwortid, $antworttext, $feedback, $richtigeantwort, $scorevalue);
		$answer_ar[]=$antwort;
		//echo $fragen[$i] . ": " . $antworten[$i];
		//echo "&nbsp;&nbsp;&nbsp;";
		//echo "<select name=\"" . $zahlmatches . "\">";
		for($m=0; $m<count($antworten); $m++)
		{
			if($antworten[$i]==$antworten[$m])
			{
				//echo "<option value=\"" .  $quidents[$m] .  "\"selected>";
				//echo $antworten[$m];
				//echo "</option>";
			}
		}
		for($m=0; $m<count($antworten); $m++)
		{
		if($antworten[$i]==$antworten[$m])
		{
		
		}
		else 
		{
			//echo "<option value=\"" .  $quidents[$m] .  "\">";
			//echo $antworten[$m];
			//echo "</option>";
		}
		}
		
		
		//echo "</select>";
		//echo "<br>";
		
	}
	$zahlmatches++;
}
//*****************************************
/*foreach ($question->resprocessing->respcondition as $respid) {
	$respid3=trim($respid->conditionvar->varequal);//left
	$gefunden=false;

for($i=0; $i<count($quidents); $i++)
{
	if($gefunden==false)
	{
	$respid2=trim($respid->conditionvar->varequal['respident']);//right

	if($quidents[$i]==$respid2)
	{
		
for($j=0; $j<count($quidents2); $j++)
{
	if($gefunden==false)
	{
	for($k=0; $k<count($quidents2[$j]); $k++)
	{
		if(isset($_POST[$fragen[$k]]))
$ab=$_POST[$fragen[$k]];
		if(isset($_POST[$ab])&& $_POST[$ab]!=="")//antworten
		{
			echo "korr" . $fragen[$k] . ": " . $_POST[$fragen[$k]];
			echo "<br>";
			
			for($m=0; $m<count($antworten); $m++)
			{
				if($antworten[$m]==$_POST[$fragen[$k]])
				{
					echo $fragen[$k] . ": " . $antworten[$m];
					echo "<br>";
					echo "<select name=\"" . $fragen[$k] . "\">";
			echo "<option value=\"" .  $antworten[$m] . "\">" . $antworten[$m];
				
							echo "</option>";
				}
				else 
				{
				
						echo "<option value=\"" .  $antworten[$m] . "\">" .  $antworten[$m];
						
						echo "</option>";
				}
	
		
		
			}
			echo "</select>";
			echo "<br>";
			$gefunden=true;
			break;
		}
		else 
		{
		if($quidents2[$j][$k]==$respid3)
		{
			echo $fragen[$k] . ": " . $antworten[$k];
			echo "<br>";
			echo "<select name=\"" . $fragen[$k] . "\">";
			for($m=0; $m<count($antworten); $m++)
			{
			echo "<option value=\"" .  $antworten[$m] .  "\">";
				echo $antworten[$m];
							echo "</option>";
				}
	
			echo "</select>";
			echo "<br>";
			$gefunden=true;
			$richtigeantwort="";
			$antworttext=$fragen[$k];//hier frage
			
			$feedback=$antworten[$k];//hier antwort
			//echo $antworttext . "    " . $feedback;
			//echo "<br><br>";
			$antwortid++;
			$antwort=new answer ($antwortid, $antworttext, $feedback, $richtigeantwort, $scorevalue);
			$answer_ar[]=$antwort;
			break;
		}
		}
	}//ende for k
	}
	else 
	{
		break;
	}
	
}		//ende for j
	}// ende for i
	}
	else 
	{
		break;
	}
}//ende foreach resprocessing




}*/


//*************************************
//feedback schleife***************************************************
//*******************************************************************
foreach ($question->itemfeedback as $itemfeedback) {//feedback
		
	$ifb=trim($itemfeedback['ident']);
		
	if($ifb=="correct" && $correctfeedback=="")
	{
		$correctfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
		$correctfeedback=xmlencoding($correctfeedback);
		
	
	}
	else if($ifb=="incorrect" && $incorrectfeedback=="")
	{
		$incorrectfeedback=$itemfeedback->flow_mat->flow_mat->material->mat_extension->mat_formattedtext;
		$incorrectfeedback=xmlencoding($incorrectfeedback);
		
		
	}
		
}//ende foreachfeedback*********************************************
//echo "Fragentyp: " . $questiontype;
$ques= new question($questiontype, $frageimSatz);
$ques->match($qt,$df, $quid, $matchid,  $answer_ar, $questiontitle, $correctfeedback, $incorrectfeedback);
//echo "****************";
//echo "<br>";
?>