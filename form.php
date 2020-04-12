<?php include 'functions.php'; ?>
<?php include 'db.php'; ?>
<?php
$recipeCategoryId = '';
    // if edit button clicked pass edit value in $_GET to query to get single recipe
    if(isset($_GET['edit'])){
      
      $recipe = $mysqli->query("SELECT * from recipes WHERE recipes.id = {$_GET['edit']}") or die($mysqli->error);

      while($row = $recipe->fetch_assoc()){
          $recipeCategoryId = $row['category_id'];
      }
    }

$categories = $mysqli->query("SELECT * FROM categories") or die($mysqli->error);

?>
<?php require 'header.php'; ?>
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
        <label for="category">Category</label>
        <br>
        <select id="category" name="category">
          <?php

           while($row = $categories->fetch_assoc()): ?>
          <option value="<?php echo $row['id'] ?>" <?php 
                if ($row['id'] == $recipeCategoryId) echo 'selected';
            ?>>
            <?php echo $row['name']; ?>

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
        <textarea rows="5" cols="5" name="ingredients" placeholder="Ingredients"
          class="form-control"><?php echo $ingredients ?></textarea>
      </div>
      <div class="form-group">
        <label>Method</label>
        <textarea rows="5" cols="5" name="method" placeholder="Method"
          class="form-control"><?php echo $method ?></textarea>
      </div>
      <div class="form-group">
        <label>Cooking</label>
        <textarea rows="5" cols="5" name="cooking" placeholder="Cooking Instructions"
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

<?php require 'footer.php'; ?>