<?php
require("cab_semic.php");
require("../_class/_class_semic_blocos.php");
$bl = new blocos;


$sql = "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00001','Sala Helena Kolody','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00002','Sala Denise Stoklos','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00003','Sala Paulo Leminski','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00004','Sala Poty Lazzaroto','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00005','Sala Anita Garibaldi','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00006','Sala Cristovão Tezza','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00007','Sala Cruz e Souza','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00008','Sala Victor Meirelles','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00009','Sala Zilda Arns','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00010','Sala Lya Luft','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00011','Sala Erico Veríssimo','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00012','Sala Jairton Dupont','',1,'2014');";
$sql .= "insert into semic_local (sl_codigo, sl_nome, sl_descricao, sl_ativa, sl_ano )
		values ('00013','Sala Mário Quintana','',1,'2014');";
//$rlt = db_query($sql);
						
$cp = $bl->cp();

$tabela = "semic_blocos";
require($include.'_class_form.php');
$form = new form;

$tela = $form->editar($cp,'semic_blocos');
if ($form->saved > 0)
	{
		$bl->updatex();
		redirecina('semic_blocos.php');
	} else {
		echo $tela;
	}



require("../foot.php");
?>
