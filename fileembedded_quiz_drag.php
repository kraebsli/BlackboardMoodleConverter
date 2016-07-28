<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
 class fileembedded_quiz_drag
 
 {
 	var $name;
 	var $id;
 	var $hash;
 	 	

var $res;
var $parentid;
var $contenthash;
var $contextid;
var $filesize;
 	 	 	
// ($fname, $identifier_hash,$xidbild, $res, $pid);
 	function fileembedded_quiz_drag($n,$i,  $r, $p, $c, $ct, $fs)
 	{
 		$this->name=$n;
 		$this->id=$i;

 		$this->contenthash=$c;
 		$this->res=$r;
 		$this->parentid=$p;
$this->contextid=$ct;
$this->filesize=$fs;
 	}
  function getFilesize()
 	{
 		
 		return $this->filesize;
 	}
 	function getName()
 	{
 		
 		return $this->name;
 	}

 	function getId()
 	{
 		
 		return $this->id;
 	}
 function getContextid()
 	{
 		
 		return $this->contextid;
 	}
 function getContentHash()
 	{
 		
 		return $this->contenthash;
 	}
 	function getParentId()
 	{
 		
 		return $this->parentid;
 	}
 
 	function getRes()
 	{
 		
 		return $this->res;
 	}
 }
?>
