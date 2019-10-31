<?php

include("../app.php");
include("../models.php");
include("../helpers.php");


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

	$plays = Playground::where("public", "true")->orderBy('views', "DESC")->get();
	foreach ($plays as $p) {
		//non DB field
		$p->Screenshot_Url = SCREENSHOT_URL_DIR.$p->screenshot;
	}
	ReturnData("playgrounds", $plays);
?>
