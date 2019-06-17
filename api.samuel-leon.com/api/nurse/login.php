<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Max-Age: 3600');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Access-Control-Max-Age,Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Nurse.php';

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

  /*Check email existance*/

  // get posted data
  $data = json_decode(file_get_contents("php://input"));
   
  // set product property values
  $nurse->nurse_email = $data->nurse_email;
  $nurse_email_exists = $nurse->emailExists();
   
  // generate jwt below

  // check if email exists and if password is correct
  if($nurse_email_exists){

    if ($data->nurse_pwd == $nurse->nurse_pwd) {
      $token = array(
         "iss" => $iss,
         "aud" => $aud,
         "iat" => $iat,
         "nbf" => $nbf,
         "data" => array(
             "nurse_id" => $nurse->nurse_id,
             "nurse_name" => $nurse->nurse_name,
             "nurse_surname" => $nurse->nurse_surname,
             "nurse_pwd" => $nurse->nurse_pwd,
             "nurse_email" => $nurse->nurse_email
         )
      );
      
      // set response code
      http_response_code(200);

      session_start();
      $_SESSION['nurse_id'] = 1; 
      
      // generate jwt
      $jwt = JWT::encode($token, $key);
      echo json_encode(
              array(
                  "message" => "Successful login.",
                  "nurse_id" => $nurse->nurse_id,
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
  

