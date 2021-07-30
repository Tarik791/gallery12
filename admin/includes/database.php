<?php 

require_once("config.php");
if(!$connection = new PDO("mysql:host=localhost;dbname=gallery_db", "root", "")){

	die("could not connect to database");
}
class Database {


	public $connection;


	function __construct(){

     $this->open_db_connection();

	 

	
	}




	public function open_db_connection(){


	// $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		
		
			$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			if (!$this->connection) {
			  # code...
			  die("Connection to database failed" . mysqli_errno($this->connection));
			}else{
			  /// this is the part you should take note of i changed the sql mode here using this code 
			  mysqli_query($this->connection, "SET GLOBAL sql_mode = ''");
	
	
			}

	

		}




	public function query($sql) {

	$result = $this->connection->query($sql);

	$this->confirm_query($result);

	return $result; 


	}

	private function confirm_query($result){


		if(!$result) {

			die("Query Failed" . $this->connection->error);

		}

	}

	public function escape_string($string) {


	 $escaped_string = $this->connection->real_escape_string($string);

	 return $escaped_string;


	}



	public function the_insert_id() {

	return $this->connection->insert_id;

	}





}  // End of Class Database


$database = new Database();



 ?>