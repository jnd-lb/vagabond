<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../CSS/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

</head>
<body>
  <header class="main-header">
    <div class="header-left">
        <div class="address">Location: Sour-Al-Housh</div>
        <div class="phone">Phone Number: +961-76740055</div>
    </div>
    <div class="header-right">
        <form class="login-form" action="/login" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>
        <form class="register-form" action="/register" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Register</button>
        </form>
        <div class="card-icon">
          <a href="../HTML/Card.html">
            <i class="fas fa-credit-card"></i>
          </a>
        </div>
        <div class="social-icons">
            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</header>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="Home.html">Vaga<img src="../Images/soul.jpg" height="25px">Bond</a></div>
            <ul class="menu">
                <li><a href="../HTML/Home.html" class="menu-btn">Home</a></li>
                <li><a href="../HTML/AboutUs.html" class="menu-btn">About Us</a></li>
                <li><a href="../HTML/Contact.html" class="menu-btn">Contact Us</a></li>
</ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <section class="menu1" id="menu1">
        <div class="max-width">
          <h2 class="title">Our Menu
          <br>メニュー</br>
          </h2>
          <div class="carousel owl-carousel">
            <!--make use for each card-->
            
            <div class="card">
              <div class="box">
                <a href="../HTML/Onigri.html">
                  <img src="../Images/Food/Onigri/Onigiri.jpg" alt="Onigiri">
                </a>
                <div class="text"><b>Onigiri (お握り)</b></div>
                <p>Onigiri is made with plain rice and seaweed.</p>
              </div>
            </div>            
            <div class="card">
              <div class="box">
                <a href="../HTML/Sashimi.html">
                <img src="../Images/Food/Sashimi/sashimi.jpg" alt="Sashimi">
              </a>
                <div class="text"><b>Sashimi (刺身)</b></div>
                <p>Fresh raw fish or meat sliced into thin pieces</p>
              </div>
            </div>
            <div class="card">
              <div class="box">
                <a href="../HTML/Sushi.html">
                <img src="../Images/Food/Sushi/sushi.jpg" alt="Sushi">
                </a>
                <div class="text"><b>Sushi (鮨飯)</b></div>
                <p>Cooked rice, vinegar, and fish</p>
              </div>
            </div>
            <div class="card">
              <div class="box">
                <a href="../HTML/Sides.html">
                <img src="../Images/Food/Sides/Sides.jpg" alt="Sides">
              </a>
                <div class="text"><b>Sides</b></div>
                <p>Assortment Of Sauces and Dips</p>
              </div>
            </div>
            <div class="card">
              <div class="box">
                <a href="../HTML/Tea.html">
                <img src="../Images/Food/Tea/Green tea.jpg" alt="Green Tea">
              </a>
                <div class="text"><b>Ryokucha – (緑茶)</b></div>
                <p>Traditional Japanese Green Tea</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
  $(document).ready(function() {
    $('.carousel').owlCarousel({
      margin: 20,
      loop: true,
      autoplay: true,
      autoplayTimeout: 2000,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        600: {
          items: 2,
          nav: false
        },
        1000: {
          items: 3,
          nav: false
        }
      }
    });
  });
</script>
    <!-- footer section start -->
    <footer>
<span>VagaBond</span> | <span id="demo"></span> All rights reserved.</span>
        <script>
            const d = new Date();
    document.getElementById("demo").innerHTML = d.toDateString();
            </script>
    </footer>
    <script src="../JAVASCRIPT/Script.js"></script>
</body>
</html>