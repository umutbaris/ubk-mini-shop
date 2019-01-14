<?php

new Success;
/**
 * Success page is rendering when order completed
 */
class Success {

	function __construct() {
		$this->successful();
	 }
	 /**
	  * Get image form api and show
	  *
	  * @return void
	  */
	 public function successful () {
		$data = json_decode(file_get_contents('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?json=1'), true); 
		echo $data['page']['content'];
	 }
}
