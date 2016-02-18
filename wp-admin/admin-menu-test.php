
<?php
echo $_POST['username'];
$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo("$email is a valid email address");
} else {
    echo("$email is not a valid email address");
}
//
//if (!filter_var($int, FILTER_VALIDATE_INT) === false) {
//    echo("Variable is an integer");
//} else {
//    echo("Variable is not an integer");
//}
?>
