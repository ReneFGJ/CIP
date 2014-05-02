<?
require("cab_pibic.php");
require($include."sisdoc_tips.php");
require("../_class/_class_position.php");
$pos = new position;

require($include.'sisdoc_form2.php');
require($include."sisdoc_search.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_data.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_editor.php");
require($include."sisdoc_ajax.php");
require($include."sisdoc_html.php");
$ed_acao = true;
global $prj_tp;
$tpp = 'pibiti';
///// Numero de erros
$nerr = 0;

if (strlen($dd[98]) > 0)
	{
	setcookie("prj_page",$dd[98],time()+60*60*60);
	
	$prj_pg = $dd[98];
	redirecina('submit_phase_2_pibiti.php');
	}

require("submit_cab.php");
require($include.'sisdoc_tips.php');

require("submit_table_pibiti.php");

$protocolo = read_cookie("prj_proto");
$prj_nr = read_cookie("prj_nr");

//////////////////////////// se não existir manuscrito enviar para página 1
if ((strlen($protocolo) == 0 ) and ($prj_pg != 1))
	{
	redirecina('submit_phase_2_pibiti.php?dd98=1');
	}

if ($submissao_aberta != True)
	{
	echo '<BR><BR><BR>';
	echo '<CENTER><font class="lt3"><font color="#FF8040"><B>SUBMISSÃO DE PROJETOS: ENCERRADO</B></font></font></CENTER>';
	echo '<BR><BR><BR>';
	require("foot.php");
	exit;
	}
	
$usql = "select * from ".$tdoc." ";
$usql .= "where (doc_protocolo like '".$protocolo."') ";

$urlt = db_query($usql);
if ($uline = db_read($urlt))
	{
	$sta = trim($uline['doc_status']);
	if ($sta != '@')
		{ redirecina("resume.php"); 	exit; }
	}

//$sql = "update ".$submit_manuscrito_field." set sub_journal_id = 20 where sub_projeto_tipo ='".$prj_tp."'";
//$rlt = db_query($sql);
	
$sql = "select * from ".$submit_manuscrito_field." where sub_projeto_tipo ='".$prj_tp."'";
$sql .= " and sub_pos = '".$prj_pg."'";
$sql .= " and sub_ativo = 1 ";
$sql .= " order by sub_ordem ";
$prlt = db_query($sql);

$tabela = $table_pesquisador;
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
$s = '<form method="post" name="fl" id="fl">';
$s .= '<TABLE align="center" width="'.$tab_max.'" border="0">';
$s .= '<TR><TD colspan="2"><center><img src="img/logo_pibiti.jpg" width="423" height="52" alt="" border="0"></center></TD></TR>';
$dx=0;
$ok = 1;
$cops = array();
while ($sb_line = db_read($prlt))
	{
	/////////////// s no final
	$sp = '';
	array_push($cops,array($sb_line['sub_codigo'],$dd[$dx]));
	$xcod = $sb_line['sub_codigo'];
	$CP1 = trim($sb_line['sub_field']);
	$CP2 = trim($sb_line['sub_descricao']);
	$CP3 = trim($sb_line['sub_caption']);
	$CPID = trim($sb_line['sub_id']);
	$CPD = trim($sb_line['sub_descricao']);
	///////////////////////////// trocas
	$CP1 = troca($CP1,'$user_id',"'".strzero($id_pesq,7)."'");
	
	if (substr($CP1,0,2) != '$A') ////////////////// informaivo com HR
		{ $CP2 = '<font class="lt0">'.$CP2; } else
		{ $CP2 = '<font class="lt3">'.$CP2; }
	if (strlen($CP3) > 0)
		{
		$CP2 .= '<br><FONT CLASS="lt0"><FONT color="#ff8888">'.$CP3;
		}
//	$estilo = trim($sb_line['sub_estilo']);
	$obriga = trim($sb_line['sub_obrigatorio']);
	$tips = trim($sb_line['sub_informacao']);
	if ((strlen($tips) > 0) and (substr($CP1,0,2) != '$F'))
		{ $CP2 .= '<BR>'.tips('<img src="img/icone_information_mini.png" alt="" border="0">',$tips); }
	if (substr($CP1,0,2) == '$F')
		{ $CP2 = '<B>'.$CP2.'</B><BR><BR>'.mst($tips); }	
	///////////////////////////qqq busca dados gravados
	if (strlen($acao) == 0)
		{
		$sql = "select * from ".$tdov." where ";
		$sql .= "spc_pagina = '".strzero($prj_pg,3)."' ";
		$sql .= " and spc_projeto = '".$protocolo."' ";
		$sql .= " and spc_autor = '".strzero($id_pesq,7)."' ";
		$sql .= " and spc_codigo = '".$xcod."'";
		$yrlt = db_query($sql);

		if ($yline = db_read($yrlt))
			{
			$dd[$dx] = trim($yline['spc_content']);
			}
		}
    ///////////////////////////////////////////////////
	require("submit_phase_2_fields.php");
	///////////////////////////////////////////////////
	$ed = false;

		///////////////////////////////////////////////////////
	if (substr($CP1,0,10)=='$PUC_ALUNO') ///////////////// ALUNO DA PUCPR
		{ require("pucpr_aluno.php"); $ed = false; }

	if (substr($CP1,0,9)=='$PUCALUNO') ///////////////// ALUNO DA PUCPR
		{ 
		require("pucpr_aluno_mst.php"); 
		$ed = false; 
		$CP1 = "$H8"; 
		}

	if (substr($CP1,0,6)=='$PIBIC') ///////////////// Orçamento
		{ require("submit_pibic_resumo.php"); $ed = true; echo $sr; }

	if (substr($CP1,0,7)=='$PIBITI') ///////////////// Orçamento
		{ require("submit_pibiti_resumo.php"); $ed = true; echo $sr; }
				
	if (substr($CP1,0,5)=='$FIM') ///////////////// Finaliza
		{ redirecina("submit_finalizar_2_pibiti.php?dd0=SIM"); $ed = False; exit;}
		
	if (substr($CP1,0,5)=='$FIC') ///////////////// Finaliza sub-projeto
		{ redirecina("submit_pibic_projeto_fim.php?dd0=SIM"); $ed = False; exit;}	

	if (substr($CP1,0,5)=='$FIT') ///////////////// Finaliza sub-projeto
		{ redirecina("submit_pibiti_projeto_fim.php?dd0=SIM"); $ed = False; exit;}	

	if (substr($CP1,0,12)=='$PROJE_ATIVO') ///////////////// Orçamento
		{ require("submit_pibic_projeto_sel.php"); $ed = true; $s .= $so;}		
		
	if (substr($CP1,0,19)=='$PROJE_PIBITI_ATIVO') ///////////////// Orçamento
		{ require("submit_pibiti_projeto_sel.php"); $ed = true; $s .= $so;}		

	if (substr($CP1,0,5)=='$FILE') ///////////////// Orçamento
		{ require("submit_phase_arquivos.php"); $edx = true; }		
		
	if ($ed == false)
		{
		$s .= '<TR valign="top">';
		$s .= gets('dd'.$dx,$dd[$dx],$CP1,$CP2,$obriga,1);
		}
		
	$s .= $sp;
	if (strlen($acao) > 0) 
		{ 
		if (($obriga == 1) and (strlen($dd[$dx])==0)) 
			{ 
			$ok = 0; 
			$err .= '<FONT COLOR=RED>Campo <B>'.$CPD.'</B><FONT COLOR=RED> é obrigatório</FONT><BR></FONT>';; 
			
			}
		}
//	array_push($cp,array($CP1,'',$CP2,False,True,''));
	$dx++;
	}
	
if (($erro) or ($nerr > 0))
	{
		if ($nerr >0)
			{ require("submit_pendencias.php"); }
	} else {	
		require("submit_finalizar.php");	
		if (!($fim))
			{
			$s .= '<TR>';
			$s .= chr(13).'<TR><TD colspan="2" align="center"><input type="submit" name="acao" value="Gravar e avançar >>>" style="width:250; height:40;" ></TD></TR>';
			}
	}
$s .= '</TABLE>';	
///////////////////////////////////////////////////////qq
if ((strlen($acao) > 0) and ($ok == 1) and ($nerr ==0))
	{
//	require("submit_phase_2_fields.php");
	require("submit_phase_grava.php");
	redirecina("submit_phase_2_pibiti.php?dd98=".($prj_pg+1));
	exit;
	} else {
		///////////////// Liberar Gravação
		echo '';
	}
////////////////////////////////////////////////////////
echo $err;
echo $s;
require($include.'cp2_gravar.php');
require("foot.php");
echo '<font class="lt0">';
echo $protocolo.'-'.$prj_nr;
?>

