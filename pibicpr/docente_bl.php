<?php
require ("cab.php");
require ("../_class/_class_docentes.php");

global $acao, $dd, $cp, $tabela;
require ($include . 'cp2_gravar.php');
require ($include . 'sisdoc_colunas.php');
require ($include . 'sisdoc_debug.php');
require ($include . 'sisdoc_form2.php');

$cl = new docentes;
$cp = $cl -> cp_blacklist();
$tabela = $cl -> tabela;
$http_edit = page();
$http_redirect = '';
$tit = msg("docente");

/** Comandos de Edição */
echo '<div id="content">';
echo '<CENTER><font class=lt5>Penalidades</font></CENTER>';
echo '<TABLE width="<?=$tab_max; ?>" align="center" bgcolor="<?=$tab_color; ?>"><TR><TD>';
editar();
echo '</TD></TR></TABLE>';
?>

<UL class="lt1">
<LI class="lt4">Relatório Parcial
<UL class="lt2">
<LI>Atraso na submissão do relatório parcial, com solicitação de envio fora do prazo, com parecer favorável do Comitê Gestor para entrega da documentação - penalidade de cinco (5) pontos no processo de seleção do próximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>Atraso na submissão do relatório parcial com indeferimento do Comitê Gestor para entrega da documentação em atraso acarreta em cancelamento do projeto, não emissão de declaração de participação no Programa e penalidade de dez (10) pontos. PROTOCOLO xxxxxxxxx</LI>
<LI>Atraso na submissão do relatório parcial, sem manifestação do professor, projeto cancelado, penalidade de 15 pontos. PROTOCOLO xxxxxxxxx</LI>
</UL>
</LI>

<LI class="lt4">Relatório Final</LI>
<UL>
<LI>Atraso na submissão do relatório final, com solicitação de envio fora do prazo, com parecer favorável do Comitê Gestor para entrega da documentação -  penalidade de cinco (5) pontos no processo de seleção do próximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>Atraso na submissão do relatório final com indeferimento do Comitê Gestor para entrega da documentação em atraso acarreta em cancelamento do projeto, não emissão de declaração de participação no Programa e penalidade de dez (10) pontos. PROTOCOLO xxxxxxxxx</LI>
<LI>Atraso na submissão do relatório final e resumo, sem manifestação do professor, penalidade: impossibilidade de participar no edital seguinte. PROTOCOLO xxxxxxxxx</LI>
</UL>

<LI class="lt4">SEMIC
<UL  class="lt2">
<LI>A ausência do professor orientador em qualquer uma das etapas do SEMIC, sem justificativa aceita pelo Comitê Gestor, PENALIDADE: impedimento de inscrição no edital subsequente. PROTOCOLO xxxxxxxxx</LI>
</UL>
</LI>
<LI class="lt4">Outros</LI>
<UL class="lt2">
<LI>Solicitação de cancelamento de projeto pelo professor. Deferimento do comitê gestor deferimento com penalidade de 15 pontos para o próximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>O professor orientador não cumpriu com suas atividades de avaliador de projetos na etapa da submissão, sem justificativa, penalidade de 05 pontos no próximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>O professor orientador não cumpriu com suas atividades de avaliador de relatório parcial, sem justificativa, penalidade de 05 pontos no próximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>O professor orientador não cumpriu com suas atividades de avaliador de relatório final, sem justificativa, penalidade de 05 pontos no próximo edital. PROTOCOLO xxxxxxxxx</LI>
</UL>
</UL>
<BR><BR><BR><BR><BR><BR><BR><BR>
<?

/** Caso o registro seja validado */
if ($saved > 0) {
	redirecina('docente.php?dd0=' . $dd[0]);
}
echo '</div>';	
require ("../foot.php");
?>
