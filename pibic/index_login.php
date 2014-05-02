		<table width="690px" align="center" border="0">
		<tbody><tr>
		<td valign="top"><form method="post" action="submissao.php">
			<table width="260px" class="t">
				<tbody>
				<TR>
					<td rowspan="8"><img src="img/logo_instituicao.gif"></td>
					<TD colspan="2" align="center"><font style="font-size: 22px"><B><?=msg('id_teacher');?></B></font><BR><BR></TD>
				</TR>
				<tr>
					<td width="100"  class="lt1" colspan="2"><nobr>Informe obrigatoriamente o seu código funcional :</td>
				<TR>
					<td><input name="dd3" value="<?=$dd[3];?>" maxlength="12" size="10" type="text"> 
					</td>
				</tr>				
				<tr>
					<td width="100" colspan="2" class="lt1" align="left"><nobr>Login de rede:</td>
				<TR>
					<td><input name="dd1" value="<?=$dd[1];?>" maxlength="50" size="25" type="text"> 
					</td>
				</tr>
				<tr>
					<td class="lt1" width="100" ><nobr>Informe sua senha:</td>
				<TR>
					<td><input name="dd2" value="" maxlength="50" size="25" type="password"> 
					</td>

				</tr>
				<tr>
					<td class="label" ></td>
					<td><input name="acao" value="Acessar" type="submit" style="width: 120px;	"></td>
				</tr>
				<tr>
					<td colspan="3" style="padding-left: 40px;">
					<br>	
					<div class="lt1"><font color="red"><B><?=msg('erro_'.$user->erro);?></div>
					</td>
				</tr>
							
			</tbody></table>
			</td>
			<td width="5px"></td>
			<td valign="top">
			<div id="texto" class="lt2" style="text-align:justify; line-height: 160%;"> 
								
					Para acessar o Portal IC informe seu login de
					rede e senha. Problemas relacionados ao acesso entrar em contato com o
					Help Desk pelo telefone (41) 3271-1558.
			</div>
			<BR><BR>
			</td>
			</tr>
			</tbody></table>
			</form>
