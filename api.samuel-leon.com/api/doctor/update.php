<?php 
  // Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Access-Control-Max-Age,Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Patient.php';

/*files for jwt below*/

  // generate json web token
include_once '../../config/core.php';
include_once '../../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../../libs/php-jwt-master/src/ExpiredException.php';
include_once '../../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

  // Instantiate DB & connect
$database = new Database();
$db = $database->connect();

  // Instantiate doctor object
$doctor = new Doctor($db);

  // Get raw  data
$data = json_decode(file_get_contents("php://input"));

  // get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";

  // decode jwt 
  // if jwt is not empty
if($jwt){
	    // if decode succeed, show user details
	try {
	        // decode jwt
	  $decoded = JWT::decode($jwt, $key, array('HS256'));
	  

	  /*doctor properties*/
	  $doctor->doc_id = $decoded->data->doc_id;

	  $doctor->doc_name = $data->doc_name;
	  $doctor->doc_surname = $data->doc_surname;
	  $doctor->doc_email = $data->doc_email;
	  $doctor->doc_phone = $data->doc_phone;
	  $doctor->doc_image = $data->doc_image;
	  $doctor->doc_pwd = $data->doc_pwd;
	  $doctor->doc_specialty = $data->doc_specialty;
	  $doctor->doc_education = $data->doc_education;

	  //update the doctor
	  if($doctor->update()) {

	  	//re-generate jwt 
	  	$token = array(
	  	   "iss" => $iss,
	  	   "aud" => $aud,
	  	   "iat" => $iat,
	  	   "nbf" => $nbf,
	  	   "data" => array(
	  	       "doc_id" => $doctor->doc_id,
	  	       "doc_name" => $doctor->doc_name,
	  	       "doc_surname" => $doctor->doc_surname,
	  	       "doc_email" => $doctor->doc_email,
	  	       "doc_phone" => $doctor->doc_phone,
	  	       "doc_image" => $doctor->doc_image,
	  	       "doc_pwd" => $doctor->doc_pwd,
	  	       "doc_specialty" => $doctor->doc_specialty,
	  	       "doc_education" => $doctor->doc_education
	  	   )
	  	);

	  	// generate jwt
	  	$jwt = JWT::encode($token, $key);

	  	  // set response code
	  	http_response_code(200);

	  	//response in json format
	  	echo json_encode(
	  	        array(
	  	            "message" => "Doctor updated successfully.",
	  	            "jwt" => $jwt
	  	        )
	  	    );

	  }else{

	  	
	  	  // set response code
	  	http_response_code(401);
	  	echo json_encode(
	  	  array('message' => 'Unable to updated the doctor!')
	  	);
	  }


	}

	// if decode fails, it means jwt is invalid
	catch (Exception $e){
	 
	    // set response code
	  http_response_code(401);
	  
	    // tell the user access denied  & show error message
	  echo json_encode(array(
	    "message" => "Access denied.",
	    "error" => $e->getMessage()
	  ));
	}
}
else{
	//error msg if jwt is empty
	// set response code
	http_response_code(401);
	
	// tell the patient update process failed
	echo json_encode(array("message" => "Access denied!"));

}