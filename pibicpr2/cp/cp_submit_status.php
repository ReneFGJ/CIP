<?
$tabela = "submit_status";
$cp = array();
$gsql = "select * from usuario_grupo where ";
array_push($cp,array('$H4','id_s','id_s',False,True,''));
$sql = 's_status:s_descricao:select s_status, s_status || chr(32) || s_descricao_1 as s_descricao from submit_status where s_journal_id = '.$journal_id.' order by s_status';
array_push($cp,array('$A','','Descri��o do status',False,True,''));
array_push($cp,array('$O '.$journal_id.':'.$journal_title,'','Descri��o do status',False,True,''));
array_push($cp,array('$S1','s_status','<I>status</I>',False,True,''));
//array_push($cp,array('$Q '.$gsql,'s_grupo_1','Grupo (ver)',False,True,''));
//array_push($cp,array('$Q '.$gsql,'s_grupo_2','Grupo (encaminhar)',False,True,''));
//array_push($cp,array('$Q '.$gsql,'s_grupo_3','Grupo (submeter)',False,True,''));


array_push($cp,array('$S60','s_descricao_1','Descri��o (Gestor)',False,True,''));
array_push($cp,array('$T40:5','s_descricao_2','Descri��o da a��o do bot�o',False,True,''));
array_push($cp,array('$S60','s_descricao_3','Descri��o (parecerista)',False,True,''));
array_push($cp,array('$S60','s_descricao_4','Descri��o (usu�rio)',False,True,''));

array_push($cp,array('$Q '.$sql,'s_i1','Encaminhar para',False,True,''));
array_push($cp,array('$Q '.$sql,'s_i2','Encaminhar para',False,True,''));
array_push($cp,array('$Q '.$sql,'s_i3','Encaminhar para',False,True,''));
array_push($cp,array('$Q '.$sql,'s_i4','Encaminhar para',False,True,''));
array_push($cp,array('$Q '.$sql,'s_i5','Encaminhar para',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>