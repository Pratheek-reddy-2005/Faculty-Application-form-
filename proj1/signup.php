<?php 
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the fields are not empty
    if(!empty($user_name) && !empty($email) && !empty($password)) {
        // Generate a unique user ID
        $user_id = random_num(20);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Save to database
        $query = "INSERT INTO users (user_id, user_name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $user_id, $user_name, $email, $hashed_password);
        mysqli_stmt_execute($stmt);

        // Redirect to login page after successful signup
        header("Location: login.php");
        die;
    } else {
        // Display error message if any field is empty
        echo "Please enter valid information!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://tse3.mm.bing.net/th?id=OIP.M4TO5RYIhhMhkiM2v-S8yAHaEa&pid=Api&P=0&h=180jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #box {
            background-color: rgba(255, 255, 255, 0.8);
            width: 300px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #box h2 {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }

        form {
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .logo {
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
            height: 150px;
        }
    </style>
</head>
<body>

<div id="box">
    <img src="https://collegekampus.com/wp-content/uploads/2020/07/IIT-Patna-logo.png" alt="IIT Patna Logo" class="logo">
    <h2>Signup</h2>
    <form method="post">
        <label for="user_name">Enter your name:</label>
        <input type="text" id="user_name" name="user_name" placeholder="Username"><br>
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" placeholder="Your Email"><br>
        <label for="password">Enter your password:</label>
        <input type="password" id="password" name="password" placeholder="Your Password"><br>
        <input type="submit" value="Signup"><br>
        <a href="login.php">Click to Login</a>
    </form>
</div>

</body>
</html>
