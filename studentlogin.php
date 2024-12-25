<?php
    // Database configuration
    $host = "localhost";
    $dbname = "event-registration";
    $username = "root";
    $password = "";
    $servername = "localhost";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize a variable to store error messages
    $error = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $password = $_POST['password'];

        // Query to check the username and password
        $stmt = $conn->prepare("SELECT * FROM studentregister WHERE name = ? AND password = ?");
        $stmt->bind_param("ss", $name, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Login successful, redirect to the dashboard
            echo "<script>window.location.href = 'studentdashboard.php';</script>";
            exit();
        } else {
            // Invalid credentials
            $error = "Invalid name or password";
        }

        $stmt->close();
    }

    $conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-color: #176368;
            font-family: 'Poppins', sans-serif;
          
            justify-content: center;
            align-items: center;
            height: 100vh;

    
}

#login-page {
    display: flex;
    flex-direction: row;
    height: 100vh;
}

#login-image {
    display: flex;
    width: 50%;
    height: 100%;
    background-color: white;
    align-items: center;
    justify-content: center;
}

#image {
    width: 65%;
    height: 65%;
}
#login-button
{
    width: 100px;
    height: 40px;
    background: linear-gradient(#26949B,#57F9B8);
    border-radius: 7px;
    color: #ffffff;
    border: none;
    cursor: pointer;
}
.input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: none;
            border-bottom: 2px solid rgba(255, 255, 255, 0.875);
            color: white;
            font-size: 16px;
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
.form-container {
    background-color: #176368;
    width: 50%;
    height: 100%;
    display: flex;
    color: white;
    align-items: center;
    justify-content: center;
}

.login-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 25px;
    gap: 30px;
}

input {
    width: 300px;
    height: 30px;
    border: none;
    border-bottom: 2px solid white;
    background-color: #176368;
    color: white;
    font-size: 16px;
    padding: 5px;
}



button .login-button {
    width: 150px;
    height: 40px;
    background: linear-gradient(#26949B,#57F9B8);
    border-radius: 7px;
    color: #ffffff;
    border: none;
    cursor: pointer;
    font-size: 18px;
}

.create-account-link {
    font-size: 14px;
}

.create-account-link a {
    color: white;
    text-decoration: underline;
}

.create-account-link a:hover {
    color: #ddd;
}


@media (max-width: 768px) {
    #login-page {
        flex-direction: column;
    }

    #login-image, .form-container {
        width: 100%;
        height: 50%;
    }

    .login-form {
        font-size: 20px;
        gap: 20px;
    }

    input {
        width: 80%;
    }

    button.login-button {
        width: 80%;
    }
}

@media (max-width: 480px) {
    .login-form {
        
        font-size: 18px;
        gap: 15px;
    }

    input {
        width: 90%;
        height: 40px;
    }

    button.login-button {
        width: 90%;
        height: 50px;
        font-size: 16px;
    }
}

    </style>
</head>
<body>



    <div id="login-page">



        <div id="login-image">
            <img src="images/login-image.png" alt="" id="image">
        </div>





        <div class="form-container">

            
        <form class="login-form"  method="POST">
            <h1>Student Login</h1>

            <div class="input-group">

                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

            </div>
            <div class="input-group">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

            </div>
            <button id="login-button" type="submit" onclick="myfunction()"><a href="studentdashboard.php">login</a></button>
            <p class="create-account-link">Don't have an account? <a href="newaccountstudent.php">Create Account</a></p>
        </form>



    </div>
    <script>
    
    </script>



</body>
</html>