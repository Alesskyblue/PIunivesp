<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Conectar ao banco de dados
        $servername = "localhost";  /
        $username = "root";        
        $password = "";             
        $dbname = "contato";

        $conn = new mysqli($servername, $username, $password, $dbname);
 
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
 
        $stmt = $conn->prepare("INSERT INTO mensagens (nome, email, mensagem) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
 
        if ($stmt->execute()) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro ao enviar a mensagem: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>

