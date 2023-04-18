<?php
session_start();
require_once '../conn.php';
$class = "signin";

?>
<?php
$cur_page = 'signup';
include 'includes/inc-header.php';
include 'includes/inc-nav.php';
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
        $check = $conn->prepare("SELECT * FROM passenger WHERE email = ? AND password = ?");
        $check->bind_param("ss", $email, $password);
        if (!$check->execute()) die("Form Filled With Error");
        $res = $check->get_result();
        $no_rows = $res->num_rows;
        if ($no_rows ==  1) {
            $row = $res->fetch_assoc();
            $id = $row['id'];
            $status = $row['status'];
            if ($status != 1) {
        ?>
<script>
alert("Account Deactivated!\nContact The System Administrator!");
window.location = "signin.php";
</script>
<?php
                exit;
            }
            session_regenerate_id(true);
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;

            ?>
<script>
alert("Access Granted!");
window.location = "individual.php";
</script>
<?php
            exit;
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
    <h1 class="signup">Sign In</h1>
        <form class="login-form" method="post" role="form" id="signup-form" autocomplete="off">
            <input type="email" required name="email" placeholder="EmailId">
            <input type="password" name="password" id="password" placeholder="Password">
            <button type="submit" id="btn-signup" onclick="submitForm()"> SIGN IN </button>
        </form>
    </div>
</div>
</div>
<script src="assets/js/index.js"></script>
<script src="assets/js/sweetalert2.js"></script>
</body>

</html>