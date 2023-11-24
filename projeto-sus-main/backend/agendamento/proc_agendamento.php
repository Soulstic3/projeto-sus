<?php
session_start();
require_once("mysql_connect.php");

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataConsulta = $_POST['dataConsulta'];
    $tipoConsulta = $_POST['tipoConsulta'];

    // Consulta para verificar os horários já agendados para a data e tipo de consulta
    $sql = "SELECT horario FROM consulta WHERE data = '$dataConsulta' AND tipo = '$tipoConsulta'";
    $result = $conn->query($sql);

    // Lista de todos os horários possíveis (por exemplo, das 8h às 18h)
    $horariosPossiveis = array("08:00", "09:00", "10:00", "11:00", "14:00", "15:00", "16:00", "17:00");

    if ($result->num_rows > 0) {
        // Se houver horários agendados para a data e tipo de consulta especificados
        $horariosOcupados = array();
        while ($row = $result->fetch_assoc()) {
            $horariosOcupados[] = $row['horario'];
        }

        // Remover horários ocupados dos horários possíveis
        foreach ($horariosOcupados as $horarioOcupado) {
            if (($key = array_search($horarioOcupado, $horariosPossiveis)) !== false) {
                unset($horariosPossiveis[$key]);
            }
        }

        // Exibir os horários disponíveis
        if (!empty($horariosPossiveis)) {
            echo "<h3>Horários Disponíveis:</h3>";
            echo "<form action='realizar_agendamento.php' method='post'>";
            echo "<select id='horarioSelecionado' name='horarioSelecionado' required>";
            echo "<option value=''>Selecione o horário</option>";
            foreach ($horariosPossiveis as $horarioDisponivel) {
                echo "<option value='$horarioDisponivel'>$horarioDisponivel</option>";
            }
            echo "</select><br><br>";
            echo "<input type='hidden' name='dataConsulta' value='$dataConsulta'>";
            echo "<input type='hidden' name='tipoConsulta' value='$tipoConsulta'>";
            echo "<input type='submit' value='Agendar Consulta'>";
            echo "</form>";
        } else {
            echo "<p>Nenhum horário disponível para esta data e tipo de consulta.</p>";
        }
    } else {
        // Se não houver horários agendados, todos os horários estão disponíveis
        echo "<h3>Horários Disponíveis:</h3>";
        echo "<form action='realizar_agendamento.php' method='post'>";
        echo "<select id='horarioSelecionado' name='horarioSelecionado' required>";
        echo "<option value=''>Selecione o horário</option>";
        foreach ($horariosPossiveis as $horarioDisponivel) {
            echo "<option value='$horarioDisponivel'>$horarioDisponivel</option>";
        }
        echo "</select><br><br>";
        echo "<input type='hidden' name='dataConsulta' value='$dataConsulta'>";
        echo "<input type='hidden' name='tipoConsulta' value='$tipoConsulta'>";
        echo "<input type='submit' value='Agendar Consulta'>";
        echo "</form>";
    }
}

$conn->close();
?>
