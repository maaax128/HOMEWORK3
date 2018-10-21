<?php

list(, $sum, $targ) = $argv;
$look = array_slice($argv, 2);
$target = implode(" ", $look);
$today = date("y-m-d");
$pay=[];




$container = fopen("money.csv", "r");
if ($sum==="--today") {	
	if ($container !== FALSE) {	
			while (($container2 = fgetcsv($container, 0, ",")) !== FALSE) {				
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
}
	else {
	if (is_numeric($sum) and (is_string($target))) {
        $resource = fopen("money.csv", "a");	
	$string = [$today, $sum, $target];
	fputcsv ($resource, $string);
	echo "Добавлена строка: $today, $sum, $target";
	fclose($resource);
	

		
	} else {
echo "Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}";

	
}

}
	
?>