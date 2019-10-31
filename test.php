<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

GetData();

function GetData() {


	echo '{"status":true,"message":"Success","user":{"id":1,"remote_id":22,"name":"Barry"}}';
}

?>
