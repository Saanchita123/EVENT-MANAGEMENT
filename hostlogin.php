<?php
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['name'];
    $password = $_POST['password'];

    // SQL query to check if the user exists in the database
    $sql = "SELECT password, phone FROM `users` WHERE CONCAT(firstname, ' ', lastname) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fullName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Directly compare for plain text password
        if ($password == $row['password']) {
            $_SESSION['username'] = $fullName;
            $_SESSION['user_phone'] = $row['phone']; // Store phone number in session

            // JavaScript to set localStorage and redirect
            echo "<script>
                    localStorage.setItem('name', '" . addslashes($fullName) . "');
                    window.location.href = 'dashboard.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Invalid Password'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid Name'); window.location.href='login.html';</script>";
    }
}
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



button.login-button {
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

            
        <form class="login-form" method="post">
            <h1>Login to your Account</h1>

            <div class="input-group">

                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

            </div>
            <div class="input-group">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

            </div>
            <button type="submit" class="login-button">Login</button>
            <p class="create-account-link">Don't have an account? <a href="newaccoutnhost.php">Create Account</a></p>
        </form>
    </div>
    <script>
   
    // document.querySelector('.login-form').addEventListener('submit', function(event) {
    //     event.preventDefault();

    //     const name = document.getElementById('name').value.trim(); 

    //     if (name) { 
    //         localStorage.setItem('name', name); 
    //         window.location.href = 'dashboard.html';
    //     }
    // });
</script>

   



</body>
</html>