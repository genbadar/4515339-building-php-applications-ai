<?php
use PHPUnit\Framework\TestCase;
require 'Person.php';

class PersonTest extends TestCase {
    public function testGetAge() {
        // Arrange
        $dob = date('Y-m-d', strtotime('-30 years'));
        $person = new Person('Test', $dob);

        // Act
        $age = $person->get_age();

        // Assert
        $this->assertEquals(30, $age);
    }

	public function testGetName() {
        $person = new Person('Test', '2000-01-01', 'hobbyist');
        $name = $person->get_name();
        $this->assertEquals('Test', $name);
    }

    public function testGetDob() {
        $person = new Person('Test', '2000-01-01', 'hobbyist');
        $dob = $person->get_dob();
        $this->assertEquals('2000-01-01', $dob);
    }

    public function testGetRole() {
        $person = new Person('Test', '2000-01-01', 'hobbyist');
        $role = $person->get_role();
        $this->assertEquals('hobbyist', $role);
    }

    public function testRoleDefault() {
        $person = new Person('Test', '2000-01-01');
        $role = $person->get_role();
        $this->assertEquals('hobbyist', $role);
    }
}