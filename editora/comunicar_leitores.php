<?
require("cab.php");
echo '<link rel="stylesheet" href="../css/style_form_001.css" type="text/css" />';
require($include."sisdoc_windows.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_email.php");
require($include."cp2_gravar.php");
require("_email.php");

require("_class/_class_users.php");

echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Comunica��o Pareceristas');

if ($dd[20] == 'DEL')
	{
		$sql = "delete from user_fila_envio ";
		$rlt = db_query($sql);
	}

	$tps = array();
	array_push($tps,array('000','Informar a lista de e-mail manualmente'));
	array_push($tps,array('300','Todos os leitores'));
	
	$op .= ' : ';
	for ($r=0;$r < count($tps);$r++)
		{
			if ($dd[1]==$tps[$r][0]) { $tipo = trim($tps[$r][1]); }
			$op .= '&'.$tps[$r][0].':'.$tps[$r][1];
		}

	$tabela = '';
	
	if ((strlen($dd[1]) > 0) and (strlen($dd[3])==0))
		{
			$page = page();
			$page = troca($page,'.php','_selecao=php');
			$page = troca($page,'=','.');
			require($page);
		}
	
	$cp = array();
	if (strlen($dd[1]) > 0)
		{
			$estilo = ' class="input_001" ';
			array_push($cp,array('${','','Destinat�rios',False,True,''));
			array_push($cp,array('$H8','','',True,True,''));			
			array_push($cp,array('$M','','Destinat�rios: <B>'.$tipo.'</B>',False,True,''));
			array_push($cp,array('$T60:10','','Lista de e-mail',True,True,''));
			array_push($cp,array('$M','','Os e-mail deve estar separados por ponto e v�rgula (;)',False,True,''));
			array_push($cp,array('$}','','',False,True,''));
						
			array_push($cp,array('${','','Conte�do do e-mail',False,True,''));			
			array_push($cp,array('$S200','','T�tulo do e-mail',True,True,''));
			array_push($cp,array('$T60:10','','Texto para enviar',True,True,''));
			array_push($cp,array('$O TXT:Texto&HTML:HTML','','Formato',True,True,''));
			array_push($cp,array('$}','','',False,True,''));
			
			array_push($cp,array('$B8','','Enviar mensagem',false,True,''));
		} else {
			array_push($cp,array('$H8','','',False,True,''));
			array_push($cp,array('$O'.$op,'','Informe os destinat�rios',True,True,''));
			array_push($cp,array('$H8','','',True,True,''));
			array_push($cp,array('$B8','','Avan�ar >>>',false,True,'botao-geral'));		
		}

	

	echo '<TABLE width="940" align="center">';
	echo '<TR><TD colspan=2>';
	echo '<H10>'.msg('comunication').'</h10>';
	echo '<TR><TD>';
		editar();
	echo '<TR><TD colspan="2">';
	echo '</TD></TR>';
	echo '</TABLE>';	
		
if ($saved > 0)
	{
		$email_producao = $dd[3];
		$total = 0;
		$usnome = 'X';
		if ($dd[9] != 'HTML')
			{
				$e4 = mst($dd[8]);
			} else {
				$e4 = $dd[8];
			}
		$e3 = $dd[7];	
		
		/* */
			
		$dx = ' '.$dd[3].';';
		
		
		$titulo = $dd[7];
		$conteudo = $e4;
		$dx = $dd[3].';;';
		
		$titulo_email = $dd[7]; 
		$user = new users;

		$email = splitx(";",$dx);
		$user->email_gera_fila_envio($titulo, $conteudo, $email);
		
	echo "<center>Total de ".$tot." comunicados enviados</center>";
	redirecina('comunicacao_enviar.php');
	}
echo '<A HREF="parecerista_email_importar.php">Importar e-mail</A>';
echo '&nbsp;&nbsp;';

$user = new users;
$tot = $user->email_resumo_enviar();
if ($tot > 0)
	{
		echo '<A HREF="comunicar_leitores.php?dd20=DEL">Cancelar e-mail ('.$tot.')</A>';
	}

echo '</div>';

function coluna() { return(""); }	
?>