<?php include("../../header.php"); ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>

<?php
    require '../../database.php';
 
    $student_id = null;
    if ( !empty($_GET['student_id'])) {
        $student_id = $_REQUEST['student_id'];
    }
     
    if ( null==$student_id ) {
        header("Location: students.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $student_fnameError = null;
        $student_lnameError = null;
        $student_emailError = null;
        $student_fnumberError = null;
         
        // keep track post values
        $student_fname = $_POST['student_fname'];
        $student_lname = $_POST['student_lname'];
        $student_email = $_POST['student_email'];
        $student_fnumber = $_POST['student_fnumber'];
         
        // validate input
        $valid = true;
        if (empty($student_fname)) {
            $student_fnameError = 'Въведете първо име';
            $valid = false;
        }

        $valid = true;
        if (empty($student_lname)) {
            $student_lnameError = 'Въведете фамилия';
        }

         
        if (empty($student_email)) {
            $student_emailError = 'Въведете електронен адрес';
            $valid = false;
        } else if ( !filter_var($student_email,FILTER_VALIDATE_EMAIL) ) {
            $student_emailError = 'Въведете валиден електронен адрес';
            $valid = false;
        }
        
        $valid = true;
        if (empty($student_fnumber)) {
            $student_fnumberError = 'Въведете факултетен номер';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE students  set student_fname = ?, student_lname = ?, student_email = ?, student_fnumber = ? WHERE student_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($student_fname,$student_lname,$student_email,$student_fnumber,$student_id));
            Database::disconnect();
            header("Location: students.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM students where student_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($student_id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $student_fname = $data['student_fname'];
        $student_lname = $data['student_lname'];
        $student_email = $data['student_email'];
        $student_fnumber = $data['student_fnumber'];
        Database::disconnect();
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Промяна на студент</h3>
                    </div>
             
                    <form class="form-horizontal" action="students_edit.php?student_id=<?php echo $student_id?>" method="post">
                      <div class="control-group <?php echo !empty($student_fnameError)?'error':'';?>">
                        <label class="control-label">Име</label>
                        <div class="controls">
                            <input name="student_fname" type="text"  placeholder="Име" value="<?php echo !empty($student_fname)?$student_fname:'';?>">
                            <?php if (!empty($student_fnameError)): ?>
                                <span class="help-inline"><?php echo $student_fnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($student_lnameError)?'error':'';?>">
                        <label class="control-label">Фамилия</label>
                        <div class="controls">
                            <input name="student_lname" type="text"  placeholder="Фамилия" value="<?php echo !empty($student_lname)?$student_lname:'';?>">
                            <?php if (!empty($student_lnameError)): ?>
                                <span class="help-inline"><?php echo $student_lnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($student_emailError)?'error':'';?>">
                        <label class="control-label">Електронна поща</label>
                        <div class="controls">
                            <input name="student_email" type="text" placeholder="Електронна поща" value="<?php echo !empty($student_email)?$student_email:'';?>">
                            <?php if (!empty($student_emailError)): ?>
                                <span class="help-inline"><?php echo $student_emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($student_fnumberError)?'error':'';?>">
                        <label class="control-label">Факултетен номер</label>
                        <div class="controls">
                            <input name="student_fnumber" type="text"  placeholder="Факултетен номер" value="<?php echo !empty($student_fnumber)?$student_fnumber:'';?>">
                            <?php if (!empty($student_fnumberError)): ?>
                                <span class="help-inline"><?php echo $student_fnumberError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Редактирай</button>
                          <a class="btn" href="students.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
