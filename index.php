<?php require 'functions.php'; ?>
<?php require 'db.php'; ?>


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
 
  // select all recipes
  $recipes = $mysqli->query("SELECT recipes.id, recipes.name as r_name, recipes.category_id, recipes.description, recipes.ingredients, recipes.method, recipes.cooking, categories.name as c_name FROM recipes, categories WHERE recipes.category_id = categories.id ORDER BY categories.name ASC") or die($mysqli->error);
 
  ?>
<?php require 'header.php'; ?>
<!-- create table to display results  -->
<div class="main-container">
  <div class="main-container-block">
    <div class="main-container-block-body">
      <a href="form.php" class="btn btn-primary">Add
      </a>
    </div>
  </div>
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
        <a href="form.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit
        </a>
        <a href="functions.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete
        </a>
      </div>
    </div>
  </div>
  <?php endwhile; ?>



</div>

<?php require 'footer.php'; ?>