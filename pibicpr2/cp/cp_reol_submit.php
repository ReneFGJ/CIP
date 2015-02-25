<?
$tabela = "reol_submit";
$cp = array();
array_push($cp,array('$H8','id_doc','id_doc',False,True,''));
array_push($cp,array('$S8','doc_protocolo','Protocolo',False,False,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.intval($journal_id).' order by upper(asc7(title))','journal_id','Journal',True,True,''));
array_push($cp,array('$Q title:id_issue:select \'v. \' || issue_volume || chr(32) || \'n. \' || issue_number || chr(32) ||  issue_year as title, * from issue where journal_id = '.intval($journal_id).' order by issue_year desc , issue_volume desc, issue_number desc','doc_issue','Ediзгo',True,True,''));
array_push($cp,array('$Q title:section_id:select * from sections where journal_id = '.intval($journal_id).' order by seq','doc_section','Seзгo',True,True,''));
array_push($cp,array('$[1-200]','doc_ord','Ordem no sumбrio',True,True,''));
array_push($cp,array('$T80:3','doc_2_titulo','Tнtulo Proj. Professor',False,True,''));
array_push($cp,array('$T80:3','doc_1_titulo','Tнtulo Proj. Aluno',False,True,''));
array_push($cp,array('$H8','doc_data_submit','',False,True,''));
array_push($cp,array('$H8','doc_data_aceite','',False,True,''));
array_push($cp,array('$H8','doc_data_final','',False,True,''));

array_push($cp,array('$S100','doc_1_key','Professor',False,True,''));
array_push($cp,array('$S100','doc_2_key','Nome do aluno/cracha',False,True,''));
array_push($cp,array('$T60:6','doc_3_resumo','Colaboradores',False,True,''));
array_push($cp,array('$S7','doc_3_key','Protocolo do aluno',True,True,''));

array_push($cp,array('$O -:Bolsa&P:PUCPR&C:CNPq&F:Fundaзгo Araucбria&I:ICV','doc_3_idioma','Bolsa',True,True,''));

array_push($cp,array('$T80:6','doc_1_resumo','Resumo',False,True,''));
array_push($cp,array('$T80:6','doc_autor','Resumo',False,True,''));

array_push($cp,array('$Q ess_descricao:ess_status:select ess_status || chr(32) || ess_descricao_1 as ess_descricao,ess_status from editora_status where ess_ativo=1 and ess_journal_id = '.intval($journal_id).' order by ess_status','doc_status','Status',True,True,''));
//array_push($cp,array('$Q ess_descricao_1:ess_status:select * from editora_status order by ess_status','doc_status','Seзгo',True,True,''));
array_push($cp,array('$Q grp_descricao_pt:grp_codigo:select * from editora_grupos order by grp_descricao_pt','doc_grupo','Grupo',True,True,''));
//array_push($cp,array('$T80:5','doc_autor','Autores<BR>um por linha',False,True,''));

//array_push($cp,array('$HV','doc_dt_atualizado',date("Ymd"),False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.5
?>