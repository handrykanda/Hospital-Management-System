<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Max-Age: 3600');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Access-Control-Max-Age,Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Receptionist.php';

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
  $receptionist = new Receptionist($db);

  /*Check email existance*/

  // get posted data
  $data = json_decode(file_get_contents("php://input"));
   
  // set product property values
  $receptionist->rep_email = $data->rep_email;
  $rep_email_exists = $receptionist->emailExists();
   
  // generate jwt below

  // check if email exists and if password is correct
  if($rep_email_exists){

    if ($data->rep_pwd == $receptionist->rep_pwd) {
      $token = array(
         "iss" => $iss,
         "aud" => $aud,
         "iat" => $iat,
         "nbf" => $nbf,
         "data" => array(
             "rep_id" => $receptionist->rep_id,
             "rep_name" => $receptionist->rep_name,
             "rep_surname" => $receptionist->rep_surname,
             "rep_pwd" => $receptionist->rep_pwd,
             "rep_email" => $receptionist->rep_email
         )
      );
      
      // set response code
      http_response_code(200);

      session_start();
      $_SESSION['rep_id'] = 1; 
      
      // generate jwt
      $jwt = JWT::encode($token, $key);
      echo json_encode(
              array(
                  "message" => "Successful login.",
                  "rep_id" => $receptionist->rep_id,
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
  

