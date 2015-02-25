<?
$tabela = "usuario_grupo_nome";
$cp = array();
$nc = $nucleo.":".$nucleo;
$opt = 'B:Bibliotecбrio';
$opt .= '&R:Revisor gramatical';
$opt .= '&E:Editor cientнfico';
$opt .= '&G:Gestor';
$opt .= '&D:Design grбfico';
$opt .= '&P:Parecerista';

array_push($cp,array('$H4','id_gun','id_gun',False,False,''));
array_push($cp,array('$H4','gun_locacao','Subordinado',False,True,''));
array_push($cp,array('$S120','gun_descricao','Nome do grupo',True,True,''));
array_push($cp,array('$O 1:SIM&0:NГO','gun_ativo','Ativo',False,True,''));
array_push($cp,array('$H4','gun_codigo','Codigo',False,True,''));
array_push($cp,array('$T60:4','gun_content','Descriзгo do grupo',False,True,''));
array_push($cp,array('$O '.$opt,'gun_tipo','Tipo',False,True,''));

$dd[1] = $journal_id;
/// Gerado pelo sistem "base.php" versao 1.0.2
?>