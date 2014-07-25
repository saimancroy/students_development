<?php 
	include("../../header.php");
    require '../../database.php';
    $subject_id = 0;
     
    if ( !empty($_GET['subject_id'])) {
        $subject_id = $_REQUEST['subject_id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $subject_id = $_POST['subject_id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM subjects  WHERE subject_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($subject_id));
        Database::disconnect();
        header("Location: subjects.php");
         
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
                        <h3>Изтрий дисциплина</h3>
                    </div>
                     
                    <form class="form-horizontal" action="subjects_delete.php" method="post">
                      <input type="hidden" name="subject_id" value="<?php echo $subject_id;?>"/>
                      <p class="alert alert-error">Сигурен ли сте, че искате да изтриете дисциплината ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Да</button>
                          <a class="btn" href="subjects.php">Не</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
