<?php

include("../app.php");
include("../models.php");
include("../helpers.php");


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// validate the user ID passed in
if (ValidRequiredQueryString("userId")) {
	$userId = GetQueryString("userId", 0);
	$user = User::where("user_id", $userId)->first();
	if ($user==null) {
		ReturnErrorData("No valid user: ".$userId);
		die;
	}
} else {
	ReturnErrorData("Error: No valid user ID given.");
	die;
}

// validate the design ID passed in
if (ValidRequiredQueryString("designId")) {
	$designId = GetQueryString("designId", 0);
	$design = PlayGround::where("id", $designId)->first();
	if ($design==null) {
		ReturnErrorData("No valid playground: ".$designId);
		die;
	} elseif ($design->user_id !== $user->user_id) {
		ReturnErrorData("Error: Design not accessable for that user");
		die;
	}
} else {
	ReturnErrorData("Error: No valid design ID given.");
	die;
}

// validate and pull assets if they exist
if (ValidRequiredQueryString("name")) {
	$name = GetQueryString("name", 0);
	$assets = Image::where(["name"=>$name, "design_id"=>$designId])->first();
	if ($assets==null) {
		ReturnErrorData("No image found for that name & designId.");
		die;
	}
	//non DB field
	$assets->full_Url = SCREENSHOT_URL_DIR.$assets->image;
	ReturnData("image", $assets);
} else {

    $assets = Image::where("design_id", $design->id)->get();
	foreach ($assets as $i) {
		//non DB field
		$i->full_Url = SCREENSHOT_URL_DIR.$i->image;
	}
	ReturnData("images", $assets);
}


?>