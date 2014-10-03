<?php
require('db.php');
require("_class/_class_message.php");
$ln = new message;
if (is_dir('messages'))
	{ }
else 
	{ mkdir('messages'); }
echo $ln->language_page_create();
echo 'FIM';
?>

