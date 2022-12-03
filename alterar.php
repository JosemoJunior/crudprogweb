<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=aulaprogweb', 'root', '');

if (isset($_GET['cod_pessoa'])) {
    $cod_pessoa = (int)$_GET['cod_pessoa'];
    //mount form whit data
    $sql = $pdo->prepare("SELECT * FROM tab_pessoa WHERE cod_pessoa = $cod_pessoa");
    $sql->execute();
    $pessoas = $sql->fetchAll();

    //montar formulário com os dados dos pessoas
    foreach ($pessoas as $pessoa) {
        echo "<form method='POST'>";
        echo "<legend>Insira os dados abaixo</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $pessoa['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "CPF: <input type='text' class='form-control' name='cpf' value='" . $pessoa['cpf'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "E-mail: <input type='text' class='form-control' name='email' value='" . $pessoa['email'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
        echo "<input type='reset' class='btn btn-primary' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
    }

    //$pdo->exec("DELETE FROM `tab_pessoa` WHERE `cod_pessoa` = $cod_pessoa");
    //echo "<h1>Usuário com id = $cod_pessoa deletado com sucesso!</h1>";
}

if (isset($_POST['nome'])) {
    //$sql = $pdo->prepare("INSERT INTO tab_pessoa VALUES (null, ?, ?, ?, ?, ?)");
    //$sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email'], $_POST['nota2'], $_POST['nota3']));
    //alterando dados da tabela tab_pessoa com os dados do form
    $sql = $pdo->prepare("UPDATE tab_pessoa SET nome = ?, cpf = ?, email = ? WHERE cod_pessoa = $cod_pessoa");
    $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
    echo "<h1>Usuário com id = $cod_pessoa alterado com sucesso!</h1>";
    //fazer botao para voltar para a pagina de listagem
    echo "<a href='index.php'>Voltar</a>";

    //echo "<h1>Alterado com sucesso!</h1>";
}