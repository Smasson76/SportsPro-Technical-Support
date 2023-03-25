<form action="index.php" method="post">
    <input type="hidden" name="action" value="logout">
    You are logged in as <?php echo $_SESSION['customer']['email']; ?><br><br>
    <input type="submit" value="Logout" />
</form>