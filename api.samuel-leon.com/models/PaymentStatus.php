<?php
	/**
	* 
	*/
	class PaymentStatus {

		private $conn;
		private $table = 'payment_status';


		//Payment Status properties
		public $pay_status_id;
		public $pay_method;
		public $pay_history;
		public $pat_id;
		
		
		//constructor with DB
		function __construct($db)
		{
			$this->conn=$db;
		}

		//get Payment Status
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
			$query = 'SELECT * FROM '.$this->table.' WHERE pay_status_id = :pay_status_id LIMIT 0,1';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//Bind ID
			$stmt->bindParam(':pay_status_id', $this->pay_status_id);

			//execute the query
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			//set properties
			$this->pay_status_id = $row['pay_status_id'];
			$this->pay_method = $row['pay_method'];
			$this->pay_history = $row['pay_history'];
			$this->pat_id = $row['pat_id'];
		}

		// Create Payment Status
		public function create() {
		      // Create query
		      $query = 'INSERT INTO ' . $this->table . '
		       SET
		         pay_method = :pay_method,
		         pay_history = :pay_history,
		         pat_id = :pat_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->pay_method = htmlspecialchars(strip_tags($this->pay_method));
		      $this->pay_history = htmlspecialchars(strip_tags($this->pay_history));
		      $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		      $stmt->bindParam(':pay_method', $this->pay_method);
		      $stmt->bindParam(':pay_history', $this->pay_history);
		      $stmt->bindParam(':pat_id', $this->pat_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		  }

		  // Print error if something goes wrong
		  printf("Error: %s.\n", $stmt->error);

		  return false;
		}


		// Update Payment Status
		public function update() {
		      // Create query
		      $query = 'UPDATE ' . $this->table . '
		       SET
		         pay_method = :pay_method,
		         pay_history = :pay_history,
		         pat_id = :pat_id

		         WHERE pay_status_id = :pay_status_id
		         ';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		    $this->pay_method = htmlspecialchars(strip_tags($this->pay_method));
		    $this->pay_history = htmlspecialchars(strip_tags($this->pay_history));
		    $this->pat_id = htmlspecialchars(strip_tags($this->pat_id));

		      // Bind data
		      $stmt->bindParam(':pay_method', $this->pay_method);
		      $stmt->bindParam(':pay_history', $this->pay_history);
		      $stmt->bindParam(':pat_id', $this->pat_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		  }

		  // Print error if something goes wrong
		  printf("Error: %s.\n", $stmt->error);

		  return false;
		}

		// Delete Payment Status
		public function delete() {
		      // Create query
		      $query = 'DELETE FROM ' . $this->table . ' WHERE pay_status_id = :pay_status_id';

		      // Prepare statement
		      $stmt = $this->conn->prepare($query);

		      // Clean data
		      $this->pay_status_id = htmlspecialchars(strip_tags($this->pay_status_id));

		      // Bind data
		      $stmt->bindParam(':pay_status_id', $this->pay_status_id);

		      // Execute query
		      if($stmt->execute()) {
		        return true;
		      }

		      // Print error if something goes wrong
		      printf("Error: %s.\n", $stmt->error);

		      return false;
		}
	}