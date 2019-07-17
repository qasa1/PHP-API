<?php
if (isset($_POST['req'])) {


  // Include database config and user database helper functions
  require "database-config.php";
  require  "users.php";

  // Create an instance of the user class
  $users = new User();
 

  // Using a switch statement for an API controller
  switch ($_POST['req']) {
    default:
      echo json_encode([
        "status" => false,
        "message" => "Invalid Request"
      ]);
      break;

    // This fetches all the users from the database
    case "get-all":
    $all = $users->getAll();
      echo json_encode([
        "status" => $all==false?false:true,
        "data" => $all
      ]);
      break;

    // Fetching users by email
    case "get-email":
    $usr = $users->getEmail($_POST['email']);
      echo json_encode([
        "status" => $all==false?false:true,
        "data" => $usr
      ]);
      break;
  
    case "get-id":
    $usr = $users->getID($_POST['id']);
      echo json_encode([
        "status" => $all==false?false:true,
        "data" => $usr
      ]);
      break;

    case "create":
      $pass = $users->create($_POST['name'], $_POST['email'], $_POST['password']);
      echo json_encode([
        "status" => $pass,
        "message" => $pass ? "User Created" : "Error creating user"
      ]);
      break;

    case "update":
      $pass = $users->update($_POST['name'], $_POST['email'], $_POST['password'], $_POST['id']);
      echo json_encode([
        "status" => $pass,
        "message" => $pass ? "User Updated" : "Error updating user"
      ]);
      break;
  
    case "delete":
      $pass = $users->delete($_POST['id']);
      echo json_encode([
        "status" => $pass,
        "message" => $pass ? "User Deleted" : "Error deleting user"
      ]);
      break;
  }
}
?>