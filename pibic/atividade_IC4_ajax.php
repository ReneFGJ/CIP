<?
$include = '../';
require("../db.php");

$proto = $dd[0];
if (strlen($proto) > 0)
	{
		$_SESSION['proto_rel'] = $proto;
	} else {
		$proto = $_SESSION['proto_rel'];
	}
	
echo '<table width="100%" class="tabela00">';
echo '<TR>';
echo '<TH width="70%">Nome completo do autor';
echo '<TH width="15%">participação';
echo '<TH width="15%">Instituição (SIGLA)';

ini_set('display_errors', 255);
ini_set('error_reporting', 255);
$dd[10]=utf8_decode($dd[10]);

/* Classe */
require("../_class/_class_semic.php");
$sub = new semic;

/* Informacoes sobre a tabela */
$tabela = 'semic_ic_trabalho';
$sub->tabela = $tabela;
$sub->tabela_autor = $tabela.'_autor';

/******************************
 * Salvar
 */
$acao = trim($acao);
if ($acao == 'adicionar')
	{
		$protocolo = $dd[0];
		
		if ($sub->adicionar_autor($protocolo,$dd[10],$dd[11],$dd[12])==1)
			{
				$dd[10]='';
				$dd[11]='';
				$dd[12]='';
			}
	}
	
/*******************************
 * Remover autor
 */
if ($acao == 'remover')
	{
		$protocolo = $dd[0];
		$id = $dd[2];
		$sub->remover_autor($protocolo,$id);
	}
$sx = '<TR>';
$sx .= '<TD>';
$sx .= '<input type="text" value="'.$dd[10].'" id="dd10" name="dd10" size="60" maxsize="100">';

/* Valida autores */
$sql = "select * from ".$sub->tabela_autor." 
			where sma_protocolo = '".$dd[0]."'
			and sma_ativo = 1 
			order by sma_funcao, sma_nome 
		";
$rlt = db_query($sql);

$sa = '';
$est = 0;
$ori = 0;

//if (strlen($dd[12])==0) { $dd[12] = 'PUCPR'; }
$sj = '';
while ($line = db_read($rlt))
	{
		$id = $line['id_sma'];
		$sa .= '<TR>';
		$sa .= '<TD class="tabela01">';
		$sa .= trim($line['sma_nome']);
		
		$funcao = trim($line['sma_funcao']);
		switch ($funcao)
			{
			case "0": $funcao = "Discente"; $est=1; break;
			case "1": $funcao = "Orientador"; $ori=1; break;
			case "2": $funcao = "Co-orientador"; break;
			case "3": $funcao = "Colaborador"; break;
			case "7": $funcao = "Mestrando de Pós-Graduação"; break;
			case "8": $funcao = "Doutorando de Pós-Graduação"; break;
			case "4": $funcao = "Pibic Junior"; break;
			case "5": $funcao = "Supervisor Pibic Junior"; break;
			case "6": $funcao = "Escola"; break;				
			case "9": $funcao = "Orientador"; $ori=1; break;
			}
		$sa .= '<TD class="tabela01">';
		$sa .= $funcao;
		
		$sa .= '<TD class="tabela01">';
		$sa .= trim($line['sma_instituicao']);
		
		$sa .= '<TD class="tabela01">';
		$sa .= '<A HREF="#" title="remover autor" 
					onclick="remover_autor(\''.round($id).'\');">';
		$sa .= '<img src="../img/icone_remove.png" border=0 >';
		$line['id_sma'];
		$sa .= '</A>';		
	}



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

$sx .= '<TD>';
$sx .= '<select name="dd11" id="dd11">';
$sx .= '<option value=""></O>';
if ($est==0) { $sx .= '<option value="0" '.$chk[0].'>Discente</option>'; }
if ($ori==0) { $sx .= '<option value="9" '.$chk[1].'>Orientador</option>'; }
$sx .= '<option value="2" '.$chk[2].'>Co-orientador</option>';
$sx .= '<option value="3" '.$chk[3].'>Colaborador</option>';

$sx .= '<option value="7" '.$chk[3].'>Mestrando de Pós-Graduação</option>';
$sx .= '<option value="8" '.$chk[3].'>Doutorando de Pós-Graduação</option>';
$sx .= '<option value="4" '.$chk[3].'>Pibic Junior</option>';
$sx .= '<option value="5" '.$chk[3].'>Supervisor Pibic Junior</option>';
$sx .= '<option value="6" '.$chk[3].'>Escola (para Pibic Júnior)</option>';

$sx .= '</select>';

$sx .= '<TD>';
$sx .= '<input type="text" value="'.$dd[12].'" id="dd12" name="dd12" size="10" maxsize="9">';

$sx .= '<TD>';
$sx .= '<input type="button" id="acao_autor" name="acao" value="adicionar >>" size="10" maxsize="9" class="botao-geral">';

$sx .= '
		<script>
		$("#acao_autor").click(function() {
		var nome = $("#dd10").val();
		var participacao = $("#dd11 option:selected").val();
		var instituicao = $("#dd12").val();
		
		var $tela = $.ajax({ url: "atividade_IC4_ajax.php", type: "POST", 
			data: { dd0: "'.$dd[0].'", dd1: "autor", dd10: nome, dd11: participacao, dd12: instituicao, acao:"adicionar"  }
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
			var $tela = $.ajax({ url: "atividade_IC4_ajax.php", type: "POST", 
				data: { dd0: "'.$dd[0].'", dd1: "autor", dd2: reg, acao:"remover"  }
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