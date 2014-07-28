<?php include("header.php"); 

require 'database.php';



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
		<div class="row">
				<h3>Всичко в едно.</h3>
                <h2>Добре дошъл <?php echo $_SESSION['user_name']; ?> !</h2>

            </div>
            <div class="row">
				
				<?php
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$sql="SELECT speciality_name_long,speciality_id FROM specialities order by speciality_name_long"; 		
		echo "<select name=subject value=''>Име на специалност</option>";
		foreach ($pdo->query($sql) as $row){
		echo "<option value=$row[speciality_id]>$row[speciality_name_long]</option>"; 		
		}
		echo "</select>";
		foreach ($pdo->query($sql) as $row){
		if($row['speciality_id']==10){
		echo "<option value=$row[speciality_id] selected>$row[speciality_name_long]</option>"; 
		}else{
		echo "<option value=$row[speciality_id]>$row[speciality_name_long]</option>"; 
		}
		}
		echo "</select>";
		
		
		$sql="SELECT course_name,course_id FROM courses order by course_id"; 
		echo "<select name=course value=''>Име на Курс</option>";
		foreach ($pdo->query($sql) as $row){
		echo "<option value=$row[course_id]>$row[course_name]</option>"; 		
		}
		echo "</select>";
		foreach ($pdo->query($sql) as $row){
		if($row['course_id']==10){
		echo "<option value=$row[course_id] selected>$row[course_name]</option>"; 
		}else{
		echo "<option value=$row[course_id]>$row[course_name]</option>"; 
		}
		}
		echo "</select>";


		 ?>                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <th colspan="2">Студенти</th>
                        <th colspan="3">Математика</th>
                        <th colspan="3">Информатика</th>
                        <th colspan="3">Физика</th>
                        <th colspan="3">Общо</th>
							<tr>
								<td>Име, Фамилия</td>
								<td>Курс</td>																							
								<td>Лекции</td>
								<td>Упражнения</td>																
								<td>Оценка</td>
								<td>Лекции</td>
								<td>Упражнения</td>																
								<td>Оценка</td>
								<td>Лекции</td>
								<td>Упражнения</td>																
								<td>Оценка</td>
								<td>Ср.успех</td>
								<td>Лекции</td>
								<td>Упражнения</td>																															
							</tr>													
                      </thead>
                      <tbody>
						  <?php
							$pdo = Database::connect();							
							$sql = 'SELECT students.student_fname, students.student_lname, students.student_fnumber, courses.course_name, students.student_course_id, courses.course_id, speciality_name_short, students.student_education_form, students_assessments.sa_subject_id, subjects.subject_id
									FROM students
									
									LEFT JOIN courses
									ON students.student_course_id = courses.course_id
									
									LEFT JOIN students_assessments									
									ON students.student_id = students_assessments.sa_student_id
									
									LEFT JOIN specialities
									ON students.student_speciality_id=specialities.speciality_id
									
									LEFT JOIN subjects
									ON students_assessments.sa_subject_id=subjects.subject_id';
								foreach ($pdo->query($sql) as $row) {
								echo '<tr>';
                                echo '<td>'. $row['student_fname'] . " " . $row['student_lname'] . " " . "(" . $row['student_fnumber'] . ")" . '</td>';							                            
                                echo '<td>'. $row['course_name'] . ", " . $row['speciality_name_short'] . " (" . $row['student_education_form'] . ")" . '</td>';
                                echo '<td>'. $row['student_fname'] . '</td>';		
                                echo '</td>';
                                echo '</tr>'; 
							}                              
						  ?>
</body>
</html>
