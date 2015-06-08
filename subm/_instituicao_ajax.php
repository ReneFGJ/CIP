<?php
require("db.php");
$q = uppercasesql($_GET["q"]);
if (!$q) return;
$sql = "select * from instituicao where inst_nome_asc LIKE '%$q%' 
		or inst_abreviatura LIKE '%$q%'
		limit 20 
";
$rsd = db_query($sql);
while($line = db_read($rsd)) {
	//print_r($line);
    $cname = trim($line['inst_nome']).' ('.trim($line['inst_abreviatura']).')';
    echo "$cname\n";
}
?>
