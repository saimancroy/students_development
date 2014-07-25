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
            $student_fnameError = 'Въведете име';
            $valid = false;
        }

        $valid = true;
        if (empty($student_lname)) {
            $student_lnameError = 'Въведете фамилия';
            $valid = false;
        }
         
        if (empty($student_email)) {
            $student_emailError = 'Въведете електронен адрес';
            $valid = false;
        } else if ( !filter_var($student_email,FILTER_VALIDATE_EMAIL) ) {
            $student_emailError = 'Въведете реален електронен адрес';
            $valid = false;
        }
         
        $valid = true;
        if (empty($student_fnumber)) {
            $student_fnumberError = 'Въведете факултетен номер';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO students (student_fname,student_lname,student_email,student_fnumber) values(?, ?, ?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($student_fname,$student_lname,$student_email,$student_fnumber));
            Database::disconnect();
            header("Location: students.php");
        }
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Създайте нов студент</h3>
                    </div>
             
                    <form class="form-horizontal" action="students_add.php" method="post">
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
                        <label class="control-label">Електронен адрес</label>
                        <div class="controls">
                            <input name="student_email" type="text" placeholder="Електронен адрес" value="<?php echo !empty($student_email)?$student_email:'';?>">
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
                          <button type="submit" class="btn btn-success">Създай</button>
                          <a class="btn" href="students.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
