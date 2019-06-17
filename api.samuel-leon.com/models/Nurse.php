<?php
	/**
	* 
	*/
	class Nurse {

		private $conn;
		private $table = 'nurse';


		//nurse properties
		public $nurse_id;
		public $nurse_name;
		public $nurse_surname;
		public $nurse_email;
		public $nurse_phone;
		public $nurse_address;
		public $nurse_pwd;
		
		//constructor with DB
		function __construct($db)
		{
			$this->conn=$db;
		}

		//get patients
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
			$query = 'SELECT * FROM '.$this->table.' WHERE nurse_id = :nurse_id LIMIT 0,1';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//Bind ID
			$stmt->bindParam(':nurse_id', $this->nurse_id);

			//execute the query
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			//set properties
			$this->nurse_id = $row['nurse_id'];
			$this->nurse_name = $row['nurse_name'];
			$this->nurse_surname = $row['nurse_surname'];
			$this->nurse_email = $row['nurse_email'];
			$this->nurse_phone = $row['nurse_phone'];
			$this->nurse_address = $row['nurse_address'];
			$this->nurse_pwd = $row['nurse_pwd'];
		}

		// Create Nurse
		public function create() {
		      // Create query
		      $query = 'INSERT INTO ' . $this->table . '
		       SET
		         nurse_name = :nurse_name,
		         nurse_surname = :nurse_surname,
		         nurse_email = :nurse_email, 
		         nurse_phone = :nurse_phone,
		         nurse_address = :nurse_address,
		         nurse_pwd = :nurse_pwd
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->nurse_name = htmlspecialchars(strip_tags($this->nurse_name));
		      $this->nurse_surname = htmlspecialchars(strip_tags($this->nurse_surname));
		      $this->nurse_email = htmlspecialchars(strip_tags($this->nurse_email));
		      $this->nurse_phone = htmlspecialchars(strip_tags($this->nurse_phone));
		      $this->nurse_address = htmlspecialchars(strip_tags($this->nurse_address));
		      $this->nurse_pwd = htmlspecialchars(strip_tags($this->nurse_pwd));

		      // Bind data
		      $stmt->bindParam(':nurse_name', $this->nurse_name);
		      $stmt->bindParam(':nurse_surname', $this->nurse_surname);
		      $stmt->bindParam(':nurse_email', $this->nurse_email);
		      $stmt->bindParam(':nurse_phone', $this->nurse_phone);
		      $stmt->bindParam(':nurse_address', $this->nurse_address);
		      $stmt->bindParam(':nurse_pwd', $this->nurse_pwd);

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
				    $query = "SELECT nurse_id, nurse_name, nurse_surname, nurse_pwd, nurse_email
				            FROM " . $this->table . "
				            WHERE nurse_email = :nurse_email
				            LIMIT 0,1";
				 
				    // prepare the query
				    $stmt = $this->conn->prepare($query);
				 
				    // sanitize
				    $this->nurse_email=htmlspecialchars(strip_tags($this->nurse_email));
				 
				    // bind given email value
				    $stmt->bindParam(':nurse_email', $this->nurse_email);
				 
				    // execute the query
				    $stmt->execute();
				 
				    // get number of rows
				    $num = $stmt->rowCount();
				 
				    // if email exists, assign values to object properties for easy access and use for php sessions
				    if($num>0){
				 
				        // get record details / values
				        $row = $stmt->fetch(PDO::FETCH_ASSOC);
				 
				        // assign values to object properties
				        $this->nurse_id = $row['nurse_id'];
				        $this->nurse_name = $row['nurse_name'];
				        $this->nurse_surname = $row['nurse_surname'];
				        $this->nurse_pwd = $row['nurse_pwd'];
				        $this->nurse_email = $row['nurse_email'];
				 
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
		         nurse_name = :nurse_name,
		         nurse_surname = :nurse_surname,
		         nurse_email = :nurse_email, 
		         nurse_phone = :nurse_phone,
		         nurse_address = :nurse_address,
		         nurse_pwd = :nurse_pwd,

		         WHERE nurse_id = :nurse_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->nurse_name = htmlspecialchars(strip_tags($this->nurse_name));
		      $this->nurse_surname = htmlspecialchars(strip_tags($this->nurse_surname));
		      $this->nurse_email = htmlspecialchars(strip_tags($this->nurse_email));
		      $this->nurse_phone = htmlspecialchars(strip_tags($this->nurse_phone));
		      $this->nurse_address = htmlspecialchars(strip_tags($this->nurse_address));
		      $this->nurse_pwd = htmlspecialchars(strip_tags($this->nurse_pwd));

		      // Bind data
		      $stmt->bindParam(':nurse_name', $this->nurse_name);
		      $stmt->bindParam(':nurse_surname', $this->nurse_surname);
		      $stmt->bindParam(':nurse_email', $this->nurse_email);
		      $stmt->bindParam(':nurse_phone', $this->nurse_phone);
		      $stmt->bindParam(':nurse_address', $this->nurse_address);
		      $stmt->bindParam(':nurse_pwd', $this->nurse_pwd);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		  }

		  // Print error if something goes wrong
		  printf("Error: %s.\n", $stmt->error);

		  return false;
		}

		// Delete Patient
		public function delete() {
		      // Create query
		      $query = 'DELETE FROM ' . $this->table . ' WHERE nurse_id = :nurse_id';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->nurse_id = htmlspecialchars(strip_tags($this->nurse_id));

		      // Bind data
		      $stmt->bindParam(':nurse_id', $this->nurse_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		      }

		      // Print error if something goes wrong
		      printf("Error: %s.\n", $stmt->error);

		      return false;
		}
	}