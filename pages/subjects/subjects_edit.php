<?php include("../../header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>

<?php
    require '../../database.php';
 
    $subject_id = null;
    if ( !empty($_GET['subject_id'])) {
        $subject_id = $_REQUEST['subject_id'];
    }
     
    if ( null==$subject_id ) {
        header("Location: subjects.php");
    }
     
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
            $subject_nameError = 'Въведете име';
            $valid = false;
        }
        
        $valid = true;
        if (empty($subject_workload_lectures)) {
            $subject_workload_lecturesError = 'Въведете брой лекции';
            $valid = false;
        }

        $valid = true;
        if (empty($subject_workload_exercises)) {
            $subject_workload_exercisesError = 'Въведете брой упражнения';
        }
                 
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE subjects  set subject_name = ?, subject_workload_lectures = ?, subject_workload_exercises = ? WHERE subject_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($subject_name,$subject_workload_lectures,$subject_workload_exercises,$subject_id));
            Database::disconnect();
            header("Location: subjects.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM subjects where subject_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($subject_id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $subject_name = $data['subject_name'];
        $subject_workload_lectures = $data['subject_workload_lectures'];
        $subject_workload_exercises = $data['subject_workload_exercises'];        
        Database::disconnect();
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Промяна на дисциплина</h3>
                    </div>
             
                    <form class="form-horizontal" action="subjects_edit.php?subject_id=<?php echo $subject_id?>" method="post">
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
                          <button type="submit" class="btn btn-success">Редактирай</button>
                          <a class="btn" href="subjects.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
