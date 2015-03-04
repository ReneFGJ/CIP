<?
require("cab_pibic.php");

require("../_class/_class_pibic_bolsa_contempladas.php");

if (strlen($acao) > 0)
	{
		$tipo = trim($dd[1]);
		$proto = trim($dd[2]);
		$check = trim($dd[3]);
		
		if ($check == checkpost($proto))
			{
				$_SESSION['ic_protocolo'] = $proto;
				redireciona($http.'protocolo/protocolo_abrir_'.$tipo.'.php');
				exit;				
			}
	}

$b1 = 'Avançar >>>';

$pb = new pibic_bolsa_contempladas;

echo '<h1>'.msg('protocolo_'.$dd[1]).'</h1>';

$professor = trim($nw->user_cracha);

$sql = "select * from ".$pb->tabela." 
			inner join pibic_aluno on pb_aluno = pa_cracha
			inner join pibic_professor on pb_professor = pp_cracha
			inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
			left join ajax_areadoconhecimento on pb_semic_area = a_cnpq
			where pbt_edital <> 'CSF'
			and pb_professor = '".$professor."' 
			and pb_status = 'A'
			and (a_ativo = '1' or a_semic = '1') 
			";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
		$proto = trim($line['pb_protocolo']);
		
		$sx .= '<form method="post" action="'.page().'">';
		$sx .= '<input type="hidden" name="dd1" value="'.$dd[1].'">';
				
		$sx .= '<TR valign="top">';
//		$sx .= '<TD width="99%">';
		$sx .= $pb->mostra_registro($line);
		
		$sx .= '<TD>';
		$sx .= '<input type="hidden" name="dd2" value="'.$proto.'">';
		$sx .= '<input type="hidden" name="dd3" value="'.checkpost($proto).'">';		
		$sx .= '<TD colspan=5>';
		$SX .= '<BR><BR>';
		$sx .= '<input type="submit" name="acao" value="Solicitar alterar desse protocolo >>>">';
		$sx .= '</form>';
	}
	
	
echo '<table width="100%" class="tabela00" border=0 >'.$sx.'</table>';
echo '</form>';
echo '<BR><BR>';
echo '<p align="left">	Prezado Professor Orientador, </p>
						<p>Esclarecemos que todas as substituições de projetos com BOLSA deverão ser solicitadas 
						até o dia 05 de cada mês para que o aluno vigente receba referente ao mês solicitado.
						Caso contrário a bolsa será paga no mês seguinte à solicitação. </p>
						<p>Cancelamentos de bolsas serão aceitos somente até 30 de abril de 2015, com justificativa,
						sendo analisada pelo Comitê Gestor a possibilidade de devolução dos valores recebidos. O professor 
						orientador deverá entregar as atividades previstas neste termo e será analisada a motivação do 
						cancelamento, podendo ou não ocorrer penalidade na próxima seleção. Após 1º de maio todos os projetos 
						vigentes deverão participar obrigatoriamente do SEMIC, conforme o item 3.2. Compromissos e Direitos do 
						professor orientador, letra x.
	  </p>';


echo '<BR><BR><BR><BR><BR><BR><BR>';

echo '</div></div>';
echo $hd->foot();
?>