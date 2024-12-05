<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Group work</title>
  <link rel="stylesheet" href="form.css">
</head>

<body>
  <?php
  print_r($_POST);
  ?>
  <div class="alert" id="alert-bad">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" height="1.2rem"
      width="1.2rem"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
      <path
        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L23</div>7.3 256 342.6 150.6z" />
    </svg>
    <span id="alert-bad-text"></span>
  </div>
  <div class="alert" id="alert-ok">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="1.2rem"
      width="1.2rem"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
      <path
        d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
    </svg>
    <span>Form succesfully submited.</span>
  </div>
  <div class="form-container">
    <h1>Kontaktní formulář</h1>
    <form method="post">
      <h2>Jméno</h2>
      <input type="text" id="name" name="name">
      <h2>Přijmení</h2>
      <input type="text" id="surname" name="surname">
      <h2>E-mail</h2>
      <input type="email" id="mail" name="mail">
      <h2>Telefon</h2>
      <input type="tel" id="tel" name="tel" placeholder="123 456 789">
      <h2>Adresa</h2>
      <input type="text" id="address" name="address">
      <h2>Město</h2>
      <input type="text" id="town" name="town">
      <h2>Zpráva</h2>
      <textarea type="textarea" id="message" name="message"> </textarea>
      <button type="submit" id="submit" name="submit">Odeslat</button>
    </form>
  </div>
<script src="script.js"></script>

<?php

$errors = [];

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $email = $_POST['mail'];
  $tel = $_POST['tel'];
  $address = $_POST['address'];
  $town = $_POST['town'];
  $message = $_POST['message'];

  if(isset($name) && isset($surname) && isset($email) && isset($tel) && isset($address) && isset($town) && isset($message))
  {
    if(empty($name) || empty($surname) || empty($email) || empty($tel) || empty($address) || empty($town) || empty($message))
    {
      $errors[] = "Please fill out all the fields.";
    }
    else
    {
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $errors[] = "Please fill out the e-mail address properly.";
      }
      if(strlen($tel) != 11)
      {
        $errors[] = "Please fill out the telephone number properly.";
      }
      if(!preg_match('/\d/', $address))
      {
        $errors[] = "Please fill out the address properly.";
      }
      if(strlen($message) > 255)
      {
        $errors[] = "Maximum length of 255 exceeded in message.";
      }
    }
  }
  else
  {
    $errors[] = "Please fill out all the fields.";
  }
}

print_r($errors);
?>
<?php foreach($errors as $error): ?>
  <div class="alert" id="alert-bad">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" height="1.2rem"
      width="1.2rem"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
      <path
        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c-12.5 12.5-32.8 12.5-45.3 0s12.5-32.8 0-45.3L23</div>7.3 256 342.6 150.6z" />
    </svg>
    <span id="alert-bad-text"><?php echo $error; ?></span>
  </div>
<?php endforeach; ?>
</body>

</html>