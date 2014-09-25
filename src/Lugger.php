<?php
	namespace Lugger;
	
	/*
	* Lightweight logging class 
	* Author	: Meisam Mirkahromi
	* Version	: 1.0
	* Copyright : no copyright, copy and paste as much as you can 
	*/
	
	class Log {
	
		/*
		* log strings' separator
		*/
		private $separator = '';
		
		/*
		* turn off/on logging 
		*/
		private $offMode = false;

		/*
		* log datatime format 
		*/
		private $dateFormat = 'M d G:i:s';
		
		/*
		* log types  
		*/
		const DEBUG 	= 'DEBUG';
		const INFO 		= 'INFO';
		const WARNING 	= 'WARNING';
		const ERROR 	= 'ERROR';
		
		/*
		* log file
		*/		
		private $file = null;
		
		/*
		* file access handler 
		*/		
		private $handler = null;

		/*
		* monitor lugger status 
		*/		
		private $status = array();
		
		/*
		* concstructor
		*
		* @param string $file as log file name
		* @param string $separator to be used as a separator in log records
		* @param bool $offMode to to specify loggin mode in on/off mode
		*
		*/
		function __construct($file, 
							$separator = ' - ', 
							$offMode = false) {
							
			$this->file = $file;
			$this->separator = $separator;
			$this->offMode = $offMode;
			
			if (!file_exists($this->file)) {
				array_push($this->status, 
					'File does not exist!');
				return;
			} 

			if (!is_writable($this->file)) {
				array_push($this->status, 
					'Access denied for writing log, check the permission!');
				return;
			}
			
			$this->handler = fopen($this->file, 'a');
		}
		
		/*
		*
		* main lugger function
		* @access private
		* @param string $message to be logged in the log file
		* @param enum $type to specify the type of log record
		* @return void
		*
		*/
		private function log($message, $type) {
			if ($this->handler && !$this->offMode) {
				$now = date($this->dateFormat);
				fwrite($this->handler, "{$now} {$type}{$this->separator}{$message}" . PHP_EOL);
			}
		}

		/*
		*
		* log function caller[s]
		* @access public
		* @param string $message to be logged in the log file
		* @return void
		*
		*/		
		function debug($message) {
			self::log($message, $this::DEBUG);
		}

		function info($message) {
			self::log($message, $this::INFO);
		}

		function warning($message) {
			self::log($message, $this::WARNING);
		}

		function error($message) {
			self::log($message, $this::ERROR);
		}		
		
		/*
		*
		* return lugger status
		* @access public
		* @return array 
		*
		*/				
		function getStatus() {
			return $this->status;
		}
		
		/*
		*
		* destructor
		*
		*/
		function __destruct() {
			if ($this->handler)
				fclose($this->handler);
		}		
	}
	
?>