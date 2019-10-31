<?php

include("../app.php");
include("../models.php");
include("../helpers.php");


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

if (ValidRequiredQueryString("userId")) {
	$userId = GetQueryString("userId", 0);
	$user = User::where("user_id", $userId)->first();
	if ($user==null) {
		ReturnErrorData("No valid user: ".$userId);
		die;
	}

	$plays = PlayGround::where("user_id", $userId)->latest()->get();
	foreach ($plays as $p) {
		//non DB field
		$p->Screenshot_Url = SCREENSHOT_URL_DIR.$p->screenshot;
	}
	ReturnData("playground", $plays);
} elseif (ValidRequiredQueryString("id")) {
	$playId = GetQueryString("id", 0);
	$play = PlayGround::where("id", $playId)->first();
	if ($play==null) {
		ReturnErrorData("No valid playground: ".$play);
		die;
	}
	//non DB field
	$play->Screenshot_Url = SCREENSHOT_URL_DIR.$play->screenshot;
	ReturnData("playground", $play);
} else {
	$plays = Playground::all();
	foreach ($plays as $p) {
		//non DB field
		$p->Screenshot_Url = SCREENSHOT_URL_DIR.$p->screenshot;
	}
	ReturnData("playgrounds", $plays);
}

?>