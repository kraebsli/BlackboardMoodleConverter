<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 *  * makes use of Blackboard - http://www.blackboard.com
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
 class link
 
 {

var $id;
var $title;
var $url;
var $desc;
var $text;
var $section;
 	var $embedar;
var $indent;
	 var $available;	
//($linkid, $linktitle,$linktext, $linkurl, $section_link)
 	function link($i, $t, $te, $u,  $s, $ar)
 	{
 	$this->embedar=array();
 		$this->id=$i;
$this->text=$te;
 		$this->title=$t;
 		$this->desc=$d;
 		$this->url=$u;
 		$this->embedar=$ar;
$this->section=$s;
$this->indent=0;
$this->available=1;
 	}
  
 function getSection()
 	{
 		
 		return $this->section;
 	}
 	function getText()
 	{
 		
 		return $this->text;
 	}
 	
 	function getId()
 	{
 		
 		return $this->id;
 	}

 function getTitle()
 	{
 		
 		return $this->title;
 	}
 	
 	function getUrl()
 	{
 		
 		return $this->url;
 	}
 function getAr()
 	{
 		
 		return $this->embedar;
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
