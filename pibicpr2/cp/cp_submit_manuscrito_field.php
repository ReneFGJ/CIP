<?
$tabela = "submit_manuscrito_field";
$sp = ' :espa�o&;:ponto e virgula (;)&.:ponto (.)';
$cp = array();
array_push($cp,array('$H8','id_sub','id_sa',False,True,''));
array_push($cp,array('$H10','sub_codigo','codigo',False,True,''));
array_push($cp,array('$O '.$journal_id.':'.$journal_title,'sub_journal_id','Publica��o',False,True,''));
array_push($cp,array('$S50','sub_descricao','T�tulo',True,True,''));
array_push($cp,array('$[1-50]','sub_pos','P�gina',True,True,''));
array_push($cp,array('$[1-50]','sub_ordem','Ordem',True,True,''));
array_push($cp,array('$Q sp_descricao:sp_codigo:select * from submit_manuscrito_tipo where sp_ativo = 1 and journal_id = '.$jid,'sub_projeto_tipo','Tipo do projeto',False,True,''));
array_push($cp,array('$T50:4','sub_field','Tipo do campo',True,True,''));
array_push($cp,array('$T50:4','sub_caption','Informativo',False,True,''));
array_push($cp,array('$I8','submit_manuscrito_minimo','Limite de palavras (m�nimo)',True,True,''));
array_push($cp,array('$I8','sub_limite','Limite de palavras (m�ximo)',True,True,''));
array_push($cp,array('$O '.$sp,'sub_separador','Separador de contagem',False,True,''));
array_push($cp,array('$T50:4','sub_informacao','Informa��es (i)',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','sub_ativo','Ativo',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','sub_obrigatorio','Obrigat�rio',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','sub_editavel','Editavel',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','sub_pdf_mostra','Ativo no PDF',False,True,''));
array_push($cp,array('$S60','sub_pdf_title','T�tulo no PDF',False,True,''));
array_push($cp,array('$O L:Esquerda&D:Direita&J:Justificado&C:Centralizado','sub_pdf_align','Alinhamento',False,True,''));
array_push($cp,array('$O 12:12&8:8&10:10&6:6&4:4','sub_pdf_font_size','Size',False,True,''));
array_push($cp,array('$O 6:6&5:5 (referencia)&8:8&10:10&12:12&4:4&2:2&1:1&0:0','sub_pdf_space','Size space',False,True,''));
array_push($cp,array('$S5','sub_id','ID',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.5
?>