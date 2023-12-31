<?php
// Create connection to MySQL
$connection = mysqli_connect("localhost", "root", "", "test");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve data from the form
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);

  // Insert data into the "users" table
  $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
  $result = mysqli_query($connection, $insertQuery);

  // Check if the insertion was successful
  if ($result) {
      echo "Data inserted successfully!";
  } else {
      echo "Error inserting data: " . mysqli_error($connection);
  }
}

// Take data from DB
$res = mysqli_query($connection, "SELECT * FROM users");
// Check if query execution was successful
if (!$res) {
    die("Query failed: " . mysqli_error($connection));
}
// Fetch the first row from the result set
$user = mysqli_fetch_assoc($res);
// Check if a user was found
if (!$user) {
    die("No user found");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <!-- Form register -->
  <div class="container mt-5">
    <form method="post" action="">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="login.php" class="btn btn-success">Login</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>