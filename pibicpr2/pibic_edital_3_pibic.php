<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_data.php");
require($include."sisdoc_autor.php");
require($include.'sisdoc_security_post.php');


if (strlen($dd[0]) == 0)
	{
	?>
	<H2>Seleciona uma das áreas - PIBIC</H2>
	<form method="get">
	<table width="704">
	<TR align="center">
	<TD><input type="submit" name="dd0" value="Exatas (Ciências)" style="width:300px; height:50px;">
	<TD><input type="submit" name="dd0" value="Vida (Ciências)" style="width:300px; height:50px;">
	<TR align="center">
	<TD><input type="submit" name="dd0" value="Humanas (Ciências)" style="width:300px; height:50px;">
	<TD><input type="submit" name="dd0" value="Sociais Aplicadas" style="width:300px; height:50px;">
	<TR align="center">	
	<TD><input type="submit" name="dd0" value="Agrárias (Ciências)" style="width:300px; height:50px;">
	<TD><input type="submit" name="dd0" value="Todas as áreas" style="width:300px; height:50px;">
	</table>
	</form>
	<?
	exit;
	}


?>
<style>
	.links a
	{
	text-decoration : none;
	font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size : 10px;
	font-style : normal;
	font-variant : normal;
	font-weight : normal;
	}

.links A:HOVER {
	text-decoration : underline;
	font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size : 10px;
	font-style : normal;
	font-variant : normal;
	font-weight : normal;	
	}
</style>
<?
$dtipo = "PIBIC";
$ptipo = "PIBIC";

require("pibic_edital_3_dados.php");
?>