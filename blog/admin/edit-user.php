<?php
include 'partials/header.php';

if(isset($_GET['id'])){
  $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($connection, $query);
  $user = mysqli_fetch_assoc($result);
}else{
  header('location: ' . ROOT_URL . 'admin/manage-users.php');
  die();
}
?>

    <!-- Add Post Form -->
    <section class="form__section">
      <div class="container form__section-container">
        <h2>Edit User</h2>

   
       <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
          <input type="hidden" name="id" value="<?= $user['id'] ?>" />
          <input type="text" placeholder="Enter Your First Name" name="firstname" value="<?= $user['firstname'] ?>" />
          <input type="text" placeholder="Enter Your Last Name" name="lastname" value="<?= $user['lastname'] ?>" />
         
          <select name="userrole">
            <option value="0">Author</option>
            <option value="1">Admin</option>
          </select>

         
          <button type="submit" class="btn" name="submit">Update User</button>
          
        </form>
      </div>
    </section>

    <!-- End Form -->


    <!-- Footer -->
 
    
<?php
include '../partials/footer.php'
?>