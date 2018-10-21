<?php
$query = $argv;

$Books = array_slice($query, 1);
$NameBooks = implode(' ',$Books);

$search = urlencode(trim($NameBooks));
$Json = file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.$search);
$file = file_put_contents('./books.json',$dataJson);
$BookJson = json_decode($Json);

switch (json_last_error()) {
    case JSON_ERROR_NONE:
        echo ' - Ошибок нет';
        break;
    case JSON_ERROR_DEPTH:
        echo ' - Достигнута максимальная глубина стека';
        break;
    case JSON_ERROR_STATE_MISMATCH:
        echo ' - Некорректные разряды или несоответствие режимов';
        break;
    case JSON_ERROR_CTRL_CHAR:
        echo ' - Некорректный управляющий символ';
        break;
    case JSON_ERROR_SYNTAX:
        echo ' - Синтаксическая ошибка, некорректный JSON';
        break;
    case JSON_ERROR_UTF8:
        echo ' - Некорректные символы UTF-8, возможно неверно закодирован';
        break;
    default:
        echo ' - Неизвестная ошибка';
        break;
}
ini_set('display_errors','Off');

$z = $BookJson->items;

for ($i = 0; $i < count($z);$i++)
{
    $x = ($z[$i]);
    $result = $x->$result;
    $title = $result->title;
    $title = str_replace(',','',$title);    
    $authors = $result->authors;
    file_put_contents('./books.csv',$title.','.$authors[0]."\n", FILE_APPEND);

}


?>