<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>

<?php
     
    require '../../database.php';
 
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
        $user_passwordHash = sha1($_POST['user_password']);
        
         
        // validate input
        $valid = true;
        if (empty($user_name)) {
            $user_nameError = 'Въведете потребителско име';
            $valid = false;
        }
        
        if (empty($user_fname)) {
            $user_fnameError = 'Въведете име';
            $valid = false;
        }
         
        if (empty($user_lname)) {
            $user_lnameError = 'Въведете фамилия';
            $valid = false;
        } 
        
        if (empty($user_email)) {
            $user_emailError = 'Въведете електронен адрес';
            $valid = false;
        } else if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'ВЪведете валиден електронен адрес';
            $valid = false;
        }
        
        if (empty($user_password)) {
            $user_passwordError = 'Въведете парола';
            $valid = false;
        } 
               
         
        // insert data
        if ($valid) {
			
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "INSERT INTO users (user_name,user_fname,user_lname, user_email, user_password) values(?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($user_name,$user_fname,$user_lname, $user_email, $user_passwordHash));
            Database::disconnect();
            header("Location: register.php");            
        }
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Регистрация</h3>
                    </div>
             
                    <form class="form-horizontal" action="register.php" method="post">
                      <div class="control-group <?php echo !empty($user_nameError)?'error':'';?>">
                        <label class="control-label">Потребителско име</label>
                        <div class="controls">
                            <input name="user_name" type="text"  placeholder="Потребителско име" value="<?php echo !empty($user_name)?$user_name:'';?>">
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
                        <label class="control-label">Електронна поща</label>
                        <div class="controls">
                            <input name="user_email" type="text"  placeholder="Електронна поща" value="<?php echo !empty($user_email)?$user_email:'';?>">
                            <?php if (!empty($user_emailError)): ?>
                                <span class="help-inline"><?php echo $user_emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>       
                      <div class="control-group <?php echo !empty($user_passwordError)?'error':'';?>">
                        <label class="control-label">Парола</label>
                        <div class="controls">
                            <input name="user_password" type="password"  placeholder="Парола" value="<?php echo !empty($user_password)?$user_password:'';?>">
                            <?php if (!empty($user_passwordError)): ?>
                                <span class="help-inline"><?php echo $user_passwordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>                     
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Създай</button>
                          <a class="btn" href="login.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
