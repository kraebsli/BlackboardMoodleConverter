
<?php
/*
 * Created on 08.08.2014
 *
* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of Moodle - http://moodle.org/
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */

 class survey
 
 {
 	var $name;
 	var $id;
 	var $items;
 	var $contextid;
var $description;
var $section;
 var $indent;
	 var $available;
 	function survey($n, $i, $c, $d)
 	{
 		
 		$this->name=$n;
 		$this->id=$i;
 		$this->items=array();

 		$this->contextid=$c;

 		$this->description=$d;
 		$this->section=$s;
		$this->indent=0;
$this->available=1;
 	}
 	
 	function getName()
 	{
 		
 		return $this->name;
 	}
 function getId()
 	{
 		
 		return $this->id;
 	}
 function getContextId()
 	{
 		
 		return $this->contextid;
 	}
 
 	function setItems($q)
 	{
 		
 		$this->items[]=$q;
 	}
 	
 function getItem($i)
 	{
 		
 		return $this->items[$i];
 	}
 function getItems()
 	{
 		
 		return $this->items;
 	}
 
 function getDescription()
 	{
 		
 		return $this->description;
 	}
 	
 	function setSectionid($s)
 	{
 			
 		$this->section=$s;
 	}
 	function getSectionid()
 	{
 	
 			return $this->section;
 	}
	function updateDescription($ud)
 	{
 			
 		 $this->description=$ud . "<br><br>" . $this->description;
 		 $this->description= xmlencoding($this->description);
 		// echo $this->name . "<br>" . $this->description . "<br>";
 
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
	function getAvailable()
 	{
 			
 		return $this->available;
 	}
 }
?>
