<?php
session_start();
include("./../Db.php");

Db::connect('localhost', 'articles', 'root', '');

if ($_POST) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    Db::insert('users', [
        'email' => $_POST['email'],
        'name' => $_POST['name'],
        'password' => $password
    ]);

    $_SESSION['user_id'] = Db::getLastId();

    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Comic+Sans+MS:wght@400;600&display=swap">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Comic Sans MS', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #1e1e2f;
            color: #fff;
        }

        .container {
            background: #2a2a3d;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        label {
            font-size: 0.9rem;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #3a3a4f;
            color: #fff;
            outline: none;
        }

        input:focus {
            border: 2px solid #6c63ff;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #6c63ff;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #5750d6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Create an Account</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>

</html>