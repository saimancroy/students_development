<?php
	include("../../header.php");
    require '../../database.php';
    $course_id = null;
    if ( !empty($_GET['course_id'])) {
        $course_id = $_REQUEST['course_id'];
    }
     
    if ( null==$course_id ) {
        header("Location: courses.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM courses where course_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($course_id));
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
                        <h3>Разгледай курс</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Име</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['course_name'];?>
                            </label>
                        </div>
                      </div>                      
                        <div class="form-actions">
                          <a class="btn" href="courses.php">Назад</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div>
  </body>
</html>
