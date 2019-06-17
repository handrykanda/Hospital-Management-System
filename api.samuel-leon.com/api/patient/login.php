<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  /*Check email existance*/

  // get posted data
  $data = json_decode(file_get_contents("php://input"));
   
  // set product property values
  $patient->pat_email = $data->pat_email;
  $pat_email_exists = $patient->emailExists();
   
  // generate jwt below

  // check if email exists and if password is correct
  if($pat_email_exists){

    if ($data->pat_pwd == $patient->pat_pwd) {
      $token = array(
         "iss" => $iss,
         "aud" => $aud,
         "iat" => $iat,
         "nbf" => $nbf,
         "data" => array(
             "pat_id" => $patient->pat_id,
             "pat_name" => $patient->pat_name,
             "pat_surname" => $patient->pat_surname,
             "pat_pwd" => $patient->pat_pwd,
             "pat_email" => $patient->pat_email
         )
      );
      
      // set response code
      http_response_code(200);

      session_start();
      $_SESSION['pat_id'] = 1; 
      
      // generate jwt
      $jwt = JWT::encode($token, $key);
      echo json_encode(
              array(
                  "message" => "Successful login.",
                  "pat_id" => $patient->pat_id,
                  "jwt" => $jwt
              )
          );
      
    } else{
      http_response_code(401);
      echo json_encode(array("message" => "The password is wrong!"));
    }
   
  }
  // login failed
  else{
   
      // set response code
      http_response_code(401);
   
      // tell the user login failed
      echo json_encode(array("message" => "Email does not exists!"));
  }
  

