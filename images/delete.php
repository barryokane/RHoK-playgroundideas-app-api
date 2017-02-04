<?php

include("../app.php");
include("../models.php");
include("../helpers.php");


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$userId = GetQueryString("userId", 0);
if ($userId == 0) {
	ReturnErrorData("No user");
	die;
}

$user = User::where("user_id", $userId)->first();
if ($user==null) {
	ReturnErrorData("No valid user: ".$userId);
	die;
}

$designId = GetQueryString("designId", 0);
if ($designId == 0) {
	ReturnErrorData("No design");
	die;
}

$design = Playground::where("id", $designId)->first();
if ($design==null) {
	ReturnErrorData("No valid playgrounds: ".$designId);
	die;
} elseif ($design->user_id !== $user->user_id){
	ReturnErrorData("Design not accessable for that user");
	die;
}

if (ValidRequiredQueryString("imageId")) {
	$imageId = GetQueryString("imageId", 0);
	$asset = Image::where("id", $imageId)->first();
	if ($asset==null) {
		ReturnErrorData("No valid image");
		die;
	}
	if ($asset->design_id !== $design->id) {
		ReturnErrorData("Error deleting (images is not for that designId)");
		die;
	}

	$asset->delete();

	ReturnData("image_delete", "done");
} else {
	ReturnErrorData("No imageID passed");
}
?>