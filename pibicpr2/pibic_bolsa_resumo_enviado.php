<?
//	$resumo = $line['pibic_resumo_text'];
//	$colaborador = $line['pibic_resumo_colaborador'];
//	$keyword = $line['pibic_resumo_keywork'];
$sx .= '<fieldset><legend>Resumo</legend>';
if (strlen($resumo) > 0)
	{
	$sx .= '<table width="100%">';
	$sx .= '<TR class="lt0">';
	$sx .= '<TR><TD colspan="4" align="right" class="lt2"><BR>';
	$sx .= mst_autor($colaborador,2);
	$sx .= '<TR class="lt0">';	
	$sx .= '<TD colspan="4"><BR><B>Resumo</B>';
	$sx .= '<TR class="lt0">';
	$sx .= '<TD colspan="4" class="lt2">';	
	$sx .= '<div align="justify"><font class="lt0">'.$resumo.'</font></div>';
	$sx .= '<BR><div>Palavras-chave: '.troca($keyword,';','.').'</div>';
	$sx .= '<TR><TD colspan="4" class="lt2"><BR>';
	$sx .= mst_autor($colaborador,3);
	$sx .= '</table>';
	}
if ($user_nivel > 0)
	{
	$sx .= '<BR><a href="ed_edit.php?dd0='.$dd[0].'&dd99=pibic_bolsas_resumo" target="_newxy">';
	$sx .= '[alterar resumo]';
	$sx .= '</A>';
	}
$sx .= '';
?>