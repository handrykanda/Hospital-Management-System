<?php
	/**
	* 
	*/
	class Patient {

		private $conn;
		private $table = 'patient';


		//patient properties
		public $pat_id;
		public $pat_name;
		public $pat_surname;
		public $pat_email;
		public $pat_phone;
		public $pat_address;
		public $pat_pwd;
		public $pat_dob;
		public $pat_gender;
		public $pat_med_history;
		public $pat_surg_history;
		public $pat_med_current;
		public $pat_occupation;
		public $dia_red_flag;
		
		//constructor with DB
		function __construct($db)
		{
			$this->conn=$db;
		}

		//get patients
		public function read(){
			//create query
			$query = 'SELECT * FROM '. $this->table. '
			       ORDER BY pat_id DESC';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//execute the query
			$stmt->execute();

			return $stmt;

			
		}


		public function read_single(){

			//create query
			$query = 'SELECT * FROM '.$this->table.' WHERE pat_id = :pat_id LIMIT 0,1';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//Bind ID
			$stmt->bindParam(':pat_id', $this->pat_id);

			//execute the query
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			//set properties
			$this->pat_id = $row['pat_id'];
			$this->pat_name = $row['pat_name'];
			$this->pat_surname = $row['pat_surname'];
			$this->pat_email = $row['pat_email'];
			$this->pat_phone = $row['pat_phone'];
			$this->pat_address = $row['pat_address'];
			$this->pat_pwd = $row['pat_pwd'];
			$this->pat_dob = $row['pat_dob'];
			$this->pat_gender = $row['pat_gender'];
			$this->pat_med_history = $row['pat_med_history'];
			$this->pat_surg_history = $row['pat_surg_history'];
			$this->pat_med_current = $row['pat_med_current'];
			$this->pat_occupation = $row['pat_occupation'];
		}

		// Create Patient
		public function create() {
		      // Create query
		      $query = 'INSERT INTO ' . $this->table . '
		       SET
		         pat_name = :pat_name,
		         pat_surname = :pat_surname,
		         pat_email = :pat_email, 
		         pat_phone = :pat_phone,
		         pat_address = :pat_address,
		         pat_pwd = :pat_pwd,
		         pat_dob = :pat_dob,
		         pat_gender = :pat_gender,
		         pat_med_history = :pat_med_history,
		         pat_surg_history = :pat_surg_history,
		         pat_med_current = :pat_med_current,
		         pat_occupation = :pat_occupation
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean or sanitize data
		      $this->pat_name = htmlspecialchars(strip_tags($this->pat_name));
		      $this->pat_surname = htmlspecialchars(strip_tags($this->pat_surname));
		      $this->pat_email = htmlspecialchars(strip_tags($this->pat_email));
		      $this->pat_phone = htmlspecialchars(strip_tags($this->pat_phone));
		      $this->pat_address = htmlspecialchars(strip_tags($this->pat_address));
		      $this->pat_pwd = htmlspecialchars(strip_tags($this->pat_pwd));
		      $this->pat_dob = htmlspecialchars(strip_tags($this->pat_dob));
		      $this->pat_gender = htmlspecialchars(strip_tags($this->pat_gender));
		      $this->pat_med_history = htmlspecialchars(strip_tags($this->pat_med_history));
		      $this->pat_surg_history = htmlspecialchars(strip_tags($this->pat_surg_history));
		      $this->pat_med_current = htmlspecialchars(strip_tags($this->pat_med_current));
		      $this->pat_occupation = htmlspecialchars(strip_tags($this->pat_occupation));

		      // Bind data
		      $stmt->bindParam(':pat_name', $this->pat_name);
		      $stmt->bindParam(':pat_surname', $this->pat_surname);
		      $stmt->bindParam(':pat_email', $this->pat_email);
		      $stmt->bindParam(':pat_phone', $this->pat_phone);
		      $stmt->bindParam(':pat_address', $this->pat_address);

		      // hash the password before saving to database
		      $password_hash = password_hash($this->pat_pwd, PASSWORD_BCRYPT);
		      $stmt->bindParam(':pat_pwd', $this->pat_pwd);
		      $stmt->bindParam(':pat_dob', $this->pat_dob);
		      $stmt->bindParam(':pat_gender', $this->pat_gender);
		      $stmt->bindParam(':pat_med_history', $this->pat_med_history);
		      $stmt->bindParam(':pat_surg_history', $this->pat_surg_history);
		      $stmt->bindParam(':pat_med_current', $this->pat_med_current);
		      $stmt->bindParam(':pat_occupation', $this->pat_occupation);

		      // Execute query and also check if was successful
		      if($stmt->execute()) {
		        return true;
		  }else{
		  	// Print error if something goes wrong
		  	printf("Error: %s.\n", $stmt->error);

		  	return false;
		  }

		}


		// check if given email exist in the database
		function emailExists(){
		 
		    // query to check if email exists
		    $query = "SELECT pat_id, pat_name, pat_surname, pat_pwd, pat_email
		            FROM " . $this->table . "
		            WHERE pat_email = :pat_email
		            LIMIT 0,1";
		 
		    // prepare the query
		    $stmt = $this->conn->prepare($query);
		 
		    // sanitize
		    $this->pat_email=htmlspecialchars(strip_tags($this->pat_email));
		 
		    // bind given email value
		    $stmt->bindParam(':pat_email', $this->pat_email);
		 
		    // execute the query
		    $stmt->execute();
		 
		    // get number of rows
		    $num = $stmt->rowCount();
		 
		    // if email exists, assign values to object properties for easy access and use for php sessions
		    if($num>0){
		 
		        // get record details / values
		        $row = $stmt->fetch(PDO::FETCH_ASSOC);
		 
		        // assign values to object properties
		        $this->pat_id = $row['pat_id'];
		        $this->pat_name = $row['pat_name'];
		        $this->pat_surname = $row['pat_surname'];
		        $this->pat_pwd = $row['pat_pwd'];
		        $this->pat_email = $row['pat_email'];
		 
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
		         pat_name = :pat_name,
		         pat_surname = :pat_surname,
		         pat_email = :pat_email, 
		         pat_phone = :pat_phone,
		         pat_address = :pat_address,
		         pat_pwd = :pat_pwd,
		         pat_dob = :pat_dob,
		         pat_gender = :pat_gender,
		         pat_med_history = :pat_med_history,
		         pat_surg_history = :pat_surg_history,
		         pat_med_current = :pat_med_current,
		         pat_occupation = :pat_occupation

		         WHERE pat_id = :pat_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->pat_name = htmlspecialchars(strip_tags($this->pat_name));
		      $this->pat_surname = htmlspecialchars(strip_tags($this->pat_surname));
		      $this->pat_email = htmlspecialchars(strip_tags($this->pat_email));
		      $this->pat_phone = htmlspecialchars(strip_tags($this->pat_phone));
		      $this->pat_address = htmlspecialchars(strip_tags($this->pat_address));
		      $this->pat_pwd = htmlspecialchars(strip_tags($this->pat_pwd));
		      $this->pat_dob = htmlspecialchars(strip_tags($this->pat_dob));
		      $this->pat_gender = htmlspecialchars(strip_tags($this->pat_gender));
		      $this->pat_med_history = htmlspecialchars(strip_tags($this->pat_med_history));
		      $this->pat_surg_history = htmlspecialchars(strip_tags($this->pat_surg_history));
		      $this->pat_med_current = htmlspecialchars(strip_tags($this->pat_med_current));
		      $this->pat_occupation = htmlspecialchars(strip_tags($this->pat_occupation));
		      $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		      $stmt->bindParam(':pat_name', $this->pat_name);
		      $stmt->bindParam(':pat_surname', $this->pat_surname);
		      $stmt->bindParam(':pat_email', $this->pat_email);
		      $stmt->bindParam(':pat_phone', $this->pat_phone);
		      $stmt->bindParam(':pat_address', $this->pat_address);
		      $stmt->bindParam(':pat_pwd', $this->pat_pwd);
		      $stmt->bindParam(':pat_dob', $this->pat_dob);
		      $stmt->bindParam(':pat_gender', $this->pat_gender);
		      $stmt->bindParam(':pat_med_history', $this->pat_med_history);
		      $stmt->bindParam(':pat_surg_history', $this->pat_surg_history);
		      $stmt->bindParam(':pat_med_current', $this->pat_med_current);
		      $stmt->bindParam(':pat_occupation', $this->pat_occupation);
		      $stmt->bindParam(':pat_id', $this->pat_id);

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
		      $query = 'DELETE FROM ' . $this->table . ' WHERE pat_id = :pat_id';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		      $stmt->bindParam(':pat_id', $this->pat_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		      }

		      // Print error if something goes wrong
		      printf("Error: %s.\n", $stmt->error);

		      return false;
		}
	}