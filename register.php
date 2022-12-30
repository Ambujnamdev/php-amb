<?php

// Replace with your API endpoint and API key
$api_endpoint = 'https://example.com/api/register';
$api_key = 'your-api-key-here';

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Get the form data
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate the passwords
  if ($password != $confirm_password) {
    $message = 'Passwords do not match';
  } else {
    // Create the data to be sent to the API
    $data = array(
      'email' => $email,
      'phone' => $phone,
      'password' => $password
    );

    // Encode the data in JSON format
    $data_json = json_encode($data);

    // Set up the HTTP headers
    $headers = array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $api_key
    );

    // Initialize cURL
    $ch = curl_init();

    // Set the URL, POST data, HTTP headers, and other options for the request
    curl_setopt($ch, CURLOPT_URL, $api_endpoint);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Send the request and get the response
    $response = curl_exec($ch);
    $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Close cURL
    curl_close($ch);

    // Check the HTTP status code
    if ($response_code == 200) {
      // Success
      $message = 'User registered successfully';
    } else {
      // Error
      $message = 'Error registering user: ' . $response;
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
</head>
<body>
  <h1>User Registration</h1>
  <?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
  <?php endif; ?>
  <form method="post">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>
    <label for="phone">Phone:</label><br>
    <input type="text" id="phone" name="phone"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <label for="Confirm password">Confirm Password:</label><br>
    <input type="password" id="password" name="Confirm-password"><br>
    <input type="submit" name="submit" value="Submit">
  </form>
</body>
</html>
