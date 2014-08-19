<?
require("_class/_class_submit.php");

/* Carrega classes */
require_once($include.'_class_form.php');
$form = new form;

require_once('_class/_class_position.php');
$pos = new posicao;

/* Recupera protocolo de submissão */

$protocolo = $_SESSION['protocol_submit'];

/* Sistema de arquivos postados */
require_once('../_ged_submit_files.php');
$ged->protocolo = $protocolo;
$ged->protocol = $protocolo;

/* Cria objeto de submissão */
$clx = new submit;

/* Identifica o autor */
$clx->author_id(0);
if (strlen($clx->author_codigo) > 0)
	{ $login = 1; }
$clx->protocolo = $ged->protocolo;
//$clx->journal_id = $_SESSION['journal_id'];

/* Paginacao */
$pages = $_GET['pag'];
if (strlen($pages) > 0) { $pag = $pages; } else { $pag = $_COOKIE['pages']; }
if (strlen($pag)==0) { $pag = 1; }

/* Se não estiver logado, solicita login */
if ($login==0)
	{
		echo '<HR>';
		$page = http.'pb/index.php/'.$path.'?dd99=submit';
		echo $clx->autor_login_form($page);
	} else {
/* Usuario logado */
		$page = http.'pb/index.php/'.$path;
		$pages = array('',$page,$page,$page,$page);
		$caps = array('Title','Autors','Files','Confirm');
		
/* Finaliza submissão */
		if ($pag==5)
			{
				echo '<H1>Finalização da Submissão</h1>';
				//$clx->enviar_email();
				$clx->finalizar();
				echo '<BR><BR><BR><BR><BR><BR>';
			} else {
/* Gera os formulários de submissão */				
				echo '<h2>'.msg('submission').'</h2>';
				echo $pos->show($pag,4,$caps,$pages);
				echo $clx->submit_01($pag);
			}		
	}
	
/* Submissão */
/* Como realizar a chamada */
function function_001()
	{
		global $dd,$acao,$clx;
		$sx .= '<tr><td colspan=2>';
		$sx .= '<fieldset>';
		$sx .= '<legend>Autores</legend>';
		$sx .= '<div id="autores" style="width: 100%">';
		$sx .= '</div>';
		$sx .= '</fieldset>';
		$sx .= '</td></tr>
		
		<script>
		var url_link = "'.http.'pb/submit_ajax.php";
		var $tela = $.ajax({ url: url_link, type: "POST", 
			data: { dd0: "'.$_SESSION['protocol_submit'].'", dd1: "autor"  }
			})
			.fail(function() { alert("error"); })
 			.success(function(data) { $("#autores").html(data); });
			;		
		</script>
		';		
		return($sx);
	}
function function_002()
	{
		global $dd,$acao,$clx;
		
		$sx = $clx->documents_requeried();
		$sx = '<TD colspan=2>'.$sx.'</td>';
		return($sx);
	}
?>