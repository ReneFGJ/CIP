<?
$include = '../';
require("../db.php");
require($include.'sisdoc_debug.php');
header("Content-Type: text/html; charset=ISO-8859-1",true);
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />';
echo '<table width="750" class="tabela00">';
echo '<TR>';
echo '<TH width="60%">Nome completo do autor';
echo '<TH width="5%">titulação';
echo '<TH width="15%">Instituição (SIGLA)';
echo '<TH width="5%">Pais';
echo '<TH width="20%">e-mail';

ini_set('display_errors', 255);
ini_set('error_reporting', 255);

/* Classe */
require("_class/_class_submit.php");
$sub = new submit;

/******************************
 * Salvar
 */
$acao = trim($acao);
if ($acao == 'adicionar')
	{
		$protocolo = $_SESSION['protocol_submit'];
		$autor = utf8_encode($dd[10]);
		$titulacao = $dd[11];
		$instituicao = $dd[12];
		$pais = $dd[13];
		$email = utf8_decode($dd[14]);
		$uf = '';
		if ($sub->adicionar_autor($protocolo,$autor,$titulacao,$instituicao,$pais,$uf,$cidade,$email)==1)
			{
				$dd[10]='';
				$dd[11]='';
				$dd[12]='';
				$dd[13]='';
				$dd[14]='';
			}
	}
	
/*******************************
 * Remover autor
 */
if ($acao == 'remover')
	{
		$protocolo = $_SESSION['protocol_submit'];
		$id = $dd[2];
		$sub->remover_autor($protocolo,$id);
	}
	
/* Formulário de entrada */
$sx = '<TR>';
$sx .= '<TD>';
$sx .= 'Nome completo do autor<BR>';
$sx .= '<input type="text" value="'.utf8_decode($dd[10]).'" style="width: 300px;" id="dd10" name="dd10" size="40" maxsize="100">';

/* Valida autores */
$sql = "select * from submit_documento_autor
			left join ajax_pais on sma_pais = pais_codigo
			where sma_protocolo = '".$_SESSION['protocol_submit']."'
			and sma_ativo = 1 
			order by sma_funcao, sma_nome 
		";
$rlt = db_query($sql);
$sa = '';
$est = 0;
$ori = 0;

$sj = '';
while ($line = db_read($rlt))
	{
		$id = $line['id_sma'];
		$sa .= '<TR>';
		$sa .= '<TD class="tabela01">';
		$sa .= utf8_decode(trim($line['sma_nome']));
		$sa .= '<TD class="tabela01">';
		$sa .= $funcao;
		
		$sa .= '<TD class="tabela01">';
		$sa .= trim($line['sma_instituicao']);

		$sx .= '<TR>';
		$sa .= '<TD class="tabela01">';
		$sa .= trim($line['pais_nome']);

		$sa .= '<TD class="tabela01">';
		$sa .= trim($line['sma_email']);
		
		$sa .= '<TD class="tabela01">';
		$sa .= '<A HREF="#" title="remover autor" 
					onclick="remover_autor(\''.round($id).'\');">';
		$sa .= '<img src="../img/icone_remove.png" border=0 >';
		//$sa .= $line['id_sma'];
		$sa .= '</A>';		
	}
$sa .= '</table>';

$sa .= '<table width="750" class="tabela00">';

/*
 * Recupera Select
 */
$chk = array('','','');
switch ($dd[11])
	{
	case '0': $chk[0] = 'selected'; break;
	case '1': $chk[1] = 'selected'; break;
	case '2': $chk[2] = 'selected'; break;
	case '3': $chk[3] = 'selected'; break;
	}

/* titulação */
$sql = "select * from apoio_titulacao where at_tit_ativo = 1 order by ap_tit_titulo";
$sx .= '<TD>';
$sx .= 'Máxima titulação<BR>';
$sx .= '<select name="dd11" id="dd11">';
$sx .= '<option value=""></option>';
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$chk = '';
	if ($dd[11]==trim($line['ap_tit_codigo'])) { $chk = 'selected'; }		
	$sx .= '<option value="'.trim($line['ap_tit_codigo']).'" '.$chk.'>'.$line['ap_tit_titulo'].'</Option>';
	}
$sx .= '</select>';

$sx .= '<TR>';
$sx .= '<TD>';
$sx .= 'Sigla da instituição<BR>';
$sx .= '<input type="text" value="'.utf8_decode($dd[12]).'" id="dd12" name="dd12" size="10" maxsize="9">';


/* pais */
$sql = "select * from ajax_pais where pais_ativo = 1 order by pais_prefe desc, pais_nome";
$sx .= '<TR><TD>País';
$sx .= '<BR>';
$sx .= '<select name="dd13" id="dd13" style="width: 100px;">';
$sx .= '<option value=""></option>';
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$chk = '';
	if ($dd[13]==$line['pais_codigo']) { $chk = 'selected'; }
	$sx .= '<option value="'.$line['pais_codigo'].'" '.$chk.'>'.$line['pais_nome'].'</Option>';
	}
$sx .= '</select>';

/* email */
$sx .= '<TR><TD>e-mail';
$sx .= '<BR>';
$sx .= '<input type="text" value="'.utf8_decode($dd[14]).'" id="dd14" name="dd14" size="40" style="width: 200px;" maxsize="100">';


$sx .= '<TR><TD colspan=5 align="right">';
$sx .= '<input type="button" id="acao_autor" name="acao" value="adicionar >>" size="10" maxsize="9" class="botao-geral">';

$sx .= '
		<script charset="iso-8859-1">
		$("#acao_autor").click(function() {
		var nome = $("#dd10").val();
		var titulacao = $("#dd11 option:selected").val();
		var instituicao = $("#dd12").val();
		var pais = $("#dd13 option:selected").val();
		var email = $("#dd14").val();
				
		var $tela = $.ajax({ url: "'.http.'pb/submit_ajax.php", type: "POST", 
			data: { dd0: "'.$_SESSION['protocol_submit'].'", dd1: "autor", dd10: nome, dd11: titulacao, dd12: instituicao, dd13: pais, dd14: email, acao:"adicionar"  }
			})
			.fail(function() { alert("error"); })
 			.success(function(data) { $("#autores").html(data); });
			;		
		});
		</script>
';

$sx .= '
		<script>
		function remover_autor(id)
			{
			var reg = id;
			var $tela = $.ajax({ url: "'.http.'pb/submit_ajax.php", type: "POST", 
				data: { dd0: "'.strzero($dd[0],7).'", dd1: "autor", dd2: reg, acao:"remover"  }
				})
				.fail(function() { alert("error"); })
 				.success(function(data) { $("#autores").html(data); });
				;		
			}
		</script>
';
echo $sa;
echo $sx;
echo '</table>';
?>