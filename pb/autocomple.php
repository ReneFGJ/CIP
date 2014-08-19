  <link rel="stylesheet" href="http://www2.pucpr.br/reol/js/jquery-ui.css" type="text/css" />
   <form action='' method='post'>
   	<table class="tabela00">
   		<TR><TD>
       <p><label>Country:</label>
       	<TD><input type='text' name='country' value='' class='auto'></p>
       </TR>
    </table>
   </form>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>    
<script type="text/javascript">
$(function() {
    
    //autocomplete
    $(".auto").autocomplete({
        source: "ajax_instituicao.php",
        minLength: 1
    });                
 
});
</script>
</body>
</html>