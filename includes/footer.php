    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cards text-center">
                        <img src="/img/cards.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="foot_nav text-center">
                        <nav>
                            <ul>
                                <li><a href="/">Home</a></li>|
                                <li><a href="/shop">Shop</a></li>|
                                <li><a href="/about-us">About</a></li>|
                                <li><a href="/contact-us">Contact Us</a></li>|
                                <li><a href="/privacy">Privacy Policy</a></li>|
                                <li><a href="/terms">Terms & Conditions</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="copy">
                    <p class="text-center"><strong>SUREMARTS</strong> &copy; Copyright <script>document.write(new Date().getFullYear());</script>. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>









    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/js/slick.min.js"></script>
    <script src="/js/main.js"></script>

    <script>
        $(document).ready(function(){
            if(localStorage.getItem('popState') != 'shown'){
                setTimeout(function(){
                    $('#popUp').css('display', 'block')
                }, 1000);
                localStorage.setItem('popState','shown')
            }
            
        });

        $('.submitId').click(function(){
            $('#popUp').css('display','none');
        });
    </script>


    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);
        function payWithPaystack(e) {
          e.preventDefault();
          let handler = PaystackPop.setup({
            key: 'pk_test_36a20d9341f6c6cafc709ff103d31726fdc2f77f', // Replace with your public key
            email: document.getElementById("email-address").value,
            amount: document.getElementById("amount").value * 100,
            firstname: document.getElementById("first-name").value,
            lastname: document.getElementById("last-name").value,

            ref: 'BH'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            onClose: function(){
                window.location = "http://shopwise.web/transaction-cancelled";
              alert('Transaction Cancelled.');
            },
            callback: function(response){
              let message = 'Payment complete! Reference: ' + response.reference;
              alert(message);
              window.location = "http://shopwise.web/verify_transaction?reference=" + response.reference;
            }
          });
          handler.openIframe();
        }
    </script>

    <script type="text/javascript">
        var html, body, scrollToTopButton;

        window.onload=function(){
            html=document.documentElement;
            body=document.body;
            scrollToTopButton=document.getElementById("scrollToTopButton");
        };

        window.onscroll=controlScrollToTopButton;

        function controlScrollToTopButton(){
            var windowInnerHeightX2=2*window.innerHeight;
            if (body.scrollTop > windowInnerHeightX2 || html.scrollTop > windowInnerHeightX2) {
                scrollToTopButton.classList.add("show");
            }
            else{
                scrollToTopButton.classList.remove("show");
            }
        }

        function scrollToTop(totalTime, easingPower){
            var timeInterval=1;//in ms
            var scrollTop=Math.round(body.scrollTop || html.scrollTop);
            var timeLeft=totalTime;
            var scrollByPixel=setInterval(function(){
                var percentSpent=(totalTime - timeLeft)/totalTime;
                if (timeLeft >=0) {
                    var newScrollTop=scrollTop*(1 - easeInOut(percentSpent,easingPower));
                    body.scrollTop=newScrollTop;
                    html.scrollTop=newScrollTop;
                    timeLeft--;
                }
                else{
                    clearInterval(scrollByPixel);
                }
            },timeInterval);
        }

        function easeInOut(t, power){
            if (t < 0.5) {
                return 0.5*Math.pow(2*t,power);
            }
            else{
                return 0.5*(2 - Math.pow(2*(1-t),power));
            }
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
          $('.img_slide').slick({
            dots: false,

              infinite: true,
              speed: 300,
              slidesToShow: 10,
              autoplay: true,
              arrows: false,
              // prevArrow:'<div class="slick-prev"><i class="fas fa-arrow-alt-circle-left"></i></div>',
              // nextArrow:'<div class="slick-next"><i class="fas fa-arrow-alt-circle-right"></i></div>',
              autoplaySpeed: 2000,
              slidesToScroll: 1,
              responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 3,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    slidesToScroll: 2
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 3,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 400,
                  settings: {
                    slidesToShow: 3,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    slidesToScroll: 1
                  }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
          });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
          $('.image').slick({
            dots: false,

              infinite: true,
              speed: 300,
              slidesToShow: 6,
              autoplay: true,
              arrows: false,
              // prevArrow:'<div class="slick-prev"><i class="fas fa-arrow-alt-circle-left"></i></div>',
              // nextArrow:'<div class="slick-next"><i class="fas fa-arrow-alt-circle-right"></i></div>',
              autoplaySpeed: 2000,
              slidesToScroll: 1,
              responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 3,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    slidesToScroll: 2
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 2,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 400,
                  settings: {
                    slidesToShow: 3,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    slidesToScroll: 1
                  }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
          });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
          $('.sliders').slick({
            centerMode: true,
              centerPadding: '60px',
              autoplay: true,
              autoplaySpeed: 3000,
              slidesToShow: 1,
              responsive: [
                {
                  breakpoint: 768,
                  settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                  }
                }
              ]
          });
        });
    </script>
</body>
</html>