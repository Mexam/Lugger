<?php
	
	// include lugger src file
	require_once(dirname(__FILE__)."/src/Lugger.php");
	
	// create an instance of class
	$lugger = new \Lugger\Log('logfile.txt');
	
	// constructor with custom configuration; separator and offMode
	//$lugger = new \Lugger\Log('logfile.txt', ', ', false);
	
	/*
	* error
	* info
	* debug
	* warning
	*/
	$lugger->error("And the last one, error function!");
	
?>