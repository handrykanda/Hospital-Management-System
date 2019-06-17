<?php
	/**
	* 
	*/
	class Doctor {

		private $conn;
		private $table = 'doctor';


		//doctor properties
		public $doc_id;
		public $doc_name;
		public $doc_surname;
		public $doc_email;
		public $doc_phone;
		public $doc_image;
		public $doc_pwd;
		public $doc_specialty;
		public $doc_education;
		
		//constructor with DB
		function __construct($db)
		{
			$this->conn=$db;
		}

		//get Doctor
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
			$query = 'SELECT * FROM '.$this->table.' WHERE doc_id = :doc_id LIMIT 0,1';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//Bind ID
			$stmt->bindParam(':doc_id', $this->doc_id);

			//execute the query
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			//set properties
			$this->doc_id = $row['doc_id'];
			$this->doc_name = $row['doc_name'];
			$this->doc_surname = $row['doc_surname'];
			$this->doc_email = $row['doc_email'];
			$this->doc_phone = $row['doc_phone'];
			$this->doc_image = $row['doc_image'];
			$this->doc_pwd = $row['doc_pwd'];
			$this->doc_specialty = $row['doc_specialty'];
			$this->doc_education = $row['doc_education'];
		}

		// Create doctor
		public function create() {
		      // Create query
		      $query = 'INSERT INTO ' . $this->table . '
		       SET
		         doc_name = :doc_name,
		         doc_surname = :doc_surname,
		         doc_email = :doc_email, 
		         doc_phone = :doc_phone,
		         doc_image = :doc_image,
		         doc_pwd = :doc_pwd,
		         doc_specialty = :doc_specialty,
		         doc_education = :doc_education
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->doc_name = htmlspecialchars(strip_tags($this->doc_name));
		      $this->doc_surname = htmlspecialchars(strip_tags($this->doc_surname));
		      $this->doc_email = htmlspecialchars(strip_tags($this->doc_email));
		      $this->doc_phone = htmlspecialchars(strip_tags($this->doc_phone));
		      $this->doc_image = htmlspecialchars(strip_tags($this->doc_image));
		      $this->doc_pwd = htmlspecialchars(strip_tags($this->doc_pwd));
		      $this->doc_specialty = htmlspecialchars(strip_tags($this->doc_specialty));
		      $this->doc_education = htmlspecialchars(strip_tags($this->doc_education));

		      // Bind data
		      $stmt->bindParam(':doc_name', $this->doc_name);
		      $stmt->bindParam(':doc_surname', $this->doc_surname);
		      $stmt->bindParam(':doc_email', $this->doc_email);
		      $stmt->bindParam(':doc_phone', $this->doc_phone);
		      $stmt->bindParam(':doc_image', $this->doc_image);
		      $stmt->bindParam(':doc_pwd', $this->doc_pwd);
		      $stmt->bindParam(':doc_specialty', $this->doc_specialty);
		      $stmt->bindParam(':doc_education', $this->doc_education);

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
				    $query = "SELECT doc_id, doc_name, doc_surname, doc_pwd, doc_email
				            FROM " . $this->table . "
				            WHERE doc_email = :doc_email
				            LIMIT 0,1";
				 
				    // prepare the query
				    $stmt = $this->conn->prepare($query);
				 
				    // sanitize
				    $this->doc_email=htmlspecialchars(strip_tags($this->doc_email));
				 
				    // bind given email value
				    $stmt->bindParam(':doc_email', $this->doc_email);
				 
				    // execute the query
				    $stmt->execute();
				 
				    // get number of rows
				    $num = $stmt->rowCount();
				 
				    // if email exists, assign values to object properties for easy access and use for php sessions
				    if($num>0){
				 
				        // get record details / values
				        $row = $stmt->fetch(PDO::FETCH_ASSOC);
				 
				        // assign values to object properties
				        $this->doc_id = $row['doc_id'];
				        $this->doc_name = $row['doc_name'];
				        $this->doc_surname = $row['doc_surname'];
				        $this->doc_pwd = $row['doc_pwd'];
				        $this->doc_email = $row['doc_email'];
				 
				        // return true because email exists in the database
				        return true;
				    }
				 
				    // return false if email does not exist in the database
				    return false;
				}

		// Update doctor
		public function update() {
		      // Create query
		      $query = 'UPDATE ' . $this->table . '
		       SET
		        doc_name = :doc_name,
		        doc_surname = :doc_surname,
		        doc_email = :doc_email, 
		        doc_phone = :doc_phone,
		        doc_image = :doc_image,
		        doc_pwd = :doc_pwd,
		        doc_specialty = :doc_specialty,
		        doc_education = :doc_education,
		        

		         WHERE doc_id = :doc_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		     $this->doc_name = htmlspecialchars(strip_tags($this->doc_name));
		     $this->doc_surname = htmlspecialchars(strip_tags($this->doc_surname));
		     $this->doc_email = htmlspecialchars(strip_tags($this->doc_email));
		     $this->doc_phone = htmlspecialchars(strip_tags($this->doc_phone));
		     $this->doc_image = htmlspecialchars(strip_tags($this->doc_image));
		     $this->doc_pwd = htmlspecialchars(strip_tags($this->doc_pwd));
		     $this->doc_specialty = htmlspecialchars(strip_tags($this->doc_specialty));
		     $this->doc_education = htmlspecialchars(strip_tags($this->doc_education));

		      // Bind data
		      $stmt->bindParam(':doc_name', $this->doc_name);
		      $stmt->bindParam(':doc_surname', $this->doc_surname);
		      $stmt->bindParam(':doc_email', $this->doc_email);
		      $stmt->bindParam(':doc_phone', $this->doc_phone);
		      $stmt->bindParam(':doc_image', $this->doc_image);
		      $stmt->bindParam(':doc_pwd', $this->doc_pwd);
		      $stmt->bindParam(':doc_specialty', $this->doc_specialty);
		      $stmt->bindParam(':doc_education', $this->doc_education);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		  }

		  // Print error if something goes wrong
		  printf("Error: %s.\n", $stmt->error);

		  return false;
		}

		// Delete Doctor
		public function delete() {
		      // Create query
		      $query = 'DELETE FROM ' . $this->table . ' WHERE doc_id = :doc_id';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->doc_id = htmlspecialchars(strip_tags($this->doc_id));

		      // Bind data
		      $stmt->bindParam(':doc_id', $this->doc_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		      }

		      // Print error if something goes wrong
		      printf("Error: %s.\n", $stmt->error);

		      return false;
		}
	}