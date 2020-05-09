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

// if(isset($_POST['submit']) )
// {
//   $categoryId = $_POST['categoryId'];
//   // print_r($categoryId);
// }

?>


<?php require 'header.php'; ?>

<?php



if(isset($_POST['catId'])){
$catId = $_POST['catId'];  // Storing Selected Value In Variable

} else {
  $catId = null;
}
 
 // select all recipes
 // $recipes = $mysqli->query("SELECT recipes.id, recipes.name as r_name, recipes.category_id, recipes.description, recipes.ingredients, recipes.instructions, recipes.suggestions, categories.name as c_name FROM recipes, categories WHERE recipes.category_id = categories.id ORDER BY categories.name ASC") or die($mysqli->error);

// select recipes by category 
 $recipes = $mysqli->query("SELECT recipes.id, recipes.name as r_name, recipes.category_id, recipes.description, recipes.ingredients, recipes.instructions, recipes.suggestions, categories.name as c_name FROM recipes, categories WHERE recipes.category_id = categories.id AND categories.id = '{$catId}'") or die($mysqli->error);

 ?>

<div class="main-container">
  <div class="main-container-row">
    <div class="main-container-block">
      <div class="main-container-block-body">
        <a href="recipeForm.php" class="btn btn-primary">Add
        </a>
      </div>
    </div>
  </div>

  <form action="recipes.php" method="POST" id="catId">
    <select class="custom-select" name="catId" onchange='this.form.submit();'>
      <option selected disabled>Select category</option>
      <option value="1" <?php if (isset($catId) && $catId=="1") echo "selected";?>>Meat</option>
      <option value="2" <?php if (isset($catId) && $catId=="2") echo "selected";?>>Fish</option>
      <option value="3" <?php if (isset($catId) && $catId=="3") echo "selected";?>>Vegetables</option>
      <option value="4" <?php if (isset($catId) && $catId=="4") echo "selected";?>>Rice and Pulses</option>
      <option value="5" <?php if (isset($catId) && $catId=="5") echo "selected";?>>Eggs and Dairy</option>
      <option value="6" <?php if (isset($catId) && $catId=="6") echo "selected";?>>Fruits</option>
      <option value="7" <?php if (isset($catId) && $catId=="7") echo "selected";?>>Bread</option>
      <option value="8" <?php if (isset($catId) && $catId=="8") echo "selected";?>>Pasta</option>
      <option value="9" <?php if (isset($catId) && $catId=="9") echo "selected";?>>Sides and accompaniments</option>
    </select>
    <!-- <input type="submit" name='select' value="Select"> -->
  </form>

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
      <div class="main-container-block-head">Instructions</div>
      <div class="main-container-block-body"><?php echo $row['instructions']; ?></div>
    </div>
    <div class="main-container-block">
      <div class="main-container-block-head">Suggestions</div>
      <div class="main-container-block-body"><?php echo $row['suggestions']; ?></div>
    </div>
    <div class="main-container-block">
      <div class="main-container-block-body">
        <a href="recipeForm.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit
        </a>
        <a href="functions.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger disabled">Delete
        </a>
      </div>
    </div>
  </div>
  <?php endwhile; ?>



</div>

<?php require 'footer.php'; ?>