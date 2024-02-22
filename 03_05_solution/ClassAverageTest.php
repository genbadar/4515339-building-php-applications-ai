<?php
use PHPUnit\Framework\TestCase;
require 'Student.php';

function class_average( $students ) {
	$total = 0.00;
	foreach ($students as $student ) {
		$total += $student->get_gpa();
	}
	
	return $total / sizeof($students);
}

class ClassAverageTest extends TestCase {
    public function testClassAverage() {
        $students = [];

        // Create some Student objects with known GPAs for testing
        for ($i = 1; $i <= 5; $i++) {
            $student = new Student("Student$i", "2000-01-01", "2025", $i);
            $students[] = $student;
        }

        // The average GPA of the students should be 3.0
        $this->assertEquals(3.0, class_average($students));
    }
}