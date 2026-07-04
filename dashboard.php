<?php

require 'includes/auth.php';
require 'includes/db.php';
require 'includes/functions.php';
$user_id = $_SESSION['user_id'];

$stmt = $db->prepare('SELECT * FROM notes WHERE user_id = ? ORDER BY created_at DESC');

$stmt->execute([$user_id]);

$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
        <div class="top-bar" style="display: flex; justify-content: space-between; align-items: center; background-color: aqua;">
            <h1>Weclome, <?php echo $_SESSION['username']; ?>
                <a href="create_note.php" class="btn btn-success">Create Note</a>
            </h1>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <div class='container'>
            <?php foreach($notes as $note): ?>
            <div class="card mt-5">
                <div class="card-header">
                    <h3><?php echo sanitize($note['title']); ?></h3>
                    <br>
                    <h6>"Created at: "<?php echo sanitize($note['created_at']); ?></h6>
                </div>
                <div class="card-body">
                    <p>
                        <?php echo nl2br(htmlspecialchars($note['content'])); ?>
                    </p>
                    <a href="edit_note.php?id=<?php echo $note['id']; ?>" class="btn btn-info mt-2">Edit</a>
                    <br>
                    <a href="delete_note.php?id=<?php echo $note['id']; ?>" class="btn btn-danger mt-2">Delete</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
