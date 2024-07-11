<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
 class wiki
 
 {

var $id;
var $title;
var $text;
var $desc;
var $pages;
var $section;
 	 	  var $indent;
	 var $available;	
 	 	 	

 	function wiki($i, $t, $te,  $s)
 	{
 	$this->pages=array();
 		$this->id=$i;

 		$this->title=$t;

 		$this->desc=$te;
 		$this->embedar=$em;
 		
$this->section=$s;
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
 	
 function getTitle()
 	{
 		
 		return $this->title;
 	}
 	
 	function getText()
 	{
 		
 		return $this->text;
 	}
 	function setPages($page)
 	{
 			
 		$this->pages[]=$page;
 	}
 	function getPages()
 	{
 			
 		return $this->pages;
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
