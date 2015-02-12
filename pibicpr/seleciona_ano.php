<?
require ("cab.php");

require ("../_class/_class_pibic_bolsa_contempladas.php");

require ($include . 'sisdoc_form2.php');
require ($include . 'cp2_gravar.php');

$pb = new pibic_bolsa_contempladas;

$cp = array();
//monta combo de anos com inicio em 1990 até anobase atual
array_push($cp, array('$[1990-' . date("Y") . ']', '', 'Escolha o ano para busca', False, True, ''));

//Captura ano selecionado e armazena na variavel $dd[0]
if (strlen($dd[0]) == 0) {$dd[0] = (date("Y"));}

echo '<h1>Relatório de Bolsas duplicadas</h1>';

if(strlen($dd[0]) == null){
    
  echo "<progress></progress>";  
    
}else{   
?>
<!--monta tabela-->
<TABLE width="<?=$tab_max?>" align="left"><TR><TD><? editar(); ?></TD></TR></TABLE>
<?

if ($saved == 0) {exit ;}


/*envia o valor da variavel $dd[0] como parametro ao metodo: rel_aluno_com_bolsa_duplicada() 
 * na classe: _class_pibic_bolsa_contempladas.php
 */
echo $pb -> rel_aluno_com_bolsa_duplicada($dd[0]);

?>

<!--Botão para retorna a pag anterior-->
<form>
    <input type="button" value="Voltar"onClick="JavaScript: window.history.back();">
</form>
<?

echo $hd -> foot();
}
?>