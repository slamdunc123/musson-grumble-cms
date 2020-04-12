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

    $recipeCategoryId = '';
    // if edit button clicked pass edit value in $_GET to query to get single recipe
    if(isset($_GET['edit'])){
      
      $recipe = $mysqli->query("SELECT * from recipes WHERE recipes.id = {$_GET['edit']}") or die($mysqli->error);

      while($row = $recipe->fetch_assoc()){
          $recipeCategoryId = $row['category_id'];
      }
    }
 
  // select all query
  $recipes = $mysqli->query("SELECT recipes.id, recipes.name as r_name, recipes.category_id, recipes.description, recipes.ingredients, recipes.method, recipes.cooking, categories.name as c_name FROM recipes, categories WHERE recipes.category_id = categories.id") or die($mysqli->error);
  $categories = $mysqli->query("SELECT * FROM categories") or die($mysqli->error);

  ?>

  <!-- create table to display results  -->
  <div class="main-container">
    <?php
        while($row = $recipes->fetch_assoc()): ?>
    <!-- table  -->
    <div class="main-container-row">
      <div class="main-container-block">
        <div class="main-container-block-head">Name</div>
        <div class="main-container-block-body"><?php echo $row['r_name']; ?></div>
      </div>
      <div class="main-container-block">
        <div class="main-container-block-head">Category</div>
        <div class="main-container-block-body"><?php echo $row['c_name']; ?></div>
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


    <!-- form  -->
    <div class="main-container-row">
      <div class="main-container-form">
        <form action="functions.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $name; ?>">
          </div>
          <div class="form-group">
            <label for="category">Categories</label>
            <br>
            <select id="category" name="category">
              <?php

           while($row = $categories->fetch_assoc()): ?>
              <option value="<?php echo $row['id'] ?>" <?php 
              // display selected value in category dropdown on edit - not working
              // while($row2 = $categories2->fetch_assoc()){
                // if ($_GET['edit'] == $row2['r_id']) {echo 'selected="selected"';}
                if ($row['id'] == $recipeCategoryId) echo 'selected';
              // }
            ?>>
                <?php 

              echo $row['name']; 

              ?>

              </option>
              <?php endwhile ?>
            </select>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="texarea" name="description" placeholder="Description" class="form-control"
              value="<?php echo $description; ?>">
          </div>
          <div class="form-group">
            <label>Ingredients</label>
            <textarea rows="10" cols="50" name="ingredients" placeholder="Ingredients"
              class="form-control"><?php echo $ingredients ?></textarea>
          </div>
          <div class="form-group">
            <label>Method</label>
            <textarea rows="10" cols="50" name="method" placeholder="Method"
              class="form-control"><?php echo $method ?></textarea>
          </div>
          <div class="form-group">
            <label>Cooking</label>
            <textarea rows="10" cols="50" name="cooking" placeholder="Cooking Times"
              class="form-control"><?php echo $cooking ?></textarea>
          </div>
          <div class="form-group">
            <?php 
              if ($update == true):
          ?>
            <button type="submit" name="update" class="btn btn-info">Update</button>
            <?php else: ?>
            <button type="submit" name="save" class="btn btn-info">Save</button>
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