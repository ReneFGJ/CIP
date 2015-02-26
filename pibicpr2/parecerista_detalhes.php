<?
$debug = true;
require("cab.php");

$label = "Cadastro de pareceristas / áreas de atuação";

	$sql = "select * from pareceristas_area ";
	$sql .= " left join ajax_areadoconhecimento on a_codigo = pa_area ";
	$sql .= "where pa_parecerista = '".strzero($dd[0],7)."' ";
	$rlt = db_query($sql);
	$s = '';
	while ($line = db_read($rlt))
		{
		$s .= '<TR '.coluna().'>';
		$s .= '<TD width="60%"><B>';
		$s .= $line['a_descricao'];
		$s .= '<TD align="center" width="20%">';
		$s .= $line['a_cnpq'];
		$s .= '<TD align="center" width="10%">';
		$s .= stodbr($line['pa_update']);
		$s .= '<TD align="center" width="10%" class="lt1">';
		$s .= '<A HREF="parecerista_areas.php?dd0='.$dd[0].'&dd10='.$line['id_pa'].'&dd11=del">';
		$s .= '[EXCLUIR]</A>';
		}

//////////////////////////////////////////////////////////////////
//require("parecerista_areas_avaliacao.php");
/////////////////////////////////////////////////////////////////
		
	$tabela = "";
	$sql = "select * from pareceristas ";
	$sql .= " inner join instituicoes on inst_codigo = us_instituicao ";
	$sql .= " where id_us = ".$dd[0]." ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$email = trim($line['us_email']);
		$email_alt = trim($line['us_email_alt']);
		if (strlen($email) > 0) { $email = '<A HREF="mailto:'.$email.'">'.$email.'</A>'; }
		if (strlen($email_alt) > 0) { $email .= ' / <A HREF="mailto:'.$email_alt.'">'.$email_alt.'</A>'; }
		?>
		<TABLE width="<?=$tab_max;?>" class="lt1">
			<TR><TD class="lt0" colspan="2">parecerista<TD>e-mail</TD>
			<TR><TD class="lt2" colspan="2"><B><?=$line['us_nome'];?><TD class="lt2"><B><?=$email;?></TD>
			<TR><TD class="lt0" colspan="2">instituição
			<TR><TD class="lt2" colspan="2"><B><?=trim($line['inst_nome']);?> (<?=trim($line['inst_abreviatura']);?>)
		</TABLE>
		
		<TABLE width="<?=$tab_max;?>" class="lt1">
			<TR><TH>Área
				<TH>código
				<TH>atualizado
				<TH>Ação
			<?=$s;?>
		</TABLE>
		<?
		}
	///////////////////////////////// Indicação de avaliação do parecerista	
	require("parecerista_projetos_indicado.php");
	
require("foot.php");	
?>