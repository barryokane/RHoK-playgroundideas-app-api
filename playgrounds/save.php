<?php

include("../app.php");
include("../models.php");
include("../helpers.php");

ValidateUploadedFile("screenshot");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$userId = GetPost("userId", 0);
if ($userId == 0) {
	ReturnErrorData("No user");
	die;
}

$user = User::where("user_id", $userId)->first();
if ($user==null) {
	//user does not exist, so lets create one!
	$user = new User();
	$user->user_Id = $userId;
	//name?
	$user->save();
}

$playground = null;
if (ValidRequiredPost("designId")) {
	//update an existing playground
	$playId = GetPost("designId", 0);
	$playground = PlayGround::where("id", $playId)->first();
	if ($playground->user_id !== $user->user_id){
		ReturnErrorData("Error saving (cannot change user for an existing playground)");
		die;
	}	
}

if ($playground==null) {
	//create a new playground
	$playground = new Playground();
}

$imagePathParts = pathinfo($_FILES['screenshot']['name']);
$filedatestamp = date('mdYHis');
$savedFilename = str_replace("//", "", $imagePathParts['filename']) . "-" . $filedatestamp . "." . $imagePathParts['extension'];
$savedFilename = str_replace(" ", "_", $savedFilename);
$uploadfile = SCREENSHOT_UPLOAD_DIR . $savedFilename;

$playgroundName = GetPost("name", "New Playground");
$playground->user_Id = $userId;
$playground->name = $playgroundName;
$playground->screenshot = $savedFilename;
$playground->model = GetPost("model", "");
$playground->public = GetPost("public", "");

if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $uploadfile)) {

	$playground->save();

	//non DB field
	$playground->screenshot_Url = SCREENSHOT_URL_DIR.$playground->screenshot;

	ReturnData("playground", $playground);

} else {
	ReturnErrorData("Error uploading screenshot");
}
?>
