<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Capta��o'));

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
<BR><BR>Neste m�s de julho a Diretoria de Pesquisa est� implementando o Centro Integrado de Pesquisa (CIP). Este projeto visa integrar diversos sistemas dentro da institui��o com o intuito de reduzir as demandas de coletas de dados e  recadastramento, al�m de integrar diversos sistemas de pesquisa dentro da PUCPR, de forma a agilizar os processo de produ��o de relat�rios e processos.
<BR><BR>Nesse primeiro momento, informa��es referentes � capta��o de recursos, que foram previamente cadastrados,  encontram-se dispon�veis no link abaixo para sua valida��o e corre��o. Pedimos, por gentileza, que verifique e valide os dados referente �s suas capta��es, corre��es e altera��es podem ser realizadas em todos os projetos. 
<BR><BR>Os dados validados ser�o utilizados para pagamento da bonifica��o dos projetos de pesquisa que tiveram o in�cio de vig�ncia em 2011. As bonifica��es correspondem a 3% do valor da aprova��o do projeto, tendo o teto de R$ 500.000,00, ou seja, at� R$ 15.000,00 por projeto por pesquisador dos programas <I>Stricto Sensu</I> da PUCPR.
<BR><BR>$link
<BR><BR>caso haja erro, inconsist�ncia ou dificuldade, favor entrar em contato com a Erli pelo telefone 3271.2582 ou por e-mail: nucleo.pesquisa@pucpr.br
<BR><BR><BR>Att.
<BR>Paula Cristina Trevilatto
<BR>Diretora de Pesquisa
<BR>Pr�-Reitoria de Pesquisa e P�s-Gradua��o
<BR>PUCPR
';

$texto = '
Prezado Pesquisador(a) $nome,
<BR><BR>Neste m�s de julho, a Diretoria de Pesquisa est� implementando o Centro Integrado de Pesquisa (CIP). Este projeto visa integrar diversos sistemas dentro da institui��o, com o intuito de reduzir as demandas de coletas de dados e recadastramento, al�m de integrar diversos sistemas de pesquisa dentro da PUCPR, de forma a agilizar os processo de produ��o de relat�rios e processos.
<BR><BR>Nesse primeiro momento, informa��es referentes � capta��o de recursos, que foram previamente cadastradas, encontram-se dispon�veis no link abaixo para sua <font color=red >valida��o e corre��o</font> (se necess�rio). Pedimos, por gentileza, que verifique e valide os dados referentes �s suas capta��es. Corre��es e altera��es podem ser realizadas em todos os projetos. A inclus�o de novos projetos com capta��o tamb�m pode ser realizada.
<BR><BR>Os dados validados ser�o utilizados para pagamento da bonifica��o de <font color=red >conv�nios e contratos</font> que apresentam o <font color=red >in�cio de vig�ncia a partir de janeiro de 2011</font>. As bonifica��es correspondem a 3% do valor da aprova��o do projeto, tendo o teto de R$ 500.000,00, ou seja, at� R$ 15.000,00 por projeto por pesquisador dos programas Stricto Sensu da PUCPR.
<BR><BR>$link
<BR><BR><font color=red >Note que, para que possamos realizar a bonifica��o nos pr�ximos 3 meses, � necess�rio que o(a) senhor(a) valide as informa��es at� segunda-feira, dia 23/07, acessando o link acima</font>.
<BR><BR>Um abra�o!
<BR><BR>Paula Cristina Trevilatto
<BR>Diretora de Pesquisa
<BR>Pr�-Reitoria de Pesquisa e P�s-Gradua��o
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
	//enviaremail('renefgj@gmail.com','','Valida��o de Projetos de Pesquisa - Capta��o',$ttt);
	echo 'Enviado';
	
	if (strlen($email) > 0) {
		echo '<BR>Enviado para '.$email; 
		enviaremail($email,'','Valida��o de Projetos de Pesquisa - Capta��o',$ttt);		
		}
	if (strlen($email2) > 0) {
		echo ', e para '.$email2;
		enviaremail($email2,'','Valida��o de Projetos de Pesquisa - Capta��o',$ttt);		 
		}	
	}	
		
}
	echo '<table width="700">';
	echo '<TR><TD>';
	echo $ttt;
	echo '</table>';
	
require("../foot.php");	?>