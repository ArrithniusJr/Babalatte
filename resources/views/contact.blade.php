<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="shortcut icon" href="/gallery/logo.svg" type="image/x-icon" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/contact.css">

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Navigation Bar -->
    <nav class="header">
      <h1>
        <img class="d-inline-block" src="gallery/logo.svg" alt="logo" />
        <span class="text-gradient">BabaLatte & Tacos</span>
      </h1>
      <div class="nav-links">
        <a href="/">Home</a>
        <span class="hide">
          <a href="/order">Order</a>
          <a href="/contact" style="color: #f17228">Contact</a>
        </span>
      </div>
    </nav>

    <!-- Contact Page Content -->
    <div class="contact-container">
      <div class="contact-header">
        <h1 style="color: #2f2f2f; margin-bottom: 1rem">Contact Us</h1>
        <p style="color: #555454">
          We're here to help! Reach out through any of these channels
        </p>
      </div>

      <div class="contact-content">
        <form class="contact-form">
          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" required />
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" required />
          </div>
          <div class="form-group">
            <label for="message">Your Message</label>
            <textarea id="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="submit-btn">Send Message</button>
        </form>

        <div class="contact-info">
          <div class="info-item">
            <i class="fas fa-phone"></i>
            <div>
              <h3>Call Us</h3>
              <p>+1 (555) 123-4567<br />Mon-Fri: 9AM - 7PM EST</p>
            </div>
          </div>
          <div class="info-item">
            <i class="fas fa-envelope"></i>
            <div>
              <h3>Email Us</h3>
              <p>support@brand.com<br />Response within 24 hours</p>
            </div>
          </div>
          <div class="info-item">
            <i class="fas fa-map-marker-alt"></i>
            <div>
              <h3>Visit Us</h3>
              <p>123 Food Street<br />New York, NY 10001</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
