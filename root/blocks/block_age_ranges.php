<?php
/**
*
* @package fs
* @author : TheUniqueTiger (Nayan Ghosh)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* DO NOT remove the above copyright notice, append additional copyright notices below this code.
*
* @version $Id: block_age_ranges.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* rewritten by: Martin Larsson phpbbireland.com 
* Stargate Portal Code 12 November 2008
* Updated: 02 November 2008 Mike (gota keep debug happy ;))
* Updated: 12 November 2008 NeXuradded:  total age, total_age_counts & average age
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

$queries = $cached_queries = 0;

global $k_config, $k_blocks;
$sgp_cache_time = $k_config['sgp_cache_time'];

$range_interval = $k_config['age_range_interval'];	//this calculates the interval in the age groups ... if 10 => 10-19, 20-29, if 5 => 10-14, 15-19...
$range_start = $k_config['age_range_start'];
$upper_limit = $k_config['age_upper_limit'];		//will show results upto value -1
$current_time = getdate(time());
$my_age = '';
$total_age = 0;
$age_ranges = $birthdays = array();

//initialize the array
for ($i = $range_start; $i < $upper_limit; $i += $range_interval)
{
	$age_ranges[$i] = 0;
}

$sql = 'SELECT user_birthday FROM ' . USERS_TABLE . "
		WHERE user_birthday != ''
			AND user_type <> 2";
$result = $db->sql_query($sql, $sgp_cache_time);

while ($row = $db->sql_fetchrow($result))
{
	$birthdays[] = explode('-', $row['user_birthday'], 3); //[0] => day, [1] => month, [2] => year					
}				
$db->sql_freeresult($result);

foreach ($birthdays as $row)
{
	if (mktime($current_time['hours'], $current_time['minutes'], $current_time['seconds'], $row[1], $row[0],  $current_time['year']) > $current_time[0])
	{
		$age = $current_time['year'] - $row[2] - 1;
	}
	else
	{
		$age = $current_time['year'] - $row[2];
	}

	//now increment the appropriate counter
	if ($age < $range_start || $age >= $upper_limit)
	{
		continue;
	}

	$age_ranges[$age - (($age - $range_start) % $range_interval)]++;
	$total_age = $total_age + $age;
}

$total_age_counts = array_sum($age_ranges);

if ($user->data['user_birthday'])
{
	$my_age_data = explode('-', $user->data['user_birthday'], 3);

	if (mktime($current_time['hours'], $current_time['minutes'], $current_time['seconds'], $my_age_data[1], $my_age_data[0], $current_time['year']) > $current_time[0])
	{
		$my_age = $current_time['year'] - $my_age_data[2] - 1;
	}
	else
	{
		$my_age = $current_time['year'] - $my_age_data[2];
	}
}

if ($total_age_counts)
{
	$average_age = $total_age / $total_age_counts;
	
	$template->assign_vars(array(
		'S_AGE'				=> true,
		'TOTAL_AGE_COUNTS'		=> $total_age_counts,
		'TOTAL_AGE'			=> $total_age,
		'AVERAGE_AGE'			=> number_format($average_age, 2)
	));

	//find max
	$max_count = 0;
	foreach ($age_ranges as $row)
	{
		if ($row > $max_count)
		{
			$max_count = $row;
		}
	}
	//assign vars to template
	foreach ($age_ranges as $age_range_start => $count)
	{
		$template->assign_block_vars('age_row', array(
			'AGE_RANGE'			=> $age_range_start . ' - ' . (($age_range_start + $range_interval > $upper_limit) ? $upper_limit - 1 : $age_range_start + $range_interval - 1),
			'COUNT'				=> $count,
			'PCT'				=> number_format($count / $total_age_counts * 100, 1),
			'IS_MAX'			=> ($count == $max_count),
			'IS_MINE'			=> ($my_age && $my_age >= $age_range_start && $my_age < $age_range_start + $range_interval)
		));
	}
}

$template->assign_vars(array(
	'AGE_RANGE_DEBUG' => sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));
?>