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
                    window.location.href = 'studentlogin1.php';
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
/*   /* Base CSS */
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
            height: auto;
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
            /* margin-bottom: 1em; */
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
            font-size:12.5px;
        }
        .input-group {
            margin-bottom: 1em;
            align-items: center;
            

        }

        .input-group label {
            display: block;
            margin-bottom: 0.5em;
        }

        .input-group input {
            width:350px;
            /* margin-top:40px; */
            padding: 5px;
            border-radius:24px;
            background-color: black;
            border: 0.5px solid rgba(255, 255, 255, 0.875);
            color: white;
            font-size: 16px;
            font-size: 1em;
        }

        .input-group input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
        }

        .button-group {
            text-align: center;
        }

        #button {
            padding: 0.7em 1.5em;
            border: none;
            border-radius: 24px;
            background: rgba(0, 0, 0, 0.30);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        
            color: white;
            margin-top: 20px;
            width: 200px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.2s ease-in-out;
        }

        #button:hover {
            background:rgba(31, 38, 135, 0.37);
        } 
        p{
            margin-top: 40px;
        } 
        #gender
        {
            padding: 0.7em 1.5em;
            border: none;
            border-radius: 24px;
            background: rgba(0, 0, 0, 0.30);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        
            color: white;
            /* margin-top: 30px; */
            width: 250px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.2s ease-in-out;
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
<body>
<div id="image-comtainer">
        <img src="login-pic.svg" alt="" >
    </div>
    <div id="form-container">



    <div class="card">
    
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
            
        <button type="submit" id="button">Submit</button>
        <p class="create-account-link">already have an account? <a href="studentlogin1.php">login</a></p>
    </form>
   
</div>

</div>
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