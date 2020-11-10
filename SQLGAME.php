<!doctype html>
<html lang="en">
  <head>
    <title>SQL Game</title>

    <link rel="stylesheet" href="sqlgames.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <div class="container">
    <div class="row text-center"><div class="col-12"><h1>MySQL Game</h1></div>
    <div class="col-12"><p class="backgroundSet">Jogo para 2 jogadores, clique no botão Ataque para ver quem reduz o HP do oponente a ZERO primeiro!</p></div>
    </div>
    <div class="row">
      <div class="col-5 colP colOne">
        <div class="row justify-content-center text-center">
          <div class="col-12">Amarelo Ataque: 5 por clique</div>
        </div>
        <div class="row text-center justify-content-center pt-2">
          <form action="" method="POST">
            <button class="btn btn-success" type="submit" name="atacarVermelho">Atacar Vermelho</button>    
          </form>
        </div>
      </div>

      <div class="col-5 colP colTwo">
      <div class="row justify-content-center text-center">
          <div class="col-12">Vermelho Ataque: 10 por clique</div>
        </div>
        <div class="row text-center justify-content-center pt-2">
        <form action="" method="POST">
          <button class="btn btn-success" name="atacarAmarelo" type="submit">Atacar Amarelo</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <?php

  $con = mysqli_connect("localhost", "root", "root", "test");

  //ATAQUE VERMELHO
  if(isset($_POST['atacarVermelho'])){

  $selectAtaque = "SELECT ataque FROM gamecor WHERE id=1";
  $queryAtk = mysqli_query($con, $selectAtaque);

  while($result = mysqli_fetch_array($queryAtk)){;

  $totalAtaqueVermelho = $result[0];

  }

  $atacarV = "UPDATE gamecor SET hp= hp - '$totalAtaqueVermelho' WHERE id=3 ";
  $queryAtacarV = mysqli_query($con, $atacarV);

  if($queryAtacarV){
    echo "Amarelo Reduzido em $totalAtaqueVermelho pontos.";
  }
}

  //ATAQUE AMARELO

  if(isset($_POST['atacarAmarelo'])){ 

    $selectAmarelo = "SELECT ataque FROM gamecor WHERE id=3";
    $querySelectAmarelo = mysqli_query($con, $selectAmarelo);

    while($resultAmarelo = mysqli_fetch_array($querySelectAmarelo)){
      $totalAtaqueAmarelo = $resultAmarelo[0];
    }

    $atacarAmarelo = "UPDATE gamecor SET hp= hp - '$totalAtaqueAmarelo' WHERE id=1";
    $queryAtacarAmarelo = mysqli_query($con, $atacarAmarelo);

    if($queryAtacarAmarelo){
      echo "Vermelho reduzido em $totalAtaqueAmarelo pontos.";
    }
  }

  $selectAllA = "SELECT ataque, hp FROM gamecor WHERE id=3";
  $querySelectAllA = mysqli_query($con, $selectAllA);

  while($rowA = mysqli_fetch_array($querySelectAllA)){
    $amareloHP = $rowA['hp'];
    $amareloAtaque = $rowA['ataque'];
  }

  $selectAllV = "SELECT ataque, hp FROM gamecor WHERE id=1";
  $querySelectAllV = mysqli_query($con, $selectAllV);

  while($rowV = mysqli_fetch_array($querySelectAllV)){
    $vermelhoHP = $rowV['hp'];
    $vermelhoAtaque = $rowV['ataque']; 
  }

  echo "Amarelo HP: $amareloHP <br>
        Amarelo Ataque: $amareloAtaque <br>
        Vermelho HP: $vermelhoHP <br>
        Vermelho Ataque: $vermelhoAtaque <br>";

  //HP = 0
  if($amareloHP <= 0){

    header("Location: victoryPageVermelho.html");
    $resetAmarelo = "UPDATE gamecor SET hp=100 WHERE id=3";
    $queryResetAmarelo = mysqli_query($con, $resetAmarelo);
    exit();
    
  } else if($vermelhoHP <= 0){

    header("Location: victoryPageAmarelo.html");
    $resetVermelho = "UPDATE gamecor SET hp=80 WHERE id=1";
    $queryResetVermelho = mysqli_query($con, $resetVermelho);
    exit();

  }


  ?>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>