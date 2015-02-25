<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_email.php");
require($include."sisdoc_windows.php");
require($include.'sisdoc_form2.php');
require($include.'sisdoc_message.php');
require($include.'sisdoc_debug.php');	
require($include.'cp2_gravar.php');
require($include."sisdoc_menus.php");
//$sql = "ALTER TABLE pibic_parecer_2012 ALTER COLUMN pp_avaliador TYPE CHAR( 8 )";
//$rlt = db_query($sql);

/**** Mensagens ***/
	/* Mensagens */
	$tabela = 'pa_relatorio_parcial_entrega';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }

/**** Classes ***/
	require("../_class/_class_pibic_bolsa_contempladas.php");
	$pb = new pibic_bolsa_contempladas;
	$pb->le($dd[0],'');
	
	echo $pb->mostar_dados();
	
	/* Renovações */
	echo $pb->bolsas_anteriores();
	
	
	require("../pibic/_ged_config.php");
	$ged->protocol = $pb->pb_protocolo;	
	

$tabela = "pibic_bolsa_contempladas";

//$sql = "update ".$tabela." set pb_status = 'A' where id_pb = ".$dd[0]; 
//$rlt = db_query($sql);

//$sql = "select * from ".$tabela." where id_pb = ".$dd[0];
//$rlt = db_query($sql);

//$sql = "update pibic_bolsa_contempladas set pb_relatorio_parcial_nota = 0 where id_pb = ".$dd[0].' and pb_relatorio_parcial > 20100101 ';
//$rlt = db_query($sql);


$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
$sql .= "left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where id_pb = ".$dd[0];
$sql .= "order by pa_nome";
$rlt = db_query($sql);

$sx = '';
if ($line = db_read($rlt))
	{
	
	$resumo = $line['pibic_resumo_text'];
	$colaborador = $line['pibic_resumo_colaborador'];
	
	$keyword = $line['pibic_resumo_keywork'];
	
	$nota_parcial = $line['pb_relatorio_parcial_nota'];
	$nota_final   = $line['pb_relatorio_final_nota'];
	$nota_resumo   = $line['pb_resumo_nota'];

	$data_parcial = $line['pb_relatorio_parcial'];
	$data_final   = $line['pb_relatorio_final'];
	$data_resumo   = $line['pb_resumo'];
	$semic = $line['pb_semic'];
	
	$ttt = LowerCase($line['doc_1_titulo']);
	$ttt = UpperCase(substr($ttt,0,1)).substr($ttt,1,strlen($ttt));
	
	$ttp = LowerCase($line['pb_titulo_projeto']);
	$ttp = UpperCase(substr($ttp,0,1)).substr($ttp,1,strlen($ttp));
	$data_ativa = stodbr($line['pb_data_ativacao']);
	$pb_contrato = trim($line['pb_contrato']);
	$aluno     = $line['pa_nome'];
	$aluno_cracha = $line['pa_cracha'];
	$aluno_rg  = $line['pa_rg'];
	$aluno_cpf = $line['pa_cpf'];
	$aluno_pai = $line['pa_pai'];
	$aluno_mae = $line['pa_mae'];
	$aluno_end = mst($line['pa_endereco']);
	
	$id_aluno = $line['id_pa'];
	
	$prof      = $line['pp_nome'];
	$prof_nome   = $line['pp_nome'];
	$prof_cracha = $line['pp_cracha'];
	$protocolo = $line['pb_protocolo'];
	$protocolom= $line['pb_protocolo_mae'];	
	$pb_fomento = trim($line['pb_fomento']);
	$pb_bolsa_codigo = trim($line['pb_codigo']);
	$pb_bolsa = trim($line['pb_tipo']);
	$pb_ordem = UpperCase(trim(tratar($line['pa_curso'])).';'.trim($line['pp_nome']).';'.trim($line['pa_nome']));
	$pa_curso = trim($line['pa_curso']);

	
	$pb_bolsa = '<img src="img/'.trim($line['pbt_img']).'"> '.trim($line['pbt_descricao']);
	$pb_cod = '';
	
	$doc_aprovado_externamente = trim($line['doc_aprovado_externamente']);
	$status = $line['pb_status'];
	$status_mst = $status;
	if ($status_mst == '@') { $status_mst = '<font color="orange">Em preparo</font>'; }
	if ($status_mst == 'A') { $status_mst = 'Ativa'; }
	if ($status_mst == 'I') { $status_mst = 'Inativa'; }
	if ($status_mst == 'C') { $status_mst = '<font color="red">**CANCELADO**</font>'; }
	
	if ($doc_aprovado_externamente == '1')
		{
		$doc_aprovado_externamente = 'SIM, '.$pb_fomento;
		}
	$linkx = '<a href="pibic_aluno.php?dd0='.$id_aluno.'">';
	
	$dt_semic = stodbr($semic);
	if ($semic < 20000101) { $dt_semic = '<font style="background-color : Yellow;"> NÃO ENVIADO </font>'; }
	//////////// Nome do aluno

	require("pibic_bolsa_resumo_enviado.php");
	}
?>
<TABLE width="<?=$tab_max;?>">
<?=$sx;?>
</TABLE>
<?
//$sql = "delete from ".$ged->tabela." where id_doc = 6121";
//$rlt = db_query($sql);
/**** Relatórios postados ****/
ECHO '<fieldset><legend>Arquivos postados</legend>';
echo $ged->filelist();
if ($user_nivel >= 6)
	{
	echo '<a href="#" onclick="newxy2('.chr(39).'../pibic/ged_upload.php?dd1='.$protocolo.'&dd90='.checkpost($gp->gp_codigo).chr(39).',600,300);">';
 	echo 'upload</A>'; 
	}
echo '</fieldset>';
echo '<BR>';
///////////////////////////////////////////////////////////
ECHO '<fieldset><legend>Relatórios e Avaliações</legend>';
$pb->mostra_relatorios_status();
echo '</fieldset>';
echo '<BR>';
echo '<BR>';
///////////////////////////////////////////////////////////
require("../_class/_class_parecer_pibic.php");
$ava = new parecer_pibic;
echo $ava->resumo_avaliacoes($pb->pb_protocolo);
///////////////////////////////////////////////////////////

if ($status != 'C')
	{
	if ($user_nivel > 5)
	{
	ECHO '<fieldset><legend>Ações da bolsa</legend>';
	require("ed_pibic_bolsas_contempladas_acao.php");
	echo '</fieldset>';
	echo '<BR>';
	}
	
	if ($data_parcial > 20100101)
		{ require("pibic_bolsas_avaliacao_indicar.php"); }
	if ($data_final > 20100101)
		{ require("pibic_bolsas_avaliacao_final_indicar.php"); }
//	if ($data_resumo > 20100101)
//		{ require("pibic_bolsas_avaliacao_resumo_indicar.php"); }		
	}

require("pibic_acao_historico.php");

require("foot.php");

function tratar($_lx)
	{
	$_lx = troca($_lx,'(Noturno) ','');
	return($_lx);
	}
?>