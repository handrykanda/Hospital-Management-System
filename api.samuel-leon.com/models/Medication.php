<?php
	/**
	* 
	*/
	class Medication {

		private $conn;
		private $table = 'medication';


		//Medication properties
		public $med_id;
		public $med_name;
		public $med_price;
		public $pat_id;
		public $doc_id;
		
		
		//constructor with DB
		function __construct($db)
		{
			$this->conn=$db;
		}

		//get Medication
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
			$query = 'SELECT * FROM '.$this->table.' WHERE med_id = :med_id LIMIT 0,1';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//Bind ID
			$stmt->bindParam(':med_id', $this->med_id);

			//execute the query
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			//set properties
			$this->med_id = $row['med_id'];
			$this->med_name = $row['med_name'];
			$this->med_price = $row['med_price'];
			$this->doc_id = $row['doc_id'];
			$this->pat_id = $row['pat_id'];
		}

		// Create Medication
		public function create() {
		      // Create query
		      $query = 'INSERT INTO ' . $this->table . '
		       SET
		         med_name = :med_name,
		         med_price = :med_price,
		         doc_id = :doc_id, 
		         pat_id = :pat_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->med_name = htmlspecialchars(strip_tags($this->med_name));
		      $this->med_price = htmlspecialchars(strip_tags($this->med_price));
		      $this->doc_id = htmlspecialchars(strip_tags($this->doc_id));
		      $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		      $stmt->bindParam(':med_name', $this->med_name);
		      $stmt->bindParam(':med_price', $this->med_price);
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


		// Update Medication
		public function update() {
		      // Create query
		      $query = 'UPDATE ' . $this->table . '
		       SET
		         med_name = :med_name,
		         med_price = :med_price,
		         doc_id = :doc_id, 
		         pat_id = :pat_id

		         WHERE med_id = :med_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		     $this->med_name = htmlspecialchars(strip_tags($this->med_name));
		     $this->med_price = htmlspecialchars(strip_tags($this->med_price));
		     $this->doc_id = htmlspecialchars(strip_tags($this->doc_id));
		     $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		      $stmt->bindParam(':med_name', $this->med_name);
		      $stmt->bindParam(':med_price', $this->med_price);
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

		// Delete Medication
		public function delete() {
		      // Create query
		      $query = 'DELETE FROM ' . $this->table . ' WHERE med_id = :med_id';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->med_id = htmlspecialchars(strip_tags($this->med_id));

		      // Bind data
		      $stmt->bindParam(':med_id', $this->med_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		      }

		      // Print error if something goes wrong
		      printf("Error: %s.\n", $stmt->error);

		      return false;
		}
	}