<?php
$cp = array();
array_push($cp,array('$H8','id_pp','',False,True));
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$H8','','',False,True));

/** Tabela **/
$tabela = 'pibic_parecer_'.date("Y");

/** Data, hora e estatus da avaliavcao **/
array_push($cp,array('$HV','pp_parecer_data',date('Yms'),False,True));
array_push($cp,array('$HV','pp_parecer_hora',date('H:m'),False,True));
array_push($cp,array('$HV','pp_status','@',False,True));
$ccor = '<font color=blue >';

/** Primeira questão **/
$cap = "1) 1)	As correções solicitadas foram realizadas?:";
$opc  = 'sim, integralmente:';
 $opc .= ':sim, integralmente.<BR>&';
$opc .= 'sim, parcialmente';
 $opc .= ':sim, parcialmente<BR>&';
$opc .= 'não';
 $opc .= ':não<BR>';

 array_push($cp,array('$H8','id_pp','',True,True));
array_push($cp,array('$R '.$opc,'pp_abe_01',$cap,True,True));

/** Segunda Questão **/
$cap = $sp.'2) Em caso negativo, indique o que não foi corrigido:';
array_push($cp,array('$T80:4','pp_abe_02',$cap,False,True));

$cap = $sp.'3)	Os itens descritos na questão 2 (se aplicável) poderão ser corrigidos no relatório final?';
$opc  = 'sim:sim<BR>';
$opc  .= '&não:não<BR>';
$opc  .= '&não aplicável:não aplicável<BR>';
array_push($cp,array('$R '.$opc,'pp_abe_03',$cap,True,True));

$cap = $sp.'4)	O avaliador considera que o projeto deve ser cancelado em função do não cumprimento das correções indicadas?';
$opc  = 'sim, projeto encaminhado ao comitê gestor:sim, projeto encaminhado ao comitê gestor<BR>';
$opc  .= '&não:não <BR>';
array_push($cp,array('$R '.$opc,'pp_abe_04',$cap,True,True));

/** Quita Questão **/
$cap = $sp.'9) Resultado da reavaliação:';
$opc  = '1:<font color=Green>Aprovado</font><BR>&';
$opc .= '2:<font color=red>Pendências - relatório parcial ainda precisa ser corrigido para o relatório final.</font>';
array_push($cp,array('$R '.$opc,'pp_p01',$cap,True,True));
//array_push($cp,array('$HV','pp_p02','1',True,True));
//array_push($cp,array('$HV','','1',True,True));

array_push($cp,array('$B8','','Finaliza avaliação >>',False,True));

?>