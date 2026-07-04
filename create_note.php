<?php

require 'includes/auth.php';
require 'includes/db.php';
require 'includes/functions.php';
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = sanitize($_POST['title']);
    $content = sanitize($_POST['content']);

    if(empty($title) || empty($content)){
        $error = 'All fields are required';
    }else{
        $stmt = $db->prepare('INSERT INTO notes (user_id, title, content) VALUES (?,?,?);');
        $stmt->execute([$_SESSION['user_id'], $title, $content]);

        header('Location: dashboard.php');
        exit();
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body style="background-color: aqua;">
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Create Note</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group" style="color: red;">
                            <h4><?php echo $error; ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" placeholder="Write your note..." required style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Save Note</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>