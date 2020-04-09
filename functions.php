<?php session_start(); 

// DB 
// database connection 

$dbSelector = false;
if ($dbSelector) {
  $mysqli = new mysqli('localhost', 'slamdunc_admin', 'PHPb0bbins1', 'slamdunc_musson_grumble') or die($mysqli->error());
} else {
  $mysqli = new mysqli('localhost', 'root', '', 'musson_grumble') or die($mysqli->error());
}


// VARIABLES
// set intial variable values 
$id = 0;
$name = '';
$description = '';
$ingredients = '';
$method = '';
$cooking = '';
$update = false;


// INSERT 
// check if save button clicked and save to database
if(isset($_POST['save'])){
  $name = $_POST['name'];
  $description = $_POST['description'];
  $ingredients = $_POST['ingredients'];
  $method = $_POST['method'];
  $cooking = $_POST['cooking'];

  // set session variables and bootstrap class
  $_SESSION['message'] = 'Recipe has been saved!';
  $_SESSION['msg_type'] = 'success';

  // redirect user 
  header('location: index.php');

  // insert query
  $mysqli->query("INSERT INTO recipes (name, description, ingredients, method, cooking) VALUES('$name', '$description', '$ingredients', '$method', '$cooking')") or die($mysqli->error());
}


// DELETE 
// check if delete button clicked and delete record from database 
if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  // set session variables and bootstrap class
  $_SESSION['message'] = 'Recipe has been deleted!';
  $_SESSION['msg_type'] = 'danger';

  // redirect user 
  header('location: index.php');

  // delete query
  $mysqli->query("DELETE FROM recipes WHERE id=$id") or die($mysqli->error());
}


// EDIT
// check if edit clicked and populate form with selected record
if(isset($_GET['edit'])){
  $id = $_GET['edit'];

  // set to true to change button to update 
  $update = true;

  // find record to update 
  $result = $mysqli->query("SELECT * FROM recipes WHERE id=$id") or die($mysqli->error());

  // check if selected record exists
    if(!empty($result)){
      $row = $result->fetch_assoc();
      $name = $row['name'];
      $description = $row['description'];
      $ingredients = $row['ingredients'];
      $method = $row['method'];
      $cooking = $row['cooking'];
    }
  
}


// UPDATE 
// check if update clicked and take in hidden id plus form fields name and description
if(isset($_POST['update'])){
  $id = $_POST['id']; 
  $name = $_POST['name']; 
  $description = $_POST['description'];
  $ingredients = $_POST['ingredients'];
  $method = $_POST['method'];
  $cooking = $_POST['cooking'];

  // set session variables and bootstrap class
  $_SESSION['message'] = 'Recipe has been updated!';
  $_SESSION['msg_type'] = 'success';

  // redirect user 
  header('location: index.php');

  // update query
  $mysqli->query("UPDATE recipes SET name='$name', description='$description', ingredients='$ingredients', method='$method', cooking='$cooking' WHERE id=$id") or die($mysqli->error());
}