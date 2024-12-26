<?php
include 'connect.php';

if (isset($_POST['signUp'])) {
    
    $firstName = htmlspecialchars(trim($_POST['fName']));
    $lastName = htmlspecialchars(trim($_POST['lName'])); 
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $password = md5($password); 

    
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email address already exists!";
    } else {
        
        $insertQuery = "INSERT INTO users (firstName, lastName, email, password)
                        VALUES ('$firstName', '$lastName', '$email', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    echo "Email: " . $_POST['email'] . "<br>";
    echo "Password: " . $_POST['password'] . "<br>";
    $password = md5(htmlspecialchars(trim($_POST['password'])));
    echo "Password Hash: " . $password . "<br>";

    $email = htmlspecialchars(trim($_POST['email']));
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: homepage.php");
        exit();
    } else {
        echo "<script>alert('Incorrect email or password.');</script>";
    }
}


?>
