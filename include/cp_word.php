<?
global $estilo;
// ************* dolar
$cp = array();
//  fl_type char(3) DEFAULT 'TXT'::bpchar,
//  fl_filename char(255),
//  fl_texto text
$sql = "title:journal_id:select * from journals where journal_id=".$jid;

$ow = "about:Sobre a revista";
$ow = $ow . "&instrution:Instruções para autores";
$ow = $ow . "&contato:Contato";
$ow = $ow . "&editor:Editores";
$ow = $ow . "&submit:Termo de envio de artigo";
$ow = $ow . "&calls:Chamada para publicação";
$ow = $ow . "&senha:Reenviar senha por e-mail";
$ow = $ow . "&noticia:Noticias / Eventos do sistema";
$ow = $ow . "&submit_ok:Peer-Review (Envio de artigo pelo autor)";
$ow = $ow . "&submit_editor:Peer-Review (Aviso ao editor de artigo enviado)";
$ow = $ow . "&email-rejeitar:Peer-Review (Rejeitar artigo)";
$ow = $ow . "&email-aceitar:Peer-Review (Aceitar artigo para analise)";
$ow = $ow . "&email-complementar:Peer-Review (Complementar artigo)";
$ow = $ow . "&email-parecerista:Peer-Review (Indicação ao parecerista)";
$ow = $ow . "&inicial:Página inicial (antes do sumário)";


array_push($cp,array('dd0',$dd[0],'$H8','Artigo ID',$estilo,False,'id_fr',False));
array_push($cp,array('dd1',$dd[1],'$Q '.$sql,'Journal ID',$estilo,False,'journal_id',False));
array_push($cp,array('dd2',$dd[2],'$O '.$ow,'Tipo',$estilo,True,'fr_word',False));
array_push($cp,array('dd3',$dd[3],'$T60:6','Texto',$estilo,False,'fr_texto',False));
array_push($cp,array('dd4',$dd[4],'$O pt_BR:Portugues (Brasil)&en:Inglês&es:Espanhol&fr:Frânces','Idioma',$estilo,True,'fr_idioma',False));
$fieldini=0;

?>


