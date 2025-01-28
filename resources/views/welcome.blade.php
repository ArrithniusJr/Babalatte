<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Registration Form</title>
  <link rel="shortcut icon" href="gallery/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <!-- Login Form -->
    <div class="login form">
      <header>Login</header>
      <form id="loginForm" method="POST" action="requests/send_login.php" onsubmit="return validateLoginForm(event)">
        <input type="email" id="loginEmail" name="email" placeholder="Enter your email" required>
        <input type="password" id="loginPassword" name="password" placeholder="Enter your password" required>
        <a href="#" class="forgot-password">Forgot password?</a>
        <input type="submit" class="button" value="Login">
      </form>

      <div class="signup">
        <span class="signup">Don't have an account?
          <label for="check">Signup</label>
        </span>
      </div>
    </div>

    <!-- Registration Form -->
    <div class="registration form">
      <header>Signup</header>
      <form id="signupForm" method="POST" action="requests/send_registration.php" onsubmit="return validateSignupForm(event)">
        <input type="email" id="signupEmail" name="email" placeholder="Enter your email" required>
        <input type="password" id="signupPassword" name="password" placeholder="Create a password" required>
        <input type="password" id="confirmPassword" placeholder="Confirm your password" required>
        <input type="submit" class="button" value="Signup">
      </form>
      <div class="signup">
        <span class="signup">Already have an account?
          <label for="check">Login</label>
        </span>
      </div>
    </div>
  </div>

  <script>
    // display error messages
    function showError(inputElement, message) {
      const errorSpan = inputElement.nextElementSibling;
      if (errorSpan && errorSpan.classList.contains('error-message')) {
        errorSpan.textContent = message;
        return;
      }

      const error = document.createElement('div');
      error.className = 'error-message';
      error.textContent = message;
      error.style.color = 'var(--bs-red)';
      inputElement.parentNode.insertBefore(error, inputElement.nextSibling);
    }

    // clear error messages
    function clearErrors(form) {
      const errors = form.querySelectorAll('.error-message');
      errors.forEach(error => error.remove());
    }

    function showRegistrationSuccess() {
      // Create the overlay
      const overlay = document.createElement('div');
      overlay.className = 'success-popup-overlay';

      // Create the popup
      const successPopup = document.createElement('div');
      successPopup.className = 'success-popup';
      successPopup.innerHTML = `
        <div class="popup-content">
          <h2>Registration Successful</h2>
          <p>You can now log in to your account.</p>
          <button class="button" id="loginButton">Login</button>
        </div>
      `;

      document.body.appendChild(overlay);
      document.body.appendChild(successPopup);

      document.getElementById('loginButton').addEventListener('click', () => {
        overlay.remove();
        successPopup.remove();

        switchToLogin();
      });
    }


    function switchToLogin() {
      document.getElementById('check').checked = false;
      const popup = document.querySelector('.success-popup');
      if (popup) {
        popup.remove();
      }
    }

    // Login Form Validation
    function validateLoginForm(event) {
      event.preventDefault();
      const form = event.target;
      clearErrors(form);

      const email = form.querySelector('#loginEmail').value.trim();
      const password = form.querySelector('#loginPassword').value.trim();

      // Basic validation
      if (!email || !password) {
        showError(form.querySelector('#loginEmail'), 'Please fill in all fields');
        return false;
      }

      fetch('requests/send_login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            console.log('Server Response:', data);
            showSuccessMessage('Login successful! Redirecting...');
            setTimeout(() => {
              sessionStorage.setItem('userEmail', data.email);
console.log('Email saved to session storage:', sessionStorage.getItem('userEmail'));

              window.location.href = 'items';
            }, 1000);
          } else {
            showError(form.querySelector('#loginEmail'), data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showError(form.querySelector('#loginEmail'), 'Something went wrong. Please try again.');
        });
    }

    function showSuccessMessage(message) {
      const messageBox = document.createElement('div');
      messageBox.className = 'success-message';
      messageBox.textContent = message;
      document.body.appendChild(messageBox);

      setTimeout(() => {
        messageBox.remove();
      }, 3000);
    }

    // Registration Form Validation
    function validateSignupForm(event) {
      event.preventDefault();
      const form = event.target;
      clearErrors(form);

      const email = form.querySelector('#signupEmail').value.trim();
      const password = form.querySelector('#signupPassword').value.trim();
      const confirmPassword = form.querySelector('#confirmPassword').value.trim();

      // validation
      if (!email || !password || !confirmPassword) {
        showError(form.querySelector('#signupEmail'), 'Please fill in all fields');
        return false;
      }

      if (password !== confirmPassword) {
        showError(form.querySelector('#confirmPassword'), 'Passwords do not match');
        return false;
      }

      // Fetch request for signup
      fetch('requests/send_registration.php', {
        method: 'POST',
        body: JSON.stringify({ email, password }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            showRegistrationSuccess();
          } else {
            showError(form.querySelector('#signupEmail'), data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showError(form.querySelector('#signupEmail'), 'Something went wrong. Please try again.');
        });
    }

  </script>
</body>
</html>
