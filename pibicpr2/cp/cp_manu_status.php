<?
$tabela = "status";
$tbb='select s_status,(trim(s_status) || chr(45) || trim(s_descricao) || chr(32) || chr(40) || trim(nucleo_descricao)) || chr(41) as s_descricao from (status inner join nucleo on s_nucleo = nucleo_codigo and nucleo_descricao = '.chr(39).$nucleo.chr(39).') as tabela order by s_status';
$cp = array();
$nc = $nucleo.":".$nucleo;
array_push($cp,array('$H8','id_s','id_s',False,True,''));
array_push($cp,array('$S1','s_status','Cуdigo do status (interno)',False,True,''));
array_push($cp,array('$S1','s_status_mst','Status visнvel',False,True,''));
array_push($cp,array('$S100','s_descricao','Descricao',False,True,''));
array_push($cp,array('$S100','s_descricao_out','Descricao - Relator',False,True,''));
array_push($cp,array('$S100','s_descricao_1','Descricao (externa - usuбrio)',False,True,''));
array_push($cp,array('$T40:5','s_descricao_2','Descricao botгo de aзгo',False,True,''));
array_push($cp,array('$S100','s_descricao_3','Descricao (relator)',False,True,''));
array_push($cp,array('$O '.$nc,'s_nucleo','Nъcleo',False,True,''));
array_push($cp,array('$Q s_descricao:s_status:'.$tbb,'s_i1','deriva para',False,True,''));
array_push($cp,array('$Q s_descricao:s_status:'.$tbb,'s_i2','deriva para',False,True,''));
array_push($cp,array('$Q s_descricao:s_status:'.$tbb,'s_i3','deriva para',False,True,''));
array_push($cp,array('$Q s_descricao:s_status:'.$tbb,'s_i4','deriva para',False,True,''));
array_push($cp,array('$Q s_descricao:s_status:'.$tbb,'s_i5','deriva para',False,True,''));
array_push($cp,array('$I4','s_prazo_dia','Prazo em dias',False,True,''));
array_push($cp,array('$O 0:Nгo&1:Sim','s_limpa_atual','Limpa usuбrio atual',False,True,''));
array_push($cp,array('$D8','s_prazo_data','Data limite',False,True,''));

if (strlen($dd[10]) == 0) { $dd[10]='0'; }
if (strlen($dd[11]) == 0) { $dd[11]='01/01/1900'; }
/// Gerado pelo sistem "base.php" versao 1.0.4
?>