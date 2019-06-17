<?php
	/**
	* 
	*/
	class ConsultationDetails {

		private $conn;
		private $table = 'consultation_details';


		//consultation details properties
		public $con_id;
		public $con_pc;
		public $con_hpc;
		public $con_drug_history;
		public $con_date;
		public $pat_id;
		public $doc_id;
		
		
		//constructor with DB
		function __construct($db)
		{
			$this->conn=$db;
		}

		//get consultation details
		public function read(){
			//create query
			$query = 'SELECT 
				consultation_details.con_id,
				consultation_details.con_pc,
				consultation_details.con_hpc,
				consultation_details.con_drug_history,
				consultation_details.con_date,
				patient.pat_id,
				patient.pat_name,
				patient.pat_surname,
				patient.pat_email
			 FROM '.$this->table.'
			 INNER JOIN patient
			 ON patient.pat_id = consultation_details.pat_id
			 ';

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
			$this->con_id = $row['con_id'];
			$this->con_pc = $row['con_pc'];
			$this->con_hpc = $row['con_hpc'];
			$this->con_drug_history = $row['con_drug_history'];
			$this->con_date = $row['con_date'];
			$this->doc_id = $row['doc_id'];
			$this->pat_id = $row['pat_id'];

		}

		// Create consultation details
		public function create() {
		      // Create query
		      $query = 'INSERT INTO ' . $this->table . '
		       SET
		         con_pc = :con_pc,
		         con_hpc = :con_hpc,
		         con_drug_history = :con_drug_history, 
		         con_date = :con_date,
		         doc_id = :doc_id,
		         pat_id = :pat_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->con_pc = htmlspecialchars(strip_tags($this->con_pc));
		      $this->con_hpc = htmlspecialchars(strip_tags($this->con_hpc));
		      $this->con_drug_history = htmlspecialchars(strip_tags($this->con_drug_history));
		      $this->con_date = htmlspecialchars(strip_tags($this->con_date));
		      $this->doc_id = htmlspecialchars(strip_tags($this->doc_id));
		      $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		      $stmt->bindParam(':con_pc', $this->con_pc);
		      $stmt->bindParam(':con_hpc', $this->con_hpc);
		      $stmt->bindParam(':con_drug_history', $this->con_drug_history);
		      $stmt->bindParam(':con_date', $this->con_date);
		      $stmt->bindParam(':doc_id', $this->doc_id);
		      $stmt->bindParam(':pat_id', $this->pat_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		  }

		  // Print error if something goes wrong
		  printf("Error: %s.\n", $stmt->error);

		  return false;
		}


		// Update consultation details
		public function update() {
		      // Create query
		      $query = 'UPDATE ' . $this->table . '
		       SET
		         con_pc = :con_pc,
		         con_hpc = :con_hpc,
		         con_drug_history = :con_drug_history, 
		         con_date = :con_date,
		         doc_id = :doc_id,
		         pat_id = :pat_id

		         WHERE con_id = :con_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		     $this->con_id = htmlspecialchars(strip_tags($this->con_id));
		     $this->con_pc = htmlspecialchars(strip_tags($this->con_pc));
		     $this->con_hpc = htmlspecialchars(strip_tags($this->con_hpc));
		     $this->con_drug_history = htmlspecialchars(strip_tags($this->con_drug_history));
		     $this->con_date = htmlspecialchars(strip_tags($this->con_date));
		     $this->doc_id = htmlspecialchars(strip_tags($this->doc_id));
		     $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		     $stmt->bindParam(':con_id', $this->con_id);
		     $stmt->bindParam(':con_pc', $this->con_pc);
		     $stmt->bindParam(':con_hpc', $this->con_hpc);
		     $stmt->bindParam(':con_drug_history', $this->con_drug_history);
		     $stmt->bindParam(':con_date', $this->con_date);
		     $stmt->bindParam(':doc_id', $this->doc_id);
		     $stmt->bindParam(':pat_id', $this->pat_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		  }

		  // Print error if something goes wrong
		  printf("Error: %s.\n", $stmt->error);

		  return false;
		}

		// Delete consultation details
		public function delete() {
		      // Create query
		      $query = 'DELETE FROM ' . $this->table . ' WHERE con_id = :con_id';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->con_id = htmlspecialchars(strip_tags($this->con_id));

		      // Bind data
		      $stmt->bindParam(':con_id', $this->con_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		      }

		      // Print error if something goes wrong
		      printf("Error: %s.\n", $stmt->error);

		      return false;
		}
	}