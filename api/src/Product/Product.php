<?php 

namespace App\Product;

class Product {
	private $name="Undefined";

	public function __construct($name=null){
		if($name!==null){
			$this->name = $name;			
		}
	}

	public function getName(){
		return $this->name;
	}
}