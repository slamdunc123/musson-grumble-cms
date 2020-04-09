<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css" />
  <title>Document</title>
</head>

<body>
  <!-- import functions.php  -->
  <?php require_once 'functions.php'; ?>


  <?php

    // check if session message is set and add bootstrap class - message and msg_type
    if(isset($_SESSION['message'])): 
    
  ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php

    // print out session message and then unset it

        echo $_SESSION['message'];
        unset($_SESSION['message']);

    ?>

  </div>

  <?php endif ?>

  <?php 
  // database connection 
  $dbSelector = false;
      if ($dbSelector) {
        $mysqli = new mysqli('localhost', 'slamdunc_admin', 'PHPb0bbins1', 'slamdunc_musson_grumble') or die($mysqli->error());
      } else {
        $mysqli = new mysqli('localhost', 'root', '', 'musson_grumble') or die($mysqli->error());
      }


  // select all query
  $result = $mysqli->query("SELECT * FROM recipes") or die($mysqli->error);

  // use function to display result on screen 
  // pre_r($result);
  // pre_r($result->fetch_assoc()); // fetch the first record if there is one
  // pre_r($result->fetch_assoc()); // fetch the second record if there is one

  // function pre_r($array){
  //   echo '<pre>';
  //   print_r($array);
  //   echo '</pre>';
  // }

  ?>

  <!-- create table to display results  -->
  <div class="main-container">


    <?php
           while($row = $result->fetch_assoc()): ?>
    <div class="main-container-row">
      <div class="main-container-block">
        <div class="main-container-block-head">Name</div>
        <div class="main-container-block-body"><?php echo $row['name']; ?></div>
      </div>
      <div class="main-container-block">
        <div class="main-container-block-head">Description</div>
        <div class="main-container-block-body"><?php echo $row['description']; ?></div>
      </div>
      <div class="main-container-block">
        <div class="main-container-block-head">Ingredients</div>
        <div class="main-container-block-body"><?php echo $row['ingredients']; ?></div>
      </div>
      <div class="main-container-block">
        <div class="main-container-block-head">Method</div>
        <div class="main-container-block-body"><?php echo $row['method']; ?></div>
      </div>
      <div class="main-container-block">
        <div class="main-container-block-head">Cooking</div>
        <div class="main-container-block-body"><?php echo $row['cooking']; ?></div>
      </div>





      <div class="main-container-block">
        <div class="main-container-block-body">
          <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit
          </a>
          <a href="functions.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete
          </a>
        </div>
      </div>
    </div>

    <?php endwhile; ?>


  </div>

  <div class="main-container-row">
    <div class="main-container-form">
      <form action="functions.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" placeholder="Recipe name" class="form-control" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
          <label>Description</label>
          <input type="text" name="description" placeholder="Recipe description" class="form-control"
            value="<?php echo $description; ?>">
        </div>
        <div class="form-group">
          <label>Ingredients</label>
          <input type="text" name="ingredients" placeholder="Recipe ingredients" class="form-control"
            value="<?php echo $ingredients; ?>">
        </div>
        <div class="form-group">
          <label>Method</label>
          <input type="text" name="method" placeholder="Recipe method" class="form-control"
            value="<?php echo $method; ?>">
        </div>
        <div class="form-group">
          <label>Cooking</label>
          <input type="text" name="cooking" placeholder="Recipe cooking" class="form-control"
            value="<?php echo $cooking; ?>">
        </div>
        <div class="form-group">
          <?php 
              if ($update == true):
          ?>
          <button type="submit" name="update" class="">Update</button>
          <?php else: ?>
          <button type="submit" name="save" class="">Save</button>
          <?php endif ?>
        </div>
      </form>
    </div>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
</body>

</html>