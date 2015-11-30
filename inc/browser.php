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

$images = glob("datas/ckeditor/*.{jpg,png,gif}", GLOB_BRACE);
$img = array();
foreach($images as $image) {
	$img[] = array('url' => $image);
}
echo json_encode($img);
exit();