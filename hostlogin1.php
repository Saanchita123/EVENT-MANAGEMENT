
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
            echo "<script>alert('Invalid Password'); window.location.href='login1.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid Name'); window.location.href='login1.html';</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
    /* Base CSS */
     * {
            margin: 0;
            padding: 0;
          
           
        }
        body {
          font-family: sans-serif;
          display: flex;
        align-items: center;
            justify-content: center;
            background-color: black;
        }

        .card {
            background: rgba(0, 0, 0, 0.30);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(11.5px);
            -webkit-backdrop-filter: blur(11.5px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: white;
            padding: 2em;
            border-radius: 30px;
            width: 100%;
            height: 500px;
            max-width: 420px;
            margin-left: -90px;
        
            
        }
        #image-comtainer
        {
            display: flex;
            width: 800px;
            height: 100vh;
         

    
    align-items: center;
    justify-content: center;
        }
        #image-comtainer img
        {
          
            width: 1300px;
            height: 100%;
        }
#form-container
{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 500px;
    height: 100vh;
   
}
 

        #form-container form {
            width: 100%;
            
}
h1
{
    text-align: center;
    margin-bottom: 1em;
}
        h1 {
           text-align:center;
            margin-bottom: 1em;
}
        h2 {
            text-align:center;
            margin-bottom: 1em;
        }
        form
        {
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            
        }
        .form-group {
            margin-bottom: 1em;
            align-items: center;
            

        }

        .form-group label {
            display: block;
            margin-bottom: 0.5em;
        }

        .form-group input {
            width:350px;
            margin-top:40px;
            padding: 10px;
            border-radius:24px;
            background-color: black;
            border: 0.5px solid rgba(255, 255, 255, 0.875);
            color: white;
            font-size: 16px;
            font-size: 1em;
        }

        .form-group input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
        }

        .button-group {
            text-align: center;
        }

        .button-group button {
            padding: 0.7em 1.5em;
            border: none;
            border-radius: 24px;
            background: rgba(0, 0, 0, 0.30);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        
            color: white;
            margin-top: 30px;
            width: 150px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.2s ease-in-out;
        }

        .button-group button:hover {
            background:rgba(31, 38, 135, 0.37);
        } 
        p{
            margin-top: 40px;
        } 



        /* Base styles (already defined above) */

/* Responsive styles */
@media screen and (max-width: 1024px) {
    #image-comtainer img {
        width: 100%;
        height: auto;
    }

    #form-container {
        width: 100%;
        padding: 20px;
    }

    .form-group input {
        width: 100%;
    }

    .card {
        margin-left: 0;
        max-width: 350px;
    }
}

@media screen and (max-width: 768px) {
    body {
        flex-direction: column;
    }

    #image-comtainer {
        width: 100%;
        height: auto;
        justify-content: center;
    }

    #form-container {
        width: 100%;
        padding: 10px;
    }

    .form-group input {
        width: 90%;
    }

    .card {
        max-width: 90%;
        padding: 1em;
    }
}

@media screen and (max-width: 480px) {
    h1, h2 {
        font-size: 1.5em;
    }

    .form-group input {
        width: 100%;
        font-size: 0.9em;
    }

    .button-group button {
        width: 120px;
        font-size: 0.9em;
    }
}



        
    </style>
</head>
<body>
    <div id="image-comtainer">
        <img src="login-pic.svg" alt="" >
    </div>
    <div id="form-container"> 
    <div class="card">
        <h1>Hello welcome back!</h1>
        <h2>Host Login</h2>
        <form method="post">
            <div class="form-group">
                <!-- <label for="name">Username</label> -->
                <input type="text" id="name" name="name" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <!-- <label for="password">Password</label> -->
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="button-group">
            <button type="submit" class="login-button">Login</button>
                <p class="create-account-link">Don't have an account? <a href="newaccounthost11.php">Create Account</a></p>
            </div>
        </form>
    </div>
</div>
    <!-- Vanilla tilt.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
    <script>
        VanillaTilt.init(document.querySelectorAll(".card"), {
            max: 4,
            speed: 800,
            scale: 1.03
            // glare: true
            // "max-glare": 0.1,
        });
    </script>
</body>
</html>



