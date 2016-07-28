<?php
/*
 * Created on 15.08.2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
//shortanswer als bestandteil von lückentext
  class multiplechoice
 
 {

 	var $id;
 	var $parentid;
 	var $answers;
var $correctfeedback;
var $incorrectfeedback;
var $fragetext;
 var $multiplechoiceid;

 	
 	//($quid,$identifier_hash,$answer_ar, $qt, $multichoiceid );
 	function multiplechoice ($r, $n, $ant, $sf, $shid)
 	{
 		$this->id=$n;
 		$this->parentid=$r;
 		$this->answers=$ant;
 		//$this->correctfeedback=$cfb;
 		//$this->incorrectfeedback=$icf;
 		$this->fragetext=$sf;
 		$this->multiplechoiceid=$shid;
 
 		
 	}


 
 
 	function getId()
 	{
 		
 		return $this->id;
 	}

 	function getMultiplechoiceId()
 	{
 		
 		return $this->multiplechoiceid;
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

 }
?>
