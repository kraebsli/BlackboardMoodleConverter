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
 }
?>
