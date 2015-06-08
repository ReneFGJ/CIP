<?php
class submit
	{
		var $tabela = 'reol_submit';
		
		function exist_email($email)
			{
				$email = lowercase($email);
				if (checaemail($email))
					{
						$sql = "select * from submit_autor where sa_email = '".$email."' ";
						$rlt = db_query($sql);
						if ($line = db_read($rlt))
							{ return(1); } else { return(0); }
					} else { return(-1); }
			}
		
		function form_autores()
			{
				global $LANG;
				$LANG = 'pt_BR';
				
				/* Botao */
				$bt_submit = msg('adicionar');
				
				$sx .= '<div id="autor">';
				$sx .= '<table width="704" class="lt0" cellpadding=0 cellspacing=2>';
				/* Autores */
				$sx .= '<TR><TD colspan=3>Autores';
				$sx .= '<TR><TD colspan=3><input type="text" size="80" value="" id="author_name" class="form_input_01">';
				
				/* Titulacao */
				$sx .= '<TR><TD width="20%">Titulação<TD width="2%"><TD width="78%">e-mail';
				$sx .= '<TR><TD><select id="author_form" class="form_input_01">';
				$sx .= '<option value=""></option>'.chr(13);
				
				$sql = "select * from apoio_titulacao where at_tit_ativo = 1 and ap_tit_idioma = '$LANG' order by ap_tit_titulo";
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						$sx .= '<option value="'.$line['ap_tit_codigo'].'">'.trim($line['ap_tit_titulo']).'</option>';
						$sx .= chr(13);
					}
				$sx .= '</select>'.chr(13);
				
				$sx .= '<TD>&nbsp;';
				
				/* e=mail */
				$sx .= '<TD><input type="text" size="50" value="" id="author_email" class="form_input_01_lower">';

				/* Afiliacao institucional */
				$sx .= '<TR><TD colspan=3>Afiliação Instituicional';
				$sx .= '<TR><TD colspan=3><input type="text" size="80" value="" id="author_inst" class="form_input_01">';
				
				/* Pais */
				$sx .= '<TR><TD colspan=3>Pais';
				
				$sx .= '<TR><TD><select id="author_coun" class="form_input_01">';
				$sx .= '<option value=""></option>'.chr(13);
				
				$sql = "select * from ajax_pais where pais_ativo = 1 and pais_idioma = '$LANG' order by pais_nome";
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						$check = '';
						if (trim($line['pais_codigo'])=='0000001') { $check = 'selected'; }
						$sx .= '<option value="'.$line['pais_codigo'].'" '.$check.'>'.trim($line['pais_nome']).'</option>';
						$sx .= chr(13);
					}
				$sx .= '</select>'.chr(13);				
				
				$sx .= '<TD>&nbsp;<TD colspan=3><input type="button" value="'.$bt_submit.'" id="author_submit">';
				
				$sx .= '</table>';
				$sx .= '</div>';
				
				$sx .= chr(13);
				$sx .= '<div id="author_result">'.chr(13);
				$sx .= '</div>'.chr(13);
				
				$js .= chr(13);
				$js .= '<script>'.chr(13);
				$js .= '$("#author_submit").click( function() {'.chr(13);
				$js .= '
						$("body").css("cursor", "progress");
						$("body").enabled = false;
				
						var dd10=$("#author_name").val();
						var dd11=$("#author_form").val();
						var dd12=$("#author_email").val();
						var dd13=$("#author_inst").val();
						var dd14=$("#author_coun").val();						
						var acao = "adicionar";
						var tabela = "author_submit";
						
						$.ajax({
							type: "POST",
  							url: "subm_ajax.php",
  							cache: false,
  							data: { dd50: acao, dd51: tabela,
  									dd1: dd10, dd2: dd11, dd3: dd12,
  									dd4: dd13, dd5: dd14 
							}
						}).done(function( html ) {
  						$("#author_result").html(html);
						});				
				'.chr(13);
				$js .= '$("body").css("cursor", "auto");'.chr(13);
				$js .= '});'.chr(13);
				
				$js .= '</script>'.chr(13);
				$js .= chr(13);
				
				$sx .= $js;
				return($sx);
			}
	}
?>