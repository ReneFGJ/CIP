<?
$tabela = "submit_documentos_obrigatorio";

$cp = array();
array_push($cp,array('$H8','id_sdo','id_faq',False,True,''));
array_push($cp,array('$O '.$journal_id.':'.$journal_title,'sdo_journal_id','Publicação',False,True,''));
array_push($cp,array('$Q sp_descricao:sp_codigo:select * from submit_manuscrito_tipo where journal_id = '.$journal_id,'sdo_tipodoc',CharE('Anexo da submissão'),False,True,''));
array_push($cp,array('$H8','sdo_codigo','Pergunta',False,True,''));
array_push($cp,array('$S50','sdo_descricao','Documento',True,True,''));
array_push($cp,array('$T60:5','sdo_content','Info - 1',False,True,''));
array_push($cp,array('$T60:5','sdo_info','Info (i)',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','sdo_ativo','Ativo',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO&-1:Opcional&-2:(obrigatório este ou outro desta ordem)','sdo_obrigatorio','Obrigatório',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','sdo_upload','Upload',False,True,''));
array_push($cp,array('$S5','sdo_tipo','Tipo',False,True,''));
array_push($cp,array('$[1-20]','sdo_ordem','Ordem de visualização',False,True,''));
array_push($cp,array('$S100','sdo_modelo','Modelo (link)',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.5
?>