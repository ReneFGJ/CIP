
<?
$tabela = "ajax_cidade";
$cp = array();
$ajax_sql = 'select * from(select estado_codigo, pais_nome || chr(32) || chr(40) || trim(estado_nome) || chr(41) as estado_nome from ajax_estado inner join ajax_pais on estado_pais = pais_codigo ) as estado order by upper(asc7(estado_nome))';

array_push($cp,array('$H8','id_cidade','id_cidade',False,True,''));
array_push($cp,array('$S100','cidade_nome','Nome',False,True,''));
array_push($cp,array('$S3','cidade_sigla','Sigla',False,True,''));
array_push($cp,array('$H7','cidade_codigo','Codigo',False,True,''));
array_push($cp,array('$O pt_BR:Portugues','cidade_idioma','Idioma',False,True,''));
array_push($cp,array('$S7','cidade_use','Use',False,True,''));
array_push($cp,array('$Q estado_nome:estado_codigo:'.$ajax_sql,'cidade_estado','Pais',True,True));
array_push($cp,array('$O 1:Sim&0:Não','cidade_ativo','Ativo',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.5
?>