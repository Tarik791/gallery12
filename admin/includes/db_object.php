<?php 




class Db_object {


//niz u kojem se nalaze poruke za gre
public $errors = array();
public $upload_errors_array = array(


	UPLOAD_ERR_OK           => "There is no error",
	UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
	UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
	UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
	UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
	UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
	UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
	UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."					
												

);



//this is passing $_FILES['uploaded_file'] as an argument
//uz pomoć ove metode postavljamo fajl
	public function set_file($file) { 

		//ako je fajl prazan ili ako nije fajl ili ako nije niz fajl, prikazat će se error poruka
		if(empty($file) || !$file || !is_array($file)) {

		//Ali ako ima pogrešku, mi tu pogrešku uzimamo i spremamo u svoj niz 	
		$this->errors[] = "There was no file uploaded here";


		return false;


		//na primjer, ako strelica nije jednaka 0 i 0 znači da strelica uopće nema, u redu, pa ako nema pogrešaka, uvijek će se proći.
		}elseif($file['error'] !=0) {

		//Ali ako ima pogrešku, mi tu pogrešku uzimamo i spremamo u svoj niz 
		$this->errors[] = $this->upload_errors_array[$file['error']];
		
		return false;

		} else {

		//specifični ključ oko super globalnog imena datoteke svojstva objekta 
		$this->user_image =  basename($file['name']);
		$this->tmp_path = $file['tmp_name'];
		$this->type     = $file['type'];
		$this->size     = $file['size'];


		}



}

	//uz pomoć ove metode pronalazimo sve iz tabela koji se nalaze u bazi podataka
	public static function find_all() {

		//uz pomoć static metode pozivamo find_by_query metodu u kroj koju mozemo pozvati bilo koji query
		return static::find_by_query("SELECT * FROM " . static::$db_table . " ");


		}

	
	//Uz pomoć ove metode pronalazak se vrši po id-u
	public static function find_by_id($id) {

		//globalna varijabla za bazu podataka
		global $database;

		//query pronalazak korisnika iz tabele, uz pomoć static metode, korisnika po id-u
		$the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");

		//ternary operator
		return !empty($the_result_array) ? array_shift($the_result_array) : false;

		
		}



	//metodu koju možemo proslijediti u bilo kojem querreyu
	public static function find_by_query($sql) {

		global $database;

		$result_set = $database->query($sql);

		$the_object_array = array();

		while($row = mysqli_fetch_array($result_set)) {

		$the_object_array[] = static::instantation($row);

		}

		return $the_object_array;

		}

	//ova metoda sluzi za instanciranje parametara, pronalazak korisnika
	public static function instantation($the_record){

		//dobivanje imena klase koja poziva statička metoda
		$calling_class = get_called_class();

		//sada će instancirati klasu kodiranja umjesto da instantira klasu Db_object
		$the_object = new $calling_class;


		foreach ($the_record as $the_attribute => $value) {

		if($the_object->has_the_attribute($the_attribute)) {

			$the_object->$the_attribute = $value;


			}

			
		}



	    return $the_object;
	} 

	//stvaranje metode uz pomoć kojeg saznajemo da li je objekt stvarno ili netacno pravo
	private function has_the_attribute($the_attribute) {

		// $object_properties = get_object_vars($this);

		// return array_key_exists($the_attribute, $object_properties);

		return property_exists($this, $the_attribute);



	}


	//ova metoda izvlači sva svojstva iz ove klase 
	protected function properties() {


		$properties = array();


		//želimo izvršiti brzu provjeru da bismo vidjeli da svojstvo postoji i ako postoji želimo potpisati vrijednost 
		foreach (static::$db_table_fields  as $db_field) {

			if(property_exists($this, $db_field)) {

				//pa sada ono što želimo učiniti je da to ovdje potpišemo u taj niz 
				$properties[$db_field] = $this->$db_field;

			}
			
		}

		return $properties;

	}


		//metoda namjenjena za čiščenje svojstava
		protected function clean_properties() {
		global $database;

		//dodjeljujemo vrijednost ovdje
		$clean_properties = array();

		//izvlačimo ključne vrijednosti iz propertiesa, svojstva.
		foreach ($this->properties() as $key => $value) {
			
			//a zatim čistimo svoju vrijednost dodjeljumeo vrijednost nizu
			$clean_properties[$key] = $database->escape_string($value);


		}

		return $clean_properties ;






	}



//ako je istina update-ovati će se, ako nije kreirati će se 
public function save() {

	return isset($this->id) ? $this->update() : $this->create();

	}


	//stvorili smo metodu za kreiranje, unos tabelu podatak.
	public function create() {
		global $database;


		$properties = $this->clean_properties();

		//ivrsili smo apstrakciju implodiramo što znači da svaku vrijednost odvajamo zarezom, a zatim koristimo ključeve,  a zatim pomoću kljuceva izvlačimo ključeve niza
		$sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";

		//izvrsili smo apstrakciju, stavljamo sve vrijednosti
		$sql .= "VALUES ('". implode("','", array_values($properties)) ."')";

		//saljemo query
		if($database->query($sql)) {
			
			//izvlačimo id iz posljednjeg query-a
			$this->id = $database->the_insert_id();

			return true;

		} else {

			return false;


		}

	


	} // Create Method


	//metoda za update-ovanje podataka
	public function update() {
		global $database;


		$properties = $this->clean_properties();

		$properties_pairs = array();

		foreach ($properties as $key => $value) {
			$properties_pairs[] = "{$key}='{$value}'";
		}

        //abstraktovana update metoda 
		$sql = "UPDATE  " .static::$db_table . "  SET ";
		$sql .= implode(", ", $properties_pairs);
		$sql .= " WHERE id= " . $database->escape_string($this->id);

		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;



	} // end of the update method



    	//metoda za brisanje podataka
		public function delete() { 
			global $database;


			$sql = "DELETE FROM  " .static::$db_table . "  ";
			$sql .= "WHERE id=" . $database->escape_string($this->id);
			$sql .= " LIMIT 1";

			$database->query($sql);

			return (mysqli_affected_rows($database->connection) == 1) ? true : false;





		}

		//ova metoda nam je kao brojač
		public static function count_all() {

			global $database;

			//count funckija nam omogućava brojanje svih redova
			$sql = "SELECT COUNT(*) FROM " . static::$db_table;
			$result_set = $database->query($sql);
			$row = mysqli_fetch_array($result_set);

			return array_shift($row);


		}

    	//metoda namjenjena za brisanje fotografije    
		public function delete_photo() {

		//ako je istina, fotografija će se obrisati
		if($this->delete()) {

			//Upravo sam napravio ovu varijablu ovdje - $target_path
			//SITE_ROOT konstanta koja ima čitav put do web mjesta na mom računalu 
			//. DS . separator
			//admin - spajamo folder
			//upload_directory lokacija za fajlove
			$target_path = SITE_ROOT.DS. 'admin' . DS . $this->picture_path();

			//uz pomoć unlink funckije brišemo fajl
			return unlink($target_path) ? true : false;


		} else {

			return false;


		}




	}








}
