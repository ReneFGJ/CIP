<?
require("cab.php");

?>
Lista de avaliações
<?
$tot = 0;

//require("avaliacoes.php");

require("avaliacoes_journals.php");
//require("avaliacoes_pibic.php");

if ($tot == 0)
	{
	echo '<BR><BR><font color="green"><font style="font-size: 40px"><center>Nenhuma indicação de avaliação localizada!<BR><BR><BR>	';
	}

?>

