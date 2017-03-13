<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$charset="UTF-8";
//*****************************************************
$coursetitle=xmlencoding($coursetitle);
$courseshortname=xmlencoding($courseshortname);
//******************************moodle-backup.xml
$xmlfile='<?xml version="1.0" encoding="'.$charset.'"?>'."\n";
$xmlfile.="<moodle_backup>\n";
$xmlfile.="<information>\n";
$xmlfile.="<name>" . $d . "</name>\n";
$xmlfile.="<moodle_version>". $moodleversion ." </moodle_version>\n";
$xmlfile.="<moodle_release>" . $moodlerelease . "</moodle_release>\n";
$xmlfile.="<backup_version>" . $backupversion . "</backup_version>\n";
$xmlfile.="<backup_release>" . $backuprelease . "</backup_release>\n";
$xmlfile.="<backup_date>" . $backupdate . "</backup_date>\n";
$xmlfile.="<mnet_remoteusers>0</mnet_remoteusers>\n";
$xmlfile.="<include_files>1</include_files>\n";
 
$xmlfile .="<include_file_references_to_external_content>0</include_file_references_to_external_content><original_wwwroot>" . $original_wwwroot . "</original_wwwroot>" .
		"<original_site_identifier_hash>" . $original_site_identifier_hash . "</original_site_identifier_hash>
    <original_course_id>" . $original_course_id . "</original_course_id>
    <original_course_fullname>". $coursetitle . "</original_course_fullname>
    <original_course_shortname>" . $courseshortname . "</original_course_shortname>
    <original_course_startdate>" . $aktuellesdatum . "</original_course_startdate>
    <original_course_contextid>" . $original_course_contextid . "</original_course_contextid>
    <original_system_contextid>" . $original_system_contextid . "</original_system_contextid>
    <details>
      <detail backup_id='" . $detail_backup_id . "'>
        <type>course</type>
        <format>moodle2</format>
        <interactive>1</interactive>
        <mode>10</mode>
        <execution>1</execution>
        <executiontime>0</executiontime>
      </detail>
    </details>";
//******************contents
$xmlfile.="<contents>
      <activities>";

if($modus=="onefolder")
{
	//**********************************folder in activities schreiben
	//only main folder
	
	
	//***************************folder*************************************
$xmlfile.="<activity>
	 <moduleid>1</moduleid>
	 <sectionid>1</sectionid>
	 <modulename>folder</modulename>
	 <title>Verzeichnis</title>
	 <directory>activities/folder_1</directory>
	 </activity>";
	
	
}
elseif($modus=="multiplefolders") 
{
	for($i=0; $i < count($arr_folder_simple); $i++)
	{
		
		$folderid=$arr_folder_simple[$i]->getId();//????
		$foldername=$arr_folder_simple[$i]->getName();
	
		$folderfiles=$arr_folder_simple[$i]->getFiles();
		$section=checkParentid($folderid, $arr_parentids, $arr);
		$sectionid=$section+$sectionstart;
		//***************************folder*************************************
	if (count($folderfiles)>1)
	{
		

			$xmlfile.="<activity>
          <moduleid>" . $folderid ."</moduleid>
          <sectionid>" . $sectionid ."</sectionid>
          <modulename>folder</modulename>
          <title>" . $foldername . "</title>
          <directory>activities/folder_" . $folderid . "</directory>
        </activity>";
		
	}//ende folderfiles
	else 
	{
		for($b=0; $b < count($folderfiles); $b++)
		{
			
		$fileid=$folderfiles[$b]->getId();
		$helparray_nonfolderfiles[]=$fileid;
		$filename=$folderfiles[$b]->getTitle();
		//$filename=xmlencoding($filename);
			
		$sectionid=$folderfiles[$b]->getSection();
		$sectionid=$sectionid+$sectionstart;
		$xmlfile.=" <activity>
          <moduleid>". $fileid . "</moduleid>";
		$xmlfile.="<sectionid>" . $sectionid . "</sectionid>";
		$xmlfile.="<modulename>resource</modulename>
		<title>$filename</title>
		<directory>activities/resource_". $fileid . "</directory>
    </activity>";
		}
	
	}
	}//for count arr_folder_simple
	
	for($i=0; $i <= count($arr_allItems); $i++)
	{
	if ($arr_allItems[$i] instanceof label)
	{
		$sectionid=$arr_allItems[$i]->getSection()+$sectionstart;
		$xmlfile.="<activity moduleid=\"" . $arr_allItems[$i]->getId() . "\" modulename=\"label\">
          <directory>activities/label_" . $arr_allItems[$i]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          		<title>" .  $arr_allItems[$i]->getTitle() . "</title>
          				</activity>";
	}
	elseif ($arr_allItems[$i] instanceof page)
	{
		$sectionid=$arr_allItems[$i]->getSection()+$sectionstart;
		$xmlfile.="<activity moduleid=\"" . $arr_allItems[$i]->getId() . "\" modulename=\"page\">
          <directory>activities/page_" . $arr_allItems[$i]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $arr_allItems[$i]->getTitle() . "</title>
          </activity>";
	}
	elseif ($arr_allItems[$i] instanceof link)
	{
		$sectionid=$arr_allItems[$i]->getSection()+$sectionstart;
		$urltitle=$arr_allItems[$i]->getTitle();
		$urltitle=xmlencoding($urltitle);
		$xmlfile.="<activity><moduleid>" . $arr_allItems[$i]->getId() . "</moduleid>
				<sectionid>" . $sectionid . "</sectionid>
				<modulename>url</modulename>
<title>" . $urltitle  . "</title>
<directory>activities/url_" . $arr_allItems[$i]->getId() . "</directory>
</activity>";
	}
	}
	
}
else 
{
	for($i=0; $i <= count($arr_allItems); $i++)
	{
		if ($arr_allItems[$i] instanceof file) {
			
			$fileid=$arr_allItems[$i]->getId();
			$filename=$arr_allItems[$i]->getTitle();
			//$filename=xmlencoding($filename);
			
			$sectionid=$arr_allItems[$i]->getSection();
			$sectionid=$sectionid+$sectionstart;
			$xmlfile.=" <activity>
          <moduleid>". $fileid . "</moduleid>";
			$xmlfile.="<sectionid>" . $sectionid . "</sectionid>";
			$xmlfile.="<modulename>resource</modulename>
			<title>$filename</title>
			<directory>activities/resource_". $fileid . "</directory>
    </activity>";
		}
		elseif ($arr_allItems[$i] instanceof label)
		{
			$sectionid=$arr_allItems[$i]->getSection()+$sectionstart;
			$xmlfile.="<activity moduleid=\"" . $arr_allItems[$i]->getId() . "\" modulename=\"label\">
          <directory>activities/label_" . $arr_allItems[$i]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          		<title>" .  $arr_allItems[$i]->getTitle() . "</title>
          				</activity>";
		}
		elseif ($arr_allItems[$i] instanceof page)
		{
			$sectionid=$arr_allItems[$i]->getSection()+$sectionstart;
			$xmlfile.="<activity moduleid=\"" . $arr_allItems[$i]->getId() . "\" modulename=\"page\">
          <directory>activities/page_" . $arr_allItems[$i]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $arr_allItems[$i]->getTitle() . "</title>
          </activity>";
		}
		elseif ($arr_allItems[$i] instanceof link)
		{
			$sectionid=$arr_allItems[$i]->getSection()+$sectionstart;
			$urltitle=$arr_allItems[$i]->getTitle();
			$urltitle=xmlencoding($urltitle);
			$xmlfile.="<activity><moduleid>" . $arr_allItems[$i]->getId() . "</moduleid>
				<sectionid>" . $sectionid . "</sectionid>
				<modulename>url</modulename>
<title>" . $urltitle  . "</title>
<directory>activities/url_" . $arr_allItems[$i]->getId() . "</directory>
</activity>";
		}
	}
	
	
}
			
			//******************************************************************labels
			/*if(count($arr_labels)>0)
			{
				for($i=0; $i<count($arr_labels); $i++)
				{
				$sectionid=$arr_labels[$i]->getSection()+$sectionstart;
				$xmlfile.="<activity moduleid=\"" . $arr_labels[$i]->getId() . "\" modulename=\"label\">
          <directory>activities/label_" . $arr_labels[$i]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          		<title>" .  $arr_labels[$i]->getTitle() . "</title>
          				</activity>";

}
}*/
//******************************************************************************
//quizzes*****************************************************tests

for($i=0; $i<count($quiz_ar); $i++)
{
	$sectionid=$quiz_ar[$i]->getSectionid();
	$sectionid=$sectionid+$sectionstart;
$xmlfile.="<activity moduleid=\"" . $quiz_ar[$i]->getId() . "\" modulename=\"quiz\">
          <directory>activities/quiz_" . $quiz_ar[$i]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $quiz_ar[$i]->getName() . "</title>
        </activity>";


}

if(count($quiz_ar2)>0)
{
for($i=0; $i<count($quiz_ar2); $i++)
{
	$sectionid=$quiz_ar2[$i]->getSectionid();
	$sectionid=$sectionid+$sectionstart;
	$xmlfile.="<activity moduleid=\"" . $quiz_ar2[$i]->getId() . "\" modulename=\"quiz\">
          <directory>activities/quiz_" . $quiz_ar2[$i]->getId() . "</directory>
       <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $quiz_ar2[$i]->getName() . "</title>
        </activity>";

}
}
//******************************************************************pages
/*if(count($arr_pages)>0)
			{
			for($i=0; $i<count($arr_pages); $i++)
			{
			$sectionid=$arr_pages[$i]->getSection()+$sectionstart;
			$xmlfile.="<activity moduleid=\"" . $arr_pages[$i]->getId() . "\" modulename=\"page\">
          <directory>activities/page_" . $arr_pages[$i]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $arr_pages[$i]->getTitle() . "</title>
          </activity>";

}
        }*/
//****************************************************************links
			/*if(count($arr_links)>0)
			{
			for($i=0; $i<count($arr_links); $i++)
				{
				$sectionid=$arr_links[$i]->getSection()+$sectionstart;
				$urltitle=$arr_links[$i]->getTitle();
				$urltitle=xmlencoding($urltitle);
				$xmlfile.="<activity><moduleid>" . $arr_links[$i]->getId() . "</moduleid>
				<sectionid>" . $sectionid . "</sectionid>
				<modulename>url</modulename>
<title>" . $urltitle  . "</title>
<directory>activities/url_" . $arr_links[$i]->getId() . "</directory>
</activity>";
}
        }*/
        //**********************************************************************
         
        $xmlfile.="</activities>";
        //***************************Sections*************************************
        $xmlfile.="<sections>";
         
        for($i=0; $i < count($arr_parentids); $i++)
        {
        $sectionid=$arr_parentids[$i]->getId();
    
        $sectionid=$sectionid+$sectionstart;
        $sectionname=$arr_parentids[$i]->getName();
     
        $sectionname=xmlencoding($sectionname);

        $xmlfile.=" <section>
          <sectionid>" . $sectionid  . "</sectionid>
          <title>" . $sectionname . "</title>
          <directory>sections/section_" . $sectionid . "</directory>
        </section>";
	}
          		$xmlfile.=" </sections>
          		<course>
          		<courseid>" . $original_course_id .  "</courseid>
          		<title>$coursetitle</title>
        <directory>course</directory>
        </course>
    </contents>";
    //******************************settings
       $xmlfile.="<settings>
      <setting>
        <level>root</level>
        <name>filename</name>
        <value>" . $d . "</value>
      </setting>
      <setting>
        <level>root</level>
        <name>imscc11</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>users</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>anonymize</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>role_assignments</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>activities</name>
        <value>1</value>
      </setting>
      <setting>
        <level>root</level>
        <name>blocks</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>filters</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>comments</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>badges</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>calendarevents</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>userscompletion</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>logs</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>grade_histories</name>
        <value>0</value>
      </setting>
      <setting>
        <level>root</level>
        <name>questionbank</name>
        <value>0</value>
      </setting>";
        	 
        	for($i=0; $i < count($arr_parentids); $i++)
        	{
        	$sectionid=$arr_parentids[$i]->getId();
        	$sectiontitle=$arr_parentids[$i]->getName();
		
			$sectiontitle=xmlencoding($sectiontitle);
		$sectionid=$sectionid+$sectionstart;

			$xmlfile.=" <setting>
			<level>section</level>
          <section>section_" . $sectionid  . "</section>
          <title>" . $sectiontitle . "</title>
           <name>section_" . $sectionid . "_included</name>
          		<value>1</value>
        </setting>
          				<setting>
          				<level>section</level>
          						<section>section_" . $sectionid  . "</section>
          <title>" . $sectiontitle . " </title>
          <name>section_" . $sectionid . "_userinfo</name>
          <value>0</value>
          </setting>";
          }
          if($modus=="onefolder")
          {
          	//**********************************folder in settings schreiben
        
          	 $xmlfile.= "<setting>
          	 <level>activity</level>
          	 <activity>folder_1</activity>
          	 <name>folder_1_included</name>
          	 <value>1</value>
          	 </setting>
          	
          	 <setting>
          	 <level>activity</level>
          	 <activity>folder_1</activity>
          	 <name>folder_1_userinfo</name>
          	 <value>0</value>
          	 </setting>";

          }
          elseif($modus=="multiplefolders")
          {
          	//**********************************folder in settings schreiben
          	for($i=0; $i < count($arr_folder_simple); $i++)
          	{
          	
          		$folderid=$arr_folder_simple[$i]->getId();
          		$foldername=$arr_folder_simple[$i]->getName();
          		$folderfiles=$arr_folder_simple[$i]->getFiles();
          		$section=checkParentid($folderid, $arr_parentids, $arr);
          		$sectionid=$section+$sectionstart;
          		if (count($folderfiles)>1)
          		{
          		 $xmlfile.= "<setting>
        <level>activity</level>
        <activity>folder_" . $folderid . "</activity>
        <name>folder_" . $folderid . "_included</name>
        <value>1</value>
      </setting>
          	
      <setting>
        <level>activity</level>
    <activity>folder_" . $folderid . "</activity>
        <name>folder_" . $folderid . "_userinfo</name>
        <value>0</value>
      </setting>";
          		}
          		else 
          		{
          			for($b=0; $b < count($folderfiles); $b++)
          			{
          			$fileid=$folderfiles[$b]->getId();
          			if(isset($fileid) && $fileid!="")
          			{
          			$xmlfile.= "<setting>
          			<level>activity</level>
          				<activity>resource_" . $fileid . "</activity>
        <name>resource_" . $fileid . "_included</name>
          			        <value>1</value>
      </setting>
          			      <setting>
        <level>activity</level>
        <activity>resource_" . $fileid . "</activity>
          <name>resource_" . $fileid . "_userinfo</name>
          			          <value>0</value>
          </setting>";
          			}
          			}
          		}
          			
          	}
          }
          else 
          {
          	for($i=0; $i < count($arr_files); $i++)
          	{
          		$fileid=$arr_files[$i]->getId();
          		if(isset($fileid) && $fileid!="")
          		{
          			$xmlfile.= "<setting>
        <level>activity</level>
        <activity>resource_" . $fileid . "</activity>
        <name>resource_" . $fileid . "_included</name>
        <value>1</value>
      </setting>
      <setting>
        <level>activity</level>
        <activity>resource_" . $fileid . "</activity>
          <name>resource_" . $fileid . "_userinfo</name>
          <value>0</value>
          </setting>";
          		}
          	}
          }

           //******************************************

//******************quizzes is settings
 	 for($i=0; $i<count($quiz_ar); $i++)
{
	$xmlfile.="<setting>
        		<activity>quiz_" .  $quiz_ar[$i]->getId() . "</activity>
        		<name>quiz_" .  $quiz_ar[$i]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
          </setting>
          <setting>
          <activity>quiz_"  . $quiz_ar[$i]->getId() . "</activity>
        <name>quiz_" .$quiz_ar[$i]->getId() . "_userinfo</name>
        <value>0</value>
        <level>activity</level>
      </setting>";

}

for($i=0; $i<count($quiz_ar2); $i++)
{
	$xmlfile.="<setting>
        		<activity>quiz_" .  $quiz_ar2[$i]->getId() . "</activity>
        		<name>quiz_" .  $quiz_ar2[$i]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
          </setting>
          <setting>
          <activity>quiz_"  . $quiz_ar2[$i]->getId() . "</activity>
        <name>quiz_" .$quiz_ar2[$i]->getId() . "_userinfo</name>
        <value>0</value>
        <level>activity</level>
      </setting>";

}
//pages in settings
//*********
for($i=0; $i<count($arr_pages); $i++)
{
	
	$xmlfile.="<setting>
	<activity>page_" .  $arr_pages[$i]->getId() . "</activity>
			<name>page_" .  $arr_pages[$i]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
        </setting>
        <setting>
        <activity>page_"  . $arr_pages[$i]->getId() . "</activity>
        <name>page_" .$arr_pages[$i]->getId() . "_userinfo</name>
        <value>0</value>
        <level>activity</level>
        </setting>";

        }
//labels in settings****************************************
 for($i=0; $i<count($arr_labels); $i++)
{
	$xmlfile.="<setting>
		<activity>label_" .  $arr_labels[$i]->getId() . "</activity>
				<name>label_" .  $arr_labels[$i]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
						</setting>
						<setting>
						<activity>label_"  . $arr_labels[$i]->getId() . "</activity>
						<name>label_" .$arr_labels[$i]->getId() . "_userinfo</name>
        <value>0</value>
        <level>activity</level>
      </setting>";

						}

						//**********************************************************
//links in settings

for($i=0; $i<count($arr_links); $i++)
{
	$xmlfile.="<setting>
						<activity>url_" .  $arr_links[$i]->getId() . "</activity>
						<name>url_" .  $arr_links[$i]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
						</setting>
						<setting>
						<activity>url_"  . $arr_links[$i]->getId() . "</activity>
						<name>url_" . $arr_links[$i]->getId() . "_userinfo</name>
						<value>0</value>
								<level>activity</level>
      </setting>";

			}
			//*************************************************************
			//************************************************************
			$xmlfile.=" </settings>";
    $xmlfile.="</information>\n";
         $xmlfile.="</moodle_backup>\n";

  $file = fopen($direxport . "/moodle_backup.xml","w");//directory
 fwrite($file,$xmlfile);
fclose($file);
//****************************************************************************
?>