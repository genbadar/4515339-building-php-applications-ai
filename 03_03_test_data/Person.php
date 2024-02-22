<?php
class Person {
		private $name;
		private $dob;
		private $role;
		
		function __construct($name, $dob, $role = 'hobbyist') {
			$this->name = $name;
			try {
				$dobDateTime = new DateTime($dob);
				$this->dob = $dobDateTime->format('Y-m-d');
			} catch (Exception $e) {
				// Handle the exception or throw a custom exception
				// For example, you can set $this->dob to null or throw an InvalidArgumentException
				$this->dob = null;
				// Or throw an exception
				// throw new InvalidArgumentException('Invalid date of birth');
			}
			$this->role = $role;
		}
		
		public function get_name() {
			return $this->name;
		}
		
		public function get_dob() {
			return $this->dob;
		}

		public function get_role() {
			return $this->role;
		}
		
		public function get_age() {
			//Calculate age
			$dob = new Datetime($this->dob);
			$today = new Datetime(date('Y-m-d'));
			$age = $today->diff($dob);
			
			//Return Age in Years
			return $age->y;
		}
	}