<?php 
include("../controll/controlSessaoAdimin.php");
include("../controll/controlDetalhes.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="shortcut icon" href="../img/SAD3.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
      .btn-flutuante {
        position: fixed;
        top: 90px;
        right: 20px;
        z-index: 9999;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      div#p{
        margin-bottom: 3px;
      }
    </style>
    <title>Detalhes</title>
</head>
<body>
<!-- menu principal -->
<nav class="navbar navbar-expand-lg shadow" style="background-color: #0D6EFD; padding-left: 15px; padding-right: 15px;">
        <div class="container">

          <a class="navbar-brand" href="./index.php">
              <img src="../img/SAD.png" alt="vazio" style="width: 70px; height: 50px;"> 
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <strong >
              <label style="font-size: 14pt; color: white;">Sistema de Avaliação de Docentes</label>
            </strong>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-underline">
              <li class="nav-item">
                <div  data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                </div>
              </li>

            </ul>

            <form class="d-flex" role="search" action="./admin.php" method="get">
              <input class="form-control me-2" type="search" name="busca2" value="<?php echo isset($_REQUEST["busca"])? $_REQUEST["busca"]:"" ?>" placeholder="Pesquisar Professor" aria-label="Search">
              <button class="btn btn-light" type="submit">Pesquisar</button>
            </form>

            <!-- limpar -->
              <button type="submit" class="btn btn-danger" style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#ModalLimpar">Limpar</button>

               <!-- drop para sair -->
               <div class="btn-group dropstart">
                <div class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 5px;">
                  <i class="material-icons">more_vert</i>
                </div>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="../controll/controlLogoutAdmin.php">Sair do sistema</a></li>
                </ul>

            </div>
          </div>
        </div>
      </nav>



  <!-- conteudo -->
<h3 class="text-center" style="margin-top: 35px;">Detalhes da Avaliação</h3>
<hr class="">

<div class="container">

    <div class="row g-0">
    
        <div class="col-6 col-md-4" style="padding-right: 10px;"> 

        <!-- imagem -->
            <img src="../img/profile_7310896.png" alt="" style="width: 110px; height: 110px; margin-bottom: 20px;">

            <p style="color: #0F77F0; font-weight: bolder;">Informações do Professor</p><hr class="border border-primary">

            <div>
                <span><strong>Nome:</strong> <?php echo ucwords($info_prof["nome"]);?></span><br>
                <div id="p"></div>
                <span><strong>Genéro: </strong> <?php echo ucwords($info_prof["genero"]);?></span><br>
                <div id="p"></div>
                <span><strong>Telefone: </strong> <?php echo $info_prof["telefone"];?></span><br>
                <div id="p"></div>
                <span><strong>Email: </strong> <?php echo $info_prof["Email"];?></span><br>
                <div id="p"></div>
                <span><strong>Disciplina(s): </strong></span><br>
                  <ul>
                    <?php while($disci = $info_prof_disci->fetch_assoc()):?>
                      <li><?php echo $disci["nome"];?> </li>
                    <?php endwhile?>
                  </ul>
            </div><br>

            <p style="color: #0F77F0; font-weight: bolder;">Média final de cada ponto aváliado</p><hr class="border border-primary">

            <div>
                <span><strong>1- Pontualidade:</strong></span> <span id="pt"><?php echo $medias["pt"];?></span><br>
                <span><strong>2- Apresentação:</strong></span> <span id="ap"><?php echo $medias["ap"];?></span><br>
                <span><strong>3- Presença:</strong></span> <span id="pr"><?php echo $medias["pr"];?></span><br>
                <span><strong>4- Organização:</strong></span> <span id="org"><?php echo $medias["org"];?></span><br>
                <span><strong>5- Dominio da cadeira:</strong></span> <span id="dc"><?php echo $medias["dc"];?></span><br>
                <span><strong>6- Explicação da Matéria:</strong></span> <span id="exm"><?php echo $medias["exm"];?></span><br>
                <span><strong>7- Modo de Avaliação:</strong></span> <span id="mda"><?php echo $medias["mda"];?></span><br>
            </div>
            <!-- botão de detalhes -->
            <button type="submit" class="btn btn-primary" style="margin-top: 10px; padding-top: 2px; padding-bottom: 2px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Mais Detalhes
            </button>
        </div>

        <div class="col-sm-6 col-md-8">

            <div class="border border-primary rounded" style="margin: 20px; padding: 15px;">

            <h3 class="text-center" style="padding: 10px;">Desempenho em Gráfico</h3>
    
            <div style="width: 420px; height: 420px; margin: auto; padding: 20px">
            <canvas id="myChart"></canvas>
            </div>

            </div>

            
        </div>
    </div>

</div><hr ><br><br><br>


<!-- Modal de limpar-->
<div class="modal fade" id="ModalLimpar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Limpar está Avaliação</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div style="font-size: 16pt;">
          Você tem certeza?
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        <form action="./admin.php" method="post">
          <input type="hidden" name="limpar" value="<?php echo $_REQUEST["id"]?>">
          <button type="submit" class="btn btn-primary">Sim</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal de disciplinas-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">
          Disciplinas aváliadas
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <!-- corpo do modal -->
        <div class="container">
        <?php while($medias2 = $result_medias2->fetch_assoc()):?>
              <div class="row p-3 mb-5 bg-body-tertiary rounded border border-primary-subtle">
                  <div class="col">
                    <div><strong><?php echo $medias2["nome"]?></strong></div>
                    <hr>
                    <ul>
                      <li>Pontualidade: <strong><?php echo $medias2["pt"]?></strong></li>
                      <li>Apresentação: <strong><?php echo $medias2["ap"]?></strong></li>
                      <li>Presença: <strong><?php echo $medias2["pr"]?></strong></li>
                      <li>Organização: <strong><?php echo $medias2["org"]?></strong></li>
                      <li>Dominio da cadeira: <strong><?php echo $medias2["dc"]?></strong></li>
                      <li>Explicação da Matéria: <strong><?php echo $medias2["exm"]?></strong></li>
                      <li>Modo de Avaliação: <strong><?php echo $medias2["mda"]?></strong></li>
                    </ul>
                  </div>
              </div>
          <?php endwhile?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Fechar
        </button>
      </div>
    </div>
  </div>
</div>
  
  <form method="post" action="../controll/controlGerarPdf.php" target="_blank">
  <input type="hidden" name="nome" value="<?php echo $info_prof['nome']; ?>">
  <input type="hidden" name="genero" value="<?php echo $info_prof['genero']; ?>">
  <input type="hidden" name="telefone" value="<?php echo $info_prof['telefone']; ?>">
  <input type="hidden" name="email" value="<?php echo $info_prof['Email']; ?>">

  <?php
    // Disciplinas
    $info_prof_disci->data_seek(0);
    while($disciplina = $info_prof_disci->fetch_assoc()):
  ?>
    <input type="hidden" name="disciplinas[]" value="<?php echo $disciplina['nome']; ?>">
  <?php endwhile; ?>

  <?php foreach ($medias as $key => $valor): ?>
    <input type="hidden" name="medias[<?php echo $key; ?>]" value="<?php echo $valor; ?>">
  <?php endforeach; ?>

  <?php
    $result_medias2->data_seek(0);
    while($media = $result_medias2->fetch_assoc()):
      foreach ($media as $chave => $valor):
        if ($chave != "nome"):
  ?>
    <input type="hidden" name="avaliacoes[<?php echo $media['nome']; ?>][<?php echo $chave; ?>]" value="<?php echo $valor; ?>">
  <?php 
        endif;
      endforeach;
    endwhile;
  ?>

  <button type="submit" class="btn btn-primary btn-flutuante" title="Imprimir">
    <i class="bi bi-printer"></i>
  </button>
</form>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    var pt = document.getElementById("pt").innerText;
    var ap = document.getElementById("ap").innerText;
    var pr = document.getElementById("pr").innerText;
    var org = document.getElementById("org").innerText;
    var dc = document.getElementById("dc").innerText;
    var exm = document.getElementById("exm").innerText;
    var mda = document.getElementById("mda").innerText;

    new Chart(ctx, {
        type: 'pie',
        data: {
        labels: ['Pontualidade', 'Apresentação', 'Presença', 'Organização', 'Dominio da cadeira', 'Explicação da Matéria', 'Modo de Avaliação'],
        datasets: [{
        label: 'Média Final',
        data: [pt, ap, pr, org, dc, exm, mda],
        borderWidth: 1
        }]
        },
        options: {
        scales: {
        y: {
        beginAtZero: true
        }
        }
        }
        });
</script>
</body>
</html>