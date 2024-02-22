<?php
require_once 'Person.php'; // Assuming Person class is in Person.php

$persons = [];

// Create 20 Person objects with different data
for ($i = 0; $i < 20; $i++) {
	$name = "Person" . $i;
	$dob = date('Y-m-d', strtotime("-" . (20 + $i) . " years")); // Age will range from 20 to 39
	$role = $i % 2 == 0 ? 'hobbyist' : 'professional'; // Alternate roles

	$persons[] = new Person($name, $dob, $role);
}

$malformedData = [
    ["Person21", "2000-02-30", "hobbyist"], // Invalid date
    ["Person22", "2000-02-28T00:00:00", "hobbyist"], // Date with time
    ["Person23", "2000/02/28", "hobbyist"], // Date with wrong format
    ["Person24", "2000-02-28", "hobbyist#"], // Role with special character
    ["Person25", "2000-02-28", "hobbyist hobbyist"], // Role with space
    ["Person26", "2000-02-28", ""], // Empty role
    ["Person27", "", "hobbyist"], // Empty name
];

// Add Person objects with malformed data
foreach ($malformedData as $data) {
	$persons[] = new Person($data[0], $data[1], $data[2]);
}


// Test each function and find issues with the code
foreach ($persons as $person) {
	echo "Name: " . $person->get_name() . "<br/>";
	echo "DOB: " . $person->get_dob() . "<br/>";
	echo "Role: " . $person->get_role() . "<br/>";
	echo "Age: " . $person->get_age() . "<br/>";
	echo "--------------------<br/>";

	// Check if DOB is a valid date
	if (!DateTime::createFromFormat('Y-m-d', $person->get_dob())) {
		echo "Error: Invalid DOB format. Expected 'Y-m-d'.\n";
	}

	// Check if age calculation is correct
	$expectedAge = date('Y') - date('Y', strtotime($person->get_dob()));
	if ($person->get_age() != $expectedAge) {
		echo "Error: Age calculation is incorrect.\n";
	}

	echo "\n";
}
?>