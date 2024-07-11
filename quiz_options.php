<?php
foreach ($daten->resources->resource as $res) {
	$residentcontenthandler=$res['type'];
	if($residentcontenthandler=="course/x-bb-courseassessment")
	{
	//echo $residentcontenthandler;
		$resident=trim($res['identifier']);

		$resdat=$dir . "/" . $resident . ".dat";//directory

		$res_single=simplexml_load_file($resdat);
		$resid=$res_single->ASMTID;
		$resid=$resid['value'];

		$resdat2=$dir . "/" . $resid . ".dat";//directory

		$res_single2=simplexml_load_file($resdat2);
		$test=$res_single2->assessment;
	
		$quizid=$test->assessmentmetadata->bbmd_asi_object_id;
		
	$quizid=trim($quizid);
		$quizid=str_replace("_", "", $quizid);
	
		//************************************************
		//************************************************
		$deliverytype=$res_single->DELIVERYTYPE;

		$deliverytype=trim($deliverytype['value']);

		$timelimit=$res_single->TIMELIMIT;
		$timetemp=(int) $timelimit['value'];
		$timelimit=$timetemp*60;
				$attemptcount=$res_single->ATTEMPTCOUNT;
		$attemptcount=trim($attemptcount['value']);
		$allowmultiple=$res_single->FLAGS->ALLOWMULTIPLEATTEMPTS;
		$allowmultiple=trim($allowmultiple['value']);
		$goback=$res_single->FLAGS->ISBACKTRACKPROHIBITED;
		$goback=trim($goback['value']);
		$zufall=$res_single->FLAGS->RANDOMIZEQUESTIONS;
		$zufall=trim($zufall['value']);
		if(isset($quiz_ar_ids["$quizid"]))
		{
		$quiz_ar_ids["$quizid"]->setDeliveryType($deliverytype);
		$quiz_ar_ids["$quizid"]->setTimeLimit($timelimit);
		$quiz_ar_ids["$quizid"]->setAttemptCount($attemptcount);
		
		}
		
	}
}
