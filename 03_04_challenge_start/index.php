<?php 
require 'Student.php';

function class_average( $students ) {
	$total = 0.00;
	foreach ($students as $student ) {
		$total += $student->get_gpa();
	}
	
	return $total / sizeof($students);
}