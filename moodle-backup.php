<?php
/* @copyright  Kathrin Braungardt, Ruhr-Universität Bochum
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * makes use of  PhpConcept Library - Zip Module 2.8, License GNU/LGPL - Vincent Blavet - March 2006, http://www.phpconcept.net
 * */
$charset="UTF-8";
//*****************************************************
$coursetitle=xmlencoding($coursetitle);
$courseshortname=xmlencoding($courseshortname);
if(count($arr_wikis)>0)
{
	$users="1";
}
else 
{
	$users="0";
}
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
	
	//*****************************************check
	if($allfiles>$fileslimit)
	{

		for($i=0; $i < count($arr_parentids); $i++)
	{
	$sectionsequence=$arr_parentids[$i]->getSectionorder();
	for($j=0;$j < count($sectionsequence); $j++)
	{
		
	//****************************************************
	for($k=0; $k <= $order; $k++)
	{
	if(isset($arr_allItems[$k]))
	{
		if($arr_allItems[$k]->getId()==$sectionsequence[$j])
		{
		if ($arr_allItems[$k] instanceof folder) {
                    	$folderfiles=$arr_allItems[$k]->getFiles();
	                    	if(count($folderfiles)>1)
				{
					$folderid=$arr_allItems[$k]->getId();
					$folderfiles2=$arr["$folderid"]->getFiles();
					for($m=0; $m<count($folderfiles2); $m++)
					{
						$filedes=$folderfiles2[$m]->getDescription();
						if($filedes!=="")
						{
							$fileid=$folderfiles2[$m]->getId();
							$helparray_nonfolderfiles[]=$fileid;
						}
					}
				}
				else 
				{
					$folderid=$arr_allItems[$k]->getId();
					
					/*for($m=0; $m<count($folderfiles); $m++)
					{
						$fileid=$folderfiles[$m]->getId();
						echo "Filename x" . $fileid;
						echo "<br>";
						$helparray_nonfolderfiles[]=$folderid;
					}*/
					$folderfiles2=$arr["$folderid"]->getFiles();
					for($m=0; $m<count($folderfiles2); $m++)
					{
						
					$fileid=$folderfiles2[$m]->getId();
					
							$helparray_nonfolderfiles[]=$fileid;
					}
					
					
					
				}
		}//if folder
	
		}//if ==secseq
	}//ifisset
	}//for
	}//for
	}//for
	}
	else
	{
		for($k=0; $k <= $order; $k++)
		{
		if(isset($arr_allItems[$k]))
		{
			if ($arr_allItems[$k] instanceof folder) {
		$folderid=$arr_allItems[$k]->getId();
			
		/*for($m=0; $m<count($folderfiles); $m++)
		 {
		 $fileid=$folderfiles[$m]->getId();
		 echo "Filename x" . $fileid;
		 echo "<br>";
		 $helparray_nonfolderfiles[]=$folderid;
		}*/
		$folderfiles2=$arr["$folderid"]->getFiles();
		for($m=0; $m<count($folderfiles2); $m++)
		{
		
		$fileid=$folderfiles2[$m]->getId();
			
		$helparray_nonfolderfiles[]=$fileid;
		}
		}}}
		
	}
	//***********************************************
	
	for($i=0; $i < count($arr_parentids); $i++)
	{
		$sectionsequence=$arr_parentids[$i]->getSectionorder();
		for($j=0;$j < count($sectionsequence); $j++)
		{
			
//****************************************************
				for($k=0; $k <= $order; $k++)
				{
					if(isset($arr_allItems[$k]))
					{
				if($arr_allItems[$k]->getId()==$sectionsequence[$j])
				{
					if ($arr_allItems[$k] instanceof file) {
							
						$fileid=$arr_allItems[$k]->getId();
					
						for($f=0;$f<count($helparray_nonfolderfiles); $f++)
						{
							if($helparray_nonfolderfiles[$f]==$fileid)
							{
								$filename=$arr_allItems[$k]->getTitle();
						
							
								$sectionid=$arr_allItems[$k]->getSection();
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
	
					}
                    elseif ($arr_allItems[$k] instanceof folder) {
                    	if($allfiles>$fileslimit)
                    	{
                    	$folderfiles=$arr_allItems[$k]->getFiles();
                    	if(count($folderfiles)>1)
                    	{
                        $folderid=$arr_allItems[$k]->getId();
                        $foldername=$arr_allItems[$k]->getName();
                        //$filename=xmlencoding($filename);
                  $sectionid=$arr_parentids[$i]->getId();
                   $sectionid=$sectionid+$sectionstart;
                        $xmlfile.=" <activity>
                        <moduleid>". $folderid . "</moduleid>";
                        $xmlfile.="<sectionid>" . $sectionid . "</sectionid>";
                        $xmlfile.="<modulename>folder</modulename>
                        <title>$foldername</title>
                        <directory>activities/folder_". $folderid . "</directory>
                        </activity>";
                    	}
                    	}
                    }
					elseif ($arr_allItems[$k] instanceof label)
					{
						
						$sectionid=$arr_allItems[$k]->getSection()+$sectionstart;
						$xmlfile.="<activity moduleid=\"" . $arr_allItems[$k]->getId() . "\" modulename=\"label\">
          <directory>activities/label_" . $arr_allItems[$k]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          		<title>" .  $arr_allItems[$k]->getTitle() . "</title>
          				</activity>";
					}
					elseif ($arr_allItems[$k] instanceof page)
					{
						$sectionid=$arr_allItems[$k]->getSection()+$sectionstart;
						$xmlfile.="<activity moduleid=\"" . $arr_allItems[$k]->getId() . "\" modulename=\"page\">
          <directory>activities/page_" . $arr_allItems[$k]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $arr_allItems[$k]->getTitle() . "</title>
          </activity>";
					}
					elseif ($arr_allItems[$k] instanceof quiz)
					{
						$sectionid=$arr_allItems[$k]->getSectionid()+$sectionstart;
						
		  $xmlfile.="<activity moduleid=\"" . $arr_allItems[$k]->getId() . "\" modulename=\"quiz\">
          <directory>activities/quiz_" . $arr_allItems[$k]->getId() . "</directory>
       <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $arr_allItems[$k]->getName() . "</title>
        </activity>";

					}
					elseif ($arr_allItems[$k] instanceof survey)
					{
						$sectionid=$arr_allItems[$k]->getSectionid()+$sectionstart;
						
		  $xmlfile.="<activity moduleid=\"" . $arr_allItems[$k]->getContextId() . "\" modulename=\"feedback\">
          <directory>activities/feedback_" . $arr_allItems[$k]->getId() . "</directory>
       <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $arr_allItems[$k]->getName() . "</title>
        </activity>";



					}
					elseif ($arr_allItems[$k] instanceof link)
					{
						$sectionid=$arr_allItems[$k]->getSection()+$sectionstart;
						$urltitle=$arr_allItems[$k]->getTitle();
						$urltitle=xmlencoding($urltitle);
						$xmlfile.="<activity><moduleid>" . $arr_allItems[$k]->getId() . "</moduleid>
				<sectionid>" . $sectionid . "</sectionid>
				<modulename>url</modulename>
<title>" . $urltitle  . "</title>
<directory>activities/url_" . $arr_allItems[$k]->getId() . "</directory>
</activity>";
}
				}
}//if arrallitems
}//For
//****************************************************

		}//for
	
	}//for
}//elseif
	
	//**********logfile resource
	$logfileid="12335679";
	$xmlfile.=" <activity>
          <moduleid>". $logfileid . "</moduleid>";
								$xmlfile.="<sectionid>" . $extrasection ."</sectionid>";
								$xmlfile.="<modulename>resource</modulename>
								<title>Importlog</title>
								<directory>activities/resource_". $logfileid . "</directory>
    </activity>";
	
	
	//*************************
	
//quizzes*****************************************************tests
//Pool quizzes
for($i=0; $i<count($quiz_ar); $i++)
{
	/*$sectionid=$quiz_ar[$i]->getSectionid();
	$sectionid=$sectionid+$sectionstart;
$xmlfile.="<activity moduleid=\"" . $quiz_ar[$i]->getId() . "\" modulename=\"quiz\">
          <directory>activities/quiz_" . $quiz_ar[$i]->getId() . "</directory>
          <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $quiz_ar[$i]->getName() . "</title>
        </activity>";*/


}

if(count($quiz_ar2)>0)
{
for($i=0; $i<count($quiz_ar2); $i++)
{
	/*$sectionid=$quiz_ar2[$i]->getSectionid();
	$sectionid=$sectionid+$sectionstart;
	$xmlfile.="<activity moduleid=\"" . $quiz_ar2[$i]->getId() . "\" modulename=\"quiz\">
          <directory>activities/quiz_" . $quiz_ar2[$i]->getId() . "</directory>
       <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $quiz_ar2[$i]->getName() . "</title>
        </activity>";*/

}
}
if(count($survey_ar)>0)
{
	for($i=0; $i<count($survey_ar); $i++)
	{
	/*	$sectionid=$survey_ar[$i]->getSectionid();
		$sectionid=$sectionid+$sectionstart;
		$xmlfile.="<activity moduleid=\"" . $survey_ar[$i]->getContextId() . "\" modulename=\"feedback\">
          <directory>activities/feedback_" . $survey_ar[$i]->getId() . "</directory>
       <sectionid>" . $sectionid . "</sectionid>
          <title>" .  $survey_ar[$i]->getName() . "</title>
        </activity>";*/

}
}
        //**********************************************************************
if(count($arr_wikis)>0)
 {
 for($i=0; $i<count($arr_wikis); $i++)
 {
 $sectionid=$arr_wikis[$i]->getSection()+$sectionstart;
 $xmlfile.="<activity moduleid=\"" . $arr_wikis[$i]->getId() . "\" modulename=\"wiki\">
 <directory>activities/wiki_" . $arr_wikis[$i]->getId() . "</directory>
 <sectionid>" . $sectionid . "</sectionid>
 <title>" .  $arr_wikis[$i]->getTitle() . "</title>
 </activity>";

 }
 }
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
        <value>" . $users . "</value>
      </setting>
      <setting>
        <level>root</level>
        <name>anonymize</name>
        <value>". $users . "</value>
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


           //******************************************

//******************quizzes is settings
 	 for($i=0; $i<count($quiz_ar); $i++)
{
	/*$xmlfile.="<setting>
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
      </setting>";*/

}
if(isset($quiz_ar2))
{
for($i=0; $i<count($quiz_ar2); $i++)
{
	/*$xmlfile.="<setting>
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
*/
}
}
if(isset($survey_ar))
{
for($i=0; $i<count($survey_ar); $i++)
{
/*	$xmlfile.="<setting>
        		<activity>feedback_" .  $survey_ar[$i]->getId() . "</activity>
        		<name>feedback_" .  $survey_ar[$i]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
          </setting>
          <setting>
          <activity>feedback_"  . $survey_ar[$i]->getId() . "</activity>
        <name>feedback_" .$survey_ar[$i]->getId() . "_userinfo</name>
        <value>0</value>
        <level>activity</level>
      </setting>";
*/
}
}
//pages in settings
//*********
for($i=0; $i < count($arr_parentids); $i++)
{
$sectionsequence=$arr_parentids[$i]->getSectionorder();
for($j=0;$j < count($sectionsequence); $j++)
{

//****************************************************
	for($k=0; $k <= $order; $k++)
	{
	if(isset($arr_allItems[$k]))
	{
	if($arr_allItems[$k]->getId()==$sectionsequence[$j])
	{
	if ($arr_allItems[$k] instanceof file) {
		$fileid=$arr_allItems[$k]->getId();
		for($f=0;$f<count($helparray_nonfolderfiles); $f++)
		{
		if($helparray_nonfolderfiles[$f]==$fileid)
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
        
            elseif ($arr_allItems[$k] instanceof folder) {
            	if($allfiles>$fileslimit)
            	{
            	$folderfiles=$arr_allItems[$k]->getFiles();
            	if(count($folderfiles)>1)
            	{
                $xmlfile.= "<setting>
                <level>activity</level>
                <activity>folder_" . $arr_allItems[$k]->getId() . "</activity>
                <name>folder_" . $arr_allItems[$k]->getId() . "_included</name>
                <value>1</value>
                </setting>
                <setting>
                <level>activity</level>
                <activity>folder_" . $arr_allItems[$k]->getId() . "</activity>
                <name>folder_" . $arr_allItems[$k]->getId() . "_userinfo</name>
                <value>0</value>
                </setting>";
            	}
            	}
            }
	elseif ($arr_allItems[$k] instanceof label)
	{
						$xmlfile.="<setting>
		<activity>label_" . $arr_allItems[$k]->getId() . "</activity>
				<name>label_" .  $arr_allItems[$k]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
						</setting>
						<setting>
						<activity>label_"  . $arr_allItems[$k]->getId() . "</activity>
						<name>label_" .$arr_allItems[$k]->getId() . "_userinfo</name>
        <value>0</value>
        <level>activity</level>
      </setting>";
						}
					elseif ($arr_allItems[$k] instanceof page)
					{
					
					$xmlfile.="<setting>
	<activity>page_" .  $arr_allItems[$k]->getId() . "</activity>
			<name>page_" .  $arr_allItems[$k]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
        </setting>
        <setting>
        <activity>page_"  . $arr_allItems[$k]->getId() . "</activity>
        <name>page_" .$arr_allItems[$k]->getId() . "_userinfo</name>
        <value>0</value>
        <level>activity</level>
        </setting>";
						}
						elseif ($arr_allItems[$k] instanceof quiz)
					{
					
					$xmlfile.="<setting>
	<activity>quiz_" .  $arr_allItems[$k]->getId() . "</activity>
			<name>quiz_" .  $arr_allItems[$k]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
        </setting>
        <setting>
        <activity>quiz_"  . $arr_allItems[$k]->getId() . "</activity>
        <name>quiz_" .$arr_allItems[$k]->getId() . "_userinfo</name>
        <value>0</value>
        <level>activity</level>
        </setting>";
						}
						elseif ($arr_allItems[$k] instanceof survey)
					{
					
					$xmlfile.="<setting>
	<activity>feedback_" .  $arr_allItems[$k]->getId() . "</activity>
			<name>feedback_" .  $arr_allItems[$k]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
        </setting>
        <setting>
        <activity>feedback_"  . $arr_allItems[$k]->getId() . "</activity>
        <name>feedback_" .$arr_allItems[$k]->getId() . "_userinfo</name>
        <value>0</value>
        <level>activity</level>
        </setting>";
						}
						elseif ($arr_allItems[$k] instanceof link)
						{
						$xmlfile.="<setting>
						<activity>url_" .  $arr_allItems[$k]->getId() . "</activity>
						<name>url_" .  $arr_allItems[$k]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
						</setting>
						<setting>
						<activity>url_"  . $arr_allItems[$k]->getId() . "</activity>
						<name>url_" . $arr_allItems[$k]->getId() . "_userinfo</name>
						<value>0</value>
								<level>activity</level>
      </setting>";
						}
						}
}//if arrallitems
}//For
//****************************************************

	}//for

	}//for

//**********************************************************

			//*************************************************************
			for($i=0; $i<count($arr_wikis); $i++)
			{
			
				$xmlfile.="<setting>
	<activity>wiki_" .  $arr_wikis[$i]->getId() . "</activity>
			<name>wiki_" .  $arr_wikis[$i]->getId() . "_included</name>
        <value>1</value>
        <level>activity</level>
        </setting>
        <setting>
        <activity>wiki_"  . $arr_wikis[$i]->getId() . "</activity>
        <name>wiki_" .$arr_wikis[$i]->getId() . "_userinfo</name>
        <value>1</value>
        <level>activity</level>
        </setting>";
			
			}
			//************************************************************
			//logfile settings*****************************************
			$xmlfile.= "<setting>
        <level>activity</level>
        <activity>resource_" . $logfileid . "</activity>
        <name>resource_" . $logfileid . "_included</name>
        <value>1</value>
      </setting>
      <setting>
        <level>activity</level>
        <activity>resource_" . $logfileid . "</activity>
          <name>resource_" . $logfileid . "_userinfo</name>
          <value>0</value>
          </setting>";
			
			
			//**************************************************************
			$xmlfile.=" </settings>";
    $xmlfile.="</information>\n";
         $xmlfile.="</moodle_backup>\n";

  $file = fopen($direxport . "/moodle_backup.xml","w");//directory
 fwrite($file,$xmlfile);
fclose($file);
//****************************************************************************
?>