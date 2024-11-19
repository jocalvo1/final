<?php
if (session_id() == '') {
  session_start();
}

require __DIR__ . '/../conn.php';

if (isset($_POST["login"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['admin_username'];
  $password = $_POST['admin_password'];

  if (!empty($username) && !empty($password)) {
    // Prepare the SQL statement
    if ($stmt = $mysqli->prepare("SELECT * FROM tbl_admin WHERE admin_username = ? AND admin_password = ?")) {
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();

      $result = $stmt->get_result();

      if ($result && $result->num_rows > 0) {
        // Successful login
        $_SESSION['admin_username'] = $username;
        $result->free();
        $stmt->close();
        header("Location: ../../admin/main/index.php");
        exit();
      } else {
        // Invalid username or password
        $_SESSION['error'] = "Invalid username / password.";
        $result->free();
        $stmt->close();
        header("Location: ../../admin/index.php");
        exit();
      }
    } else {
      echo "Error: Could not prepare the SQL statement.";
      exit();
    }
  } else {
    // Username or password is empty
    $_SESSION['error'] = "Username / Password is empty.";
    header("Location: ../../admin/index.php");
    exit();
  }
}
?>
