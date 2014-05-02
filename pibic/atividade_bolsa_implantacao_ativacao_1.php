<?
$ac1 = "Substituir aluno";
$ac2 = "Aceitar Indicação";

if (strlen($dd[6]) > 0)
	{
	$link = 'atividade_bolsa_implantacao_ativacao.php?dd0='.$dd[0]."&dd1=".$dd[1]."&dd2=".$dd[2].'&dd5=';
	if ($ac2 == $dd[6])
		{ redirecina($link.'2'); }
	if ($ac1 == $dd[6])
		{ redirecina($link.'3'); }
	}
?>
<form method="post">
	<input type="hidden" name="dd0" value="<?=$dd[0];?>">
	<input type="hidden" name="dd1" value="<?=$dd[1];?>">
	<input type="hidden" name="dd2" value="<?=$dd[2];?>">
	<input type="hidden" name="dd3" value="<?=$dd[3];?>">
	<input type="hidden" name="dd4" value="<?=$dd[4];?>">
	<input type="hidden" name="dd5" value="<?=$dd[5];?>">

<table width="98%">
<TR><TD colspan="2" class="lt1">
Prezado professor(a),
<BR>
<BR>Confirme os dados abaixo e efetive uma das duas opções.
<BR>
<BR>Conforme edital, o professor tem direito de realizar até 2 substituições de alunos durante a vigência do programa.
<BR>
<BR>Caso exista a necessidade de substituição de aluno, no momento da implementação está será considerada.
<BR>
<BR>
</TD></TR>
<TR><TD colspan="2" class="lt0">Protocolo</TD></TR>
<TR><TD class="lt2" colspan="2"><B><?=$proto;?></B></TD></TR>
<TR><TD colspan="2" class="lt0">Título do plano do aluno</TD></TR>
<TR><TD class="lt2" align="center" colspan="2"><B><?=$tit_plano;?></TD></TR>
<TR><TD colspan="2" class="lt0">Aluno</TD></TR>
<TR><TD colspan="2" class="lt1"><B><?=$aluno_nome; ?></B></TD></TR>
<TR><TD colspan="2" class="lt0">Selecione a opção</TD></TR>


<TR align="center">
	<TD><input type="submit" name="dd6" value="<?=$ac1;?>" style="width:200px; height:50px;"></TD>
	<TD><input type="submit" name="dd6" value="<?=$ac2;?>" style="width:200px; height:50px;"></TD>
</TR>
</table>
</form>