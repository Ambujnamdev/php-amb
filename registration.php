<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
</head>
<body>
  <h1>Registration Form</h1>
  <!-- registration form -->
<form id="registrationForm" method="POST" action="login.php">
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email"><br>
  <label for="phone">Phone:</label><br>
  <input type="tel" id="phone" name="phone"><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br>
  <label for="confirmPassword">Confirm Password:</label><br>
  <input type="password" id="confirmPassword" name="confirmPassword"><br><br>
  
<input type="submit" value="Submit" >
</form>

<!-- form validation and submission -->
<script>
  const form = document.getElementById('registrationForm');
  form.addEventListener('submit', e => {
    e.preventDefault();

    // get form data
    const email = form.elements.email.value;
    const phone = form.elements.phone.value;
    const password = form.elements.password.value;
    const confirmPassword = form.elements.confirmPassword.value;

    // validate form data
    if (!email || !phone || !password || !confirmPassword) {
      alert('All fields are required');
      return;
    }

    if (password !== confirmPassword) {
      alert('Password and confirm password must match');
      return;
    }

    // send POST request to API endpoint
    const data = { email, phone, password };
    fetch('/api/register', {
      method: 'POST',
      body: JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json'
      }
    })
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          alert('User successfully registered');
        } else {
          alert(result.error);
        }
      });
  });
</script>

</body>
</html>
