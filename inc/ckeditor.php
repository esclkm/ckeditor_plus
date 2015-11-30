<?php

define('COT_CODE', true);

set_include_path('../../../');
require_once('datas/config.php');

chdir ('../../../');

if (!file_exists('datas/ckeditor'))
{
	mkdir('datas/ckeditor', $cfg['dir_perms']);
}
//getcwd ( void )


$name = preg_replace('#[^a-zA-Z0-9\-_\.\ \+]#', '', $_FILES['upload']['name']);
$name = mb_strtolower($name);

//extensive suitability check before doing anything with the file…
$message = "";
if (($_FILES['upload'] == "none") OR (empty($name)) )
{
   $message = "Файл не был загружен.";
}
elseif ($_FILES['upload']["size"] == 0)
{
   $message = "The file is of zero length.";
}
elseif (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png"))
{
   $message = "Поддерживаются только JPG и PNG форматы файлов";
}
elseif (!is_uploaded_file($_FILES['upload']["tmp_name"]))
{
   $message = "Ошибка загрузки.";
}

if(empty($message))
{
	$message = "";
	$name = preg_replace('#[^a-zA-Z0-9\-_\.\ \+]#', '', $_FILES['upload']['name']);
	$name = mb_strtolower($name);
	if(file_exists('datas/ckeditor/'.$name))
	{
		$name = time()."_".$name;
	}
	$url = 'datas/ckeditor/'.$name;

	$move = @ move_uploaded_file($_FILES['upload']['tmp_name'], $url);
	if(!$move)
	{
		$message = "Ошибка записи файла. Проверить права на запись директории";
	}
}
if(!empty($message))
{
	$_ret_array = array(
	    "uploaded" => 0,
	    "error" =>  array(
	        "message" => $message
	        )
	    );	
}
else
{
	$_ret_array=array(
	    "uploaded" => 1,
	    "fileName" => $name,
	    "url" => $url,
	    );
}


echo json_encode($_ret_array);
exit();