<?php 

include("../controll/controlSessaoAdimin.php");
include("../controll/controlAdmin.php");
?>

<!DOCTYPE html >
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="shortcut icon" href="../img/SAD3.png" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>ADM</title>
</head>
<body>
<!-- menu principal -->
<nav class="navbar navbar-expand-lg shadow" style="background-color: #0D6EFD; padding-left: 15px; padding-right: 15px;">
        <div class="container">

          <a class="navbar-brand" href="./admin.php">
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

            <form class="d-flex" role="search" action="" method="get">
              <input class="form-control me-2" type="search" name="busca" value="<?php echo isset($_REQUEST["busca"])? $_REQUEST["busca"]:"" ?>" placeholder="Pesquisar Professor" aria-label="Search">
              <button class="btn btn-light" type="submit">Pesquisar</button>
            </form>

            <!-- limpar -->
              <button type="submit" class="btn btn-danger" style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#ModalLimpar">Limpar Tudo</button>

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



<!-- Modal de limpar-->
<div class="modal fade" id="ModalLimpar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Limpar todas as avaliações</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div style="font-size: 16pt;">
          Você tem certeza?
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        <form action="" method="post">
          <input type="hidden" name="limparTudo" value="">
          <button type="submit" class="btn btn-primary">Sim</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- conteudo -->

<div>
<div class="container" style="margin-top: 20px; padding-top: 20px;">
    <h3 class="text-center">Professores Avaliados</h3><br>
    <ul>
        <?php if ($result->num_rows > 0): ?>

            <!-- Construindo os cards -->
            <div class="container text-center">
            <div class="row">

                <?php while ($professor = $result->fetch_assoc()): ?>
                        <div class="col">
                            <div class="card shadow p-3 mb-5 bg-body-tertiary rounded border border-primary" style="width: 326px;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $professor['nome']?></h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Avaliação Geral</h6>
                                    <p class="card-text"><strong><?php echo $professor["media_geral"]?></strong></p>
                                    <form action="./detalhes.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $professor['id']?>">
                                    <button type="submit" class="btn btn-primary">Ver Detalhes</button>
                                    </form>
                                </div>
                            </div>
                        </div>  
                <?php endwhile; ?>
            </div>
            </div>

        <?php else: ?>
            <li>Nenhum professor encontrado.</li>
        <?php endif; ?>
    </ul>
    <br>
    
            <!-- criar paginação -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php if ($paginaAtual > 1): ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $paginaAtual - 1; ?>">Anterior
                </a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $i; ?>" <?php if ($i== $paginaAtual) echo "style=\"font-weight:bold;\"";?>>
                    <?php echo $i; ?>
                </a></li>
            <?php endfor; ?>

            <?php if ($paginaAtual < $totalPaginas): ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $paginaAtual + 1; ?>">Próximo</a></li>
            <?php endif; ?>
            </ul>
    </nav>
</div>
</div><br><br>

    <?php
    // Fechar a conexão
    $mysqli->close();
    ?>
 
</body>
</html>