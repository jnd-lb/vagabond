<?php $rootFolder =  "/".basename(dirname(__DIR__)) ?>

 <!-- footer section start -->
    <footer id="contact-us">
<span>VagaBond</span> | <span id="demo"></span> All rights reserved.</span>
<div class="text-white w-100 py-2 d-flex container gap-3 justify-content-center ">
      <div class="d-flex align-items-center gap-1 ">
        <i data-lucide="map-pin" class="icon"></i>
        <span class="fs-6 fw-lighter "> Location: Sour-Al-Housh</span>
      </div>

      <div class="d-flex align-items-center gap-1 ">
        <i data-lucide="phone" class="icon"></i>
        <span class="fs-6 fw-lighter ">Phone Number: +961-76740055</span>
      </div>
    </div>
        <script>
            const d = new Date();
             document.getElementById("demo").innerHTML = d.getFullYear();
            </script>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


   <!--Icons-->
   <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        //init icons
         lucide.createIcons();
    </script>

    <script src="<?php echo "./js/script.js" ?>"></script>
</body>
</html>