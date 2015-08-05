<?
require ("cab.php");
require ($include . 'sisdoc_debug.php');

/* Tipo do serviço */
$tipo = 'RCS';

require ("../_class/_class_pibic_projetos_v2.php");
$pb = new projetos;

require ("../_class/_class_discentes.php");
$dc = new discentes;

require ("../_class/_class_protocolo.php");
$pr = new protocolo;

/* redireciona se sessao expirada */
$proto = $_SESSION['ic_protocolo'];
if (strlen($proto) == 0) {
	redireciona('index.php');
	exit ;
}

echo '<h1>' . msg('protocolo_' . $tipo) . '</h1>';

/* Erros */
$erro01 = '<h4>Já existe uma protocolo de atendimento deste tipo, aguarde ser finalizado</h4>';

/* formulario */
require ($include . '_class_form.php');
$form = new form;
require ("_form_css.php");
$pb -> le_plano($proto);
echo '<table>';
echo $pb -> mostra_plano($proto,$pb->line);
echo '</table>';
/* Verificar se não existe um protocolo desse tipo aberto */
$ok = $pr -> verifica_sem_exite_protocolo_aberto($proto, $tipo);
if ($ok == 1) {
	echo '<h1><font color="red">*** ERRO ao solicitar abertura ***</A></h1>';
	echo $erro01;
	$_SESSION['ic_protocolo'] = '';
	exit ;
}

/* campos */
$cp = array();
array_push($cp, array('$H8', '', '', False, True));
$mt = $pb -> substituicao_motivo();
$opm = ' : ';

foreach ($mt as $key => $value) {
		
		$opm .= '&' . $key . ':' . $value;
}
array_push($cp, array('$H8', '', '', False, True));
array_push($cp, array('$O ' . $opm, '', 'Motivo do recurso', True, True));
array_push($cp, array('$T80:5', '', 'Justificativa', True, True));
array_push($cp, array('$DECLA', '', '', True, True));
array_push($cp, array('$B8', '', 'Solicitar alteração >>', False, True));

$tela = $form -> editar($cp, '');

/* recupera tipo de bolsa */
$bolsa = $pb -> line['pb_tipo'];

/* valida formulário */
if ($form -> saved > 0) {
	/* Abre protocolo de atendimento */
	$local = 'IC';
	$autor = $pb -> line['pp_cracha'];
	$protocolo = $proto;
	$descricao = $dd[3];
	$justificativa = $dd[2] . ' - ' . $mt[$dd[2]] . '<BR>Justificativa:' . $dd[5];

	/* Verifica se não existe um protocolo aberto */
	$ok = $pr -> criar_protocolo($local, $tipo, $autor, $protocolo, $descricao, $justificativa);
	if ($ok == 1) {
		/* Comunicao Coordenação */
		/* Comunica Professor */
		/* Encerra abertura */

		echo '<center>';
		echo '<h1>Solicitação de reconsideração aberta com sucesso!</h1>';
		exit ;
	} else {
		echo '<center>';
		echo '<h1><font color="red">*** ERRO ao solicitar abertura ***</A></h1>';
		switch($ok) {
			case -1 :
				echo erro01;
				break;
		}
	}
	$_SESSION['ic_protocolo'] = '';
	exit ;
} else {
	echo '<table width="100%" class="tabela00">';
	echo '<TR valign="top">';
	echo '<TD width="70%">' . $tela;
	echo '<TD width="30%">
			<h3>Informações</h3>
			' . msg('info_IC_RCS');
	echo '</table>';
}
echo '<BR><BR><BR><BR><BR><BR><BR>';
echo '</div></div>';
echo $hd -> foot();
?>