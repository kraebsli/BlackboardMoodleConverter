<?php
/*
 * Created on 08.08.2014
 *
* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
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
 	var $description;
 	function folder($n,$i,$p)
 	{
		
 		$this->name=$n;
 		$this->id=$i;
 		$this->parentid=$p;
 		$this->files=array();
 		$this->description="";
 		
 	}
 	function setFiles($file)
 	{
 		
 		$this->files[]=$file;
 	}
 	function getName()
 	{
		if(strlen($this->name)>15)
		{
			$this->name=substr($this->name,0,250);
		}
 		
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
 	function getDescription()
 	{
 	
 		return $this->description;
 	}
 	function setDescription($d)
 	{
 	
 		$this->description =$d;
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
