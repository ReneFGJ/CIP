<?
$include = '../';
session_start();
require("../db.php");

require($include."sisdoc_data.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_debug.php");

header ("content-type: text/xml");

$id = round($dd[0]);
require('../_class/_class_autor.php');
$autor = new autor;
require('../_class/_class_article.php');
$article = new article;

require('../_class/_class_cited.php');
$cited = new cited;

require('../_class/_class_doi_schema.php');
$doi = new doi;
$doi = $doi->xml_doi_issue($dd[0]);
echo $doi;
?>