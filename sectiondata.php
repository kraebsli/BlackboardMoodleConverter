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
var $othersections;
var $sectionorder;

 	function sectiondata($i, $t, $p)
 	{
 
 		$this->id=$i;

 		$this->title=$t;
 			$this->elementnumber=0;
 		$this->parentid=$p;
 		$this->othersections=array();
 		$this->sectionorder=array();
		$this->temparray=array();
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
 	function setOtherSections($s, $t) {
 		$sectionpair= array();
 		$sectionpair[]=$s;
 		$sectionpair[]=$t;
 		$this->othersections[]=$sectionpair;
 	}
 	function getOtherSections() {
 	
 		return	$this->othersections;
 	}
 	function setSectionorder($s) {

 		$this->sectionorder[]=$s;
 	}
	function setElementnumber($s) {

 		$this->temparray[]=$s;
 	}
 	function getSectionorder() {
 			
 		return $this->sectionorder;
 	}
	function insertSectionElement($i)
	{
		//$this->temparray[]=$i;
		//array_unshift($this->sectionorder, $this->temparray);
		//array_splice($this->sectionorder, 0, count($this->temparray),$this->temparray);
		 array_splice($this->sectionorder, $this->position, 0, $i);
		 $this->position++;
	}
 	function insertSection($s, $t) {
 		
 		//$this->sectionorder[]=$t;
 		$p=$this->sectionorder;
 		$new_ar=array();
 		$j=0;
 		if(count($p)>0)
 		{
 		for($i=0;$i<count($p);$i++)
 		{
 			
 		
 			if($p[$i]==$s)
 			{
 			
 			$new_ar[$j]=$p[$i];
 			$j++;
 			$new_ar[$j]=$t;
 			$j++;
 				
 			
 				
 			}
 			else 
 			{
 	$new_ar[$j]=$p[$i];
 			$j++;
 			}
 		}//for
 		if(count($new_ar)>0)
 		{
 			$this->sectionorder=$new_ar;
 		}
 		}//if
 		
 	}
 }
?>
