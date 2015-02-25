<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include.'sisdoc_security_post.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');	
require($include.'cp2_gravar.php');
$tabela = "";
$cp = array();
array_push($cp,array('$O : &S:SIM','','Confirmar zerar Edital',True,True,''));
?>
<H2>Gerar dados para montagem do Edital</H2>
<TABLE width="98%" align="center" border="1">
<TR><TD>
<?
echo $msc;
echo '<TR><TD>';
editar();
?></TD></TR></TABLE><?	

if ($saved < 1) { require('foot.php'); exit; }

$sql = "
DROP TABLE pibic_edital;

CREATE TABLE pibic_edital
( 
id_pee serial NOT NULL, 
pee_edital int4 DEFAULT 0, 
pee_aluno char(8), 
pee_protocolo char(7), 
pee_protocolo_mae char(7), 
pee_data int4 DEFAULT 0, 
pee_hora char(5), 
pee_n01 int4 DEFAULT 0, 
pee_n02 int4 DEFAULT 0, 
pee_n03 int4 DEFAULT 0, 
pee_n04 int4 DEFAULT 0, 
pee_n05 int4 DEFAULT 0, 
pee_n06 int4 DEFAULT 0, 
pee_n07 int4 DEFAULT 0, 
pee_n08 int4 DEFAULT 0, 
pee_n09 int4 DEFAULT 0, 
pee_n10 int4 DEFAULT 0, 
pee_n11 int4 DEFAULT 0, 
pee_n12 int4 DEFAULT 0, 
pee_n13 int4 DEFAULT 0, 
pee_n14 int4 DEFAULT 0, 
pee_n15 int4 DEFAULT 0, 
pee_n16 int4 DEFAULT 0, 
pee_n17 int4 DEFAULT 0, 
pee_n18 int4 DEFAULT 0, 
pee_n19 int4 DEFAULT 0, 
pee_n20 int4 DEFAULT 0, 
pee_n21 int4 DEFAULT 0, 
pee_total int4 DEFAULT 0, 
pee_icv int4 DEFAULT 0, 
pee_area char(1), 
pp_ano char(4), 
pe_ano char(4) 
); 

ALTER TABLE pibic_edital ADD CONSTRAINT id_pee PRIMARY KEY(id_pee);";
$rlt = db_query($sql);
echo 'OK';

require("foot.php");	?>
