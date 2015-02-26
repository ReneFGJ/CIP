
<?
$tabela = "ajax_areadoconhecimento";
//$sql = "update ".$tabela." set a_submit = 'S'";
//$rlt = db_query($sql);

$cp = array();
array_push($cp,array('$H8','id_aa','id_aa',False,True,''));
array_push($cp,array('$S100','a_descricao','Nome',False,True,''));
array_push($cp,array('$S14','a_cnpq','Sigla',False,True,''));
array_push($cp,array('$H7','a_codigo','Codigo',False,True,''));
array_push($cp,array('$H7','a_geral','Use',False,True,''));
array_push($cp,array('$O 1:Sim&0:Não','a_semic','Habilitado para o SEMIC',True,True,''));
array_push($cp,array('$O 1:Sim&0:Não','a_submit','Habilitado para o SUBMISSAO',True,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.5
?>