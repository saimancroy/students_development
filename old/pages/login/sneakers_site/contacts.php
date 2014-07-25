<?php include "inc-files/before_content.code"; ?>

<?php 
$action=$_REQUEST['action']; 
if ($action=="")    /* display the contact form */ 
    { 
    ?> 
    <form  action="" method="POST" enctype="multipart/form-data"> 
    <p align='center'>
    <input type="hidden" name="action" value="submit"> 
    Вашето име:<br> 
    <input name="name" type="text" value="" size="30"/><br> 
    Вашия email:<br> 
    <input name="email" type="text" value="" size="30"/><br> 
    Вашето съобщение:<br> 
    <textarea name="message" rows="7" cols="30"></textarea><br> 
    <input type="submit" value="Изпрати"/> 
    </form> 
    <?php 
    }  
else                /* send the submitted data */ 
    { 
    $name=$_REQUEST['name']; 
    $email=$_REQUEST['email']; 
    $message=$_REQUEST['message']; 
    if (($name=="")||($email=="")||($message=="")) 
        { 
        echo "Всички полета са нужни, моля попълнете ги <a href=\"\">the form</a> again."; 
        } 
    else{         
        $from="From: $name<$email>\r\nReturn-path: $email"; 
        $subject="Message sent using your contact form"; 
        mail("youremail@yoursite.com", $subject, $message, $from); 
        echo "Писмото е изпратено!"; 
        } 
    }   
?> 