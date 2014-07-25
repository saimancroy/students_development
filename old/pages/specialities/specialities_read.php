<?php
	include("../../header.php");
    require '../../database.php';
    $speciality_id = null;
    if ( !empty($_GET['speciality_id'])) {
        $speciality_id = $_REQUEST['speciality_id'];
    }
     
    if ( null==$speciality_id ) {
        header("Location: specialities.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM specialities where speciality_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($speciality_id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Разгледай специалност</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Име на специалност</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['speciality_name_long'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Абривиатура</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['speciality_name_short'];?>
                            </label>
                        </div>
                      </div>                      
                        <div class="form-actions">
                          <a class="btn" href="specialities.php">Назад</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div>
  </body>
</html>
