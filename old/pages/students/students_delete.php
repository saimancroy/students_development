<?php include("../../header.php"); ?>
<?php
    require '../../database.php';
    $student_id = 0;
     
    if ( !empty($_GET['student_id'])) {
        $student_id = $_REQUEST['student_id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $student_id = $_POST['student_id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM students  WHERE student_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($student_id));
        Database::disconnect();
        header("Location: students.php");
         
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
                        <h3>Изтрий студент</h3>
                    </div>
                     
                    <form class="form-horizontal" action="students_delete.php" method="post">
                      <input type="hidden" name="student_id" value="<?php echo $student_id;?>"/>
                      <p class="alert alert-error">Сигурен ли сте, че искате да изтриете студента ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Да</button>
                          <a class="btn" href="students.php">Не</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
