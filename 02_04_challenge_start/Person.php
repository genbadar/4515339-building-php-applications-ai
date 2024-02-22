<?php
class Person {
		private $name;
		private $dob;
		private $role;
		
		function __construct($name, $dob, $role = 'hobbyist') {
			$this->name = $name;
			$this->dob = $dob;	
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