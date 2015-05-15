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

$b1 = 'Avan�ar >>>';

$pb = new pibic_bolsa_contempladas;

echo '<h1>Emiss�o da carta convite de orienta��o IC/IT/Jr</h1>';

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
 * Seta o perfil com a op��o escolhida, para cada aop��o existe um texto diferente
 * 	ALT = Altera��o de t�tulo do Plano do Aluno
 * 	SBS = Substitui��o do aluno
 * 	CAN = Cancelamento de orienta��o
 */
if ($dd[1] == 'SBS')
	{
		echo '	<p align="justify" style="width:50%; line-height:150%;"> Prezado Professor Orientador, </p>
		
				<p align="justify" style="width:50%; line-height:150%;"> Esclarecemos que todas as substitui��es de projetos com BOLSA dever�o ser solicitadas 
				at� o dia 05 de cada m�s para que o aluno vigente receba referente ao m�s solicitado.
				Caso contr�rio a bolsa ser� paga no m�s seguinte � solicita��o. </p>
				
				<p align="justify" style="width:50%; line-height:150%;"> Cancelamentos de bolsas ser�o aceitos somente at� 30 de abril de 2015, com justificativa,
				sendo analisada pelo Comit� Gestor a possibilidade de devolu��o dos valores recebidos. O professor 
				orientador dever� entregar as atividades previstas neste termo e ser� analisada a motiva��o do 
				cancelamento, podendo ou n�o ocorrer penalidade na pr�xima sele��o. Ap�s 1� de maio todos os projetos 
				vigentes dever�o participar obrigatoriamente do SEMIC, conforme o item 3.2. Compromissos e Direitos do 
				professor orientador, letra x.</p>';
		
	} elseif ($dd[1] == 'CAN')
		{
			echo '	<p align="justify" style="width:50%; line-height:150%;">Prezado Professor Orientador, </p>
			
					<p align="justify" style="width:50%; line-height:150%;"> Cancelamentos de bolsas ser�o aceitos somente at� 30 de abril de 2015, com justificativa,
					sendo analisada pelo Comit� Gestor a possibilidade de devolu��o dos valores recebidos. O professor 
					orientador dever� entregar as atividades previstas neste termo e ser� analisada a motiva��o do 
					cancelamento, podendo ou n�o ocorrer penalidade na pr�xima sele��o. Ap�s 1� de maio todos os projetos 
					vigentes dever�o participar obrigatoriamente do SEMIC, conforme o item 3.2. Compromissos e Direitos do 
					professor orientador, letra x.</p>';
			
		}elseif ($dd[1] == 'ALT')
			{
			  echo'<p align="justify" style="width:50%; line-height:150%;"> Prezado Professor Orientador, </p>
				
					<p align="justify" style="width:50%; line-height:150%;"> Para altera��o de t�tulo do projeto solicitamos sua <B>especial aten��o</B> nos seguintes procedimentos abaixo:
						<p align="justify" style="width:50%; line-height:150%;">
							<ul>
								<li style="list-style-type: disc; font-family: arial, sans-serif; font-size: 12px; margin-top:5px; line-height:120%;"> 
									Todos os t�tulos dos projetos devem estar padronizados: Primeira letra mai�scula e as demais min�sculas, exceto 
									para nome pr�prio;</li>
								<li style="list-style-type: disc; font-family: arial, sans-serif; font-size: 12px; margin-top:5px; line-height:120%;"> 
									Caso tenha ocorrido algum problema no desenvolvimento do projeto que <B>justifique</B> alguma altera��o de t�tulo fique 
									atento que a mudan�a deve respeitar o proposto no projeto aprovado no edital. <B>Bolsas CNPq e Funda��o Arauc�ria n�o 
									autorizam</B> esse ajuste, neste caso o projeto ser� transformado em ICV ou ITV;</li>
							</ul>
						</p>
	  				</p>';
		
			}










echo '<BR><BR><BR><BR><BR><BR><BR>';

echo '</div></div>';
echo $hd->foot();
?>