<?
$breadcrumbs=array();
require("cab_semic.php");

echo '<form method="get" action="'.page().'">
				<span class="titulo-busca">Nome do professor</span><br>
				<input name="dd10" value="" class="campo-busca" placeholder="Informe parte do nome do autor " type="text">
				<input name="acao" class="botao-busca" value="BUSCAR" type="submit">
				</form>
';

if (strlen($dd[10]) > 0)
	{
	$sql = "
		select sma_nome from (
		select * from semic_trabalho_autor where sma_nome like '%".UpperCase($dd[10])."%'
		union 
		select * from semic_ic_trabalho_autor where sma_nome like '%".UpperCase($dd[10])."%'
		) as tabela group by sma_nome
	";
	$rlt = db_query($sql);

	while ($line = db_read($rlt))
		{
		$link = '<A HREF="semic_autoridades_ed.php?dd1='.trim($line['sma_nome']).'" class="lt3">'.$line['sma_nome'].'</A>';
		echo '<BR>'.$link;
		}
	}
require("../foot.php");	
?>