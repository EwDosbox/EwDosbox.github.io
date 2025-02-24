<?php
include('./../database.php');

Database::connect('alert');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $surname = trim($_POST['surname'] ?? '');
  $email = trim($_POST['mail'] ?? '');
  $tel = trim($_POST['tel'] ?? '');
  $address = trim($_POST['address'] ?? '');
  $town = trim($_POST['town'] ?? '');
  $message = trim($_POST['message'] ?? '');

  if (!$name || !$surname || !$email || !$tel || !$address || !$town || !$message) {
    $errors[] = "Please fill out all the fields.";
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email address.";
    }
    if (!preg_match('/^\d{9,11}$/', $tel)) {
      $errors[] = "Invalid telephone number.";
    }
    if (!preg_match('/\d/', $address)) {
      $errors[] = "Invalid address format.";
    }
    if (strlen($message) > 255) {
      $errors[] = "Message exceeds 255 characters.";
    }
  }

  Db::query(
    "INSERT INTO `alert` (`name`, `surname`, `email`, `telephone`, `address`, `city`, `message`) VALUES (?, ?, ?, ?, ?, ?, ?)",
    $name,
    $surname,
    $email,
    $tel,
    $address,
    $town,
    $message
  );

  header("Location: /web/alert");
  die();
}

$alerts = Db::queryAll("SELECT * FROM `alert`");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Group Work</title>
  <link rel="stylesheet" href="./../styles.css">
</head>

<body>
  <?php foreach ($errors as $error): ?>
    <div class="alert" id="alert-bad">
      <span><?php echo htmlspecialchars($error); ?></span>
    </div>
  <?php endforeach; ?>

  <div class="form-container">
    <h1>Kontaktní formulář</h1>
    <form method="post">
      <label>Jméno <input type="text" name="name" required></label>
      <label>Přijmení <input type="text" name="surname" required></label>
      <label>E-mail <input type="email" name="mail" required></label>
      <label>Telefon <input type="tel" name="tel" placeholder="123 456 789" required></label>
      <label>Adresa <input type="text" name="address" required></label>
      <label>Město <input type="text" name="town" required></label>
      <label>Zpráva <textarea name="message" maxlength="255" required></textarea></label>
      <button type="submit">Odeslat</button>
    </form>
  </div>

  <table>
    <tr>
      <th>Name</th>
      <th>Surname</th>
      <th>E-mail</th>
      <th>Telephone</th>
      <th>Address</th>
      <th>Town</th>
      <th>Message</th>
      <th>TimeStamp</th>
    </tr>
    <?php foreach ($alerts as $alert): ?>
      <tr>
        <td><?php echo htmlspecialchars($alert['name']); ?></td>
        <td><?php echo htmlspecialchars($alert['surname']); ?></td>
        <td><?php echo htmlspecialchars($alert['email']); ?></td>
        <td><?php echo htmlspecialchars($alert['telephone']); ?></td>
        <td><?php echo htmlspecialchars($alert['address']); ?></td>
        <td><?php echo htmlspecialchars($alert['city']); ?></td>
        <td><?php echo htmlspecialchars($alert['message']); ?></td>
        <td><?php echo htmlspecialchars(date('d.m.Y', strtotime($alert['timestamp']))); ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <script src="script.js"></script>
</body>

</html>