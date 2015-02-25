<?
global $estilo;
// ************* dolar

$cp = array();
array_push($cp,array('dd0',$dd[0],'$H8','ASS ID',$estilo,False,'id_article',False));
array_push($cp,array('dd1',$dd[1],'$O P:Individual&I:Institucional','Tipo assinatura',$estilo,True,'assinatura_tipo',False));
array_push($cp,array('dd2',$dd[2],'$S255','Nome completo',$estilo,True,'assinatura_nome',False));
array_push($cp,array('dd3',$dd[3],'$S255','Endereço',$estilo,False,'assinatura_endereco',False));
array_push($cp,array('dd4',$dd[4],'$S20','Numero',$estilo,False,'assinatura_nr',False));
array_push($cp,array('dd5',$dd[5],'$S20','Complemento',$estilo,False,'assinatura_compl',False));
array_push($cp,array('dd6',$dd[6],'$S40','Cidade',$estilo,False,'assinatura_cidade',False));
array_push($cp,array('dd7',$dd[7],'$S20','Estado (UF)',$estilo,False,'assinatura_estado',False));
array_push($cp,array('dd8',$dd[8],'$S10','CEP',$estilo,False,'assinatura_cep',False));
array_push($cp,array('dd9',$dd[9],'$S20','CNPJ',$estilo,False,'assinatura_cnpj',False));
array_push($cp,array('dd10',$dd[10],'$S20','RG',$estilo,False,'assinatura_rg',False));
array_push($cp,array('dd11',$dd[11],'$S25','Fone',$estilo,False,'assinatura_fone',False));
array_push($cp,array('dd12',$dd[12],'$S100','e-mail',$estilo,False,'assinatura_email',False));
array_push($cp,array('dd13',$dd[13],'$S40','Profissão (se individual)',$estilo,False,'assinatura_profissao',False));
array_push($cp,array('dd14',$dd[14],'$O :Opcao&SIM:SIM&NAO:NAO','Ligado ao ensino',$estilo,False,'assinatura_ensino',False));
array_push($cp,array('dd15',$dd[15],'$S100','Instituição',$estilo,False,'assinatura_instituicao',False));
array_push($cp,array('dd16',$dd[16],'$O 2005:Assinatura 2005&2006:Assinatura 2006:0000:Avulsos','Assinatura',$estilo,False,'assinatura_periodo',False));
array_push($cp,array('dd17',$dd[17],'$T40:6','Números',$estilo,False,'assinatura_exemplar',False));
array_push($cp,array('dd21',$jid,'$H8','Jornal',$estilo,True,'journal_id',False));
$fieldini=0;

?>


