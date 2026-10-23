<?php 
include("./controll/controlLogin.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/media_screen.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="img/SAD3.png" type="image/x-icon">

    <title>Login</title>
</head>

<body style="background: linear-gradient(to right, #F6F8FB, #0D6EFD);">




<!-- conteudo -->

<div id="conteudo">

    <!-- área do login -->
    <div class="container px-4 shadow p-3 mb-5 rounded border border-primary" style="background-color: #F6F8FB;">
        <div class="row">

        <!-- local da logo -->
            <div class="col">
                <div class="p-3">
                    <div style="text-align: center;">
                        <img src="./img/SAD3.png" alt="" style="width: 200px; height: 150px;">
                        <h5>Sistema de Avalição de Docentes</h5>
                    </div>
                   
                </div>
            </div>

            <!-- local do formulário -->
            <div class="col">
                <div class="" style="padding-top: 60px;">
                    <form action="" method="post">

                        <!-- input -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Nº Matrícula</span>
                            <input type="number" name="matricula" id="inputPassword5" class="form-control border border-primary" aria-describedby="passwordHelpBlock" required>
                        </div>

                        <hr>

                        <!-- texto ou informação abaixo -->
                        <div id="passwordHelpBlock" class="form-text">
                            <strong>Informe o seu número de matrícula</strong><br>
                            <strong>Para efectuar a avaliação</strong>
                        </div>
                        <hr>

                        <!-- botão de entrar -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div><br>
                        
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>