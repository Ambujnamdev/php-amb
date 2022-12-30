<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate the form data
  $errors = validate_form_data();

  // If there are no errors, send the data to the API
  if (empty($errors)) {
    // Determine which action to perform (create, read, update, delete)
    if ($_POST['action'] == 'create') {
      $api_response = send_data_to_api('create');
    } elseif ($_POST['action'] == 'read') {
      $api_response = send_data_to_api('read');
    } elseif ($_POST['action'] == 'update') {
      $api_response = send_data_to_api('update');
    } elseif ($_POST['action'] == 'delete') {
      $api_response = send_data_to_api('delete');
    }

    // Check the API response and display a message to the user
    if ($api_response['success']) {
      if ($_POST['action'] == 'create') {
        echo "Your post has been created successfully!";
      } elseif ($_POST['action'] == 'read') {
        echo "Your post information:<br>";
        echo "Title: " . $api_response['data']['title'] . "<br>";
        echo "Body: " . $api_response['data']['body'] . "<br>";
      } elseif ($_POST['action'] == 'update') {
        echo "Your post has been updated successfully!";
      } elseif ($_POST['action'] == 'delete') {
        echo "Your post has been deleted successfully!";
      }
    } else {
      echo "An error occurred: " . $api_response['message'];
    }
  }
}

// Function to validate the form data
function validate_form_data() {
  $errors = array();

  // Validate the title
  if (empty($_POST['title'])) {
    $errors[] = "Title is required";
  }

  // Validate the body
  if (empty($_POST['body'])) {
    $errors[] = "Body is required";
  }

  return $errors;
}

//
