<?php
	include("../../header.php");
    require '../../database.php';
    $course_id = 0;
     
    if ( !empty($_GET['course_id'])) {
        $course_id = $_REQUEST['course_id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $course_id = $_POST['course_id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM courses  WHERE course_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($course_id));
        Database::disconnect();
        header("Location: courses.php");
         
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
                        <h3>Изтрий курс</h3>
                    </div>
                     
                    <form class="form-horizontal" action="courses_delete.php" method="post">
                      <input type="hidden" name="course_id" value="<?php echo $course_id;?>"/>
                      <p class="alert alert-error">Сигурен ли сте, че искате да изтриете курса ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Да</button>
                          <a class="btn" href="courses.php">Не</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
