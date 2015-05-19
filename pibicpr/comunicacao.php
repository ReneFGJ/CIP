<?
require("cab.php");
echo '<link rel="stylesheet" href="../css/style_form_001.css" type="text/css" />';
require($include."sisdoc_windows.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_email.php");
require($include."cp2_gravar.php");
require("_email.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('inicia��o cient�fica')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu CIP')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Comunica��o</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';

//////////////////// MANAGERS ///////////////////////////////
$tps = array();
	array_push($tps,array('000','Informar a lista de e-mail manualmente'));

	array_push($tps,array('','-- Docentes ------------------------------'));
	array_push($tps,array('003','Docentes com orienta��es IC (recuperar e-mail)'));
	array_push($tps,array('004','Docentes Stricto Sensu com orienta��es IC (recuperar e-mail)'));
	array_push($tps,array('005','Docentes Stricto Sensu vinculados a programas de P�s-Gradua��o'));
	array_push($tps,array('008','Docentes com titula��o de Msc e Dr.'));
	array_push($tps,array('006','Docentes com Doutorado'));
	array_push($tps,array('009','Docentes Horistas com Orienta��o'));
	array_push($tps,array('013','Docentes TP com Orienta��o'));
	array_push($tps,array('014','Docentes TI com Orienta��o'));
	
	array_push($tps,array('','-- Discentes -----------------------------'));
	array_push($tps,array('060','Estudantes em IC/IT em '.date("Y")));
	array_push($tps,array('061','Estudantes em IC/IT em '.(date("Y")-1)));
	array_push($tps,array('062','Estudantes em IC/IT em '.(date("Y")-2)));
	array_push($tps,array('063','Estudantes em IC/IT em '.(date("Y")-3)));
	
	array_push($tps,array('010','Professores que submeteram projetos em '.date("Y")));
	array_push($tps,array('011','Professores que submeteram projetos (PIBITI) em '.date("Y")));
	array_push($tps,array('012','Professores que submeteram projetos (PIBIC) em '.date("Y")));
	array_push($tps,array('015','Professores que submeteram projetos contemplados com ICV (PIBIC) em '.date("Y")));
	array_push($tps,array('016','Professores que submeteram projetos contemplados com ITV (PIBITI) em '.date("Y")));
	array_push($tps,array('017','Professores que submeteram projetos com views PIBITI em '.date("Y")));
	
	array_push($tps,array('021','Professores que n�o enviaram relat�rio parcial de '.(date("Y")-1).'/'.date("Y")));
	array_push($tps,array('022','Professores que n�o enviaram corre��es do relat�rio parcial de '.(date("Y")-1).'/'.date("Y")));
	array_push($tps,array('024','Professores que n�o enviaram relatorio final de '.(date("Y")-1).'/'.date("Y")));
	array_push($tps,array('028','Professores que n�o enviaram resumo de '.(date("Y")-1).'/'.date("Y")));
	
	array_push($tps,array('110','Avaliadores do relat�rio parcial em aberto ('.(date("Y")-1).'/'.date("Y").')'));
	
	array_push($tps,array('100','Bolsistas produtividades da Institui��o'));
	
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
			if ($dd[1] != '000') { require($page); }
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

	echo '<TABLE width="940" align="left">';
	echo '<TR><TD colspan=2>';
	echo '<H10>'.msg('Comunica��o por e-mail').'</h10>';
	echo '<TR><TD>';
		editar();
	echo '<TR><TD colspan="2">';
	echo '</TD></TR>';
	echo '</TABLE>';	
		
$id = 'ic';
		
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
		$style = '<font style=font-family: Tahoma, Arial; font-size: 12px; line-height: 150%; >';
		$e4 = '<TABLE width=600 ><TR><TD><img src='.http.'img/email_'.$id.'_header.png >
				<TR><TD>
				<BR>'.$style.$e4.'</font><BR>
				<img src='.http.'img/email_'.$id.'_foot.png ></TABLE>';
		$dx = ' '.$dd[3].';';
		echo $e4;
		while (strpos($dx,';') > 0)
			{
			$tot++;
			$e1 = trim(substr($dx,0,strpos($dx,';')));
			$dx = ' '.substr($dx,strpos($dx,';')+1,strlen($dx));
			$email_2 = $e1;
			
			$anti_spam = ' - [IC-'.substr(md5($tot.date("dmYs")),5,10).']';
			
			echo '<BR>enviado ';
			if (strlen($email_2) > 0) { enviaremail($email_2,$e2,$e3.$anti_spam,$e4); echo $email_2.''; }
			}
	echo "<center>Total de ".$tot." comunicados enviados</center>";
	}

if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Inicia��o Cient�fica','Modelo de Mensagens','comunicacao_modelos.php?dd1=ic'));
	array_push($menu,array('Inicia��o Cient�fica','Modelo de Mensagens Pareceristas','comunicacao_modelos.php?dd1=PARIC_'));
	array_push($menu,array('Inicia��o Cient�fica','Modelo de Mensagens Protocolo de Servi�o','comunicacao_modelos.php?dd1=prot_'));
	array_push($menu,array('Inicia��o Cient�fica','Modelo de Mensagens Relat�rio Parcial','comunicacao_modelos.php?dd1=RPA'));
	array_push($menu,array('Inicia��o Cient�fica','Modelos dos Termos de Contrato','comunicacao_modelos.php?dd1=termo_'));
	array_push($menu,array('Inicia��o Cient�fica','Todos os modelos','comunicacao_ver.php'));
	
	array_push($menu,array('SEMIC','Mensagens e e-mail','comunicacao_modelos.php?dd1=semic_'));
	} 
$tela = menus($menu,"3");

require("../foot.php");

?>