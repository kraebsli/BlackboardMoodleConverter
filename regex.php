<?php

function lueckentextfrage($string)
{
//$test="<p>Was obst[obst] und ws gemüse [gemüse] sdf</p>";
$suchmuster="/\[.+\]/U";
//$ersetzung="{#" . $n++ . "}";

$moodlefrage= preg_replace_callback(
$suchmuster, 
function($n) {
	static $t=0;
	$t++;
	$ersetzung="{#" . $t . "}";
	return $ersetzung; 
},
$string);
return $moodlefrage;
}
function internerlink2($t)
{
	
	//***************************suchmuster interne links
	$suchmuster_internelinks='/<a href=\".*EmbeddedFile.*\">(.*)<\/a>/';
	$neuertext=preg_replace($suchmuster_internelinks, 'eingebettete Datei', $t);
	//echo "treffer: " .  htmlentities($neuertext);
	//echo "<br>";
	
	return $neuertext;
}
function internerlink($t, $pid, $res, $s, $dir)
{
	
	$replaced=$t;
	$bildobjekt= array();

	//**************************************************
	$suchmuster='/<a href=\".*EmbeddedFile.*\">(.*)<\/a>/U';

	preg_match_all($suchmuster, $t, $treffer);
	
	//******************************************************
	for ($i=0; $i<count($treffer[0]); $i++)
	{
		
	
	//$bilddaten= array();
	$fname= array();
	//*******************************
	
			//****************************xid
			$suchmuster_xid='/xid-\d+/';
					$xid=preg_match($suchmuster_xid, $treffer[0][$i], $treffer4);
					if(count($treffer4)>0 )
					{
						
					$xid_bild=$treffer4[0] . "_1";
			
							//$bilddaten[2]=$xid_bild;
							$fname=VerzeichnisDurchsuchen3($dir, $xid_bild);
						
	
					}
					else
					{
						$treffer4=array();
					}
					//***************************************************
					$suchmuster_xid2='/EmbeddedFile\.location@X@[a-zA-Z0-9.]+/';
					$xid2=preg_match($suchmuster_xid2, $treffer[0][$i], $treffer5);
					if(count($treffer5)>0 )
					{

						$treffer5temp=explode("@X@", $treffer5[0]);
						$xid_bild=trim($treffer5temp[1], '"');
					
						//$bilddaten[2]=$xid_bild;
						$fname=VerzeichnisDurchsuchen3($dir, $xid_bild);
	
					}
					else
					{
						$treffer5=array();
					}
					//********************************************
					if(count($treffer4)>0 or count($treffer5)>0)
					{
	
	
						//$bilddaten[3]=$fname[1];
						//***********************************************************
					/*	$oldname=$fname[0];
	
	
						$temppath=$dir . "/temp/";
						$newname= $temppath . $fname[1];
	
						if(is_dir($temppath)){
								
							copy($oldname, $newname);
						}
						//******************************************************Kopieren in HASH-Ordner
						$filesize    = filesize($newname);
						$contenthash = sha1_file($newname);
						$hashpath    = substr($contenthash, 0, 2);
						$hashfilepath=$direxport . "/files/" .$hashpath;
						mkdir($hashfilepath, 0700);
						$hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
						copy($newname, $hashfilepath_mit_file);
	
						//**************************************************************
						$identifier=$fname[1];
						$identifier_hash=hash('md5',$identifier);
						$identifier_hash = preg_replace('![^0-9]!', '', $identifier_hash);
						$identifier_hash=substr($identifier_hash, 0, 7);//questionid
						$identifier_hash=ltrim($identifier_hash, "0");
						//******************************************************
						 */
		
					$identifier=$fname[1];
					$identifier_hash=hash('md5',$identifier);
					$identifier_hash = preg_replace('/[^0-9]/','',$identifier_hash);
					$identifier_hash=str_replace("0","",$identifier_hash);
					$identifier_hash=substr($identifier_hash,0,7);
					
					// $fileitem= new file ($filename, $fileid,$filename2, $title, $resident, $parentid, $section);
							$fileitem= new file($fname[1], $identifier_hash,$xid_bild,$fname[1], $res, $pid, $s);
							
							$arr_files[]=$fileitem;
							

	
						//******************************************************************
						//$pattern="`".$treffer[$i] . "`";
	
						
						//$replaced=preg_replace('#\##', "x", $bild);
						//hier suchmuster2=$suchmuster='/<img[^>]+>/i'; notwendig, wegen mehrerer Bilder //treffer[$i]
						//echo $replaced;
						//echo "<br>";
						//echo "<br>";
						//echo $treffer[0][$i];
			
						//$dateiname=preg_split("/<.*>/",$treffer[0][$i] );
						
						$replaced=str_replace($treffer[0][$i], $fname[1], $replaced);
						//echo $i . ": " . $treffer[0][$i];
				
						$bilddaten[3]=$replaced;
	
					}//ende if
					//if(count($treffer4)>0 or count($treffer5)>0)
					//$bildobjekt[0]=$bilddaten;
					$bildobjekt[1]=$replaced;
					
						$bildobjekt[3]= $arr_files;
				
	}//ende for count treffer
	
	return $bildobjekt;
}
function bild($bild, $dir, $pid, $res, $direxport, $mod_label)
{

$replaced=$bild;
	$bildobjekt= array();
	//echo htmlentities($bild);
	//echo "<br><br>";
	//**************************************************
	$suchmuster='/<img[^>]+>/i';
	
	preg_match_all($suchmuster, $bild, $treffer);
	
	//******************************************************
	for ($i=0; $i<count($treffer[0]); $i++)
	{

	$bilddaten= array();
	$fname= array();
	$width_bild="";
	$height_bild="";
	//*******************width
	$suchmuster_width='/width="\d+/';
		$width=preg_match($suchmuster_width, $treffer[0][$i], $treffer2);
		if(isset($treffer2[0]))
		{
		$width2=explode('"', $treffer2[0]);
		$width_bild= $width2[1];
		$bilddaten[0]=$width_bild;
		}
		else 
		{
			$bilddaten[0]="";
		}
		//**************************
		//***************height
		$suchmuster_height='/height="\d+/';
		$height=preg_match($suchmuster_height, $treffer[0][$i], $treffer3);
		if(isset($treffer3[0]))
		{
		$height2=explode('"', $treffer3[0]);
		$height_bild= $height2[1];
		$bilddaten[1]=$height_bild;
		}
		else 
		{
			$bilddaten[1]="";
		}

		//****************************xid
			$suchmuster_xid='/xid-\d+/';
				$xid=preg_match($suchmuster_xid, $treffer[0][$i], $treffer4);
				if(count($treffer4)>0 )
		{
				$xid_bild=$treffer4[0] . "_1";
		$bilddaten[2]=$xid_bild;
		$fname=VerzeichnisDurchsuchen3($dir, $xid_bild);
		
		}
		else 
		{
			$treffer4=array();
		}
				//***************************************************
			$suchmuster_xid2='/EmbeddedFile\.location@X@[a-zA-Z0-9.]+/';
$xid2=preg_match($suchmuster_xid2, $treffer[$i], $treffer5);
	if(count($treffer5)>0 )
		{

			$treffer5temp=explode("@X@", $treffer5[0]);
$xid_bild=trim($treffer5temp[1], '"');
				
		$bilddaten[2]=$xid_bild;
		$fname=VerzeichnisDurchsuchen3($dir, $xid_bild);
		
		}
		else 
		{
			$treffer5=array();
		}
						//********************************************
		if(count($treffer4)>0 or count($treffer5)>0)
		{
		
				
$bilddaten[3]=$fname[1];
	//***********************************************************
	$oldname=$fname[0];
	

	$temppath=$dir . "/temp/";
	$newname= $temppath . $fname[1];
	
	if(is_dir($temppath)){
			
	copy($oldname, $newname);
	}
	//******************************************************Kopieren in HASH-Ordner
        $filesize    = filesize($newname);
        $contenthash = sha1_file($newname);
        $hashpath    = substr($contenthash, 0, 2);
        $hashfilepath=$direxport . "/files/" .$hashpath; 
        mkdir($hashfilepath, 0700);
        $hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
        copy($newname, $hashfilepath_mit_file);
				
				//**************************************************************
				$identifier=$fname[1];
				$identifier_hash=hash('md5',$identifier);
				$identifier_hash = preg_replace('![^0-9]!', '', $identifier_hash); 
				$identifier_hash=substr($identifier_hash, 0, 7);//questionid
				$identifier_hash=ltrim($identifier_hash, "0");
        //******************************************************
       
        if($mod_label==false){
	$fileitem= new fileembedded ($fname[1], $identifier_hash,$fname[0], $res, $pid, $contenthash, $filesize);
	$arr_files_embedded[]=$fileitem;
        }
        else 
        {
        	
        $fileitem= new fileembedded ($fname[1], $identifier_hash,$fname[0], $res, $pid, $contenthash, $filesize);
        $arr_files_embedded_label[]=$fileitem;
        }



//******************************************************************
	//$pattern="`".$treffer[$i] . "`";
	
	if($width_bild!=="" && $width_height!=="")
	{
	$replacement="img src=\"@@PLUGINFILE@@/" . $fname[1] . "\" width=\"" . $width_bild . "\" height=\"" . $height_bild . "\" class=\"img-responsive\"";
	}
	else 
	{
				$replacement="img src=\"@@PLUGINFILE@@/" . $fname[1] .  "\" class=\"img-responsive\" /";
	
	}
	//$replaced=preg_replace('#\##', "x", $bild);
	//hier suchmuster2=$suchmuster='/<img[^>]+>/i'; notwendig, wegen mehrerer Bilder //treffer[$i]

	$replaced=preg_replace($treffer[0][$i], $replacement, $replaced);

	$bilddaten[3]=$replaced;
	
		}//ende if
		//if(count($treffer4)>0 or count($treffer5)>0)
		$bildobjekt[0]=$bilddaten;
		$bildobjekt[1]=$replaced;
		if($mod_label==false){
		$bildobjekt[3]=$arr_files_embedded;
		}
		else
		{
			$bildobjekt[3]=$arr_files_embedded_label;
		}
	}//ende for count treffer
	
	return $bildobjekt;
}
//***************************************************
function bild2($bild, $dir, $pid, $res, $direxport, $ct, $fa)//für fragen wird die contextid gebraucht
{

	//fa ist filearea, bei quizzes answer und question
	$replaced=$bild;
	$bildobjekt= array();
	//echo htmlentities($bild);
	//echo "<br><br>";
//**************************************************
	$suchmuster='/<img[^>]+>/i';
	preg_match($suchmuster, $bild, $treffer);
	for ($i=0; $i<count($treffer); $i++)
	{
		
		$bilddaten= array();
				$fname= array();
	//echo htmlentities($treffer[$i]);
	$width_bild="";
	$height_bild="";
	//*******************width
	$suchmuster_width='/width="\d+/';
		$width=preg_match($suchmuster_width, $treffer[$i], $treffer2);
		$width2=explode('"', $treffer2[0]);
		$width_bild= $width2[1];
	
		$bilddaten[0]=$width_bild;
		//**************************
		//***************height
		$suchmuster_height='/height="\d+/';
		$height=preg_match($suchmuster_height, $treffer[$i], $treffer3);
		$height2=explode('"', $treffer3[0]);
		$height_bild= $height2[1];
		//echo "<br>";
		//echo $height_bild;
		$bilddaten[1]=$height_bild;
		//****************************xid
			$suchmuster_xid='/xid-\d+/';
		$xid=preg_match($suchmuster_xid, $treffer[$i], $treffer4);
		//echo "<br>";
		//echo $treffer4[0];
		//********************************************
		if(isset($treffer4[0]) && $treffer4[0]!=="")
		{
		$xid_bild=$treffer4[0] . "_1";
	
		$bilddaten[2]=$xid_bild;
		$fname=VerzeichnisDurchsuchen3($dir, $xid_bild);
		
$bilddaten[3]=$fname[1];

	
	//***********************************************************
	$oldname=$fname[0];
	

	$temppath=$dir . "/temp/";
	$newname= $temppath . $fname[1];
	
	if(is_dir($temppath)){
			
	copy($oldname, $newname);
	}
	//******************************************************Kopieren in HASH-Ordner
        $filesize    = filesize($newname);
        $contenthash = sha1_file($newname);
        	
        $hashpath    = substr($contenthash, 0, 2);
        
        $hashfilepath=$direxport . "/files/" .$hashpath; 
        mkdir($hashfilepath, 0700);
        $hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
        copy($newname, $hashfilepath_mit_file);
				
				//**************************************************************
					$identifier=$fname[1];
				$identifier_hash=hash('md5',$identifier);
				$identifier_hash = preg_replace('![^0-9]!', '', $identifier_hash); 
				$identifier_hash=substr($identifier_hash, 0, 7);//questionid
				$identifier_hash=ltrim($identifier_hash, "0");
				
        //******************************************************
	$fileitem= new fileembedded_quiz ($fname[1], $identifier_hash,$fname[0], $res, $pid, $contenthash, $ct, $filesize, $fa);
	$arr_files_embedded_quiz[]=$fileitem;


//******************************************************************
	
	//echo "pattern: " . $pattern;
	if($width_bild!=="" && $width_height!=="")
	{
	$replacement="<img src=\"@@PLUGINFILE@@/" . $fname[1] . "\" width=\"" . $width_bild . "\" height=\"" . $height_bild . "\"  class=\"img-responsive\" />";
	}
	else 
	{
		$replacement="<img src=\"@@PLUGINFILE@@/" . $fname[1] .  "\" class=\"img-responsive\" />";
	}
	//$replaced=preg_replace('#\##', "x", $bild);
	$replaced=preg_replace($suchmuster, $replacement, $replaced);
	//echo "<br>";
	//echo "replactes zeug: ";
	//echo "<br>";
	//echo "<br>";
	//echo "<br>";
	//echo htmlentities($replaced);
	$bilddaten[3]=$replaced;
	
		}
		$bildobjekt[0]=$bilddaten;
		$bildobjekt[1]=$replaced;
		$bildobjekt[3]=$arr_files_embedded_quiz;
	}
	
	return $bildobjekt;
}
//****************************************************************

//bildinlabel
function bildinlabel($bild, $dir, $pid, $res, $direxport)
{
	
	$bildobjekt= array();
//***************************************
$fname=VerzeichnisDurchsuchen3($dir, $bild);
$bildobjekt[3]=$fname[1];
		//********************************************
		$oldname=$fname[0];//pfad ist schon übergeben
	
		$temppath=$dir . "/temp/";
	$newname= $temppath . $fname[1];
	if(is_dir($temppath)){
			
	copy($oldname, $newname);
	}
//***************************************

	//******************************************************Kopieren in HASH-Ordner
        $filesize    = filesize($newname);
        $contenthash = sha1_file($newname);
        $hashpath    = substr($contenthash, 0, 2);
        $hashfilepath=$direxport . "/files/" .$hashpath; 
        mkdir($hashfilepath, 0700);
        $hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
        copy($newname, $hashfilepath_mit_file);
			
				//**************************************************************
				//$identifier=$fname[1];
				//$identifier_hash=hash('md5',$identifier);
				//$identifier_hash = preg_replace('![^0-9]!', '', $identifier_hash); 
				//$identifier_hash=substr($identifier_hash, 0, 7);//questionid
				//$identifier_hash=ltrim($identifier_hash, "0");
        //******************************************************
	$fileitem= new fileembedded ($fname[1], $pid,$fname[0], $res, $pid, $contenthash, $filesize);
	
$bannertext="<p><img src=\"@@PLUGINFILE@@/" . $fname[1] . "\"  class=\"img-responsive\" /></p><p>Ihr Blackboard-Kurs wurde erfolgreich in Moodle wiederhergestellt. Bitte
beachten Sie, dass nicht alle Elemente aus Blackboard uebernommen werden koennen.</p>";
$bannertext=xmlencoding($bannertext);

$bildobjekt[0]=$bannertext;
$bildobjekt[1]=$fileitem;
return $bildobjekt;
//******************************************************************
//*********************************************************************

}
//***************************************************
function draganddropbild($hpfile, $dir, $pid, $res, $direxport, $ct)//für fragen wird die contextid gebraucht
{
		$fname=VerzeichnisDurchsuchen3($dir, $hpfile);
		//********************************************
		$oldname=$fname[0];//pfad ist schon übergeben
		$temppath=$dir . "/temp/";
	$newname= $temppath . $fname[1];
	if(is_dir($temppath)){
			
	copy($oldname, $newname);
	}
	//******************************************************Kopieren in HASH-Ordner
        $filesize    = filesize($newname);
        $contenthash = sha1_file($newname);
   $hashpath    = substr($contenthash, 0, 2);
        
        $hashfilepath=$direxport . "/files/" .$hashpath; 
        mkdir($hashfilepath, 0700);
        $hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
        copy($newname, $hashfilepath_mit_file);
				
				//**************************************************************
				$identifier=$fname[1];
				$identifier_hash=hash('md5',$identifier);
				$identifier_hash = preg_replace('![^0-9]!', '', $identifier_hash); 
				$identifier_hash=substr($identifier_hash, 0, 7);//questionid
				$identifier_hash=ltrim($identifier_hash, "0");
				
        //******************************************************
	$fileitem= new fileembedded_quiz_drag ($fname[1], $identifier_hash, $res, $pid, $contenthash, $ct, $filesize);
	
	return $fileitem;
		
}


function dateibeifrage($file_qu, $dir, $pid, $res, $direxport, $ct, $fa)//für fragen wird die contextid gebraucht
{
	
$bildobjekt=array();
		$fname=VerzeichnisDurchsuchen3($dir, $file_qu);
		


	
	//***********************************************************
	$oldname=$fname[0];
	

	$temppath=$dir . "/temp/";
	$newname= $temppath . $fname[1];
	
	if(is_dir($temppath)){
			
	copy($oldname, $newname);
	}
	//******************************************************Kopieren in HASH-Ordner
        $filesize    = filesize($newname);
        $contenthash = sha1_file($newname);
        	
        $hashpath    = substr($contenthash, 0, 2);
        
        $hashfilepath=$direxport . "/files/" .$hashpath; 
        mkdir($hashfilepath, 0700);
        $hashfilepath_mit_file=$hashfilepath . "/" . $contenthash;
        copy($newname, $hashfilepath_mit_file);
				
				//**************************************************************
					$identifier=$fname[1];
				$identifier_hash=hash('md5',$identifier);
				$identifier_hash = preg_replace('![^0-9]!', '', $identifier_hash); 
				$identifier_hash=substr($identifier_hash, 0, 7);//questionid
				$identifier_hash=ltrim($identifier_hash, "0");
				
        //******************************************************
	$fileitem= new fileembedded_quiz ($fname[1], $identifier_hash,$fname[0], $res, $pid, $contenthash, $ct, $filesize, $fa);
	$arr_files_embedded_quiz[]=$fileitem;



		$replacement="<img src=\"@@PLUGINFILE@@/" . $fname[1] .  "\" class=\"img-responsive\" />";

		$bildobjekt[1]=$replacement;
		$bildobjekt[2]=$arr_files_embedded_quiz;
	
	
	return $bildobjekt;
}
//****************************************************************


?>