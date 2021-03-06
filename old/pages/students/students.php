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
                <h3>Студенти</h3>
            </div>
            <div class="row">
                <p>
                    <a href="students_add.php" class="btn btn-success">Създай</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Име</th>
                          <th>Фамилия</th>
                          <th>Електронен адрес</th>
                          <th>Факултетен номер</th>
                          <th>Операции</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include '../../database.php';                       
                       $pdo = Database::connect();                       
                       $sql = 'SELECT * FROM students ORDER BY student_id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['student_fname'] . '</td>';
                                echo '<td>'. $row['student_lname'] . '</td>';
                                echo '<td>'. $row['student_email'] . '</td>';
                                echo '<td>'. $row['student_fnumber'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="students_read.php?student_id='.$row['student_id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="students_edit.php?student_id='.$row['student_id'].'">Промени</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="students_delete.php?student_id='.$row['student_id'].'">Изтрий</a>';
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
