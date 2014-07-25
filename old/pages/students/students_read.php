<?php
	include("../../header.php");
    require '../../database.php';
    $student_id = null;
    if ( !empty($_GET['student_id'])) {
        $student_id = $_REQUEST['student_id'];
    }
     
    if ( null==$student_id ) {
        header("Location: students.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM students where student_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($student_id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
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
                        <h3>Разгледай студент</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Име</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['student_fname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Фамилия</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['student_lname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Електронен адрес</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['student_email'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Факултетен номер</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['student_fnumber'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="students.php">Назад</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div>
  </body>
</html>
