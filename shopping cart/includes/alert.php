<?php

// Define variables to store message types and corresponding CSS classes
$messageTypes = [
  'success' => 'success-msg',
  'warning' => 'warning-msg',
  'info' => 'info-msg',
  'error' => 'error-msg'
];

// Function to display messages
function displayMessage($type, $text) {
  global $messageTypes;
  if (isset($messageTypes[$type]) && !empty($text)) {
    // Display the message using sweetalert library
    echo '<script>swal("' . $text . '", "", "' . $type . '");</script>';
  }
}

// Check if there are any messages to display
if (isset($success_msg) || isset($warning_msg) || isset($info_msg) || isset($error_msg)) {
  // Display success messages
  if (isset($success_msg)) {
    foreach($success_msg as $success_msg) {
      displayMessage('success', $success_msg);
    }
  }
  // Display warning messages
  if (isset($warning_msg)) {
    foreach($warning_msg as $warning_msg) {
      displayMessage('warning', $warning_msg);
    }
  }
  // Display info messages
  if (isset($info_msg)) {
    foreach($info_msg as $info_msg) {
      displayMessage('info', $info_msg);
    }
  }
  // Display error messages
  if (isset($error_msg)) {
    foreach($error_msg as $error_msg) {
      displayMessage('error', $error_msg);
    }
  }
}
