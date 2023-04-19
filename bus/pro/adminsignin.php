<?php
session_start();
require_once '../conn.php';
$file = "admin";

?>
<?php
$cur_page = 'signup';
include 'includes/inc-header.php';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!isset($email, $password)) {
?>
<script>
alert("Ensure you fill the form properly.");
</script>
<?php
    } else {

        //Check for login
        $password = md5($password);
        $check = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $check->bind_param("ss", $email, $password);
        if (!$check->execute()) die("Form Filled With Error");
        $res = $check->get_result();
        $no_rows = $res->num_rows;
        if ($no_rows ==  1) {
            $row = $res->fetch_assoc();
            $id = $row['id'];
            session_regenerate_id(true);
            $_SESSION['category'] = "super";
            $_SESSION['admin'] = $id;

        ?>
<script>
alert("Access Granted!");
window.location = "admin.php";
</script>
<?php

        } else { ?>
<script>
alert("Access Denied.");
</script>
<?php
        }
    }
}
?>
<div class="container">
    <div class="form">
        <h2 class="signIn">Admin Sign In</h2>
        
        <form class="login-form" method="post" role="form" id="signup-form" autocomplete="off">
            <input type="email" required name="email" placeholder="EmailId">

            <input type="password" name="password" id="password" placeholder="Password">
            
            <button type="submit" id="btn-signup" onclick="submitForm()"> SIGN IN </button> 
        </form>
    </div>
</div>
</div>
<script src="assets/js/index.js"></script>

</body>

</html>