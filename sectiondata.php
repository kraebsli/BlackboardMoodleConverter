<?php
/*
 * Created on 08.08.2014
 *
 * @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
 class sectiondata
 
 {

var $id;
var $title;
var $parentid;
var $available;
 	 	 	

 	function sectiondata($i, $t, $p)
 	{
 
 		$this->id=$i;

 		$this->title=$t;
 			
 		$this->parentid=$p;
 		
	//$this->available=$a;
 	}

 	function getParentId()
 	{
 		
 		return $this->parentid;
 	}
 	
 	function getId()
 	{
 		
 		return $this->id;
 	}

 function getName()
 	{
 		
 		return $this->title;
 	}
 function getVisible()
 	{
 		
 		return $this->available;
 	}
 
 }
?>
