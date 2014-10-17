<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Capta��o'));

require("cab_cip.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_windows.php');
require($include.'cp2_gravar.php');

require($include.'sisdoc_email.php');

require("../_class/_class_docentes.php");

require("../_class/_class_position.php");
$pos = new posicao;
require("../_class/_class_captacao.php");
$cap = new captacao;
require("../_class/_class_bonificacao.php");
$bon = new bonificacao;
/* P�gina */
$pag = $_GET["pag"];
if (strlen($pag) ==0 ) { $pag = $_SESSION['pag_cap']; }
if (strlen($pag)==0)
	{ $pag = 1; }
//if (strlen($cap->protocolo)==0) { $pag=1; }
	
$_SESSION['pag_cap'] = $pag;

if (strlen($dd[0]) > 0) { $cap->le($dd[0]); }
echo $pos->show($pag,4);
$status = $cap->status;

if (($cap->status <> 0) and ($cap->status <> 8))
	{
		echo '<fieldset><legend>Capta��o de Recurso</legend>';
		echo '<H3><font color="red">Projeto n�o est� mais em edi��o</font></h3>';
		echo '</fieldset>';
		exit;		
	}
/* Informacoes sobre a edicao */
$tabela = $cap->tabela;

$data = date("Ymd");


if (date("Ymd") < 20131220)
	{
	echo '<IMG SRC="'.$http.'img/icone_alert.png">';
	echo '<font color="red" style="font-size: 18px.">';
	echo 'Prezados pesquisadores<BR><BR>Informamos que ser� solicitado o(s) pagamento(s) da(s) bonifica��o(�es) do(s) Projeto(s) de Pesquisa com Capta��o de Recursos, registrados e validados pelos Coordenadores dos Programas stricto sensu, no Centro Integrado de Pesquisa - CIP,  que estejam na al�ada da Diretoria de Pesquisa at� o dia 06/12/2013, o restante dos projetos n�o validados pelo coordenadores at� esta data, ser�o verificados em 2014.';
	echo '<BR><BR>';
	echo 'Os novos cadastros est�o suspensos at� 20/12/2013';
	echo '</font>';
		
	exit;
	}
	


if ($pag == 1) { $cp = $cap->cp_01(); }
if ($pag == 2) { $cp = $cap->cp_02(); }
if ($pag == 3) { $cp = $cap->cp_03(); }
if ($pag == 4) { $cp = $cap->cp_04(); }
if ($pag == 5) 
	{
		echo 'Inserir historico';
		$bon->historico_inserir($cap->protocolo,'cad','cadastro de nova capta��o');
		// Alterar Status
		echo '<BR>Alterar status';
		$cap->alterar_status(10);

		echo '<BR>Envio de e-mail';
		$cap->enviar_email_coordenador();
		echo '<BR>FIM';
		exit; 
	}
	
/* P�gina 04 */
if ($pag == 4)
	{
		echo '<fieldset><legend><h3>'.msg('cadastro_projeto').'</h3></legend>';
		echo '<P>';
		
		require("_ged_captacao_ged_documento.php");
		$ged->protocol = $cap->protocolo;
		$arqs = $ged->file_list();		
		/* */
		$total_arquivos = $ged->total_files;
		
		if ($total_arquivos == 0)
			{
				$img = '<img src="'.$http.'img/icone_alert.png">';
				array_push($cp,array('$H8','','',True,True));
				array_push($cp,array('$M8','',$img.'<BR><font color="red">Documentos comprobat�rios n�o foram anexados</font>',True,True));
			}
		
		echo msg('cadastro_projeto_info');
		echo '</P>';
	}

/* Pagina 03 */
if ($pag == 3) 
	{
		require("_ged_captacao_ged_documento.php");
		$ged->protocol = $cap->protocolo;
		$arqs = $ged->file_list();
		
		/* */
		$total_arquivos = $ged->total_files;
		
		echo $cap->mostra();
		
		
		/* */
		if ($total_arquivos == 0)
			{
				echo '<H2><img src="'.$http.'img/icone_alert.png">Nenhum arquivo postado</h2>';
			} else {
				echo $arqs;
			}
		echo msg('cap_arquivo_obrigatorio');
		echo '<BR>';
		echo '<BR>';
		//if ($perfil->valid('#SCR#ADM#COO'))
		{
			echo $ged->upload_botton_with_type($cap->protocolo,'','DOC');
		}		
	}
if (($pag==1) or ($pag==2) or ($pag==3) or ($pag==4))
	{
	echo '<Table width="100%" class="tabela00">';
	echo '<TR><TD>';
	editar();
	echo '</table>';
	}

if ($saved > 0)
	{
		$user = $ss->user_cracha;
		if (strlen($dd[0])==0)
			{
				$sql = "select max(id_ca) as id_ca from captacao where ca_professor = '".$user."' ";
				$rlt = db_query($sql);
				$line = db_read($rlt);
				$dd[0] = $line['id_ca'];
			}
		$cap->updatex();
		$cap->atualiza_vigencias($dd[0]);
		//$cap->atualiza_vigencia();
		$pag++;
		$_SESSION['pag_cap'] = $pag;
		redirecina(page().'?dd0='.$dd[0].'&dd90='.checkpost($dd[0]));
	}
require("../foot.php");	
?>