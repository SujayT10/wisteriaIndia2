<?php
include_once("database.php");
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);

    $name = trim($request->name);
    $lastname = trim($request->lastname);
    $pwd = mysqli_real_escape_string($mysqli, trim($request->pwd));
    $email = mysqli_real_escape_string($mysqli, trim($request->email));
    $contactno = $request->contactno;

    $sql = "INSERT INTO users(name,lastname,password,email,contactno)
                             VALUES ('$name','$lastname','$pwd','$email','$contactno')";

    if ($mysqli->query($sql) === TRUE) {
        $authdata = [
                    'name' => $name,
                    'lastname' => $lastname,
                    'pwd' => '',
                    'email' => $email,
                    'contactno' => $contactno,
                    'Id' => mysqli_insert_id($mysqli)
                   ];

         echo json_encode($authdata);
    }
}

?>
