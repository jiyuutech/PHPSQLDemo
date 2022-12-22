<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
define('PROJECT_ROOT_PATH','');

include_once PROJECT_ROOT_PATH . '../config/database.php';
include_once PROJECT_ROOT_PATH . '../config/config.php';
include_once PROJECT_ROOT_PATH . '../class/personprofile.php';
// connect to database
$database = new Database();
$db = $database->getConnection();
// initialize object
$personprofile = new PersonProfile($db);



$personprofile->profileid = isset($_GET['profileid']) ? $_GET['profileid'] : 0;
$result = null;


if(isset($_GET['profileid'])){
    $result = $personprofile->getProfileById();
}else{
    $result = $personprofile->getAllProfile();
}

if($result->num_rows > 0){

    $personprofile_arr=array();
    $personprofile_arr["data"]=array();
    while ($row = mysqli_fetch_assoc($result)){
        $row = array_map('utf8_encode', $row);
        array_push($personprofile_arr["data"], $row);
    }
    http_response_code(200);
    echo json_encode($personprofile_arr);
} else{
    http_response_code(404);
    echo json_encode(array("message" => "No Person Profile found."));
}


