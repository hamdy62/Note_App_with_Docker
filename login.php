<?php

session_start();
require 'includes/db.php';
require 'includes/functions.php';

$error = '';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");

    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    }else{
        $error = "Invalid email or password!";
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body style="background-color: aqua;">
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group" style="color: red;">
                            <h4><?php echo $error; ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="exampl@gmail.com" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" name="password" id="password" placeholder="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info mt-2">Login</button>
                        </div>
                    </form>
                    <h4>Do not have account? <a href="register.php">Create account</a></h4>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>