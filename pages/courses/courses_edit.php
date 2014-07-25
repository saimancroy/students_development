<?php include("../../header.php"); ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>

<?php
    require '../../database.php';
 
    $course_id = null;
    if ( !empty($_GET['course_id'])) {
        $course_id = $_REQUEST['course_id'];
    }
     
    if ( null==$course_id ) {
        header("Location: courses.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $course_nameError = null;
                 
        // keep track post values
        $course_name = $_POST['course_name'];
        
        // validate input
        $valid = true;
        if (empty($course_name)) {
            $course_nameError = 'Въведете име';
            $valid = false;
        }
                                
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE courses  set course_name = ? WHERE cpurse_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($course_name,$course_id));
            Database::disconnect();
            header("Location: courses.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM courses where course_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($course_id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $course_name = $data['course_name'];               
        Database::disconnect();
    }
?>
 
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Промяна на курс</h3>
                    </div>                   
                      <form class="form-horizontal" action="courses_edit.php?course_id=<?php echo $course_id?>" method="post">
                      <div class="control-group <?php echo !empty($course_nameError)?'error':'';?>">
                        <label class="control-label">Име</label>
                        <div class="controls">
                            <input name="course_name" type="text"  placeholder="Име" value="<?php echo !empty($course_name)?$course_name:'';?>">
                            <?php if (!empty($course_nameError)): ?>
                                <span class="help-inline"><?php echo $course_nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>                                          
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Редактирай</button>
                          <a class="btn" href="courses.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
