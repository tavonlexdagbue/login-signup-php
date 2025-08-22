
<?php session_start(); ?>
<?php
/*login.php */
//Frontend,uses AJAX //?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Login</h2>
  <form id="loginForm">
    <input type="text" name="login" placeholder="Email or Username" required><br>

    <div class="input-container">
      <input type="password" id="loginPass" name="password" placeholder="Password" required>
      <span class="eye-icon" onclick="togglePassword('loginPass', this)">👁️</span>
    </div>

    <button type="submit">Login</button>
    <p class="message" id="loginMessage"></p>
  </form>
  <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

<script>
// Toggle show/hide password
function togglePassword(fieldId, icon) {
  let input = document.getElementById(fieldId);
  if(input.type === "password"){
    input.type = "text";
    icon.textContent = "👁️"; // optional: change icon
  } else {
    input.type = "password";
    icon.textContent = "👁️";
  }
}

// AJAX login
document.getElementById("loginForm").addEventListener("submit", async function(e) {
  e.preventDefault();
  let formData = new FormData(this);
  let response = await fetch("login_process.php", {
    method: "POST",
    body: formData
  });
  let result = await response.json();

  let msg = document.getElementById("loginMessage");
  msg.textContent = result.message;
  msg.className = "message " + (result.success ? "success" : "error");

  if(result.success){
    setTimeout(() => window.location.href = "dashboard.php", 1000);
  }
});
</script>
</body>
</html>
