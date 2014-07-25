<?php include("../../header.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>

<?php
     
    require '../../database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $course_nameError = null;        
         
        // keep track post values
        $course_name = $_POST['course_name'];        
         
        // validate input
        $valid = true;
        if (empty($course_name)) {
            $course_nameError = 'Въведете име на курс';
            $valid = false;
        }
       
                
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO courses (course_name) values(?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($course_name));
            Database::disconnect();
            header("Location: courses.php");
        }
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Добавяне на курс</h3>
                    </div>
             
                    <form class="form-horizontal" action="courses_add.php" method="post">
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
                          <button type="submit" class="btn btn-success">Създай</button>
                          <a class="btn" href="courses.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
