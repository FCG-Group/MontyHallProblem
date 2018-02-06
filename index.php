<?php

function pre($s)
{
	echo '<pre>';
	print_r($s);
	echo '</pre>';
}

$result = ['no_change_win'=>0,'no_change_loss'=>0,'no_change_win_percent'=>0, 'change_win'=>0,'change_loss'=>0,'change_win_percent'=>0, ];

function MontyHallProblem($choice_change = false, $cycle_count = 1000, $doors_count = 3)
{
	global $result;

	if (!$doors_count) $doors_count = 1;
	if (!$cycle_count) $cycle_count = 1;

	for ($i = 0; $i < $cycle_count; $i++)
	{
		$car_door = rand(1, $doors_count);
		$player_first_choice = rand(1, $doors_count);

		if ($choice_change)
		{
			while( in_array( ($shoman_open_door = rand(1,$doors_count)), array($player_first_choice, $car_door) ) );
			while( in_array( ($player_second_choice = rand(1,$doors_count)), array($player_first_choice, $shoman_open_door) ) );

			if ($player_second_choice == $car_door)
				$result['change_win']++;
			else
				$result['change_loss']++;
		}
		else
		{
			if ($player_first_choice == $car_door)
				$result['no_change_win']++;
			else
				$result['no_change_loss']++;
		}
	}

	if ($choice_change)
		$result['change_win_percent'] = round(100 / ($result['change_win'] + $result['change_loss']) * $result['change_win'],0);
	else
		$result['no_change_win_percent'] = round(100 / ($result['no_change_win'] + $result['no_change_loss']) * $result['no_change_win'],0);

	return $result;

}

MontyHallProblem(false); // do not change choice
MontyHallProblem(true); // change choice

pre($result);

?>