<?php
// Conexão à base de dados
$conn = new mysqli('localhost', 'root', '', 'gestao_alunos');
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $contacto = $_POST['contacto'];

    // Validar os dados (podes adicionar mais validações)
    if (empty($nome) || empty($email) || empty($contacto)) {
        echo "<div class='alert alert-danger' role='alert'>'Todos os campos são obrigatórios.'</div>";
    } else {
        // Preparar e executar a inserção
        $stmt = $conn->prepare("INSERT INTO alunos (nome, email, contacto) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $contacto);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Erro: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Aluno</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div>     
            <br><br>   
            <h1 class="text-decoration-underline text-center text-uppercase">Adicionar Novo Aluno</h1>
            <form method="post" action="">
            Nome: <input type="text" name="nome" class="form-control"placeholder="Mario"><br>
            Email: <input type="email" name="email" class="form-control"placeholder="MARIO@example.com"><br>
            Contacto: <input type="number" name="contacto" class="form-control"placeholder="91919191"><br>
            <input type="submit" value="Adicionar" class="btn btn-success mb-3">
        	</form>
            <a href="index.php" class="btn btn-primary mb-3">Voltar à lista</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>