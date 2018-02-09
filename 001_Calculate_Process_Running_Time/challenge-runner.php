<?php
require __DIR__ . '/StateUtils.class.php';
require __DIR__ . '/SomeObject.class.php';

// Feel free to test your code here - we'll have our own tester to run the code
// you wrote in the StateUtils class.



// ===== THE TEST CASES =====

// TEST CASE 1
$startDate = date("U", strtotime("next week"));
$stopDate = null;
$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => null,
		'newState' => 'PAUSED'
	)
);

$answer1 = 0;
$testObject1 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer1<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";


// TEST CASE 2
$startDate = null;
$stopDate = null;
$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => null,
		'newState' => 'PAUSED'
	),
	array(
		'date' => date("U", strtotime("2015-10-16")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	)
);

$answer2 = time() - date("U", strtotime("2015-10-16"));
$testObject2 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer2<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

// TEST CASE 3
$startDate = null;
$stopDate = null;

$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => null,
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
	),
	array(
		'date' => date("U", strtotime("2015-10-18")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
);

$answer3 = time() - date("U", strtotime("2015-10-18")) + (24 * 60 * 60);
$testObject3 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer3<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";


// TEST CASE 4
$startDate = null;
$stopDate = null;

$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => null,
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
	),
	array(
		'date' => date("U", strtotime("2015-10-18")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
	array(
		'date' => date("U", strtotime("2015-10-18 12:00:00")),
		'oldState' => 'RUNNING',
		'newState' => 'PAUSED'
	),
	array(
		'date' => date("U", strtotime("2015-10-19")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
);

$answer4 = time() - date("U", strtotime("2015-10-19")) + (24 * 60 * 90);
$testObject4 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer4<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";


// TEST CASE 5
$startDate = null;
$stopDate = null;

$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => null,
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
	),
	array(
		'date' => date("U", strtotime("2015-10-18")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
	array(
		'date' => date("U", strtotime("2015-10-18 12:00:00")),
		'oldState' => 'RUNNING',
		'newState' => 'PAUSED'
	),
	array(
		'date' => date("U", strtotime("2015-10-19")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
	array(
		'date' => date("U", strtotime("2015-10-20")),
		'oldState' => 'RUNNING',
		'newState' => 'COMPLETE'
	)
);

$answer5 = (24 * 60 * 150);
$testObject5 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer5<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

// TEST CASE 6
$startDate = date("U", strtotime("2015-10-15"));
$stopDate = null;

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
	)
);

$answer6 = time() - date("U", strtotime("2015-10-15"));
$testObject6 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer6<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

// TEST CASE 7
$startDate = date("U", strtotime("2015-10-15"));
$stopDate = null;
$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-13")),
		'oldState' => null,
		'newState' => 'PAUSED'
	),
	array(
		'date' => date("U", strtotime("2015-10-16")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	)
);

$answer7 = time() - date("U", strtotime("2015-10-16"));
$testObject7 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer7<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

// TEST CASE 8
$startDate = date("U", strtotime("2015-10-17"));
$stopDate = null;
$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => null,
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
	),
	array(
		'date' => date("U", strtotime("2015-10-18")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
	array(
		'date' => date("U", strtotime("2015-10-18 12:00:00")),
		'oldState' => 'RUNNING',
		'newState' => 'PAUSED'
	),
	array(
		'date' => date("U", strtotime("2015-10-19")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
);

$answer8 = (time() - date("U", strtotime("2015-10-19"))) + (12 * 60 * 60);
$testObject8 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer8<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

// TEST CASE 9
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
	)
);

$answer9 = 24 * 60 * 60;
$testObject9 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer9<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

// TEST CASE 10
$startDate = null;
$stopDate = date("U", strtotime("2015-10-18"));
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
		'newState' => 'COMPLETE'
	)
);

$answer10 = 24 * 60 * 60;
$testObject10 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer10<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

//TEST CASE 11
$startDate = null;
$stopDate = null;
$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => null,
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
		'newState' => 'RUNNING'
	)
);

$answer11 = time() - date("U", strtotime("2015-10-16"));
$testObject11 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer11<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

// TEST CASE 12
$startDate = null;
$stopDate = null;
$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => null,
		'newState' => 'PAUSED'
	),
	array(
		'date' => date("U", strtotime("2015-10-15")) + 1800,
		'oldState' => 'PAUSED',
		'newState' => 'PAUSED'
	)
);

$answer12 = 0;
$testObject12 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer12<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";


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
	)/*,
	array(
		'date' => date("U", strtotime("2015-10-16")),
		'oldState' => 'PAUSED',
		'newState' => 'RUNNING'
	),
	array(
		'date' => date("U", strtotime("2015-10-17")),
		'oldState' => 'RUNNING',
		'newState' => 'PAUSED'
	)*/
);
$answer9 = 24 * 60 * 60;
$testObject9 = new SomeObject($statusLog, $startDate, $stopDate);
echo "Required: $answer9<br>";
echo "---actual  : ".StateUtils::calculateTimeInState($statusLog, $startDate, $stopDate)."<br><br>";

?>