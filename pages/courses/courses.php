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
                <h3>Курсове</h3>
            </div>
            <div class="row">
                <p>
                    <a href="courses_add.php" class="btn btn-success">Създай</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Име</th>                                              
                          <th>Операции</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include '../../database.php';                       
                       $pdo = Database::connect();                       
                       $sql = 'SELECT * FROM courses ORDER BY course_id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['course_name'] . '</td>';                                                     
                                echo '<td width=250>';
                                echo '<a class="btn" href="courses_read.php?course_id='.$row['course_id'].'">Read</a>';
                                echo ' ';
                                if($_SESSION['is_admin']=1) {
                                echo '<a class="btn btn-success" href="courses_edit.php?course_id='.$row['course_id'].'">Промени</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="courses_delete.php?course_id='.$row['course_id'].'">Изтрий</a>';
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
