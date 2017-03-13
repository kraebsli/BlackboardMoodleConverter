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
var $embedar;
var $section;
var $linkref;
 	 	 	

 	function wiki($i, $t, $te, $em, $s, $l)
 	{
 	$this->embedar=array();
 		$this->id=$i;

 		$this->title=$t;
 	
 		$this->text=$te;
 		$this->embedar=$em;
 		$this->linkref=$l;
$this->section=$s;
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
 	function getLinkRef()
 	{
 			
 		return $this->linkref;
 	}
 function getTitle()
 	{
 		
 		return $this->title;
 	}
 	
 	function getText()
 	{
 		
 		return $this->text;
 	}
 }
?>
