<?php

//  1. Здесь используется решения, по которому не сможет произойти антипаттерн "Слепая вера", так как в коде проверяем подключение к БД, 
// и в случае возникновения каких-то трудностей к БД, будем давать ошибку "Connection failed to DB"

$dir_images = scandir('./images'); 
$src_dir_img = "./images"; 

$link = mysqli_connect('localhost', 'root', '', 'gb'); 

if ($link) {
    foreach ($dir_images as $dir) { 
        if ($dir != '.' && $dir != "..") {
            $src_images[] = $dir;
        }
    }
    foreach ($src_images as $src_image) { 
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

// Пример спаггети-кода, когда переменные abc не несут какой-то информации. В идеале, наименование переменных нужно поменять на более подходящие под смыслы.

<?php
 /* Принимаем данные из формы */
  $connect=mysqli_connect('localhost','login','password') or die(mysqli_error());
mysqli_select_db('myDB') or die ("Не могу выбрать базу данных");
if(isset($_POST['enter'])){/*если нажата кнопка, то заносим в бд данные*/
	 if (empty($_POST['name']) or empty($_POST['phone'])) {
        echo '<script>alert("Заполните все поля формы");</script>';
	 } else {
  $a = $_POST["name"];
  $b = $_POST["phone"];
  $c = date("l dS of F Y h:i:s A");
$mysql=mysqli_query($connect,"INSERT INTO contacts VALUES ('','$name','$phone','$datetime','')") OR DIE (MYSQLI_ERROR());}}
  ?>

