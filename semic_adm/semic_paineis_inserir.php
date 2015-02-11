<?php
require("cab_semic.php");
$jid = 85;
require("../_class/_class_semic_paineis.php");
$sm = new semic_paineis;
/*
 * $breadcrumbs
 */
 $bb1 = 'Incluir>>';
$bb2 = '<< Excluir'; 
if ($acao == $bb2)
	{
		$trabalho = $dd[7];
		echo 'Excluir';
		echo $trabalho;
		$sm->excluir_painel($trabalho,'');
	}
if ($acao == $bb1)
	{
		$painel = $dd[5];
		$trabalho = $dd[6];
		$sm->incluir_painel($painel,$trabalho);
	}
	$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$bloco = $dd[1];

for ($r=1;$r <= 50;$r++)
	{
		$nm = 'P'.strzero($r,2);
		$sel = '';
		if ($dd[6] == $nm) { $sel = 'selected'; }
		$sb .= '<option value="P'.strzero($r,2).'" '.$sel.'>P'.strzero($r,2).'</option>';
	}

/* SEM */
$sql = "select * from semic_trabalhos 
		left join semic_paineis on st_codigo = spl_trabalho
			where  st_bloco = '$bloco' 
			and spl_trabalho isnull
		order by st_codigo
";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
		$sa .= '<option value="'.$line['st_codigo'].'">'.$line['st_codigo'].'</option>';
	}

/* INDICADOES */
$sql = "select * from semic_trabalhos 
		inner join semic_paineis on st_codigo = spl_trabalho
			where  st_bloco = '$bloco' 
			and spl_painel = '".$dd[6]."'
		order by st_codigo
";
$rlt = db_query($sql);
$sc = '';
$id = 0;
while ($line = db_read($rlt))
	{
		$id++;
		$sc .= '<option value="'.$line['st_codigo'].'">'.$line['st_codigo'].'</option>';
	}
	
$so .= '<table width="100%">';
$so .= '<form method="post" action="'.page().'">';
$so .= '<input type="hidden" name="dd1" value="'.$dd[1].'">';
$so .= '<TR valign="center">';
$so .= '<TD>';
$so .= '<select name="dd5" size=10>'.$sa."</select>";
$so .= '<TD>';
$so .= '<input type="submit" name="acao" value="'.$bb1.'">';
$so .= '<BR>';
$so .= '<input type="submit" name="acao" value="'.$bb2.'">';
$so .= '<TD>';
$so .= '<select name="dd6" size=10>'.$sb."</select>";
$so .= '<TD>';
$so .= '<select name="dd7" size=10>'.$sc."</select>";
$so .= '<TD>';
$so .= '<h1>'.$id.'</h1>Total';
$so .= '</table>';
$so .= '</form>';
echo $so;


?>
