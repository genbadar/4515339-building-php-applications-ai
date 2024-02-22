<?php 
require 'Student.php';

function class_average( $students ) {
	$total = 0.00;
	foreach ($students as $student ) {
		$total += $student->get_gpa();
	}
	
	return $total / sizeof($students);
}

$students = [];

for ($i = 0; $i < 30; $i++) {
    $name = "Student" . $i;
    $dob = date('Y-m-d', strtotime('-' . rand(10, 30) . ' years'));
    $graduation_year = date('Y', strtotime('+' . rand(1, 5) . ' years'));
    $gpa = rand(0, 400) / 100.0;

    $student = new Student($name, $dob, $graduation_year, $gpa);
    $students[] = $student;
}

$malformedData = [
    ["Student31", "2000-02-30", "2025", "3.8"], // Invalid date
    ["Student32", "2000-13-01", "2025", "3.8"], // Invalid month
    ["Student33", "200018-12-01", "2025", "3.8"], // Long year
    ["Student34", "2000-12-01", "202525", "3.8"], // Long graduation year
    ["Student35", "2000-12-01", "2025", "3.8.8"], // Malformed GPA
    ["Student36", "2000-12-01", "2025", "GPA"], // Non-numeric GPA
    ["Student37", "2000-12-01", "Graduation Year", "3.8"], // Non-numeric graduation year
    ["Student38", "Date of Birth", "2025", "3.8"], // Non-date dob
    ["Student39", "2000-12-01", "2025", 3.8], // Correct data for control
    ["Student40", "", "", ""], // Empty data
];

foreach ($malformedData as $data) {
    $student = new Student($data[0], $data[1], $data[2], $data[3]);
    $students[] = $student;
}

// Now you can use the $students array to test the properties and functions of the Student class
// For example, print the name, age, graduation year, and GPA of each student
foreach ($students as $student) {
	echo "Name: " . $student->get_name() . "<br/>";
	echo "Age: " . $student->get_age() . "<br/>";
	echo "Graduation Year: " . $student->get_graduation_year() . "<br/>";
	echo "GPA: " . $student->get_gpa() . "<br/>";
	echo "-----------------<br/>";
}