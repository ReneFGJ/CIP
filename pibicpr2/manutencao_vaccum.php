<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include.'sisdoc_security_post.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');	
require($include.'cp2_gravar.php');
$tabela = "";
$cp = array();
array_push($cp,array('$O : &S:SIM','','Confirmar zerar Edital',True,True,''));
?>
<H2>Gerar dados para montagem do Edital</H2>
<TABLE width="98%" align="center" border="1">
<TR><TD>
<?
echo $msc;
echo '<TR><TD>';
editar();
?></TD></TR></TABLE><?	

if ($saved < 1) { require('foot.php'); exit; }

$sql = "";
$rlt = fopen('http://www2.pucpr.br/reol/ro8_index.php?verbo=Tables&table=pibic_submit_documento&format=TXT&limit=100','r');
$s = '';
while ($sx = fread($rlt,1024))
	{
	$s .= $sx;
	}
fclose($rlt);
$s = troca($s,'"','');
$ln = split(chr(13),$s);
echo '<DIV>';
for ($n=0;$n < count($ln);$n++)
	{
	$sp = $ln[$n];
	$sc = split(',',$sp);
	if (strlen($sc[0]) > 0)
		{
		$sql = "vacuum ".$sc[0];
		echo '<TT>'.date("Y-m-d H:i:s").' '.$sql;
		$rlt = db_query($sql);
		}
	}
echo '</DIV>';

require("foot.php");	?>
