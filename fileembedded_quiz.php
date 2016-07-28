<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
 class fileembedded_quiz
 
 {
 	var $name;
 	var $id;
 	 	var $hash;
 	 	
 	 	 	var $name2;
var $res;
var $parentid;
var $contenthash;
var $contextid;
var $filesize;
var $filearea;
 	 	 	
// ($fname, $identifier_hash,$xidbild, $res, $pid);
 	function fileembedded_quiz($n,$i, $n2, $r, $p, $c, $ct, $fs, $fa)
 	{
 		$this->name=$n;
 		$this->id=$i;
 		$this->name2=$n2;
 		$this->contenthash=$c;
 		$this->res=$r;
 		$this->parentid=$p;
$this->contextid=$ct;
$this->filesize=$fs;
$this->filearea=$fa;
 	}
  function getFilesize()
 	{
 		
 		return $this->filesize;
 	}
 	function getFilearea()
 	{
 			
 		return $this->filearea;
 	}
 	function getName()
 	{
 		
 		return $this->name;
 	}
 	function getName2()
 	{
 		
 		return $this->name2;
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
