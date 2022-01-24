<?php

// Задание 1-2
$dir_images = scandir('./images'); // сканируем директорию
$src_dir_img = "./images"; // путь к директории

$link = mysqli_connect('localhost', 'root', '', 'gb'); // подключаемся к БД

if ($link) {
    foreach ($dir_images as $dir) { // фильтруем директорию на файлы в папке, и добавляем файлы в массив
        if ($dir != '.' && $dir != "..") {
            $src_images[] = $dir;
        }
    }
    foreach ($src_images as $src_image) { // сортируем файлы по-очереди
        $filesize = filesize("$src_dir_img/$src_image");
        $insert_in_db = mysqli_query($link, "INSERT INTO images (src, name, size) VALUES ('$src_dir_img/$src_image', '$src_image', '$filesize');");
    };
    render($link);
    mysqli_close($link);
} else {
    die('Connection failed to DB');
};

function render($arg){
    $select_in_db = mysqli_query($arg, "SELECT * FROM images;"); // достаём данные из БД
    while($result = mysqli_fetch_assoc($select_in_db)){
       echo '<a target="_blank" href="' . $result['src'] . '"><img src="' . $result['src'] . '" with="100px" height="100px"> </img>';
    }
}