<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
define('PROJECT_ROOT_PATH','');

include_once PROJECT_ROOT_PATH . '../config/database.php';
include_once PROJECT_ROOT_PATH . '../config/config.php';
include_once PROJECT_ROOT_PATH . '../class/personprofile.php';
// connect to database
$database = new Database();
$db = $database->getConnection();
// initialize object
$enrollmentinfo = new PersonProfile($db);

//echo $_POST['firstname'];
// get posted data and assign to properties of object
$enrollmentinfo->firstname = $_POST['firstname'];
$enrollmentinfo->lastname = $_POST['lastname'];
$enrollmentinfo->middlename = $_POST['middlename'];
$enrollmentinfo->birthdate = $_POST['birthdate'];
$enrollmentinfo->gender = $_POST['fullGender'];
$enrollmentinfo->email = $_POST['email'];
$enrollmentinfo->address = $_POST['address'];
$enrollmentinfo->category = $_POST['fullcat'];


// create the person profile
if($enrollmentinfo->create()){
    http_response_code(201);
    echo json_encode(array("message" => "Person Profile was created."));
} else{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to create Person Profile."));
}


?>