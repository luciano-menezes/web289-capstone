<?php
require_once('../private/initialize.php');

$errors = [];
$name = '';
$mailFrom = '';
$subject = '';
$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data
  $name = h(trim($_POST['name']));
  $mailFrom = h(trim($_POST['email']));
  $subject = h(trim($_POST['subject']));
  $message = h(trim($_POST['message']));
  // Validate the form data
  if (empty($name)) {
    $errors[] = 'Name is required';
  }

  if (empty($mailFrom)) {
    $errors[] = 'Email is required';
  } elseif (!filter_var($mailFrom, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email is invalid';
  }

  if (empty($subject)) {
    $errors[] = 'Subject is required';
  }

  if (empty($message)) {
    $errors[] = 'Message is required';
  }

  // If there are no errors, send the email and set $success to true
  if (empty($errors)) {
    $mailTo = 'info@example.com';
    $headers = "From: " . $mailFrom;
    $txt = "You have received an email from " . $name . ".\n\n" . $message;

    if (mail($mailTo, $subject, $txt, $headers)) {
      $success = true;
    } else {
      $errors[] = 'There was a problem sending your message. Please try again later.';
    }
  }
}

$page_title = 'Contact Us';
include(SHARED_PATH . '/header.php');
?>

<section id="contact" class="container my-5 py-5">
  <div class="container text-center mt-5">
    <h3>Contact us</h3>
    <hr class="mx-auto">
    <?php if ($success) { ?>
      <p class="text-success">Thank you for your message. We will get back to you soon.</p>
    <?php } else { ?>
      <?php if (!empty($errors)) { ?>
        <div class="alert alert-danger">
          <ul>
            <?php foreach ($errors as $error) { ?>
              <li><?php echo $error; ?></li>
            <?php } ?>
          </ul>
        </div>
      <?php } ?>

      <form class="message-form" method="post" action="message_form.php">
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name" placeholder="Full name" value="<?php echo h($name); ?>"><br>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" placeholder="Your e-mail" value="<?php echo h($mailFrom); ?>"><br>
        <label for="subject">Subject</label><br>
        <input type="text" id="subject" name="subject" placeholder="Subject" value="<?php echo h($subject); ?>"><br>
        <label for="message">Message</label><br>
        <textarea id="message" name="message" placeholder="Message" maxlength="500"><?php echo h($message); ?></textarea><br>
        <input type="submit" id="message-btn" class="btn" name="submit" value="Submit">
      </form>
    <?php } ?>
  </div>
</section>


<!-----Footer----->
<!-- footer file, with the closing tags and scripts. -->
<?php
include(SHARED_PATH . '/footer.php');
?>