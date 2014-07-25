<?php
	include("../../header.php");
    require '../../database.php';
    $speciality_id = 0;
     
    if ( !empty($_GET['speciality_id'])) {
        $speciality_id = $_REQUEST['speciality_id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $speciality_id = $_POST['speciality_id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM specialities  WHERE speciality_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($speciality_id));
        Database::disconnect();
        header("Location: specialities.php");
         
    }
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Изтрий специалност</h3>
                    </div>
                     
                    <form class="form-horizontal" action="specialities_delete.php" method="post">
                      <input type="hidden" name="speciality_id" value="<?php echo $speciality_id;?>"/>
                      <p class="alert alert-error">Сигурен ли сте, че искате да изтриете дисциплината ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Да</button>
                          <a class="btn" href="specialities.php">Не</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
