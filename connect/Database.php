<?php 

	/**
	 * Database Class
	 */
	class Database
	{
		public $con;
    	public $error;


		private function db_connect(){

			$DBHOST = "localhost";
			$DBNAME = "shopwise";
			$DBUSER = "root";
			$DBPASS = "barcelonareal1";
			$DBDRIVER = "mysql";

			try{
				$this->con = new PDO("$DBDRIVER:host=$DBHOST;dbname=$DBNAME",$DBUSER,$DBPASS);
			}catch(PDOException $e){
				echo $e->getMessage();
			}

			return $this->con;

		}

		public function select($query,$data = array()){

			$con = $this->db_connect();
			$stmt = $con->prepare($query);
			

			if ($stmt) {
				$check = $stmt->execute($data);

				if($check){

					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

					if (is_array($result) && count($result) > 0) {
						
						return $result;
					}
				}

			}

			return false;

		}

		// Create Data in to the database 

	    public function insert($query, $data = array()){

	    	$con = $this->db_connect();
			$stmt = $con->prepare($query);
			

			if ($stmt) {
				$check = $stmt->execute($data);

				if($check){
					
					return $check;
				}

			}

			return false;

	    }

	    
	    
	    
	    /// Update Data in to the database

	    public function update($query, $data = array()){
	    	$con = $this->db_connect();
			$stmt = $con->prepare($query);


		    if ($stmt) {
				$check = $stmt->execute($data);

				if($check){
					
					return $check;
					
				}

			}
			return false;
	    
	    }


	    

	    public function delete($query, $id = array()){

	    	$con = $this->db_connect();
			$stmt = $con->prepare($query);
			

			if ($stmt) {
				$check = $stmt->execute($id);

				if($check){
					
					return $check;
					exit();
				}

			}
			return false;

		}
	}