<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/header.php');

  $sql = "SELECT UserID, Email, Password, FirstName, LastName, UserTypeID, Active FROM Users ORDER BY DateCreated";
?>

<script>
  function deleteUser(userid) {
    if (confirm("Are you sure you want to delete this User?")) {
      window.location.href = "updateUser.php?action=delete&UserID=" + userid;
    }
  }

  function deactivateUser(userid) {
    if (confirm("Are you sure you want to deactivate this User?")) {
      window.location.href = "updateUser.php?action=deactivate&UserID=" + userid;
    }
  }

  function activateUser(userid) {
    if (confirm("Are you sure you want to activate this User?")) {
      window.location.href = "updateUser.php?action=activate&UserID=" + userid;
    }
  }
</script>

<?php if (isset($_GET['action'])) { ?>
  <p class="responseMessage">
    <?php
      switch ($_GET['action']) {
        case "activate":
          echo "User activated successfully.";
          break;
        case "deactivate":
          echo "User deactivated successfully.";
          break;
        case "edit":
          echo "User updated successfully.";
          break;
        case "editPassword":
          echo "Password updated successfully.";
          break;
      }
    ?>
  </p>
<?php } ?>

<h1>All Users</h1>
<table class="list_table">
  <tr>
    <th>Name</th>
    <th>User Type</th>
    <th>Actions</th>
  </tr>
  <?php
    if ($result = mysqli_query($db, $sql)) {
      while ($user = mysqli_fetch_assoc($result)) {
  ?>
    <tr>
      <td><?php echo $user['FirstName'] . ' ' . $user['LastName'] ?></td>
      <td>
        <?php
          if ($user['UserTypeID'] == 1) {
            echo "Admin";
          } else {
            echo "Customer";
          }
        ?>
      </td>
      <td>
        <a href="edit.php?UserID=<?= $user['UserID']?>">Edit</a>&nbsp;|&nbsp;
        <a href="editPassword.php?UserID=<?= $user['UserID']?>">Edit Password</a>&nbsp;|&nbsp;
        <?php if ($user['Active']) { ?>
          <a href="javascript: deactivateUser(<?= $user['UserID']?>)">Deactivate</a>
        <?php } else { ?>
          <a href="javascript: activateUser(<?= $user['UserID']?>)">Activate</a>
        <?php } ?>
        <!-- <a href="javascript: deleteUser(<?php //$user['UserID'] ?>)">Delete</a> -->
      </td>
    </tr>
  <?php
      }
    } else {
  ?>
    <tr>
      <td colspan="3">
        <br/>
        No records found.
        <br/><br/><br/>
      </td>
    </tr>
  <?php } ?>
</table>

<?php
  mysqli_free_result($result);
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/footer.php');
?>
