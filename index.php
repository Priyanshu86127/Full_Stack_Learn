<?php
session_start();
$errors = [
    'login'    => $_SESSION['login_error']    ?? '',
    'register' => $_SESSION['register_error'] ?? '',
];
$activeForm = $_SESSION['active_form'] ?? 'login';
session_unset();

function showError($e) {
    return $e !== '' ? "<p class='error-message'>$e</p>" : '';
}

function isActiveForm($name, $active) {
    return $name === $active ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="form-box <?=isActiveForm('login',$activeForm)?>" id="login-form">
            <form action="login_registernew.php" method="post">
                <h2>Login</h2>
                <?=showError($errors['login'])?>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? 
                   <a href="#" onclick="event.preventDefault(); showform('register-form');">
                     Register
                   </a>
                </p>
            </form>
        </div>

        <div class="form-box <?=isActiveForm('register',$activeForm)?>" id="register-form">
            <form action="login_registernew.php" method="post">
                <h2>Register</h2>
                <?=showError($errors['register'])?>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <label for="role" class="sr-only">Role</label>
                <select id="role" name="role" required>
                    <option value="">-- Select Role --</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account? 
                   <a href="#" onclick="event.preventDefault(); showform('login-form');">
                     Login
                   </a>
                </p>
            </form>
        </div>
    </div>
    <script src="assets/script.js"></script>
</body>
</html>
