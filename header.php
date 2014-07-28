<?php session_start();
	 if(!isset($_SESSION["user_name"])) {
			header('Location: /students_development2/pages/login/login.php');
		}
?>


<!DOCTYPE HTML>
<head>
  <meta charset="utf-8">
  <title>Студенти</title>
  <link href="/students_development2/css/bootstrap.css" rel="stylesheet">
  <script src="/students_development2/js/bootstrap.min.js"></script>
</head>
<body>
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="/students_development2/index.php">Home</a></li>
  <li><a href="/students_development2/pages/students/students.php">Студенти</a></li>
  <li><a href="/students_development2/pages/courses/courses.php">Курсове</a></li>
  <li><a href="/students_development2/pages/specialities/specialities.php">Дисциплини</a></li>
  <li><a href="/students_development2/pages/subjects/subjects.php">Хорариум</a></li>
  <li><a href="/students_development2/pages/users/users.php">Потребители</a></li>
  <li><a>Username: <?php echo $_SESSION["user_name"] ?> </a><li>
  <li><a href="/students_development2/pages/login/logout.php">Logout</a></li>
</ul>


