<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab.php");
require("../_class/_class_captacao.php");
require("../_class/_class_docentes.php");

$doc = new docentes;
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_email.php');
//$cap->structure();

$texto = '
<BR>Prezado pesquisador $nome,
<BR><BR>Neste mês de julho a Diretoria de Pesquisa está implementando o Centro Integrado de Pesquisa (CIP). Este projeto visa integrar diversos sistemas dentro da instituição com o intuito de reduzir as demandas de coletas de dados e  recadastramento, além de integrar diversos sistemas de pesquisa dentro da PUCPR, de forma a agilizar os processo de produção de relatórios e processos.
<BR><BR>Nesse primeiro momento, informações referentes à captação de recursos, que foram previamente cadastrados,  encontram-se disponíveis no link abaixo para sua validação e correção. Pedimos, por gentileza, que verifique e valide os dados referente às suas captações, correções e alterações podem ser realizadas em todos os projetos. 
<BR><BR>Os dados validados serão utilizados para pagamento da bonificação dos projetos de pesquisa que tiveram o início de vigência em 2011. As bonificações correspondem a 3% do valor da aprovação do projeto, tendo o teto de R$ 500.000,00, ou seja, até R$ 15.000,00 por projeto por pesquisador dos programas <I>Stricto Sensu</I> da PUCPR.
<BR><BR>$link
<BR><BR>caso haja erro, inconsistência ou dificuldade, favor entrar em contato com a Erli pelo telefone 3271.2582 ou por e-mail: nucleo.pesquisa@pucpr.br
<BR><BR><BR>Att.
<BR>Paula Cristina Trevilatto
<BR>Diretora de Pesquisa
<BR>Pró-Reitoria de Pesquisa e Pós-Graduação
<BR>PUCPR
';

$texto = '
Prezado Pesquisador(a) $nome,
<BR><BR>Neste mês de julho, a Diretoria de Pesquisa está implementando o Centro Integrado de Pesquisa (CIP). Este projeto visa integrar diversos sistemas dentro da instituição, com o intuito de reduzir as demandas de coletas de dados e recadastramento, além de integrar diversos sistemas de pesquisa dentro da PUCPR, de forma a agilizar os processo de produção de relatórios e processos.
<BR><BR>Nesse primeiro momento, informações referentes à captação de recursos, que foram previamente cadastradas, encontram-se disponíveis no link abaixo para sua <font color=red >validação e correção</font> (se necessário). Pedimos, por gentileza, que verifique e valide os dados referentes às suas captações. Correções e alterações podem ser realizadas em todos os projetos. A inclusåo de novos projetos com captaçåo também pode ser realizada.
<BR><BR>Os dados validados serão utilizados para pagamento da bonificação de <font color=red >convênios e contratos</font> que apresentam o <font color=red >início de vigência a partir de janeiro de 2011</font>. As bonificações correspondem a 3% do valor da aprovação do projeto, tendo o teto de R$ 500.000,00, ou seja, até R$ 15.000,00 por projeto por pesquisador dos programas Stricto Sensu da PUCPR.
<BR><BR>$link
<BR><BR><font color=red >Note que, para que possamos realizar a bonificação nos próximos 3 meses, é necessário que o(a) senhor(a) valide as informações até segunda-feira, dia 23/07, acessando o link acima</font>.
<BR><BR>Um abraço!
<BR><BR>Paula Cristina Trevilatto
<BR>Diretora de Pesquisa
<BR>Pró-Reitoria de Pesquisa e Pós-Graduação
<BR>PUCPR
';
$texto2	 = msg('email_captacao_link');

$sql = "select * from docentes where pp_ss = 'S' 
		and pp_ativo = 1
		order by pp_nome ";
$rlt = db_query($sql);

echo '<A HREF="captacao_lista_email.php?dd2=S">Clique aqui para enviar os e-mail</A>';

require("_email.php");

while ($line = db_read($rlt))
{
	if (strlen(trim($line['pp_email']))==0) { echo '<font color="red">';}
	else { echo '<font color="#101010">'; }
	$link = 'http://www2.pucpr.br/reol/pesquisador/acesso.php?dd0='.trim($line['pp_cracha']).'&dd90='.substr(md5('pesquisador'.trim($line['pp_cracha'])),0,10);
	$link = '<A HREF="'.$link.'">'.$link.'</A>';
	$ttt = troca($texto,'$link',$link);
	$ttt = troca($ttt,'$nome',trim($line['pp_nome']));

	$email = trim($line['pp_email']);
	$email2 = trim($line['pp_email_alt']);
	echo '<HR>';
	echo $line['pp_nome'];
	echo '<BR>'.$link;
	echo '<HR>';
	
	if (strlen($dd[2]) > 0)
	{
	//enviaremail('renefgj@gmail.com','','Validação de Projetos de Pesquisa - Captação',$ttt);
	echo 'Enviado';
	
	if (strlen($email) > 0) {
		echo '<BR>Enviado para '.$email; 
		enviaremail($email,'','Validação de Projetos de Pesquisa - Captação',$ttt);		
		}
	if (strlen($email2) > 0) {
		echo ', e para '.$email2;
		enviaremail($email2,'','Validação de Projetos de Pesquisa - Captação',$ttt);		 
		}	
	}	
		
}
	echo '<table width="700">';
	echo '<TR><TD>';
	echo $ttt;
	echo '</table>';
	
require("../foot.php");	?>