<?php
	include("../../header.php");
    require '../../database.php';
    $user_id = 0;
     
    if ( !empty($_GET['user_id'])) {
        $user_id = $_REQUEST['user_id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $user_id = $_POST['user_id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM users  WHERE user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_id));
        Database::disconnect();
        header("Location: users.php");
         
    }
?>
 
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Изтриване на потребител</h3>
                    </div>
                     
                    <form class="form-horizontal" action="users_delete.php" method="post">
                      <input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
                      <p class="alert alert-error">Сигурен ли сте, че искате да изтриете потребителя ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Да</button>
                          <a class="btn" href="users.php">Не</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
