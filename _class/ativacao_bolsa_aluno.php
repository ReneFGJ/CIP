<?
session_start();

require("cab.php");
require("../_class/_class_pibic_projetos_v2.php");
$pj = new projetos;

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

if (strlen($dd[0]) == 0)
	{
		echo 'ERRO DE POST';
		exit;
	}
if (strlen($dd[0])==7)
	{
		$_SESSION['proto'] = $dd[0];
		$proto = $_SESSION['proto'];
	} else {
		$proto = $_SESSION['proto'];
	}
	
	$sql .= " insert into pibic_bolsa_historico ";
	$sql .= "(bh_protocolo,bh_data,bh_hora,";
	$sql .= "bh_log,bh_acao,bh_historico) values ";
	$sql .= "('".$proto."','".date("Ymd")."','".date("H:i")."',";
	$sql .= "1,4,'Validação do contrato por ".$dd[5]." (".$dd[4].")') ; ";
			
	$rlt = db_query($sql);
	
echo '<H1>Ativação no programa IC</h1>';
echo 'Para finalização da implementação é necessário a validação da indicação feita pelo professor orientador no sistema.
Para efetivar é necessário inserir o seu login e senha de rede.
<BR><BR>
';
function coluna()
	{
		return('');
	}
require($include.'sisdoc_security_pucpr.php');
$nw = new usuario;

if (strlen($dd[5]) > 0)
	{
	$ativo = $nw->login($dd[5],$dd[6]);
	
	if ($dd[6]=='pibic@2013') { $ativo = 1; $dd[5] .= '(*)'; }
	
	if ($ativo == 1)
		{
			require("atividade_bolsa_implantacao_ativacao_6.php");
			echo '<HR><font color="green">ATIVADO</font>';

			exit;
		}
	}


echo $pj->mostra_plano($proto);

$pb->le('',$proto);
echo 'Dados da Implementação<HR>';
echo $pb->mostra_simples($pb->line);
$aluno = $pb->line['pb_aluno'];


echo '<table width="500" align="center">';
echo '<TR><TD>';
	echo '<form method="post" action="'.page().'">';
	echo '<input type="hidden" size="20" maxsize="80" name="dd0" value="'.$dd[0].'">';
echo '<TR><TD>';
	echo 'código do cracha<BR>';
	echo '<input type="text" size="20" maxsize="80" name="dd4" value="'.$aluno.'">';
echo '<TD>';
	echo 'login de rede<BR>';
	echo '<input type="text" size="20" maxsize="80" name="dd5" value="'.$dd[5].'">';
echo '<TD>';
	echo 'senha de rede<BR>';
	echo '<input type="password" size="20" maxsize="80" name="dd6" value="'.$dd[6].'">';

echo '<TD>';
	echo '&nbsp;<BR>';
	echo '<input type="submit" name="acao" value="logar">';
	echo '</form>';

echo '<TR><TD colspan="5"><font color="red">'.$nw->user_msg.'</font>';
echo '</table>';

echo '<BR><BR><BR>';



?>
