<?php

session_start();
require 'includes/db.php';
require 'includes/functions.php';
$errors = [];

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    if(empty($username)){
        $errors[] = "Username is required";
    }
    if(!validateEmail($email)){
        $errors[] = "Invalid email";
    }
    if(!validatePassword($password)){
        $errors[] = "Password must be at least 6 characters";
    }

    if(empty($errors)){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");

        try{
            $stmt->execute([$username, $email, $hashedPassword]);
            header("Location:  login.php");
            exit();
        }catch(PDOException $e){
            $errors[] = "Username or Email already exists";
        }
    }
}

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body style="background-color: aqua;">
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Register</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group" style="color: red;">
                            <?php foreach($errors as $error): ?>
                                <h4><?php echo $error; ?></h4>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="username" name="username" id="username" placeholder="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="example@gmail.com" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" name="password" id="password" placeholder="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info mt-2">Register</button>
                        </div>
                    </form>
                    <h4>Already have an account?</h4>
                    <h4><a href="login.php">Login</a></h4>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>