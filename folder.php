<?php
/*
 * Created on 08.08.2014
 *
* @copyright  Kathrin Braungardt, Ruhr-Universit�t Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */

 class folder
 
 {
 	var $name;
 	var $id;
 	var $files;
 	var $parentid;
 	function folder($n,$i,$p)
 	{
 		$this->name=$n;
 		$this->id=$i;
 		$this->parentid=$p;
 		$this->files=array();
 		
 	}
 	function setFiles($file)
 	{
 		
 		$this->files[]=$file;
 	}
 	function getName()
 	{
 		
 		return $this->name;
 	}
 	function getId()
 	{
 		
 		return $this->id;
 	}
 	function getParentId()
 	{
 		
 		return $this->parentid;
 	}
 	function getFiles()
 	{
 		
 		return $this->files;
 	}
 }
?>