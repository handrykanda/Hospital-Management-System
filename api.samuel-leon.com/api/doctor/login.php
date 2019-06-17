<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Max-Age: 3600');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Access-Control-Max-Age,Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Doctor.php';

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

  /*Check email existance*/

  // get posted data
  $data = json_decode(file_get_contents("php://input"));
   
  // set product property values
  $doctor->doc_email = $data->doc_email;
  $doc_email_exists = $doctor->emailExists();
   
  // generate jwt below

  // check if email exists and if password is correct
  if($doc_email_exists){

    if ($data->doc_pwd == $doctor->doc_pwd) {
      $token = array(
         "iss" => $iss,
         "aud" => $aud,
         "iat" => $iat,
         "nbf" => $nbf,
         "data" => array(
             "doc_id" => $doctor->doc_id,
             "doc_name" => $doctor->doc_name,
             "doc_surname" => $doctor->doc_surname,
             "doc_pwd" => $doctor->doc_pwd,
             "doc_email" => $doctor->doc_email
         )
      );
      
      // set response code
      http_response_code(200);

      session_start();
      $_SESSION['doc_id'] = 1; 
      
      // generate jwt
      $jwt = JWT::encode($token, $key);
      echo json_encode(
              array(
                  "message" => "Successful login.",
                  "doc_id" => $doctor->doc_id,
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
  

