<?
$tabela = "editora_calendario_tipo";
$cp = array();
$opx="";
array_push($cp,array('$H4','id_ct','id_s',False,True,''));
array_push($cp,array('$H2','ct_ev','nome se��o',False,True,''));
array_push($cp,array('$S58','ct_descricao','nome evento',False,True,''));
array_push($cp,array('$S10','ct_cor','cor (HTML)',False,True,''));
array_push($cp,array('$O 1:SIM&0:NAO'.$opx,'ct_ativo','Ativo',False,True,''));
// DD5
array_push($cp,array('$H8','ct_journal_id','Journalo',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.2
$dd[5] = $jid;
?>