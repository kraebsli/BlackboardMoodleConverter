<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
 class page
 
 {

var $id;
var $title;
var $text;
var $desc;
var $embedar;
var $section;
 	 	 	

 	function page($i, $t, $te, $d, $em, $s)
 	{
 	$this->embedar=array();
 		$this->id=$i;

 		$this->title=$t;
 		$this->desc=$d;
 		$this->text=$te;
 		$this->embedar=$em;
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
