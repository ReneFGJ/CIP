<?php
require ("cab_semic.php");
require ($include . '_class_form.php');
require ($include . 'sisdoc_autor.php');
$form = new form;
$jid = 85;
$cp = array();
array_push($cp, array('$H8', '', '', False, False));
array_push($cp, array('$S20', '', 'Informe o código', True, True));
$tela = $form -> editar($cp, '');

echo $tela;

if ($form -> saved > 0) {
	$cod = ($dd[1]);
	$sql = "select * from semic_trabalhos
				left join semic_blocos on st_bloco = blk_codigo
				where st_codigo like '%$cod%'
				";
	$rlt = db_query($sql);
	while ($line = db_read($rlt)) {
		
		echo '<table border=1 class="tabela00">';
		$link = '<A HREF="semic_poster_indicacao.php?dd1='.trim($line['blk_codigo']).'&dd2='.trim($line['st_avaliador_1']).'">indicar</A>';
		echo ''.mostra_avaliador($line['st_avaliador_1']).'<TD>'.$line['st_avaliador_1'].'<td>'.$link;
		$link = '<A HREF="semic_poster_indicacao.php?dd1="'.$line['blk_codigo'].'&dd2='.$line['st_avaliador_2'].'">indicar</A>';
		echo ''.mostra_avaliador($line['st_avaliador_2']).'<TD>'.$line['st_avaliador_2'];
		$link = '<A HREF="semic_poster_indicacao.php?dd1="'.$line['blk_codigo'].'&dd2='.$line['st_avaliador_3'].'">indicar</A>';
		echo ''.mostra_avaliador($line['st_avaliador_3']).'<TD>'.$line['st_avaliador_3'];
		echo ''.mostra_avaliador($line['blk_avaliador_1']).'<TD>'.$line['blk_avaliador_1'];
		echo ''.mostra_avaliador($line['blk_avaliador_2']).'<TD>'.$line['blk_avaliador_2'];
		echo ''.mostra_avaliador($line['blk_avaliador_3']).'<TD>'.$line['blk_avaliador_3'];
		echo '</table>';
	}
}
function mostra_avaliador($cod) {
	global $jid;
	$cod = trim($cod);
	
	if (strlen($cod) == 0) { return('<TR><TD>sem avaliador'); exit;}
	$sql = "
	select * from pareceristas 
	left join instituicao on us_instituicao = inst_codigo
	where us_codigo = '$cod'
	order by us_nome
";
	$rlt = db_query($sql);
	if ($line = db_read($rlt)) {

		$ac = trim($line['us_codigo']);
		$ac = md5($ac);
		$ac = UpperCase(substr($ac, 4, 2));

		$link = '<A HREF="http://www2.pucpr.br/reol/semic_avaliacao/index.php?dd1=' . trim($line['us_codigo']) . $ac . '&dd3=1&acao=IN" target="_new">';

		$id++;
		$sx .= '<TR>';
		$sx .= '<TD>' . nbr_autor($line['us_nome'], 7);
		$sx .= '<TD>' . $line['inst_abreviatura'];
		$sx .= '<TD>' . $line['us_email'];
		$sx .= '<TD>' . $link . trim($line['us_codigo']) . $ac . '</A>';

		$et .= '<TR><TD>';
		$et .= nbr_autor($line['us_nome'], 7) . '<BR>';
		$et .= '[' . trim($line['us_codigo']) . $ac . ']';
		$et .= '<BR>';
	}
	return($sx);
}
?>
