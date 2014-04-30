<?php
require("cab.php");
require($include.'sisdoc_debug.php');

require("../_class/_class_discentes.php");
$dis = new discentes;

$tabela = $dis->tabela;
require("../_class/_class_pibic_pagamento.php");
$pag = new pagamentos;

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_pibic_historico.php");
$hi = new pibic_historico;

$dis->le(round($dd[0]));

echo $dis->mostra_dados_pessoais();
$cracha = $dis->pa_cracha;
$cpf = $dis->pa_cpf;

echo '<HR>';
$dis->limpar_aluno_sem_codigo();

echo $dis->documentos_pessoais($cracha);
echo '<BR>';

echo $dis->formacao_pos($cracha);

$arr = $pb->discentes_ic($cracha);

echo '<h3>'.msg('participacao_ic').'</h3>';
echo $pb->mostra_orientacoes_ic($arr);

echo $hi->consulta_historico($cracha);

echo '<BR>';
echo $pag->pagamentos('',$dis->pa_cpf);

require("../foot.php");
