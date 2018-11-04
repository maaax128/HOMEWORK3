<?php

$query = $argv;
if (empty($query[1])) {
    exit('Ошибка! Аргументы не заданы. …');
}

$Books = array_slice($query, 1);
$NameBooks = implode(' ',$Books);
$search = urlencode(trim($NameBooks));
$Json = @file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.$search);
$BookJson = json_decode($Json, true);


var_dump($BookJson);
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




foreach ($BookJson['items'] as $book) {

    $title = (!empty($book['volumeInfo']['title'])) ? $book['volumeInfo']['title'] : '';

    $authors = (!empty($book['volumeInfo']['authors'][0])) ? implode(',', $book['volumeInfo']['authors']) : '';

    file_put_contents('./books.csv',$title.','.$authors.';', FILE_APPEND);

}




?>