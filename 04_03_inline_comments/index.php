<?php 
require 'Person.php';

function sort_people_by_age_and_name($people) {
	usort($people, function($a, $b) {
		// Compare by age first
		if ($a->get_age() != $b->get_age()) {
			return $a->get_age() - $b->get_age();
		}

		// If ages are equal, compare by name
		return strcmp($a->get_name(), $b->get_name());
	});

	return $people;
}

function separate_by_role($people) {
	$hobbyists = [];
	$professionals = [];

	foreach ($people as $person) {
		if ($person->get_role() == 'hobbyist') {
			$hobbyists[] = $person;
		} else if ($person->get_role() == 'professional') {
			$professionals[] = $person;
		}
	}

	return ['hobbyists' => $hobbyists, 'professionals' => $professionals];
}

$joe = new Person ('Joe', '1985-10-20' );
$phil = new Person ('Phil', '1987-07-12', 'professional' );
$erin = new Person ('Erin', '1991-08-28' );
$teresa = new Person ('Teresa', '2017-03-06', 'professional' );
$mike = new Person ('Mike', '1989-04-07' );
$louie = new Person ('Lou', '2020-07-12' );
$rob = new Person ('Rob', '1990-12-16' );
$abby = new Person ('Abby', '2022-12-24' );
$annie = new Person ('Annie', '1949-10-02', 'professional' );
$ben = new Person ('Ben', '1977-05-25' );
$peter = new Person ('Peter', '1962-08-10', 'professional' );
$diane = new Person ('Diane', '1990-04-08', 'professional' );

$people = [ $joe, $phil, $erin, $teresa, $mike, $louie, $rob, $abby, $annie, $ben, $peter, $diane ];

$sorted_people = sort_people_by_age_and_name($people);

foreach ($sorted_people as $person) {
	echo $person->get_name() . ' - ' . $person->get_age() . ' - ' . $person->get_role() . '<br>';
}

$separated_people = separate_by_role($sorted_people);

echo '<h2>Hobbyists</h2>';
foreach ($separated_people['hobbyists'] as $person) {
	echo $person->get_name() . ' - ' . $person->get_age() . ' - ' . $person->get_role() . '<br>';
}

echo '<h2>Professionals</h2>';
foreach ($separated_people['professionals'] as $person) {
	echo $person->get_name() . ' - ' . $person->get_age() . ' - ' . $person->get_role() . '<br>';
}