<?
require($include."sisdoc_editor.php");
$tabela = "ic_noticia";
$cp = array();
$nc = $nucleo.":".$nucleo;
array_push($cp,array('$H4','id_nw','id_nw',False,False,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.intval($journal_id).' order by upper(asc7(title))','nw_journal','Journal',True,True,''));
array_push($cp,array('$S20','nw_ref','Ref.p�gina',True,True,''));
array_push($cp,array('$S200','nw_titulo','Titulo da mensagem',True,True,''));
array_push($cp,array('$E600:400','nw_descricao','Conte�do em (HTML)',False,True,''));
//dd5
array_push($cp,array('$D3','nw_dt_de','Mostrar de',True,True,''));
array_push($cp,array('$D3','nw_dt_ate','at�',True,True,''));
array_push($cp,array('$S120','nw_fonte','(Citar fonte)',False,True,''));
array_push($cp,array('$S120','nw_link','(Link externo)',False,True,''));
array_push($cp,array('$H8','nw_secao','Se��o',False,True,''));
//dd10
array_push($cp,array('$O pt_BR:Portugues&en:Ingl�s','nw_idioma','Idioma',True,True,''));
array_push($cp,array('$U8','nw_dt_cadastro','data',False,True,''));
$dd[9] = 1;
?>