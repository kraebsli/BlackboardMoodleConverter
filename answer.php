<?php
/*
 * Created on 15.08.2014
 *
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
* makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
* */

  class answer
 
 {
 	var $name;
 	var $id;
 	var $questiontype;
 	var $answertext;
 	var $feedback;
 	var $fraction;
 	var $answerformat;
 	var $feedbackformat; 
 	var $richtigeantwort;
 	var $scorevalue;
 	
 	
 	function answer ($r, $at, $fb, $ra, $sv)
 	{
 		
 	
 		$this->id=$r;
 		$this->answertext=$at;
 		$this->feedback=$fb;
 		$this->richtigeantwort=$ra;
 		$this->scorevalue=$sv;
 		
 	}
 	function getScorevalue()
 	{
 		
 		return $this->scorevalue;
 	}
 	function getName()
 	{
 		
 		return $this->name;
 	}
 function getRichtigeAntwort()
 	{
 		
 		return $this->richtigeantwort;
 	}
 	function getId()
 	{
 		
 		return $this->id;
 	}
 	function getQuestiontype()
 	{
 		
 		return $this->questiontype;
 	}
 	
 		function getAnswertext()
 	{
 		
 		return $this->answertext;
 	}
 function getFeedback()
 	{
 		
 		return $this->feedback;
 	}
 }
?>
