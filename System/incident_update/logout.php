<?php
if (isset($_SESSION['technician']['email'])) { ?>
  <section>
    <p>You are logged in as <?php echo $_SESSION['technician']['email']; ?></p>
    <form action="." method="post">
      <input type="hidden" name="action" value="logout">
      <input type="submit" value="Logout" />
    </form>
  </section>
<?php } ?>