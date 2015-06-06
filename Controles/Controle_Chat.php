 <?php
 require_once "../Dados/Conexao.php";
 session_start();

  $logado = $_SESSION['login'];
  $codigo = $_SESSION['codigo'];
  $tipo = $_SESSION['tipo'];
?>
<div class="chat-box" id="chat-box">
      <?php
      $query = mysql_query("SELECT mensagens_troca.*, USUARIO_MENSAGEM.V_NOME, USUARIO_MENSAGEM.N_COD_USUARIO, USUARIO_MENSAGEM.V_FOTO, USUARIO_MENSAGEM.V_SEXO, mensagens_troca.D_DATA_MENSAGEM from mensagens_troca INNER JOIN troca ON troca.N_COD_TROCA = mensagens_troca.N_COD_TROCA_IE
        INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = TROCA.N_COD_LIVRO
        INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = TROCA.N_COD_LIVRO_SOLICITANTE
        INNER JOIN usuario AS USUARIO_SOLICITADO ON USUARIO_SOLICITADO.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
        INNER JOIN usuario AS USUARIO_SOLICITANTE ON USUARIO_SOLICITANTE.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
        INNER JOIN usuario as USUARIO_MENSAGEM ON USUARIO_MENSAGEM.N_COD_USUARIO = mensagens_troca.N_USUARIO_DE 
        WHERE mensagens_troca.N_COD_TROCA_IE = ".$_SESSION['id_troca']." order by mensagens_troca.n_cod_mensagens_troca desc;");
      
      while ($consulta = mysql_fetch_array($query)){
        $mensagem = $consulta["V_MENSAGEM"];  
        $usuario = $consulta["V_NOME"];
        $cod_usuario = $consulta["N_COD_USUARIO"];
        $foto_usuario = $consulta["V_FOTO"];
        $datamensagem = $consulta["D_DATA_MENSAGEM"];
        $datadehoje = date("Y-m-d H:i:s");
        $sexo = $consulta["V_SEXO"];

        $start_date = new DateTime($datadehoje);
        $since_start = $start_date->diff(new DateTime($datamensagem));
          /*echo $since_start->days.' dias total<br>';
          echo $since_start->y.' Anos<br>';
          echo $since_start->m.' Meses<br>';
          echo $since_start->d.' dias<br>';
          echo $since_start->h.' horas<br>';
          echo $since_start->i.' minutos<br>';
          echo $since_start->s.' segundos<br>';*/
          $tempo = '';

          if ($since_start->y > 0){
            $tempo = 'há '.$since_start->y.' Anos(s)';
          }else if ($since_start->m > 0){
            $tempo = 'há '.$since_start->m.' Mes(ses)';
          }else if ($since_start->d > 0){
            $tempo = 'há '.$since_start->d.' Dia(s)';
          }else if ($since_start->h > 0){
            $tempo = 'há '.$since_start->h.' Hora(s)';
          }else if ($since_start->i > 0){
            $tempo = 'há '.$since_start->i.' Minuto(s)';
          }else if ($since_start->s > 0){
            $tempo = 'há '.$since_start->s.' Segundo(s)';
          }else{
            $tempo = 'Agora';
          }

          if ($codigo == $cod_usuario){
            echo '<div class="message-box left-img">';
            echo '<div class="picture">';
            if ($foto_usuario != ''){
              echo ' <img src="'.$foto_usuario.'"/>';
            }else{
              if ($sexo == 'F') {
                $foto_usuario = "../FotoPerfilUsuario/foto_padraoF.jpg";
              } else {
                $foto_usuario = "../FotoPerfilUsuario/foto_padraoM.jpg";
              }
              echo ' <img src="'.$foto_usuario.'"/>';
            }
            echo ' <span class="time">'.$tempo.'</span>';
            echo '</div>';
            echo ' <div class="message">';
            echo '  <span>'.$usuario.'</span>';
            echo ' <p>'.$mensagem.'</p>';
            echo ' </div>';
            echo '</div>';     
          }else{

            echo '<div class="message-box right-img">';    
            echo '<div class="picture">';    
            if ($foto_usuario != ''){
              echo ' <img src="'.$foto_usuario.'"/>';
            }else{
              if ($sexo == 'F') {
                $foto_usuario = "../FotoPerfilUsuario/foto_padraoF.jpg";
              } else {
                $foto_usuario = "../FotoPerfilUsuario/foto_padraoM.jpg";
              }
              echo ' <img src="'.$foto_usuario.'"/>';
            }
            echo '  <span class="time-right">'.$tempo.'</span>';    
            echo ' </div>';    
            echo '<div class="message">';    
            echo ' <span>'.$usuario.'</span>';    
            echo '  <p>'.$mensagem.'</p>';    
            echo '  </div>';    
            echo '</div>';    
          }

      } 
      ?>  
  </div>
  