<?php


if (empty($argv[1])) {
    exit('Ошибка! Аргументы не заданы. …');
}
$country = $argv[1];
if ($fp = fopen("https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8", "r") or $fp = fopen("https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv", "r")) {
    while ($data = fgetcsv($fp, 0, ",")){
        $list[] = $data;
    }    

    foreach ($list as $key => $value) {
         $column1[] = $value[1];
         $column4[] = $value[4];
    }
    $registry = array_combine($column1, $column4);
    foreach ($registry as $key2 => $key3) {
        if ($key2[1] === $country[1]){
        echo "$country: $key3";
        break;         
   
        }            
    }   
}    

?>
