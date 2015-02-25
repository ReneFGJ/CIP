<?
$tabela = "semic_eventos";

$cp = array();
array_push($cp,array('$H8','id_ev','id_ev',False,True,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.intval($journal_id).' order by upper(asc7(title))','ev_journal_id','Journal',True,True,''));
array_push($cp,array('$O A:Ativo','ev_status','Status',True,True,''));
array_push($cp,array('$D8','ev_data','Data',True,True,''));
array_push($cp,array('$S20','ev_bardcod','Código de barras',False,True,''));
array_push($cp,array('$T80:4','ev_descricao','Título no certificado',False,True,''));
array_push($cp,array('$S20','ev_horas','Horas (carga horária)',False,True,''));
array_push($cp,array('$S20','ev_sala','Sala',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','ev_ativo','Ativo',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.5
?>