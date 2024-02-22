<?php
/**
 * Class Person
 * 
 * Represents a person with a name, date of birth, and role.
 */
class Person {
	private $name;
	private $dob;
	private $role;
	
	/**
	 * Person constructor.
	 *
	 * @param string $name The name of the person.
	 * @param string $dob The date of birth of the person.
	 * @param string $role The role of the person (default: 'hobbyist').
	 */
	function __construct($name, $dob, $role = 'hobbyist') {
		$this->name = $name;
		$this->dob = $dob;  
		$this->role = $role;
	}
	
	/**
	 * Get the name of the person.
	 *
	 * @return string The name of the person.
	 */
	public function get_name() {
		return $this->name;
	}
	
	/**
	 * Get the date of birth of the person.
	 *
	 * @return string The date of birth of the person.
	 */
	public function get_dob() {
		return $this->dob;
	}

	/**
	 * Get the role of the person.
	 *
	 * @return string The role of the person.
	 */
	public function get_role() {
		return $this->role;
	}
		
	/**
	 * Calculates and returns the age of the person.
	 *
	 * @return int The age of the person in years.
	 */
	public function get_age() {
		//Calculate age

		$dob = new Datetime($this->dob); // Create a new DateTime object using the date of birth.
		$today = new Datetime(date('Y-m-d')); // Create a new DateTime object for the current date.
		$age = $today->diff($dob); // Calculate the difference between the current date and the date of birth to get the age.
		
		//Return Age in Years
		return $age->y;
	}
}