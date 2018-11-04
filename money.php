<?php

/*ni_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/





if (empty($argv[1])) {
	exit('Ошибка! Аргументы не заданы. …');
}
$sum = $argv[1];

$today = date('y-m-d');
$pay=[];


if ($sum==='--today') {	
	if (file_exists('money.csv')) {	
		$container = fopen('money.csv', 'r');
		$list = [];
			while (($container2 = fgetcsv($container, 0, ',')) !== FALSE) {				
					$list[] = $container2;					
			}

			foreach ($list as $key) {
				if ($key[0] === $today){
				
					$pay[] = $key[1];
	
				}		
			}
		
		$total = array_sum($pay);
		echo ("$today расход за день: $total р.");
	} 
}	else {
	if (is_numeric($sum) and (count($argv) > 2)) {
		$look = array_slice($argv, 2);
		$target = implode(" ", $look);
        $resource = fopen("money.csv", "a");	
		$string = [$today, $sum, $target];
		fputcsv ($resource, $string);
		echo "Добавлена строка: $today, $sum, $target";
		fclose($resource);
		
	} else {
echo 'Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}';

	
	}

}
	
?>