<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
require_once 'confignew.php';

if (isset($_POST['register'])) {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'] ?? '';

    if ($role === '') {
        $_SESSION['register_error'] = 'Please select a role';
        $_SESSION['active_form']    = 'register';
        header('Location: index.php');
        exit;
    }

    $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered';
        $_SESSION['active_form']    = 'register';
    } else {
        $stmt = $conn->prepare(
            'INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)'
        );
        $stmt->bind_param('ssss', $name, $email, $password, $role);
        if (! $stmt->execute()) {
            die('Insert failed: ' . $stmt->error);
        }
        $_SESSION['active_form'] = 'login';
    }

    header('Location: index.php');
    exit;
}

if (isset($_POST['login'])) {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT name, email, password, role FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['name']  = $user['name'];
            $_SESSION['email'] = $user['email'];
            if ($user['role'] === 'admin') {
                header('Location: admin_page.php');
            } else {
                header('Location: user_page.php');
            }
            exit;
        }
    }

    $_SESSION['login_error']   = 'Incorrect email or password';
    $_SESSION['active_form']   = 'login';
    header('Location: index.php');
    exit;
}
