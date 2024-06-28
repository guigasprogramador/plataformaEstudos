<?php
$servername = "localhost";
$username = "root"; // altere para seu usuário do MySQL
$password = ""; // altere para sua senha do MySQL
$dbname = "estudos";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $materia = $_POST['materia'];
        $questoes_feitas = $_POST['questoes_feitas'];
        $questoes_erradas = $_POST['questoes_erradas'];
        $percentual_acertos = ( ($questoes_feitas - $questoes_erradas) / $questoes_feitas ) * 100;

        $sql = "INSERT INTO registro_estudos (materia, questoes_feitas, questoes_erradas, percentual_acertos)
                VALUES (:materia, :questoes_feitas, :questoes_erradas, :percentual_acertos)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':materia', $materia);
        $stmt->bindParam(':questoes_feitas', $questoes_feitas);
        $stmt->bindParam(':questoes_erradas', $questoes_erradas);
        $stmt->bindParam(':percentual_acertos', $percentual_acertos);

        $stmt->execute();
        echo "Novo registro criado com sucesso";
    }
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;
?>
