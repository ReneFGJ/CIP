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
$article->le($dd[0]);
require('../_class/_class_cited.php');
$cited = new cited;
$cited->artigo = strzero($dd[0],7);
require('_class/_class_doaj.php');
$doaj = new doaj;
$doaj = $doaj->xml_doaj_issue($dd[0]);
echo $doaj;
?>