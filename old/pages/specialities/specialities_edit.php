<?php include("../../header.php"); ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>

<?php
    require '../../database.php';
 
    $speciality_id = null;
    if ( !empty($_GET['speciality_id'])) {
        $speciality_id = $_REQUEST['speciality_id'];
    }
     
    if ( null==$speciality_id ) {
        header("Location: specialities.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $speciality_name_longError = null;
        $speciality_name_shortError = null;
                 
        // keep track post values
        $speciality_name_long = $_POST['speciality_name_long'];
        $speciality_name_short = $_POST['speciality_name_short'];
              
        // validate input
        $valid = true;
        if (empty($speciality_name_long)) {
            $speciality_name_longError = 'Въведете име на специалност';
            $valid = false;
        }

        $valid = true;
        if (empty($speciality_name_short)) {
            $sspeciality_name_shortError = 'Въведете абривиатура';
        };
               
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE specialities  set speciality_name_long = ?, speciality_name_short = ? WHERE speciality_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($speciality_name_long,$speciality_name_short,$speciality_id));
            Database::disconnect();
            header("Location: speciality_id.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM specialities where speciality_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($speciality_id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $speciality_name_long = $data['speciality_name_long'];
        $speciality_name_short = $data['speciality_name_short'];       
        Database::disconnect();
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Промяна на специалност</h3>
                    </div>
             
                    <form class="form-horizontal" action="specialities_edit.php?speciality_id=<?php echo $speciality_id?>" method="post">
                      <div class="control-group <?php echo !empty($speciality_name_longError)?'error':'';?>">
                        <label class="control-label">Име на специалност</label>
                        <div class="controls">
                            <input name="speciality_name_long" type="text"  placeholder="Име на специалност" value="<?php echo !empty($speciality_name_long)?$speciality_name_long:'';?>">
                            <?php if (!empty($speciality_name_longError)): ?>
                                <span class="help-inline"><?php echo $speciality_name_longError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($speciality_name_shortError)?'error':'';?>">
                        <label class="control-label">Абривиатура</label>
                        <div class="controls">
                            <input name="speciality_name_short" type="text"  placeholder="Абривиатура" value="<?php echo !empty($speciality_name_short)?$speciality_name_short:'';?>">
                            <?php if (!empty($speciality_name_shortError)): ?>
                                <span class="help-inline"><?php echo $speciality_name_shortError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Редактирай</button>
                          <a class="btn" href="specialities.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
