<!DOCTYPE html> 
<html> 
<head> 
    <title>Результат регистрации</title> 
    <style> 
        body {
            background: linear-gradient(to right, #f13f3f, #d33220);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            border: 2px solid black; 
            padding: 40px;
            text-align: center;
            background-color: white; 
            border-radius: 10px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
        }


        .message { 
            font-size: 20px; 
        } 
 
        button { 
            padding: 10px 20px; 
            background-color: #FF0000; 
            color: white; 
            border: none; 
            cursor: pointer; 
            border-radius: 5px; 
        } 
 
        button:hover { 
            background-color: #CC0000; 
        } 
    </style> 
</head> 
<body>
<div class="container">
    <div class="message"> 
    <?php  
$servername = "localhost";  
$username = "root"; 
$password = ""; 
$dbname = "chelgumath";  
 
$conn = new mysqli($servername, $username, $password, $dbname);  
  

if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $email = $_POST['email'];  
    $password = $_POST['password'];  
  

    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");  
    $stmt->bind_param("s", $email);  
  
  
    if ($stmt->execute()) {  
        $stmt->store_result();  
        $stmt->bind_result($hashed_password);  
         
        if ($stmt->fetch() && password_verify($password, $hashed_password)) {  
            echo "Вход выполнен успешно!";  

   
            header("Location: 2.html"); 
            exit(); 
        } else {  
            echo "Неверный email или пароль.";  
        }  
    } else { 
        echo "Ошибка: " . $stmt->error; 
    }  
  
    $stmt->close();  
}  
  
$conn->close();  
?> 

</div>
    <p>&nbsp;</p>
    <button onclick="window.history.back();">Назад</button> 
</div>
</body> 
</html>

