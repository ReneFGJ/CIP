<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

		$sql = "select * from pibic_bolsa_contempladas ";
		$sql .= " left join pibic_aluno on pa_cracha = pb_aluno ";
		$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
		$sql .= " left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
		$sql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
		$sql .= " where (pb_status = 'A') and pa_update < ".date("Ymd");
//		$sql .= " or (pa_curso = 'Biotecnologia') ";
		$sql .= " order by pa_update ";
		$sql .= " limit 1 ";
//pa_update
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$sx .= '<TR>';
	$sx .= '<TD>'.$line['pa_nome'];
	$sx .= '<TD align="center">'.stodbr($line['pa_update']);
	$sx .= '<TD align="center">'.$line['pa_cracha'];
	$sx .= '</TR>';
	$dd[2] = '1';
	$cracha = trim($line['pa_cracha']);
	
	require('pucpr_soap_pesquisaAluno.php');
	?>
	<META HTTP-EQUIV="Refresh" CONTENT="1;URL=estudantes_atualizar.php">
	<?
	} else {
	 echo '<BR><BR>';
	 echo '<BR><BR>';
	 echo '<BR><BR>';
	 echo '<H1>Fim da atualização</H1>';
	 echo '<BR><BR>';
	 echo '<BR><BR>';
	 echo '<BR><BR>';
	 require("foot.php");
	 
	//////////////////// REGRA FINAL

 	$sql = "update pibic_aluno set pa_centro = 'Centro de Ciências Biológicas e da Saúde - CCBS' where pa_curso = 'Biotecnologia' "; 
	$rlt = db_query($sql);

	 exit;
	}
?>
<BR><BR>
<table class="lt1" width="600" border="1"> 
<TR>
	<Th width="60%">Nomo</Th>
	<Th width="20%">Atualização</Th>
	<Th width="20%">Código</Th>
</TR>
<?=$sx;?>
</TABLE>
<? require("foot.php");	?>