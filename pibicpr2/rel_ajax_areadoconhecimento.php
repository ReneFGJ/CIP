<?
///////////////// Versao 0.0.1f de 02/08/2008
require("cab.php");
require($include.'sisdoc_colunas.php');
$label = "Área do conhecimento";
$tabela = "ajax_areadoconhecimento";
?>
<font class="lt5"><?=$label;?></FONT>
<?
$sql = "select * from ".$tabela." order by a_cnpq ";
$rlt = db_query($sql);


while ($line = db_read($rlt))
	{
	$s .= '<TR '.coluna().'>';
	$sf = '';
	$cnpq = trim($line['a_cnpq']);
	if (substr($cnpq,2,2) == '00')
		{
		$sf .= '<TD colspan="4"><B>';
		} else {
			if (substr($cnpq,5,2) == '00')
			{
			$sf .= '<TD><TD colspan="3"><I>';
			} else {
				if (substr($cnpq,8,2) == '00')
				{
				$sf .= '<TD><TD><TD colspan="2">';
				} else {
				$sf .= '<TD>&nbsp;&nbsp;<TD>&nbsp;&nbsp;<TD>&nbsp;&nbsp;<TD>';
				}		
			}
		}
	$s .= '<TD align="center"><TT>';
	$s .= $line['a_cnpq'];
	$s .= ''.$sf;
	$s .= $line['a_descricao'];
	}
?>
<table width="<?=$tab_max;?>" class="lt1">
<TR>
<TH width="20%">Código CNPq
<TH colspan="5">Descrição
<?=$s;?>
</table>
<?
require("foot.php");	
?>