<?php

include("../app.php");
include("../models.php");
include("../helpers.php");


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

if (ValidRequiredQueryString("UserId")) {
	$userId = GetQueryString("UserId", 0);
	if ($userId==0) {
		ReturnErrorData("No valid user");
		die;
	}
}

if (ValidRequiredQueryString("DesignId")) {
	$playId = GetQueryString("DesignId", 0);
	if ($playId==0) {
		ReturnErrorData("No valid playground");
		die;
	}
}
$playground = PlayGround::where("user_id", $userId)->where("id", $playId)->get();
PlayGround::where("user_id", $userId)->where("id", $playId)->increment("views");
ReturnData("playground", $playground);
?>
