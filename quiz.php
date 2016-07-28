
<?php
/*
 * Created on 08.08.2014
 *
* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
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
 		$this->section=0;
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
 		
 		return $this->contextid;
 	}
 	function setQuestions($q)
 	{
 		
 		$this->questions[]=$q;
 	}
 	function setPoolQuestions($q)
 	{
 			
 		$this->poolquestions[]=$q;
 	}
 	function getPoolQuestions($q)
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
 	function setSectionid($s)
 	{
 			
 		$this->section=$s;
 	}
 	function getSectionid()
 	{
 	
 			return $this->section;
 	}
 }
?>
