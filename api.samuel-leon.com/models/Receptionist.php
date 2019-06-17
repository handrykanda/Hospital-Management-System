<?php
	/**
	* 
	*/
	class Receptionist {

		private $conn;
		private $table = 'receptionist';


		//receptionist properties
		public $rep_id;
		public $rep_name;
		public $rep_surname;
		public $rep_email;
		public $rep_phone;
		public $rep_address;
		public $rep_pwd;
		
		
		//constructor with DB
		function __construct($db)
		{
			$this->conn=$db;
		}

		//get receptionists
		public function read(){
			//create query
			$query = 'SELECT * FROM '. $this->table;

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//execute the query
			$stmt->execute();

			return $stmt;
		}

		public function read_single(){

			//create query
			$query = 'SELECT * FROM '.$this->table.' WHERE rep_id = :rep_id LIMIT 0,1';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//Bind ID
			$stmt->bindParam(':rep_id', $this->rep_id);

			//execute the query
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			//set properties
			$this->rep_id = $row['rep_id'];
			$this->rep_name = $row['rep_name'];
			$this->rep_surname = $row['rep_surname'];
			$this->rep_email = $row['rep_email'];
			$this->rep_phone = $row['rep_phone'];
			$this->rep_address = $row['rep_address'];
			$this->rep_pwd = $row['rep_pwd'];
		}

		// Create Receptionist
		public function create() {
		      // Create query
		      $query = 'INSERT INTO ' . $this->table . '
		       SET
		         rep_name = :rep_name,
		         rep_surname = :rep_surname,
		         rep_email = :rep_email, 
		         rep_phone = :rep_phone,
		         rep_address = :rep_address,
		         rep_pwd = :rep_pwd
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->rep_name = htmlspecialchars(strip_tags($this->rep_name));
		      $this->rep_surname = htmlspecialchars(strip_tags($this->rep_surname));
		      $this->rep_email = htmlspecialchars(strip_tags($this->rep_email));
		      $this->rep_phone = htmlspecialchars(strip_tags($this->rep_phone));
		      $this->rep_address = htmlspecialchars(strip_tags($this->rep_address));
		      $this->rep_pwd = htmlspecialchars(strip_tags($this->rep_pwd));

		      // Bind data
		      $stmt->bindParam(':rep_name', $this->rep_name);
		      $stmt->bindParam(':rep_surname', $this->rep_surname);
		      $stmt->bindParam(':rep_email', $this->rep_email);
		      $stmt->bindParam(':rep_phone', $this->rep_phone);
		      $stmt->bindParam(':rep_address', $this->rep_address);
		      $stmt->bindParam(':rep_pwd', $this->rep_pwd);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		  }

		  // Print error if something goes wrong
		  printf("Error: %s.\n", $stmt->error);

		  return false;
		}


		// check if given email exist in the database
				function emailExists(){
				 
				    // query to check if email exists
				    $query = "SELECT rep_id, rep_name, rep_surname, rep_pwd, rep_email
				            FROM " . $this->table . "
				            WHERE rep_email = :rep_email
				            LIMIT 0,1";
				 
				    // prepare the query
				    $stmt = $this->conn->prepare($query);
				 
				    // sanitize
				    $this->rep_email=htmlspecialchars(strip_tags($this->rep_email));
				 
				    // bind given email value
				    $stmt->bindParam(':rep_email', $this->rep_email);
				 
				    // execute the query
				    $stmt->execute();
				 
				    // get number of rows
				    $num = $stmt->rowCount();
				 
				    // if email exists, assign values to object properties for easy access and use for php sessions
				    if($num>0){
				 
				        // get record details / values
				        $row = $stmt->fetch(PDO::FETCH_ASSOC);
				 
				        // assign values to object properties
				        $this->rep_id = $row['rep_id'];
				        $this->rep_name = $row['rep_name'];
				        $this->rep_surname = $row['rep_surname'];
				        $this->rep_pwd = $row['rep_pwd'];
				        $this->rep_email = $row['rep_email'];
				 
				        // return true because email exists in the database
				        return true;
				    }
				 
				    // return false if email does not exist in the database
				    return false;
				}

		// Update Patient
		public function update() {
		      // Create query
		      $query = 'UPDATE ' . $this->table . '
		       SET
		         rep_name = :rep_name,
		         rep_surname = :rep_surname,
		         rep_email = :rep_email, 
		         rep_phone = :rep_phone,
		         rep_address = :rep_address,
		         rep_pwd = :rep_pwd,

		         WHERE rep_id = :rep_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->rep_name = htmlspecialchars(strip_tags($this->rep_name));
		      $this->rep_surname = htmlspecialchars(strip_tags($this->rep_surname));
		      $this->rep_email = htmlspecialchars(strip_tags($this->rep_email));
		      $this->rep_phone = htmlspecialchars(strip_tags($this->rep_phone));
		      $this->rep_address = htmlspecialchars(strip_tags($this->rep_address));
		      $this->rep_pwd = htmlspecialchars(strip_tags($this->rep_pwd));

		      // Bind data
		      $stmt->bindParam(':rep_name', $this->rep_name);
		      $stmt->bindParam(':rep_surname', $this->rep_surname);
		      $stmt->bindParam(':rep_email', $this->rep_email);
		      $stmt->bindParam(':rep_phone', $this->rep_phone);
		      $stmt->bindParam(':rep_address', $this->rep_address);
		      $stmt->bindParam(':rep_pwd', $this->rep_pwd);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		  }

		  // Print error if something goes wrong
		  printf("Error: %s.\n", $stmt->error);

		  return false;
		}

		// Delete Receptionist
		public function delete() {
		      // Create query
		      $query = 'DELETE FROM ' . $this->table . ' WHERE rep_id = :rep_id';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->rep_id = htmlspecialchars(strip_tags($this->rep_id));

		      // Bind data
		      $stmt->bindParam(':rep_id', $this->rep_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		      }

		      // Print error if something goes wrong
		      printf("Error: %s.\n", $stmt->error);

		      return false;
		}
	}