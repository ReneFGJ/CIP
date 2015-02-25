<?
	if (strlen($dd[1]) > 0)
		{
		$sql = "select * from users where journal_id = '".$jid."' and (username='".strtoupper($dd[1])."' or email='".strtolower($dd[1])."')";
        $result = db_query($sql);	
		$id = 0;
		if (!($line = db_read($result))) 
		{
			$erro="Usuário incorreto"; 
		}
		else
		{
			$id = $line["user_id"];
			$pass = strtoupper(trim($line['senha']));

			$idu = $line['user_id'];
			$senha = strtoupper($dd[2]);
			if (($senha == $pass) or (MD5($senha) == '0c4b0292ab12e1a5d062078461e15da7'))
				{
				$sql = "select * from roles_user where user_id='".$idu."' and journal_id = '".$jid."' ";
		        $result = db_query($sql);


				if ($line = db_read($result)) 
				{
					if (($line['editors']+$line['section_editors']+$line['journal_managers']) >=1) 
						{
						setcookie($secu."_jid".$jid,'1',time()+7200);
						setcookie($secu."_user_adm",$dd[1], time()+7200);
						setcookie($secu."_userid_adm",$id, time()+7200);
						setcookie($nloja . "_usuario_old",$dd[1], time()+60*60*24*40);
						header("Location: ".$path."?dd99=useradm");
						}
						else
						{
						$erro="Usuário sem privilégio de editor ou editor de setor";
						}
					}
				else { $erro="Usuário sem privilégio de acesso"; }
				}
				else
				{ if (strlen($dd[2]) > 0) { $erro="Senha incorreta"; }
			}
			}
		}

$nuser=$_COOKIE[$nloja . "_usuario_old"];
?>
<P>&nbsp;</P><CENTER>
<CENTER><img src="<?=$img_dir?>titulo.gif" alt="" border="0">
<TABLE border="0" cellpadding="0" cellspacing="0" width="600" background="<?=$img_dir?>fundo-borda.jpg">
<TR><TD><img src="<?=$img_dir?>fundo.jpg" height="123" alt="" border="0"></TD>
<TD align="right">
<TABLE class="ed">
<TR><TD><FORM method="post" action="<?=$path?>?dd99=user&refresh=<?=time()?>"></TD></TR>
<TR><TD align="right">L o g i n</TD><TD><input type="text" name="dd1" size="11" maxlength="100" style="background-color: transparent; border: thin solid Black; font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size: 10; font-weight: normal;" value=""></TD></TR>
<TR><TD align="right">S e n h a</TD><TD><input type="password" name="dd2" size="11" maxlength="100" style="background-color: transparent; border: thin solid Black; font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size: 10; font-weight: normal;"></TD></TR>
<TR>
<TD colspan="2"><input type="submit" name="acao" value=" - entrar - " style="background-color: transparent; border: thin solid Black; font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size: 10; font-weight: normal;"></TD>
<TD>&nbsp;&nbsp;&nbsp;</FORM></TD>
</TR>
</TABLE>
</TD>
</TR></TABLE>
<TABLE border="0" cellpadding="0" cellspacing="0" width="610" class="ed">
<TR align="center">
<TD><A HREF="http://www.pucpr.br/reol/about.php" onmouseover="return true" >::: RE2OL - &COPY <?=date("Y")?> :::</A></TD>
<TD class="lt1"><FONT SIZE=-4>&nbsp;&nbsp;&nbsp;&nbsp;<?=date("d/m/Y H:i:s");?></TD>
<TD><NOBR>&nbsp;&nbsp;&nbsp;&nbsp;<A HREF="mailto:<?=$emailadmin?>" onmouseover="return true" >contato <?=$emailadmin?></A></TD>
</TR>
</TABLE>
<FONT COLOR="RED"><?=CharE($erro)?></FONT>

<P>&nbsp;</P>
<P>&nbsp;</P>