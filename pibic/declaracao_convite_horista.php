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
				redireciona('declaracao_convite_horista_pdf.php?dd0='.$proto.'&dd90='.checkpost($proto));
				exit;				
			}
	}

$b1 = 'Avançar >>>';

$pb = new pibic_bolsa_contempladas;

echo '<h1>Emissão da carta convite de orientação IC/IT/Jr</h1>';

$professor = trim($nw->user_cracha);

$sql = "select * from ".$pb->tabela." 
			inner join pibic_aluno on pb_aluno = pa_cracha
			inner join pibic_professor on pb_professor = pp_cracha
			inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
			left join ajax_areadoconhecimento on pb_semic_area = a_cnpq
			where pbt_edital <> 'CSF'
			and pb_professor = '".$professor."' 
			and pb_status = 'A' 
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
		$sx .= '<input type="submit" name="acao" value="Emitir convite >>>">';
		$sx .= '</form>';
	}
	
	
echo '<table width="100%" class="tabela00" border=0 >'.$sx.'</table>';
echo '</form>';
echo '<BR><BR>';

/*
 * Seta o perfil com a opção escolhida, para cada aopção existe um texto diferente
 * 	ALT = Alteração de título do Plano do Aluno
 * 	SBS = Substituição do aluno
 * 	CAN = Cancelamento de orientação
 */
if ($dd[1] == 'SBS')
	{
		echo '	<p align="justify" style="width:50%; line-height:150%;"> Prezado Professor Orientador, </p>
		
				<p align="justify" style="width:50%; line-height:150%;"> Esclarecemos que todas as substituições de projetos com BOLSA deverão ser solicitadas 
				até o dia 05 de cada mês para que o aluno vigente receba referente ao mês solicitado.
				Caso contrário a bolsa será paga no mês seguinte à solicitação. </p>
				
				<p align="justify" style="width:50%; line-height:150%;"> Cancelamentos de bolsas serão aceitos somente até 30 de abril de 2015, com justificativa,
				sendo analisada pelo Comitê Gestor a possibilidade de devolução dos valores recebidos. O professor 
				orientador deverá entregar as atividades previstas neste termo e será analisada a motivação do 
				cancelamento, podendo ou não ocorrer penalidade na próxima seleção. Após 1º de maio todos os projetos 
				vigentes deverão participar obrigatoriamente do SEMIC, conforme o item 3.2. Compromissos e Direitos do 
				professor orientador, letra x.</p>';
		
	} elseif ($dd[1] == 'CAN')
		{
			echo '	<p align="justify" style="width:50%; line-height:150%;">Prezado Professor Orientador, </p>
			
					<p align="justify" style="width:50%; line-height:150%;"> Cancelamentos de bolsas serão aceitos somente até 30 de abril de 2015, com justificativa,
					sendo analisada pelo Comitê Gestor a possibilidade de devolução dos valores recebidos. O professor 
					orientador deverá entregar as atividades previstas neste termo e será analisada a motivação do 
					cancelamento, podendo ou não ocorrer penalidade na próxima seleção. Após 1º de maio todos os projetos 
					vigentes deverão participar obrigatoriamente do SEMIC, conforme o item 3.2. Compromissos e Direitos do 
					professor orientador, letra x.</p>';
			
		}elseif ($dd[1] == 'ALT')
			{
			  echo'<p align="justify" style="width:50%; line-height:150%;"> Prezado Professor Orientador, </p>
				
					<p align="justify" style="width:50%; line-height:150%;"> Para alteração de título do projeto solicitamos sua <B>especial atenção</B> nos seguintes procedimentos abaixo:
						<p align="justify" style="width:50%; line-height:150%;">
							<ul>
								<li style="list-style-type: disc; font-family: arial, sans-serif; font-size: 12px; margin-top:5px; line-height:120%;"> 
									Todos os títulos dos projetos devem estar padronizados: Primeira letra maiúscula e as demais minúsculas, exceto 
									para nome próprio;</li>
								<li style="list-style-type: disc; font-family: arial, sans-serif; font-size: 12px; margin-top:5px; line-height:120%;"> 
									Caso tenha ocorrido algum problema no desenvolvimento do projeto que <B>justifique</B> alguma alteração de título fique 
									atento que a mudança deve respeitar o proposto no projeto aprovado no edital. <B>Bolsas CNPq e Fundação Araucária não 
									autorizam</B> esse ajuste, neste caso o projeto será transformado em ICV ou ITV;</li>
							</ul>
						</p>
	  				</p>';
		
			}










echo '<BR><BR><BR><BR><BR><BR><BR>';

echo '</div></div>';
echo $hd->foot();
?>