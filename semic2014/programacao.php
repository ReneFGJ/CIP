<?php 
	require("cab.php");
?>

        
        
        <div class="main">
            <header>
                <img src="img/bk_topo_pt1.png" />
            </header>

            <div class="content-2">
                <div class="text-2">
                <h1>Programação do XXII SEMIC</h1>
                <p>Estamos montando nossa programação para o evento, logo ela estará disponível aqui.</p>

                <div id="programacao-info">
                        <div class="programacao-horario">
                            <div class="data-programacao cor-data-programacao_1">
                                <h5>4 de novembro</h5>
                            </div>
                            <div class="estilo_data4_1 celula-tabela-horario">
                                <p><span class="estilo-horario">9h00</span> -</p>
                            </div>
                            <div class="estilo_data4_2 celula-tabela-horario">
                                <p><span class="estilo-horario">14h00</span> -</p>

                            </div>
                            <div class="estilo_data4_3 celula-tabela-horario">
                                <p><span class="estilo-horario">16h20</span> -</p>
                            </div>
                            <div class="estilo_data4_4 celula-tabela-horario">
                                <p><span class="estilo-horario">19h00</span> -</p>
                            </div>
                        </div>

                        <div class="programacao-horario">
                            <div class="data-programacao cor-data-programacao_2">
                                <h5>5 de novembro</h5>
                            </div>
                            <div class="estilo_data5_1 celula-tabela-horario">
                                <p><span class="estilo-horario">9h00</span> - </p>

                            </div>
                            <div class="estilo_data5_2 celula-tabela-horario">
                                <p><span class="estilo-horario">10h20</span> - </p>

                            </div>
                            <div class="estilo_data5_3 celula-tabela-horario">
                                <p><span class="estilo-horario">14h00</span> -</p>
                            </div>
                            <div class="estilo_data5_4 celula-tabela-horario">
                                <p><span class="estilo-horario">16h20</span> - </p>
                            </div>
                            
                        </div>

                        <div class="programacao-horario">
                            <div class="data-programacao cor-data-programacao_3">
                                <h5>6 de novembro</h5>
                            </div>
                            <div class="estilo_data6_1 celula-tabela-horario">
                                <p><span class="estilo-horario">8h00</span> - </p>
                            </div>
                            <div class="estilo_data6_2 celula-tabela-horario">
                                <p><span class="estilo-horario">10h20</span> - </p>

                            </div>
                            <div class="estilo_data6_3 celula-tabela-horario">
                                <p><span class="estilo-horario">14h00</span> - </p>

                            </div>
                            <div class="estilo_data6_4 celula-tabela-horario">
                                <p><span class="estilo-horario">17h00</span> - </p>
                            </div>
                        </div>
                    </div> <!-- programacao-info -->

        <div>
            </div>













    <script>
        $(function() {
      $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    });
  </script>
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="js/jquery.cbpContentSlider.min.js"></script>
        <script>
            $(function() {

                $( '#cbp-contentslider' ).cbpContentSlider();
            });
        </script>
    
</body>
</html>