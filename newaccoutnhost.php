<?php
include 'connect.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

if($password == $confirmpassword)
{
    $sql = "INSERT INTO `users` (`firstname`, `lastname`, `phone`, `email`, `password`) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password')";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
       header("Location: hostlogin.php");
    }
    else
    {
        echo "Account not created";
    }
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>


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
gap: 10px;
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
#button
{
    width: 150px;
    height: 40px;
    background: linear-gradient(#26949B,#57F9B8);
    border-radius: 7px;
    color: #ffffff;
    border: none;
    cursor: pointer;
    font-size: 18px;
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

#button .login-button {
    width: 80%;
}
}

@media (max-width: 480px) {
.login-form {
    margin-top: 400px;
    font-size: 18px;
    gap: 10px;
}

input {
    width: 90%;
    height: 40px;
}

#button .login-button {
    width: 90%;
    height: 50px;
    font-size: 16px;
}
}

</style>



<body>
    <div id="login-page">



        <div id="login-image">
            <img src="images/login-image.png" alt="" id="image">
        </div>





        <div class="form-container">

            
        <form class="login-form" method="post">
            <h1>Host Login</h1>

            <div class="input-group">

                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" required>

            </div>

            <div class="input-group">

                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" required>

            </div>

            <div class="input-group">

                <label for="phone">phone</label>
                <input type="text" id="phone" name="phone" required>

            </div>

            <div class="input-group">

                <label for="email">email</label>
                <input type="email" id="email" name="email" required>

            </div>



            <div class="input-group">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            
            </div> 
            <div class="input-group">

                <label for="confirmpassword">confirm password</label>
                <input type="password" id="confirmpassword" name="confirmpassword" required>
            
            </div> 
                <!-- <input type="submit" value="Create Account" class="login-button"> -->
                 <input type="submit" name="Create Account" id="button">
            <p class="create-account-link">already have an account? <a href="hostlogin.html">login</a></p>
        </form>

    </div>

    <script>
       
    </script>
</body>
</html>
