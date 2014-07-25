<?php include("../../header.php"); ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>

<?php
    require '../../database.php';
 
    $user_id = null;
    if ( !empty($_GET['user_id'])) {
        $user_id = $_REQUEST['user_id'];
    }
     
    if ( null==$user_id ) {
        header("Location: users.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $user_nameError = null;
        $user_fnameError = null;
        $user_lnameError = null;
        $user_emailError = null;
        $user_passwordError = null;
         
        // keep track post values
        $user_name = $_POST['user_name'];
        $user_fname = $_POST['user_fname'];
        $user_lname = $_POST['user_lname'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
         
        // validate input
        $valid = true;
        if (empty($user_name)) {
            $user_nameError = 'Въведете потребителско име';
            $valid = false;
        }
        
        $valid = true;
        if (empty($user_fname)) {
            $user_fnameError = 'Въведете име';
            $valid = false;
        }
        
        $valid = true; 
        if (empty($user_lname)) {
            $user_lnameError = 'Въведете фамилия';
            $valid = false;
        } 
        
        $valid = true;
        if (empty($user_email)) {
            $user_emailError = 'Въведете електронен адрес';
            $valid = false;
        } else if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'ВЪведете валиден електронен адрес';
            $valid = false;
        }
        
        $valid = true;
        if (empty($user_password)) {
            $user_passwordError = 'Въведете парола';
            $valid = false;
        } 
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (user_name,user_fname,user_lname, user_email, user_password) values(?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($user_name,$user_fname,$user_lname, $user_email, $user_password));
            Database::disconnect();
            header("Location: register.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users where user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $user_name = $data['user_name'];
        $user_fname = $data['user_fname'];
        $user_lname = $data['user_lname'];
        $user_email = $data['user_email'];
        $user_password = $data['user_password'];        
        Database::disconnect();
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Промяна на потребител</h3>
                    </div>
             
                    <form class="form-horizontal" action="users_edit.php?id=<?php echo $user_id?>" method="post">
                      <div class="control-group <?php echo !empty($user_nameError)?'error':'';?>">
                        <label class="control-label">Потребителско име</label>
                        <div class="controls">
                            <input name="user_password" type="text"  placeholder="Потребителско име" value="<?php echo !empty($user_name)?$user_name:'';?>">
                            <?php if (!empty($user_nameError)): ?>
                                <span class="help-inline"><?php echo $user_nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($user_fnameError)?'error':'';?>">
                        <label class="control-label">Име</label>
                        <div class="controls">
                            <input name="user_fname" type="text" placeholder="Име" value="<?php echo !empty($user_fname)?$user_fname:'';?>">
                            <?php if (!empty($user_fnameError)): ?>
                                <span class="help-inline"><?php echo $user_fnameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($user_lnameError)?'error':'';?>">
                        <label class="control-label">Фамилия</label>
                        <div class="controls">
                            <input name="user_lname" type="text"  placeholder="Фамилия" value="<?php echo !empty($user_lname)?$user_lname:'';?>">
                            <?php if (!empty($user_lnameError)): ?>
                                <span class="help-inline"><?php echo $user_lnameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($user_emailError)?'error':'';?>">
                        <label class="control-label">Електронен адрес</label>
                        <div class="controls">
                            <input name="user_email" type="text"  placeholder="Електронен адрес" value="<?php echo !empty($user_email)?$user_email:'';?>">
                            <?php if (!empty($user_emailError)): ?>
                                <span class="help-inline"><?php echo $user_emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($user_passwordError)?'error':'';?>">
                        <label class="control-label">Парола</label>
                        <div class="controls">
                            <input name="user_password" type="text"  placeholder="Парола" value="<?php echo !empty($user_password)?$user_password:'';?>">
                            <?php if (!empty($user_passwordError)): ?>
                                <span class="help-inline"><?php echo $user_passwordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Промяна</button>
                          <a class="btn" href="users.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
