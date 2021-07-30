<?php 


class Paginate {

//svojstva
 public $current_page;
 public $items_per_page;
 public $items_total_count;

	//konstruktor
	public function __construct($page=1, $items_per_page=4, $items_total_count=0 ){

		$this->current_page = (int)$page;
		$this->items_per_page = (int)$items_per_page;
		$this->items_total_count = (int)$items_total_count;


	}




	//metoda namjenjena za putanju naprijed u paginaciji
	public function next(){

		return $this->current_page + 1;


}

	//metoda namjenjena za putanju nazad u paginaciji
	public function previous(){

		return $this->current_page - 1;


}
	//recimo da želimo saznati koliko stranica trenutno imamo na stranici 
	public function page_total(){

		return ceil($this->items_total_count/$this->items_per_page);



}
	//Da li naša aplikacija ima narednu stranicu
	public function has_previous(){

		return $this->previous() >= 1 ? true : false;



	}


		public function has_next(){

		return $this->next() <= $this->page_total() ? true : false;



	}

		public function offset() {


		return ($this->current_page -1 ) * $this->items_per_page;


	}















} // Paginate Class







 ?>
