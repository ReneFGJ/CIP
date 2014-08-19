<?php
$include = '../';
require("../db.php");
 
//busca valor digitado no campo autocomplete "$_GET['term']
$text = UpperCaseSql($_GET['term']);
$query = "SELECT inst_nome, inst_abreviatura, inst_codigo FROM instituicao WHERE inst_nome_asc LIKE '%$text%' ORDER BY inst_nome_asc";

$result = db_query($query);
//formata o resultado para JSON
$json = '[';
$first = true;
while($row = db_read($result))
{
  if (!$first) { $json .=  ','; } else { $first = false; }
  $json .= '{"value":"'.trim($row['inst_nome']).'"}';
}
$json .= ']';
 
echo $json;