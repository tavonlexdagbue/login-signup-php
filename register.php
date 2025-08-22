<?php
/*register.php */
//Registration page//?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Register</h2>
  <form id="registerForm">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>

    <div class="input-container">
      <input type="password" id="regPass" name="password" placeholder="Password" required>
      <span class="eye-icon" onclick="togglePassword('regPass', this)">👁️</span>
    </div>

    <div class="input-container">
      <input type="password" id="regConfirm" name="confirm_password" placeholder="Confirm Password" required>
      <span class="eye-icon" onclick="togglePassword('regConfirm', this)">👁️</span>
    </div>

    <button type="submit">Register</button>
    <p class="message" id="regMessage"></p>
  </form>
  <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

<script>
// Show/hide password
function togglePassword(fieldId, icon) {
  let input = document.getElementById(fieldId);
  if(input.type === "password") {
    input.type = "text";
    icon.textContent = "👁️"; // change icon
  } else {
    input.type = "password";
    icon.textContent = "👁️";
  }
}

// AJAX Register
document.getElementById("registerForm").addEventListener("submit", async function(e) {
  e.preventDefault();

  let password = document.getElementById("regPass").value;
  let confirm = document.getElementById("regConfirm").value;

  if(password !== confirm){
    let msg = document.getElementById("regMessage");
    msg.textContent = "Passwords do not match!";
    msg.className = "message error";
    return;
  }

  let formData = new FormData(this);
  let response = await fetch("register_process.php", {
    method: "POST",
    body: formData
  });
  let result = await response.json();

  let msg = document.getElementById("regMessage");
  msg.textContent = result.message;
  msg.className = "message " + (result.success ? "success" : "error");
  if(result.success){
    // Clear form on success
    document.getElementById("registerForm").reset();
  }
});
</script>
</body>
</html>
