<?php include("../../header.php"); ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Потребители</h3>
            </div>
            <div class="row">
                <p>
                    <a href="users_add.php" class="btn btn-success">Създай</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Потребителско име</th>
                          <th>Име</th>
                          <th>Фамилия</th>
                          <th>E-mail</th>                          
                          <th>Парола</th>
                          <th>Операции</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include '../../database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM users ORDER BY user_id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['user_name'] . '</td>';
                                echo '<td>'. $row['user_fname'] . '</td>';
                                echo '<td>'. $row['user_lname'] . '</td>';
                                echo '<td>'. $row['user_email'] . '</td>';
                                echo '<td>'. $row['user_password'] . '</td>';
                                echo '<td width=250>';                                
                                echo '<a class="btn btn-success" href="users_edit.php?user_id='.$row['user_id'].'">Промени</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="users_delete.php?user_id='.$row['user_id'].'">Изтрий</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
