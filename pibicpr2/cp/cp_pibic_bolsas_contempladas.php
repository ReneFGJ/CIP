<?
$tabela = "pibic_bolsa_contempladas";

//$sql = "ALTER TABLE ".$tabela." ADD COLUMN pb_area_estrategica char(60)";
//db_query($sql);
//$sql = "ALTER TABLE ".$tabela." ADD COLUMN pb_colegio_orientador char(60)";
//db_query($sql);

$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$T50:2','pb_titulo_projeto','T�tulo',True,True,''));
array_push($cp,array('$HV','pb_titulo_projeto_asc',uppercasesql($dd[1]),False,True,''));

array_push($cp,array('$T50:2','pb_titulo_plano','T�tulo Plano',False,True,''));
array_push($cp,array('$T50:2','pb_fomento','Aprova��o externa',False,True,''));
array_push($cp,array('$S10','pb_codigo','C�digo da Bolsa',False,False,''));
array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo order by pbt_descricao','pb_tipo','Bolsa',True,True,''));
array_push($cp,array('$S1','pb_status','Status',False,True,''));
//array_push($cp,array('$S10','pb_status','Status',False,True,''));
array_push($cp,array('$S10','pb_contrato','Contrato',False,True,''));

array_push($cp,array('$S8','pb_aluno','Aluno (Cracha)',False,True,''));


array_push($cp,array('${','','PIBICJr',False,True,''));
array_push($cp,array('$S100','pb_aluno_nome','Nome do Aluno (PIBICJr)',False,True,''));
array_push($cp,array('$S60','pb_colegio','Nome do Col�gio',False,True,''));
array_push($cp,array('$S60','pb_colegio_orientador','Nome Prof. Orie. Col�gio',False,True,''));
array_push($cp,array('$S60','pb_area_estrategica','Area estrat�fica',False,True,''));
array_push($cp,array('$}','','PIBICJr',False,True,''));

array_push($cp,array('$S8','pb_professor','Professor (Cracha)',False,True,''));

array_push($cp,array('$S7','pb_protocolo','Protocolo',False,True,''));
array_push($cp,array('$S7','pb_protocolo_mae','Protocolo (M�e)',False,True,''));

array_push($cp,array('$D8','pb_data','Data',False,True,''));
array_push($cp,array('$S5','pb_hora','Hora',False,True,''));

array_push($cp,array('$D8','pb_data_ativacao','Data (ativa��o)',False,True,''));
array_push($cp,array('$D8','pb_data_encerramento','Data (encerramento)',False,True,''));
array_push($cp,array('$D8','pb_relatorio_parcial','Data (envio relat�rio parcial)',False,True,''));
array_push($cp,array('$I8','pb_relatorio_parcial_nota','Nota relat�rio',False,True,''));
array_push($cp,array('$D8','pb_relatorio_final','Data (envio relat�rio final)',False,True,''));
array_push($cp,array('$I8','pb_relatorio_final_nota','Nota relat�rio final',False,True,''));
array_push($cp,array('$D8','pb_resumo','Data Resumo',False,True,''));
array_push($cp,array('$I8','pb_resumo_nota','Nota resumo',False,True,''));
array_push($cp,array('$D8','pb_semic','Data Semic',False,True,''));

array_push($cp,array('$O 1:SIM&0:N�o','pb_ativo','Ativo',False,True,''));
array_push($cp,array('$D8','pb_ativacao','Data ativa��o',False,True,''));
array_push($cp,array('$D8','pb_desativacao','Data cancelamento',False,True,''));
array_push($cp,array('$S8','','Contrato',False,True,''));

array_push($cp,array('$S1','pb_area_conhecimento','Area conhecimento',False,True,''));
array_push($cp,array('$S10','','Codigo da bolsa',False,True,''));

array_push($cp,array('$S16','pb_semic_area','Semic �rea',False,True,''));

array_push($cp,array('$I4','pb_ano','Ano',False,True,''));
//array_push($cp,array('$S6','pb_edital','Edital',False,True,''));

array_push($cp,array('$T70:10','pibic_resumo_text','Resumo',False,True,''));
array_push($cp,array('$T70:10','pibic_resumo_colaborador','Autores',False,True,''));
array_push($cp,array('$S200','pibic_resumo_keywork','Palavras-Chave',False,True,''));

array_push($cp,array('$S20','pb_etica','N� parecer de �tica',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>