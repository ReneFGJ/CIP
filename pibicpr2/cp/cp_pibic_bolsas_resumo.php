<?
$tabela = "pibic_bolsa_contempladas";
$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));

array_push($cp,array('$T70:4','pb_titulo_projeto','Título Plano (quando nesta categoria)',False,True,''));
array_push($cp,array('$S1','pb_status','Status',False,True,''));
//array_push($cp,array('$S10','pb_status','Status',False,True,''));

//array_push($cp,array('$D8','pb_semic','Data Semic',False,True,''));

array_push($cp,array('$T70:10','pibic_resumo_text','Resumo',False,True,''));
array_push($cp,array('$T70:10','pibic_resumo_colaborador','Autores',False,True,''));
array_push($cp,array('$S200','pibic_resumo_keywork','Palavras-Chave',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>