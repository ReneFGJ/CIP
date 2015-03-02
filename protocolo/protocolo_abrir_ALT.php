<?
require ("cab.php");
$tipo = 'ALT';
require ("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_protocolo.php");
$pr = new protocolo;

$proto = $_SESSION['ic_protocolo'];
if (strlen($proto) == 0)
	{
		redireciona('index.php');
		exit;
	}

echo '<h1>'.msg('protocolo_'.$tipo).'</h1>';

/* Erros */
$erro01 = '<h4>Já existe uma protocolo de atendimento deste tipo, aguarde ser finalizado</h4>';

/* formulario */
require ($include . '_class_form.php');
$form = new form;
require("_form_css.php");
$pb -> le('', $proto);
echo $pb -> mostar_dados();

/* Verificar se não existe um protocolo desse tipo aberto */
$ok = $pr->verifica_sem_exite_protocolo_aberto($proto, $tipo);
if ($ok == 1)
	{
		echo '<h1><font color="red">*** ERRO ao solicitar abertura ***</A></h1>';
		echo $erro01;			
		$_SESSION['ic_protocolo'] = '';
		exit;	
	}


$cp = array();
array_push($cp, array('$H8', '', '', False, True));
array_push($cp, array('$M', '', 'Informe novo título', False, True));
array_push($cp, array('$T80:5', '', '', True, True));
array_push($cp, array('$M', '', 'Justificativa da alteração', False, True));
array_push($cp, array('$T80:5', '', '', True, True));
array_push($cp, array('$DECLA', '', 'Declaração', True, True));
array_push($cp, array('$B8', '', 'Solicitar alteração de título >>', False, True));

$tela = $form -> editar($cp, '');

/* recupera tipo de bolsa */
$bolsa = $pb->line['pb_tipo'];

/* valida formulário */
if ($form->saved > 0) {
	/* Abre protocolo de atendimento */
	$local = 'IC';
	$tipo  = 'ALT';
	$autor = $pb->line['pp_cracha'];
	$protocolo = $proto;
	$descricao = $dd[2];
	$justificativa = $dd[4];
	
	/* Verifica se não existe um protocolo aberto */
	$ok = $pr->criar_protocolo($local,$tipo,$autor,$protocolo,$descricao,$justificativa);
	if ($ok == 1)
		{
		/* Comunicao Coordenação */
		/* Comunica Professor */
		/* Encerra abertura */
	
		echo '<center>';
		echo '<h1>Solicitação aberta com sucesso!</h1>';
		exit;
		} else {
			echo '<center>';
			echo '<h1><font color="red">*** ERRO ao solicitar abertura ***</A></h1>';
			switch($ok)
				{
				case -1:
					echo erro01;
					break;
				}			
		}
	$_SESSION['ic_protocolo'] = '';
	exit;
} else {
	echo '<table width="100%" class="tabela00">';
	echo '<TR valign="top">';
	echo '<TD width="70%">' . $tela;
	echo '<TD width="30%">
			<h3>Informações</h3>
			' . msg('info_IC_ALT');
	echo '</table>';
}
echo '<BR><BR><BR><BR><BR><BR><BR>';
echo '</div></div>';
echo $hd -> foot();
?>