<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://jsuites.net/v4/jsuites.js"></script>
    <link rel="stylesheet" href="stiles.css">
  </head>
  <body>

    <?php
        $pdo = new PDO("mysql:host=localhost;dbname=aulaprogweb", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(isset($_POST['nome'])){
            $sql = $pdo->prepare("INSERT INTO `tab_pessoa` VALUES (null, ?, ?, ?)");    
            $sql->execute(array($_POST['nome'],$_POST['cpf'],$_POST['email']));

            echo "<h2>Pessoa cadastrada com sucesso!</h2>";
        }

        if(isset($_GET['delete'])){
            $cod_pessoa = (int) $_GET['delete'];
            $pdo->exec("DELETE FROM `tab_pessoa` WHERE cod_pessoa = $cod_pessoa");

            echo "<h2>Pessoa excluída com sucesso</h2>";
        }
    ?>

<div class="container">
        <form class="formulario" method="POST">
            <legend>
                <h1 text-align="center">Sistema de Cadastro de Pessoas</h1>
            </legend>
            <fieldset>
                <div>
                    Nome: <input type="text"
                    class="form-control" name="nome" required>
                </div>
                <div>
                    CPF: <input type="text"
                    class="form-control"
                    name="cpf" data-mask='000.000.000-00' required placeholder="000.000.000-00">
                </div>
                <div>
                    E-mail: <input type="email"
                    class="form-control" name="email" required placeholder="email@email.com">
                </div>
                <div>
                    <input type="submit" class="btn btn-primary botao" value="Enviar">
                    <input type="reset" class="btn btn-primary botao" value="Limpar Dados"> 
                </div>    
            </fieldset>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <?php
        $sql = $pdo->prepare("SELECT * FROM `tab_pessoa`");
        $sql->execute();
        $pessoas = $sql->fetchAll();

        echo "<table class='table table-striped table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col' colspan='2' align='center'>Ações</th>";
        echo "<th scope='col'>Nome</th>";
        echo "<th scope='col'>CPF</th>";
        echo "<th scope='col'>E-mail</th>";
        echo "</tr>";
        echo "</thead>";

        foreach($pessoas as $pessoa) {
            echo "<tr>";

            echo '<td align="center"><a href="?delete=' 
            . $pessoa['cod_pessoa'] . '">( X )</a></td>';
            echo '<td align="center"><a href="alterar.php?cod_pessoa=' 
            . $pessoa['cod_pessoa'] . '">( Alterar )</a></td>';
            
            echo "<td> $pessoa[nome] </td>";
            echo "<td> $pessoa[cpf] </td>";
            echo "<td> $pessoa[email] </td>";
            echo "</td>";

        }

    ?>
    </body>
</html>