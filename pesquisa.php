<?php
$servername = "localhost";
$username = "root"; // altere para seu usuário do MySQL
$password = ""; // altere para sua senha do MySQL
$dbname = "estudos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM registro_estudos";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql .= " WHERE materia LIKE '%$search%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Matéria</th><th>Questões Feitas</th><th>Questões Erradas</th><th>Percentual de Acertos</th><th>Data</th><th>Ações</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['materia'] . "</td>";
        echo "<td>" . $row['questoes_feitas'] . "</td>";
        echo "<td>" . $row['questoes_erradas'] . "</td>";
        echo "<td>" . $row['percentual_acertos'] . "%</td>";
        echo "<td>" . $row['data_registro'] . "</td>";
        echo "<td>";
        echo "<button class='btn btn-warning btn-sm editBtn' data-id='" . $row['id'] . "' data-materia='" . $row['materia'] . "' data-questoes_feitas='" . $row['questoes_feitas'] . "' data-questoes_erradas='" . $row['questoes_erradas'] . "'>Editar</button> ";
        echo "<button class='btn btn-danger btn-sm deleteBtn' data-id='" . $row['id'] . "'>Excluir</button>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "Nenhum resultado encontrado.";
}

$conn->close();
?>
