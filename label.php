<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
 class label
 
 {

var $id;
var $title;
var $text;
var $desc;
var $embedar;
var $section;
var $parentid;
var $indent;
	 var $available;	

 	function label($i, $t, $te, $s, $em, $p)
 	{
 	$this->embedar=array();
 		$this->id=$i;

 		$this->title=$t;
 	
 		$this->text=$te;

$this->section=$s;
$this->embedar=$em;
$this->parentid=$p;
$this->indent=0;
$this->available=1;
 	}
  function getAr()
 	{
 		
 		return $this->embedar;
 	}
 function getSection()
 	{
 		
 		return $this->section;
 	}
 	function getDescription()
 	{
 		
 		return $this->desc;
 	}
 	
 	function getId()
 	{
 		
 		return $this->id;
 	}
  	function getParentid()
 	{
 		
 		return $this->parentid;
 	}
 function getTitle()
 	{
 		
 		return $this->title;
 	}
 	
 	function getText()
 	{
 		
 		return $this->text;
 	}
	function getAvailable()
 	{
 			
 		return $this->available;
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
 }
?>
