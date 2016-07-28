<?php
/*
 * Created on 15.08.2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  class question
 
 {
 	var $name;
 	var $id;
 	var $questiontype;
 	var $questiontext;
 	var $defaultmark;
 	var $questionid;
 	var $questiontitle;
 	var $feedbackcorrect;
 	var $feedbackincorrect;
 	var $loesungid;
 	 	var $multichoiceid;
 	 	var $antworten;
 	 	var $ZahlRichtigerAntworten;
 	 	var $truefalseid;
 	 	var $single;
 	 	var $shortanswerid;
 	 	var $attachment;
 	 	var $matchid;
 	 	var $multianswerid;
 	 	var $draganddropid;
 	 	var $numericalid;
 	 	var $shortanswer;// für multianswer bool
 	 	var $coords;
 	 	var $fehler;
 	 	var $frageimSatz;
 	function question ($t,$sz)
 	{
 		$this->frageimSatz=$sz;
 		$this->questiontype=$t;

 	}
 
 	//$qt, $df, $quid, $multichoiceid, $correctfeedback, $incorrectfeedback, $loesung, $answer_ar, $ZahlRichtigerAntworten, $questiontitle
 	function multichoice($qt,$df, $id, $m, $fbc, $fbic, $lid, $ant, $z, $tit, $s)
 	{
 		$this->single=$s;
 		$this->questiontext=$qt;
 		$this->questiontitle=$tit;
 		$this->defaultmark=$df;
 		$this->questionid=$id;
 		$this->feedbackcorrect=$fbc;
 		$this->feedbackincorrect=$fbic;
 		$this->loesungid=$lid;
 		$this->antworten=$ant;
 		$this->multichoiceid=$m;
 		$this->ZahlRichtigerAntworten=$z;
 	}
 function draganddrop($qt,$df, $id, $m, $fbc, $fbic, $coor, $tit)
 	{
 		
 		$this->questiontext=$qt;
 		$this->questiontitle=$tit;
 		$this->defaultmark=$df;
 		$this->questionid=$id;
 		$this->feedbackcorrect=$fbc;
 		$this->feedbackincorrect=$fbic;
 		$this->coords=$coor;
 		$this->draganddropid=$m;
 
 	}
 	//$qt,$df, $quid, $numericalid, $correctfeedback, $incorrectfeedback,  $loesung, $fehler,$questiontitle);
  function numerical($qt,$df, $id, $m, $fbc, $fbic, $l, $f, $tit)
 	{
 		
		$this->questiontext=$qt;
 		$this->questiontitle=$tit;
 		$this->defaultmark=$df;
 		$this->questionid=$id;
 		$this->feedbackcorrect=$fbc;
 		$this->feedbackincorrect=$fbic;
 		$this->numericalid=$m;
 		$this->loesungid=$l;
 		echo $l;
 		$this->fehler=$f;
 }
 	function truefalse($qt, $df, $id, $m, $fbc, $fbic, $lid, $tit, $ant)
 	{
 		//questiontype, questiontext, defaultmark, questionid, truefalseid, feedbackcorrect, feedbackincorrect, loesung, questiontitle
 		$this->questiontext=$qt;
 		$this->questiontitle=$tit;
 		$this->defaultmark=$df;
 		$this->questionid=$id;
 		$this->feedbackcorrect=$fbc;
 		$this->feedbackincorrect=$fbic;
		$this->truefalseid=$m;
 		$this->loesungid=$lid;
 		$this->antworten=$ant;
 	}
 	//	$ques->shortanswer($qt,$df, $quid, $shortanswerid, $antworttext, $answer_ar, $questiontitle);
 	//$shanswer= new shortanswer($quid,$shortanswerid,$antworten,$correctfeedback,$incorrectfeedback, $subfrage, $shortanswerid, $questiontitle );
 function shortanswer($qt, $df, $id, $m, $lid, $ant,$tit)
 	{

 		$this->questiontext=$qt;
 		$this->questiontitle=$tit;
 		$this->defaultmark=$df;
 		$this->questionid=$id;
		$this->shortanswerid=$m;
 		$this->loesungid=$lid;
 		$this->antworten=$ant;
 	}
 function shortanswer2($qt, $df, $id, $m,  $ant,$tit, $fbc, $fbic)
 	{

 		$this->questiontext=$qt;
 		$this->questiontitle=$tit;
 		$this->defaultmark=$df;
 		$this->questionid=$id;
		$this->shortanswerid=$m;
 	
 		$this->antworten=$ant;
 			$this->feedbackcorrect=$fbc;
 		$this->feedbackincorrect=$fbic;
 	}
 function essay($qt, $df, $id, $m, $lid, $ant,$tit, $at)
 	{

 		$this->questiontext=$qt;
 		$this->questiontitle=$tit;
 		$this->defaultmark=$df;
 		$this->questionid=$id;
		$this->shortanswerid=$m;
 		$this->loesungid=$lid;
 		$this->antworten=$ant;
 		$this->attachment=$at;
 	}
 	//**********************************************
 	//$qt,$df, $quid, $multianswerid,  $fragen, $questiontitle, $correctfeedback, $incorrectfeedback,  "false");
 	function multianswer($qt, $df, $id, $m,  $ant,$tit, $cf, $icf, $sh)
 	{
 		$this->questiontext=$qt;
 		$this->questiontitle=$tit;
 		$this->defaultmark=$df;
 		$this->questionid=$id;
		$this->multianswerid=$m;
 		$this->antworten=$ant;
 		$this->feedbackcorrect=$cf;
 		$this->feedbackincorrect=$icf;
 		$this->shortanswer=$sh;
 	}
 	function getName()
 	{
 		
 		return $this->name;
 	}
  	function getCoords()
 	{
 		
 		return $this->coords;
 	}
 function getFehler()
 	{
 		
 		return $this->fehler;
 	}
 	function getId()
 	{
 		
 		return $this->questionid;
 	}
 	function getTitle()
 	{
 		
 		return $this->questiontitle;
 	}
 	
 	function getAntworten()
 	{
 		
 		return $this->antworten;
 	}
 function getLoesungId()
 	{
 		
 		return $this->loesungid;
 	}
 function getMultichoiceId()
 	{
 		
 		return $this->multichoiceid;
 	}
  function getNumericalId()
 	{
 		
 		return $this->numericalid;
 	}
 function getDragandDropId()
 	{
 		
 		return $this->draganddropid;
 	}
 function getTruefalseId()
 	{
 		
 		return $this->truefalseid;
 	}
  function getShortanswerId()
 	{
 		
 		return $this->shortanswerid;
 	}
 function getMatchId()
 	{
 		
 		return $this->matchid;
 	}
 function getMultianswerId()
 	{
 		
 		return $this->multianswerid;
 	}
 function getFeedbackCorrect()
 	{
 		
 		return $this->feedbackcorrect;
 	}
  function getFeedbackInCorrect()
 	{
 		
 		return $this->feedbackincorrect;
 	}
 	 	function getQuestiontype()
 	{
 		
 		return $this->questiontype;
 	}
 	
 		function getQuestiontext()
 	{
 		
 		return $this->questiontext;
 	}
 		function getDefaultmark()
 	{
 		
 		return $this->defaultmark;
 	}
 	function getZahlRichtigerAntworten()//bei MC-Aufgaben
 	{
 		
 		return $this->ZahlRichtigerAntworten;
 	}
 		function getSingle()
 	{
 		
 		return $this->single;
 	}
 	function getAttachment()
 	{
 		return $this->attachment;
 	}
 function getShortanswer()
 	{
 		return $this->shortanswer;
 	}
 	function getFrageimSatz()
 	{
 		return $this->frageimSatz;
 	}
 	//***************$ques->match($qt,$df, $quid, $matchid,  $answer_ar, $questiontitle);
  function match($qt, $df, $id, $m, $ant,$tit, $fbc, $fbic)
 	{

 		$this->questiontext=$qt;
 		$this->questiontitle=$tit;
 		$this->defaultmark=$df;
 		$this->questionid=$id;
		$this->matchid=$m;
 		$this->antworten=$ant;
 		$this->feedbackcorrect=$fbc;
 		$this->feedbackincorrect=$fbic;
 	
 	}
 }
?>
