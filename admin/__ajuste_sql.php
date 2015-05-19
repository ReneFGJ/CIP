<?php
require('cab.php');

require($include.'../_include/_class_form.php');
$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$T80:6','','',TRUE,True));

$form = new form;
$tela = $form->editar($cp,'');
echo $tela;

$sql = "
select 1+1;
";
$rlt = db_query($sql);
while ($line = db_read($rlt))
{
	print_r($line);
	echo '<HR>';
}

if ($form->saved > 0)
	{
		$sql = $dd[1];
		$rlt = db_query($sql);
	}
?>