<?php

require 'functions.php';

// Get the posted data.

$input_data = file_get_contents("php://input");            

if(isset($input_data) && !empty($input_data))
{
  // Extract the data.
  $input_data = json_decode($input_data); 

  // Validate.
  /* if(trim($request->number) === '' || (float)$request->amount < 0)
  {
    return http_response_code(400);
  } */

  $id = get_incremented_id($con, 'contact_me_messages');

  date_default_timezone_set('Asia/Kolkata');


  // Sanitize.
  $project_title = mysqli_real_escape_string($con, $input_data->projectTitle);
  $full_name = mysqli_real_escape_string($con, $input_data->fullName);
  $email = mysqli_real_escape_string($con, $input_data->emailAddress);
  $phone_no = mysqli_real_escape_string($con, $input_data->phoneNumber);
  $current_timestamp = time();

  // Create.
  $query = "INSERT INTO `contact_me_messages`(`id`,`project_title`,`full_name`,`email`,`phone_no`,`timestamp_created`) VALUES ($id, '$project_title', '$full_name', '$email', '$phone_no', '$current_timestamp')";

  if(mysqli_query($con, $query))
  {
    http_response_code(201);
    $output = [
      'id'             => $id,
      'project_title'  => $project_title,
      'full_name'      => $full_name,
      'email'          => $email,
      'phone_no'       => $phone_no,
      'timestamp'      => $current_timestamp
    ];
    echo json_encode($output);
  }
  else
  {
    http_response_code(422);
  }
}