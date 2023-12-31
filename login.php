<?php
// Create session
session_start();
// Create connection to MySQL
$connection = mysqli_connect("localhost", "root", "", "test");
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// check if users have submitted tho form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Query to check if the user exists
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $query);

    // Check if the query execution was successful
    if ($result) {
        // Check if a user was found
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['username'] = $username;
            header("Location: homepage.php");
            exit;
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Error in query: " . mysqli_error($connection);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <!-- Form login -->
  <div class="container mt-5">
    <form method="post" action="">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="register.php" class="btn btn-success">Register</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
