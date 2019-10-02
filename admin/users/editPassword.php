<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/header.php');

  $userid = 0;
  $password = "";

  if ($stmt = mysqli_prepare($db, "SELECT UserID, Password FROM Users WHERE UserID = ?")) {

    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "i", $_GET['UserID']);

    /* execute query */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt, $userid, $password);

    /* fetch value */
    mysqli_stmt_fetch($stmt);
  }
?>

<h1>Edit User</h1>
<table class="list_table">
  <form action="updateUser.php" method="post">
    <tr>
      <td>Password:</td>
      <td><input type="password" name="password" value=""></td>
    </tr>
    <tr>
      <td>Confirm Password:</td>
      <td><input type="password" name="password_confirm" value=""></td>
    </tr>
    <tr>
      <td colspan="2" align="right">
        <input type="hidden" name="UserID" value="<?= $userid ?>">
        <input type="hidden" name="action" value="editPassword">
        <button type="button" onClick="window.location.href='list.php'">Cancel</button>
        <button type="submit">Update</button>
      </td>
    </tr>
</form>
</table>

<?php
  mysqli_stmt_close($stmt);
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/footer.php');
?>
