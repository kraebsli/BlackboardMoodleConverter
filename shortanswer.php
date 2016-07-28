<?php
/*
 * Created on 15.08.2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
//shortanswer als bestandteil von lückentext
  class shortanswer
 
 {

 	var $id;
 	var $parentid;
 	var $answers;
var $correctfeedback;
var $incorrectfeedback;
var $fragetext;
 var $shortanswerid;
 var $questiontitle;
 	
 	//$quid,$nr,$antworten,$correctfeedback,$incorrectfeedback
 	function shortanswer ($r, $n, $ant, $cfb, $icf, $sf, $shid, $tit)
 	{
 		$this->id=$n;
 		$this->parentid=$r;
 		$this->answers=$ant;
 		$this->correctfeedback=$cfb;
 		$this->incorrectfeedback=$icf;
 		$this->fragetext=$sf;
 		$this->shortanswerid=$shid;
 		$this->questiontitle=$tit;
 		
 	}


 
 
 	function getId()
 	{
 		
 		return $this->id;
 	}

 	function getShortanswerId()
 	{
 		
 		return $this->shortanswerid;
 	}
 
 	function getParentId()
 	{
 		
 		return $this->parentid;
 	}
 		function getCorrectFeedback()
 	{
 		
 		return $this->correctfeedback;
 	}
 function getInCorrectFeedback()
 	{
 		
 		return $this->incorrectfeedback;
 	}
 	function getAnswers()
 	{
 		
 		return $this->answers;
 	}
 function getFragetext()
 	{
 		
 		return $this->fragetext;
 	}
 function getTitle()
 	{
 		
 		return $this->questiontitle;
 	}
 }
?>
