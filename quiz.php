
<?php
/*
 * Created on 08.08.2014
 *
* @copyright  Kathrin Braungardt, Ruhr-Universit�t Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */

 class quiz
 
 {
 	var $name;
 	var $id;
 	var $questions;
 	var $contextid;
 	 	var $categoryid;
 	 	var $gesamtscore;
 	 	var $description;
 	 	var $section;
 	var $poolquestions;
 	var $deliverytype;
 	var $timelimit;
 	var $attemptcount;
	 var $indent;
	 var $available;
 	function quiz($n, $i, $c, $cat, $g, $d)
 	{
 		$this->name=$n;
 		$this->id=$i;
 		$this->questions=array();
 		$this->poolquestions=array();
 		$this->contextid=$c;
 		$this->categoryid=$cat;
 		$this->gesamtscore=$g;
 		$this->description=$d;
 		$this->section=1;
		$this->indent=0;
$this->available=1;
 	}
 	
 	function getName()
 	{
 		
 		return $this->name;
 	}
 function getId()
 	{
 		
 		return $this->id;
 	}
 function getContextId()
 	{
 		
 		return $this->contextid;
 	}
 function getCategoryId()
 	{
 		
 		return $this->categoryid;
 	}
 	function setQuestions($q)
 	{
 		
 		$this->questions[]=$q;
 	}
 	function setPoolQuestions($q)
 	{
 			
 		$this->poolquestions[]=$q;
 	}
 	function getPoolQuestions()
 	{
 	
 		return $this->poolquestions;
 	}
 function getQuestion($i)
 	{
 		
 		return $this->questions[$i];
 	}
 function getQuestions()
 	{
 		
 		return $this->questions;
 	}
  function getGesamtscore()
 	{
 		
 		return $this->gesamtscore;
 	}
 function getDescription()
 	{
 		
 		return $this->description;
 	}
 	function updateDescription($ud)
 	{
 			
 		 $this->description=$ud . "<br><br>" . $this->description;
 		 $this->description= xmlencoding($this->description);
 		// echo $this->name . "<br>" . $this->description . "<br>";
 
 	}
 	function setSectionid($s)
 	{
 			
 		$this->section=$s;
 	}
 	function getSectionid()
 	{
 	
 			return $this->section;
 	}
 	function setDeliveryType($d)
 	{
 	
 		$this->deliverytype=$d;
 	}
 	function getDeliveryType()
 	{
 	
 		return $this->deliverytype;
 	}
 	function setTimeLimit($t)
 	{
 	
 		$this->timelimit=$t;
 	}
 	function getTimeLimit()
 	{
 	
 		return $this->timelimit;
 	}
 	function setAttemptCount($t)
 	{
 	
 		$this->attemptcount=$t;
 	}
 	function getAttemptCount()
 	{
 	
 		return $this->attemptcount;
 	}
	function setAvailable($a)
 	{
 	if($a==true)
	{
 		$this->available ="1";
	}
	else
	{
		$this->available ="0";
 	}
	}
	function getIndent()
 	{
 		
 		return $this->indent;
 	}
	function setIndent($in)
 	{
 		
 		 $this->indent=$in;
 	}
	function getAvailable()
 	{
 			
 		return $this->available;
 	}
 }
?>
