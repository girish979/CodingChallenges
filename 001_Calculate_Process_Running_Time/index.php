<?php
require __DIR__ . '/StateUtils.class.php';
require __DIR__ . '/SomeObject.class.php';

// Feel free to test your code here - we'll have our own tester to run the code
// you wrote in the StateUtils class.



// ===== THE TEST CASES =====
// TEST CASE 13
$startDate = null;
$stopDate = date("U", strtotime("2015-10-15"));
$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-13")),
		'oldState' => null,
		'newState' => 'PAUSED'
	),
	array(
		'date' => date("U", strtotime("2015-10-14")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => 'RUNNING',
		'newState' => 'PAUSED'
	),
	array(
		'date' => date("U", strtotime("2015-10-16")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
	array(
		'date' => date("U", strtotime("2015-10-17")),
		'oldState' => 'RUNNING',
		'newState' => 'PAUSED'
	)
);
$answer9 = 24 * 60 * 60;
$testObject9 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer9<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

?>