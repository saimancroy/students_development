<?php include("../../header.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Хорариум</h3>
            </div>
            <div class="row">
                <p>
                    <a href="subjects_add.php" class="btn btn-success">Създай</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Име</th>
                          <th>Хорариум (Л)</th>
                          <th>Хорариум (У)</th>                          
                          <th>Операции</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include '../../database.php';                       
                       $pdo = Database::connect();                       
                       $sql = 'SELECT * FROM subjects ORDER BY subject_id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['subject_name'] . '</td>';
                                echo '<td>'. $row['subject_workload_lectures'] . '</td>';
                                echo '<td>'. $row['subject_workload_exercises'] . '</td>';                                
                                echo '<td width=250>';
                                echo '<a class="btn" href="subjects_read.php?subject_id='.$row['subject_id'].'">Read</a>';
                                echo ' ';
                                if($_SESSION['is_admin']=0) {
                                echo '<a class="btn btn-success" href="subjects_edit.php?subject_id='.$row['subject_id'].'">Промени</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="subjects_delete.php?subject_id='.$row['subject_id'].'">Изтрий</a>';
							}
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div>
    </div> 
  </body>
</html>
