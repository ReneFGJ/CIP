<?
require("db.php");
require("_class/_class_article.php");
require("_class/_class_autor.php");
require('include/sisdoc_autor.php');
?>
<title>DOI</title>
<?
$dd0 = $_GET['dd0'];
$ct = new article;
$ct->le($dd0);
echo $ct->article_head();
?>