<?
$tabela = "editora_status";
$cp = array();
array_push($cp,array('$H4','id_ess','id_ess',False,True,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.intval($journal_id).' order by upper(asc7(title))','ess_journal_id','Journal',True,True,''));
array_push($cp,array('$A','','Descrição do status',False,True,''));
array_push($cp,array('$S1','ess_status','<I>status</I>',False,True,''));
array_push($cp,array('$S60','ess_descricao_1','Descrição (Status)',False,True,''));
array_push($cp,array('$S60','ess_descricao_2','Descrição (Autor)',False,True,''));
array_push($cp,array('$S60','ess_descricao_3','Descrição (Ação Interna)',False,True,''));
array_push($cp,array('$S60','ess_descricao_4','Descrição (??)',False,True,''));
array_push($cp,array('$T60:4','ess_descricao_5','Botão de ação',False,True,''));
$sql = 'select ess_status, ess_status || chr(32) || ess_descricao_1 as ess_descricao from editora_status where ess_journal_id = '.$jid.' order by ess_status';
array_push($cp,array('$Q ess_descricao:ess_status:'.$sql,'ess_status_1','Deriva para',False,True,''));
array_push($cp,array('$Q ess_descricao:ess_status:'.$sql,'ess_status_2','Deriva para',False,True,''));
array_push($cp,array('$Q ess_descricao:ess_status:'.$sql,'ess_status_3','Deriva para',False,True,''));
array_push($cp,array('$Q ess_descricao:ess_status:'.$sql,'ess_status_4','Deriva para',False,True,''));

$op = '$O 0:sem função&1:Ativar&-1:Limpar';
array_push($cp,array($op,'ess_limpa_secretaria','Secretária',False,True,''));
array_push($cp,array($op,'ess_limpa_editor','Editor',False,True,''));
array_push($cp,array($op,'ess_limpa_parecerista_1','Parecerista (1)',False,True,''));
array_push($cp,array($op,'ess_limpa_parecerista_2','Parecerista (2)',False,True,''));

array_push($cp,array($op,'ess_limpa_geral','Revisão geral',False,True,''));
array_push($cp,array($op,'ess_limpa_normalizador','Normalizador',False,True,''));
array_push($cp,array($op,'ess_limpa_revisor','Revisor gramatical',False,True,''));
array_push($cp,array($op,'ess_limpa_diagramador','Diagramador',False,True,''));
array_push($cp,array('$I8','ess_prazo','Prazo (dias)',True,True,''));

array_push($cp,array('$O 1:SIM&2:NÃO','ess_ativo','Ativo',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.2
?>