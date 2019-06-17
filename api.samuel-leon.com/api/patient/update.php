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
$patient = new Patient($db);

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
	  

	  /*patient properties*/
	  $patient->pat_id = $decoded->data->pat_id;

	  $patient->pat_name = $data->pat_name;
	  $patient->pat_surname = $data->pat_surname;
	  $patient->pat_email = $data->pat_email;
	  $patient->pat_phone = $data->pat_phone;
	  $patient->pat_address = $data->pat_address;
	  $patient->pat_pwd = $data->pat_pwd;
	  $patient->pat_dob = $data->pat_dob;
	  $patient->pat_gender = $data->pat_gender;
	  $patient->pat_med_history = $data->pat_med_history;
	  $patient->pat_surg_history = $data->pat_surg_history;
	  $patient->pat_med_current = $data->pat_med_current;
	  $patient->pat_occupation = $data->pat_occupation;

	  //update the patient
	  if($patient->update()) {

	  	//re-generate jwt 
	  	$token = array(
	  	   "iss" => $iss,
	  	   "aud" => $aud,
	  	   "iat" => $iat,
	  	   "nbf" => $nbf,
	  	   "data" => array(
	  	       "pat_id" => $patient->pat_id,
	  	       "pat_name" => $patient->pat_name,
	  	       "pat_surname" => $patient->pat_surname,
	  	       "pat_email" => $patient->pat_email, 
	  	       "pat_phone" => $patient->pat_phone,
	  	       "pat_address" => $patient->pat_address,
	  	       "pat_pwd" => $patient->pat_pwd,
	  	       "pat_dob" => $patient->pat_dob,
	  	       "pat_gender" => $patient->pat_gender,
	  	       "pat_med_history" => $patient->pat_med_history,
	  	       "pat_surg_history" => $patient->pat_surg_history,
	  	       "pat_med_current" => $patient->pat_med_current,
	  	       "pat_occupation" => $patient->pat_occupation
	  	   )
	  	);

	  	// generate jwt
	  	$jwt = JWT::encode($token, $key);

	  	  // set response code
	  	http_response_code(200);

	  	//response in json format
	  	echo json_encode(
	  	        array(
	  	            "message" => "Patient updated successfully.",
	  	            "jwt" => $jwt
	  	        )
	  	    );

	  }else{

	  	
	  	  // set response code
	  	http_response_code(401);
	  	echo json_encode(
	  	  array('message' => 'Unable to updated the patient!')
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