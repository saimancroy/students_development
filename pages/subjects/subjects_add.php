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
        $subject_nameError = null;
        $subject_workload_lecturesError = null;
        $subject_workload_exercisesError = null;       
         
        // keep track post values
        $subject_name = $_POST['subject_name'];
        $subject_workload_lectures = $_POST['subject_workload_lectures'];
        $subject_workload_exercises = $_POST['subject_workload_exercises'];        
         
        // validate input
        $valid = true;
        if (empty($subject_name)) {
            $subject_nameError = 'Въведете име на дисциплината';
            $valid = false;
        }

        $valid = tude;
        if (empty($subject_workload_lectures)) {
            $subject_workload_lecturesError = 'Въведете брой на лекции';
            $valid = false;
        }
         
        if (empty($subject_workload_exercises)) {
            $subject_workload_exercises = 'Въведете брой на упражнения';
            $valid = false;
        } 
                
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO subjects (subject_name,subject_workload_lectures,subject_workload_exercises) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($subject_name,$subject_workload_lectures,$subject_workload_exercises));
            Database::disconnect();
            header("Location: subjects.php");
        }
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Добавяне на дисциплина</h3>
                    </div>
             
                    <form class="form-horizontal" action="subjects_add.php" method="post">
                      <div class="control-group <?php echo !empty($subject_nameError)?'error':'';?>">
                        <label class="control-label">Име</label>
                        <div class="controls">
                            <input name="subject_name" type="text"  placeholder="Име" value="<?php echo !empty($subject_name)?$subject_name:'';?>">
                            <?php if (!empty($subject_nameError)): ?>
                                <span class="help-inline"><?php echo $subject_nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($subject_workload_lecturesError)?'error':'';?>">
                        <label class="control-label">Хорариум (Л)</label>
                        <div class="controls">
                            <input name="subject_workload_lectures" type="text"  placeholder="Хорариум (Л)" value="<?php echo !empty($subject_workload_lectures)?$subject_workload_lectures:'';?>">
                            <?php if (!empty($subject_workload_lecturesError)): ?>
                                <span class="help-inline"><?php echo $subject_workload_lecturesError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($subject_workload_exercisesError)?'error':'';?>">
                        <label class="control-label">Хорариум (У)</label>
                        <div class="controls">
                            <input name="subject_workload_exercises" type="text" placeholder="Хорариум (У)" value="<?php echo !empty($subject_workload_exercises)?$subject_workload_exercises:'';?>">
                            <?php if (!empty($subject_workload_exercisesError)): ?>
                                <span class="help-inline"><?php echo $subject_workload_exercisesError;?></span>
                            <?php endif;?>
                        </div>
                      </div>                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Създай</button>
                          <a class="btn" href="subjects.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
