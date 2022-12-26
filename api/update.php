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
$personprofile = new PersonProfile($db);

// get posted data and assign to properties of object
$personprofile->profileid = $_POST['profileid'];
$personprofile->firstname = $_POST['firstname'];
$personprofile->lastname = $_POST['lastname'];
$personprofile->middlename = $_POST['middlename'];
$personprofile->birthdate = $_POST['birthdate'];
$personprofile->gender = $_POST['fullGender'];
$personprofile->email = $_POST['email'];
$personprofile->address = $_POST['address'];
$personprofile->category =$_POST['fullcat'];

// update the person profile
if($personprofile->update()){
    http_response_code(201);
    echo json_encode(array("message" => "Person Profile was updated."));
} else{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update Person Profile."));
}
