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


if (ValidRequiredQueryString("designId")) {
	$playId = GetQueryString("designId", 0);
	$play = PlayGround::where("id", $playId)->first();
	if ($play==null) {
		ReturnErrorData("No valid playground");
		die;
	}
	if ($play->user_id !== $user->user_id){
		ReturnErrorData("Error deleting (not for that user)");
		die;
	}

	//delete screenshot file
	$uploadedFile = SCREENSHOT_UPLOAD_DIR . $play->screenshot;
	if (file_exists($uploadedFile)) {
		unlink($uploadedFile);
	}

	//delete from DB
	$play->delete();

	ReturnData("playground_delete", "done");
} else {
	ReturnErrorData("No ID passed");
}
?>
