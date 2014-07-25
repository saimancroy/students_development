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
                <h3>Дисциплини</h3>
            </div>
            <div class="row">
                <p>
                    <a href="specialities_add.php" class="btn btn-success">Създай</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Пълно име</th>
                          <th>Абривиатура</th>                          
                          <th>Операции</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include '../../database.php';                       
                       $pdo = Database::connect();                       
                       $sql = 'SELECT * FROM specialities ORDER BY speciality_id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['speciality_name_long'] . '</td>';
                                echo '<td>'. $row['speciality_name_short'] . '</td>';                                
                                echo '<td width=250>';
                                echo '<a class="btn" href="specialities_read.php?speciality_id='.$row['speciality_id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="specialities_edit.php?speciality_id='.$row['speciality_id'].'">Промени</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="specialities_delete.php?speciality_id='.$row['speciality_id'].'">Изтрий</a>';
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
