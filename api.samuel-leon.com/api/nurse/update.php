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

  // Instantiate patient object
$nurse = new Nurse($db);

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
	  

	  /*nurse properties*/
	  $nurse->nurse_id = $decoded->data->nurse_id;
	  
	  $nurse->nurse_name = $data->nurse_name;
	  $nurse->nurse_surname = $data->nurse_surname;
	  $nurse->nurse_email = $data->nurse_email;
	  $nurse->nurse_phone = $data->nurse_phone;
	  $nurse->nurse_address = $data->nurse_address;
	  $nurse->nurse_pwd = $data->nurse_pwd;

	  //update the nurse
	  if($nurse->update()) {

	  	//re-generate jwt 
	  	$token = array(
	  	   "iss" => $iss,
	  	   "aud" => $aud,
	  	   "iat" => $iat,
	  	   "nbf" => $nbf,
	  	   "data" => array(
	  	       "nurse_id" => $nurse->nurse_id,
	  	       "nurse_name" => $nurse->nurse_name,
	  	       "nurse_surname" => $nurse->nurse_surname,
	  	       "nurse_email" => $nurse->nurse_email, 
	  	       "nurse_phone" => $nurse->nurse_phone,
	  	       "nurse_address" => $nurse->nurse_address,
	  	       "nurse_pwd" => $nurse->nurse_pwd
	  	   )
	  	);

	  	// generate jwt
	  	$jwt = JWT::encode($token, $key);

	  	  // set response code
	  	http_response_code(200);

	  	//response in json format
	  	echo json_encode(
	  	        array(
	  	            "message" => "Nurse updated successfully.",
	  	            "jwt" => $jwt
	  	        )
	  	    );

	  }else{

	  	
	  	  // set response code
	  	http_response_code(401);
	  	echo json_encode(
	  	  array('message' => 'Unable to updated the nurse!')
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