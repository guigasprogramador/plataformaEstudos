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
    $materia = $_POST['materia'];
    $questoes_feitas = $_POST['questoes_feitas'];
    $questoes_erradas = $_POST['questoes_erradas'];
    $percentual_acertos = (($questoes_feitas - $questoes_erradas) / $questoes_feitas) * 100;

    $sql = "UPDATE registro_estudos SET materia='$materia', questoes_feitas='$questoes_feitas', questoes_erradas='$questoes_erradas', percentual_acertos='$percentual_acertos' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }
}

$conn->close();
?>
