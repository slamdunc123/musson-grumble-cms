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
  $categories = $mysqli->query("SELECT * FROM categories ORDER BY name ASC") or die($mysqli->error);
 
  ?>
<?php require 'header.php'; ?>
<!-- create table to display results  -->
<div class="main-container">
  <div class="main-container-row">
    <div class="main-container-block">
      <div class="main-container-block-body">
        <a href="recipeForm.php" class="btn btn-primary">Add
        </a>
      </div>
    </div>
  </div>
  <?php
        while($row = $categories->fetch_assoc()): ?>
  <!-- table  -->
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
      <div class="main-container-block-body">
        <a href="categoryForm.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit
        </a>
        <a href="functions.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete
        </a>
      </div>
    </div>
  </div>
  <?php endwhile; ?>



</div>

<?php require 'footer.php'; ?>