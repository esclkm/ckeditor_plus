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

// Required: anonymous function reference number as explained above.
$funcNum = $_GET['CKEditorFuncNum'] ;
// Optional: instance name (might be used to load a specific configuration file or anything else).
$CKEditor = $_GET['CKEditor'] ;
// Optional: might be used to provide localized messages.
$langCode = $_GET['langCode'] ;

@header('Content-type: text/html; charset=utf-8');

echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";

exit();