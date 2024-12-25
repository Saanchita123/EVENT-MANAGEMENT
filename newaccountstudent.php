<?php

    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $dateofbirth = $_POST['dateofbirth'];
        $gender = $_POST['gender']  ;

        $sql = "INSERT INTO studentregister (name, email, password, phone, address, dateofbirth, gender) VALUES ('$name', '$email', '$password', '$phone', '$address', '$dateofbirth', '$gender')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo 
            "<script>
                    alert('Account created successfully');
                    window.location.href = 'studentlogin.php';
                  </script>";
            
        }
        else{
            echo  "<script>alert('Account not created')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        
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
        font-family: Poppins;


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
        margin-bottom: -20px;
    text-align: left;
   
      
    }

    .input-group label {
        display: block;
        margin-top: 20px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 16px;
        
    }

    .input-group input {
        width: 300px;
        padding: 6px;
        border: none;
        background-color: none;
        color: white;
        font-size: 16px;
        display:flex;
        border-bottom: 2px solid white;
background-color: #176368;
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
/*  */
.input-group select {
width: 300px;
padding: 6px;
border: 2px solid white;
background-color: #176368;
color: white;
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
h1
{
    color: white;
}



button {
width: 150px;
height: 40px;
background: linear-gradient(#26949B,#57F9B8);
border-radius: 7px;
color: #ffffff;
border: none;
cursor: pointer;
font-size: 18px;
margin-top: 17px;
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

#button {
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

button  {
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

    <form action="" method="post"  class="login-form">
    <h1>student Login</h1>
      
        <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="input-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" required>
        </div>

        <div class="input-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" required>
        </div>

        <div class="input-group">
            <label for="dateofbirth">Date of Birth</label>
            <input type="date" name="dateofbirth" id="dateofbirth" required>
        </div>

        <div class="input-group">

            <label for="gender">gender</label>
        <select name="gender" id="gender" required>
            <option value="">-- Select gender --</option>
            <option value="male">male</option>
            <option value="female">female</option>
            <option value="others">other</option>
        </select>
        </div>
            
        <button type="submit">Submit</button>
        <p class="create-account-link">already have an account? <a href="hostlogin.html">login</a></p>
    </form>
   
</div>
</body>
</html>