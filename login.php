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
        echo "Your profile has been created successfully!";
      } elseif ($_POST['action'] == 'read') {
        echo "Your profile information:<br>";
        echo "First name: " . $api_response['data']['first_name'] . "<br>";
        echo "Last name: " . $api_response['data']['last_name'] . "<br>";
        echo "Role: " . $api_response['data']['role'] . "<br>";
      } elseif ($_POST['action'] == 'update') {
        echo "Your profile has been updated successfully!";
      } elseif ($_POST['action'] == 'delete') {
        echo "Your profile has been deleted successfully!";
      }
    } else {
      echo "An error occurred: " . $api_response['message'];
    }
  }
}

// Function to validate the form data
function validate_form_data() {
  $errors = array();

  // Validate the first name
  if (empty($_POST['first_name'])) {
    $errors[] = "First name is required";
  }

  // Validate the last name
  if (empty($_POST['last_name'])) {
    $errors[] = "Last name is required";
  }

  // Validate the role
  if (empty($_POST['role'])) {
    $errors[] = "Role is required";
  } elseif ($_POST['role'] != 'writer' && $_POST['role'] != 'editor') {
    $errors[] = "Invalid role";
  }

  return $errors;
}

// Function to send the data to the API
function send_data_to_api($action) {
  // Build the API endpoint URL
  $api_url = "https://example.com/api/profile";

  // Build the data to send to the API
  $data = array(
    'action
