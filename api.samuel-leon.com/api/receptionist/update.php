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

  // Instantiate receptionist object
$receptionist = new Receptionist($db);

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
	  

	  /*receptionist properties*/
	  $receptionist->rep_id = $decoded->data->rep_id;

	  $receptionist->rep_name = $data->rep_name;
	  $receptionist->rep_surname = $data->rep_surname;
	  $receptionist->rep_email = $data->rep_email;
	  $receptionist->rep_phone = $data->rep_phone;
	  $receptionist->rep_address = $data->rep_address;
	  $receptionist->rep_pwd = $data->rep_pwd;

	  //update the receptionist
	  if($receptionist->update()) {

	  	//re-generate jwt 
	  	$token = array(
	  	   "iss" => $iss,
	  	   "aud" => $aud,
	  	   "iat" => $iat,
	  	   "nbf" => $nbf,
	  	   "data" => array(
	  	       "rep_id" => $receptionist->rep_id,
	  	       "rep_name" => $receptionist->rep_name,
	  	       "rep_surname" => $receptionist->rep_surname,
	  	       "rep_email" => $receptionist->rep_email, 
	  	       "rep_phone" => $receptionist->rep_phone,
	  	       "rep_address" => $receptionist->rep_address,
	  	       "rep_pwd" => $receptionist->rep_pwd
	  	   )
	  	);

	  	// generate jwt
	  	$jwt = JWT::encode($token, $key);

	  	  // set response code
	  	http_response_code(200);

	  	//response in json format
	  	echo json_encode(
	  	        array(
	  	            "message" => "Receptionist updated successfully.",
	  	            "jwt" => $jwt
	  	        )
	  	    );

	  }else{

	  	
	  	  // set response code
	  	http_response_code(401);
	  	echo json_encode(
	  	  array('message' => 'Unable to updated the receptionist!')
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