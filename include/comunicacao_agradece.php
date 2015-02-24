<TABLE width="710">
<TR><TD class="lt1">
<?
$errc="";
$o = "<HR size=1><CENTER>";
if (strlen($err) > 0)
	{
	$o=$o.$err;
	} else {
	$o=$o."Cadastro realizado com sucesso !</CENTER>";
	}
$o=$o."<HR size=1>";
$o=$o."Obrigado, ".$dd[2]." por se cadastrar em nossa comunicação.<P>";
$o=$o."A partir de agora voce esta fazendo parte da nossa comunidade recebendo nosso informativo.<P>";
$o=$o."Caso não queira mais receber nosso informativo é so se descadastrar do nosso site a qualquer momento.";
$o=$o."<HR size=1>";
$o=$o."<CENTER><B>".$dd[5]."</CENTER>";
$o=$o."<HR size=1>";

if ($idioma == "2")
	{
	$o = "<HR size=1><CENTER>Cadaster accomplished with success!</CENTER>";
	$o=$o."<HR size=1>";
	$o=$o."Thank you, ".$dd[2]." for registering in our communication.<P>";
	$o=$o."Starting from now you this making our community's part receiving our informative one.<P>";
	$o=$o."In case he/she doesn't want more to receive our informative one. you can cancel it.";
	$o=$o."<HR size=1>";
	$o=$o."<CENTER><B>".$dd[5]."</CENTER>";
	$o=$o."<HR size=1>";	
	}
echo CharE($o);
?>

</TD></TR>
</TABLE>
<?=$errc?>