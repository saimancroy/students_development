<?php
     session_start();
	require '../../database.php';
    
     if ( !empty($_POST)) {
        // keep track validation errors
        $user_nameError = null;
        $user_passwordError = null;
        
        // keep track post values
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_passwordHash = sha1($user_password);
        
        
        // validate input
        $valid = true;
        if (empty($user_name)) {
            $user_nameError = 'Въведете име';
            $valid = false;
        }
        
        $valid = true;
        if (empty($user_password)) {
            $user_passwordError = 'Въведете парола';
            $valid = false;
        }
        
        if ($valid) {
			
				
			$pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql=("SELECT user_name, user_password, is_admin FROM users WHERE user_name= :hjhjhjh AND user_password= :asas LIMIT 1");
            $q = $pdo->prepare($sql);
			$q->bindParam(':hjhjhjh', $user_name);
			$q->bindParam(':asas', $user_passwordHash);
			$q->execute();
			$row = $q->fetch(PDO::FETCH_OBJ);
			//var_dump($row);die;
			if($row) {
				//var_dump($row->is_admin); die;
				
									
				if(!isset($_SESSION['user_name'])){
				$_SESSION['user_name']=$user_name;}								
				if(!isset($_SESSION['is_admin'])){					
				$_SESSION['is_admin']=strval($row->is_admin);}
					header("location: /students_development2/index.php");
				
				
							
			}			
			else{
 				$user_nameError = 'Потребителското име и паролата не са намерени';
				$user_name = $_POST['user_name'];
				$user_password = $_POST['user_password'];	
				}
			
			}
	}
                        
 ?>
 <!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>
 <body>
	 <div class="container">
			
				<div class="span10 offset1">
                    <div class="row">
                        <h3>Логин</h3>
                    </div>
             
                    <form class="form-horizontal" action="login.php" method="post">
                      <div class="control-group <?php echo !empty($user_nameError)?'error':'';?>">
                        <label class="control-label">Потребителско име</label>
                        <div class="controls">
                            <input name="user_name" type="text"  placeholder="Потребителско име" value="<?php echo !empty($user_name)?$user_name:'';?>">
                            <?php if (!empty($user_nameError)): ?>
                                <span class="help-inline"><?php echo $user_nameError;?></span>
                            <?php endif; ?>
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
                          <button type="submit" class="btn btn-success">Готово</button>
                          <a class="btn" href="register.php">Регистрация</a>
                        </div>
                    </form>
                </div>
                   
    </div> <!-- /container -->
 
</body>
</html>      

