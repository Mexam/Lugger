<?php
	
	// include lugger src file
	require_once(dirname(__FILE__)."/src/Lugger.php");
	
	
	
	/* create an instance of class
	* constructor with custom configuration; separator and offMode :
	* $lugger = new \Lugger\Log('logfile.txt', ', ', false);	
	*/
	$lugger = new \Lugger\Log('logfile.txt');
	
	
	
	/*
	* method list:
	* error
	* info
	* debug
	* warning
	*/
	$lugger->error("And the last one, error function!");
	
?>