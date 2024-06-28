<?php
$servername = "localhost";
$username = "root"; // altere para seu usuário do MySQL
$password = ""; // altere para sua senha do MySQL
$dbname = "estudos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM registro_estudos WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro ao excluir registro: " . $conn->error;
    }
}

$conn->close();
?>
