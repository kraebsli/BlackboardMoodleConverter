<?php
if(count($arr_labels)>0)
{
	 for($i=0; $i<count($arr_labels); $i++)
{

$labelid=$arr_labels[$i]->getId();
$labelparentid=$arr_labels[$i]->getParentid();
$labeltitle=$arr_labels[$i]->getTitle();
$labeltext=$arr_labels[$i]->getText();
$section=$arr_labels[$i]->getSection();
$section=$section+$sectionstart;
$labelpfad=$direxport . "/activities/label_" . $labelid;
$labelfiles=$arr_labels[$i]->getAr();
if(is_dir($labelpfad))
{
	
}
else 
{
mkdir($labelpfad, 0700);
}
$pfad3= $labelpfad . "/grades.xml";//grades
copy("activities_src/grades.xml", $pfad3);
$pfad4= $labelpfad . "/roles.xml";//roles
copy("activities_src/roles.xml", $pfad4);
$pfad5= $labelpfad . "/inforef.xml";//inforef
copy("activities_src/inforef.xml", $pfad5);

//********************************************************
//**********************************************module.xml
$xmlfile17='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile17.="<module id=\"" . $labelid . "\" version=\"" . $labelmoduleversion . "\">
  <modulename>label</modulename>
  <sectionid>" . $section . "</sectionid>
  <sectionnumber>" .  $section . "</sectionnumber>
  <idnumber></idnumber>
  <added>0</added>
  <score>0</score>
  <indent>0</indent>
  <visible>1</visible>
  <visibleold>1</visibleold>
  <groupmode>1</groupmode>
  <groupingid>0</groupingid>
  <groupmembersonly>0</groupmembersonly>
  <completion>0</completion>
  <completiongradeitemnumber>$@NULL@$</completiongradeitemnumber>
  <completionview>0</completionview>
  <completionexpected>0</completionexpected>
  <availablefrom>0</availablefrom>
  <availableuntil>0</availableuntil>
  <showavailability>1</showavailability>
  <showdescription>0</showdescription>
  <availability_info>
  </availability_info>
</module>";
$file17 = fopen($labelpfad . "/module.xml","w");
fwrite($file17,$xmlfile17);
fclose($file17);
//*************************************************label.xml
$xmlfile18='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile18.="<activity id=\"" . $labelid . "\" moduleid=\"" . $labelid . "\" modulename=\"label\" contextid=\"" . $labelparentid . "\">
<label id=\"" . $labelid . "\">
<name>". $labeltitle . "</name>
<intro>" . $labeltext . "</intro>
<introformat>1</introformat>
<timemodified>0</timemodified>
</label>
</activity>";
$file18 = fopen($labelpfad . "/label.xml","w");
fwrite($file18,$xmlfile18);
fclose($file18);
//***********************************************************
//**********************************************inforef.xml
$xmlfile19='<?xml version="1.0" encoding="'.$charset.'"?>'."\n"; 
$xmlfile19.="<inforef>";
if(count($labelfiles)>0)
{

  $xmlfile19.="<fileref>";
for ($b=0; $b < count($labelfiles); $b++)
{
	
	$fileid=$labelfiles[$b]->getId();
   $xmlfile19.="<file>";
     $xmlfile19.=" <id>" . $fileid . "</id>";
    $xmlfile19.="</file>";
}
      $xmlfile19.="</fileref>";
}

 $xmlfile19.="</inforef>";
$file19 = fopen($labelpfad . "/inforef.xml","w");
fwrite($file19,$xmlfile19);
fclose($file19);
//**************************************************
}
}//ende 
?>