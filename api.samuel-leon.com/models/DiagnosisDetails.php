<?php
	/**
	* 
	*/
	class DiagnosisDetails {

		private $conn;
		private $table = 'diagnosis_details';


		//Diagnosis Details 
		public $dia_id;
		public $dia_red_flag;
		public $dia_date;
		public $dia_weight;
		public $dia_bp;
		public $dia_temp;
		public $dia_blood_type;
		public $dia_blood_count;
		public $dia_glucose_tolerance;
		public $dia_pulse;
		public $pat_id;
		public $nurse_id;
		
		//constructor with DB
		function __construct($db)
		{
			$this->conn=$db;
		}

		//get diagnosis details
		public function read(){
			//create query
			$query = 'SELECT 
				diagnosis_details.dia_id,
				diagnosis_details.dia_date,
				diagnosis_details.dia_weight,
				diagnosis_details.dia_bp,
				diagnosis_details.dia_temp,
				diagnosis_details.dia_blood_type,
				diagnosis_details.dia_blood_count,
				diagnosis_details.dia_glucose_tolerance,
				diagnosis_details.dia_pulse,
				patient.pat_id,
				patient.pat_name,
				patient.pat_surname,
				patient.pat_email
			 FROM '.$this->table.'
			 INNER JOIN patient
			 ON patient.pat_id = diagnosis_details.pat_id
			 ';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//execute the query
			$stmt->execute();

			return $stmt;
		}

		public function read_single(){

			//create query
			$query = 'SELECT * FROM '.$this->table.'
			 WHERE pat_id = :pat_id LIMIT 0,1';


			//prepare statement
			$stmt = $this->conn->prepare($query);

			//Bind ID
			$stmt->bindParam(':pat_id', $this->pat_id);

			//execute the query
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			//set properties
			$this->dia_id = $row['dia_id'];
			$this->dia_red_flag = $row['dia_red_flag'];
			$this->dia_date = $row['dia_date'];
			$this->dia_weight = $row['dia_weight'];
			$this->dia_bp = $row['dia_bp'];
			$this->dia_temp = $row['dia_temp'];
			$this->dia_blood_type = $row['dia_blood_type'];
			$this->dia_blood_count = $row['dia_blood_count'];
			$this->dia_glucose_tolerance = $row['dia_glucose_tolerance'];
			$this->dia_pulse = $row['dia_pulse'];
			$this->pat_id = $row['pat_id'];
			$this->nurse_id = $row['nurse_id'];
		}

		// Create Patient
		public function create() {
		      // Create query
		      $query = 'INSERT INTO ' . $this->table . '
		       SET
		         dia_red_flag = :dia_red_flag,
		         dia_date = :dia_date,
		         dia_weight = :dia_weight, 
		         dia_bp = :dia_bp,
		         dia_temp = :dia_temp,
		         dia_blood_type = :dia_blood_type,
		         dia_blood_count = :dia_blood_count,
		         dia_glucose_tolerance = :dia_glucose_tolerance,
		         dia_pulse = :dia_pulse,
		         nurse_id = :nurse_id,
		         pat_id = :pat_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->dia_red_flag = htmlspecialchars(strip_tags($this->dia_red_flag));
		      $this->dia_date = htmlspecialchars(strip_tags($this->dia_date));
		      $this->dia_weight = htmlspecialchars(strip_tags($this->dia_weight));
		      $this->dia_bp = htmlspecialchars(strip_tags($this->dia_bp));
		      $this->dia_temp = htmlspecialchars(strip_tags($this->dia_temp));
		      $this->dia_blood_type = htmlspecialchars(strip_tags($this->dia_blood_type));
		      $this->dia_blood_count = htmlspecialchars(strip_tags($this->dia_blood_count));
		      $this->dia_glucose_tolerance = htmlspecialchars(strip_tags($this->dia_glucose_tolerance));
		      $this->dia_pulse = htmlspecialchars(strip_tags($this->dia_pulse));
		      $this->nurse_id = htmlspecialchars(strip_tags($this->nurse_id));
		      $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		      $stmt->bindParam(':dia_red_flag', $this->dia_red_flag);
		      $stmt->bindParam(':dia_date', $this->dia_date);
		      $stmt->bindParam(':dia_weight', $this->dia_weight);
		      $stmt->bindParam(':dia_bp', $this->dia_bp);
		      $stmt->bindParam(':dia_temp', $this->dia_temp);
		      $stmt->bindParam(':dia_blood_type', $this->dia_blood_type);
		      $stmt->bindParam(':dia_blood_count', $this->dia_blood_count);
		      $stmt->bindParam(':dia_glucose_tolerance', $this->dia_glucose_tolerance);
		      $stmt->bindParam(':dia_pulse', $this->dia_pulse);
		      $stmt->bindParam(':nurse_id', $this->nurse_id);
		      $stmt->bindParam(':pat_id', $this->pat_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		  }

		  // Print error if something goes wrong
		  printf("Error: %s.\n", $stmt->error);

		  return false;
		}


		// Update diagnosis details
		public function update() {
		      // Create query
		      $query = 'UPDATE ' . $this->table . '
		       SET
		        dia_date = :dia_date,
		        dia_red_flag = :dia_red_flag,
		        dia_weight = :dia_weight, 
		        dia_bp = :dia_bp,
		        dia_temp = :dia_temp,
		        dia_blood_type = :dia_blood_type,
		        dia_blood_count = :dia_blood_count,
		        dia_glucose_tolerance = :dia_glucose_tolerance,
		        dia_pulse = :dia_pulse,
		        nurse_id = :nurse_id,
		        pat_id = :pat_id
		         WHERE dia_id = :dia_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		     $this->dia_id = htmlspecialchars(strip_tags($this->dia_id));
		     $this->dia_date = htmlspecialchars(strip_tags($this->dia_date));
		     $this->dia_red_flag = htmlspecialchars(strip_tags($this->dia_red_flag));
		     $this->dia_weight = htmlspecialchars(strip_tags($this->dia_weight));
		     $this->dia_bp = htmlspecialchars(strip_tags($this->dia_bp));
		     $this->dia_temp = htmlspecialchars(strip_tags($this->dia_temp));
		     $this->dia_blood_type = htmlspecialchars(strip_tags($this->dia_blood_type));
		     $this->dia_blood_count = htmlspecialchars(strip_tags($this->dia_blood_count));
		     $this->dia_glucose_tolerance = htmlspecialchars(strip_tags($this->dia_glucose_tolerance));
		     $this->dia_pulse = htmlspecialchars(strip_tags($this->dia_pulse));
		     $this->nurse_id = htmlspecialchars(strip_tags($this->nurse_id));
		     $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		     $stmt->bindParam(':dia_id', $this->dia_id);
		     $stmt->bindParam(':dia_date', $this->dia_date);
		     $stmt->bindParam(':dia_red_flag', $this->dia_red_flag);
		     $stmt->bindParam(':dia_weight', $this->dia_weight);
		     $stmt->bindParam(':dia_bp', $this->dia_bp);
		     $stmt->bindParam(':dia_temp', $this->dia_temp);
		     $stmt->bindParam(':dia_blood_type', $this->dia_blood_type);
		     $stmt->bindParam(':dia_blood_count', $this->dia_blood_count);
		     $stmt->bindParam(':dia_glucose_tolerance', $this->dia_glucose_tolerance);
		     $stmt->bindParam(':dia_pulse', $this->dia_pulse);
		     $stmt->bindParam(':nurse_id', $this->nurse_id);
		     $stmt->bindParam(':pat_id', $this->pat_id);

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
		      $query = 'DELETE FROM ' . $this->table . ' WHERE dia_id = :dia_id';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->dia_id = htmlspecialchars(strip_tags($this->dia_id));

		      // Bind data
		      $stmt->bindParam(':dia_id', $this->dia_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		      }

		      // Print error if something goes wrong
		      printf("Error: %s.\n", $stmt->error);

		      return false;
		}
	}