<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/validate.php';

$name = '';
$email = '';
$message = '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = isset($_POST['name']) && is_string($_POST['name'])
        ? $_POST['name'] :'';

    $email = isset($_POST['email']) && is_string($_POST['email'])
        ? $_POST['email'] :'';

    $message = isset($_POST['message']) && is_string($_POST['message'])
        ? $_POST['message'] :'';

    if (!validate_required($name)){
        $errors['name'] = 'Name is required.';
    } elseif (!validate_length($name, 2, 60)){
        $errors['name'] = 'Name must be between 2 and 60 characters.';
    }

    if (!validate_email($email)){
        $errors['email'] = 'Please enter a valid email address.';
    }
    if (!validate_required($message)){
        $errors['message'] = 'Message is required.';
    } elseif (!validate_length($message, 10, 1000)){
        $errors['message'] = 'Message must be between 10 and 1000 characters.';
    }

    if (empty($errors)) {
        header('Location: success.php', true, 303);
        exit;
    }
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
</head>
    
<body>
  <h1>Contact Us</h1>
  <form method="post" action="index.php">
      
    <label>Name <input type="text" name="name" value="<?= escape($name) ?>"></label><br>
        <?php if(isset($errors['name'])): ?>
         <p><?= escape($errors['name']) ?></p>
        <?php endif;?>
<br> 
      
    <label>Email <input type="email" name="email" value="<?= escape($email) ?>"></label><br>
        <?php if(isset($errors['email'])): ?>
         <p><?= escape($errors['email']) ?></p>
        <?php endif;?>
 <br>
      
    <label>Message <textarea name="message"><?= escape($message) ?></textarea></label><br>
        <?php if(isset($errors['message'])): ?>
         <p><?= escape($errors['message']) ?></p>
        <?php endif; ?>
<br>
    <button type="submit">Send</button>
  </form>
</body>
</html>
