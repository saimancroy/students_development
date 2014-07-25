<?php
	include("../../header.php");
    require '../../database.php';
    $subject_id = null;
    if ( !empty($_GET['subject_id'])) {
        $subject_id = $_REQUEST['subject_id'];
    }
     
    if ( null==$subject_id ) {
        header("Location: subjects.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM subjects where subject_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($subject_id));
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
                        <h3>Разгледай дисциплина</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Име</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['subject_name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Хорариум (Л)</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['subject_workload_lectures'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Хорариум (У)</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['subject_workload_exercises'];?>
                            </label>
                        </div>
                      </div>                      
                        <div class="form-actions">
                          <a class="btn" href="subjects.php">Назад</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div>
  </body>
</html>
