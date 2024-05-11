<?php 
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $email = $_POST['email']; // Change 'user_name' to 'email'
    $password = $_POST['password'];

    if(!empty($email) && !empty($password)) {
        // Prepare and execute the query
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            // Verify hashed password
            if(password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: page1.html");
                die;
            }
        }
        
        echo "Wrong email or password!";
    } else {
        echo "Please enter valid information!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://tse3.mm.bing.net/th?id=OIP.M4TO5RYIhhMhkiM2v-S8yAHaEa&pid=Api&P=0&h=180jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: #f0f0f0;
        }

        #box {
            background-color: #fff;
            margin: 50px auto;
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
            text-align: left;
            margin-bottom: 5px;
        }

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
    <h2>Login</h2>
    <form method="post">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" placeholder="Your Email"><br>
        <label for="password">Enter your password:</label>
        <input type="password" id="password" name="password" placeholder="Your Password"><br>
        <input type="submit" value="Login"><br>
        <a href="signup.php">Click to Signup</a>
    </form>
</div>

</body>
</html>
