
    const mail = document.getElementById("email");
    const pass = document.getElementById("password");
    const login = document.getElementById("logIn");
    
    function releaseDisabled(){
      if(mail.value!="" && pass.value.length>3){
        login.disabled = false;
      }else{
        login.disabled = true;
      }
    }
    mail.addEventListener('keyup', function(){releaseDisabled()});
    pass.addEventListener('keyup', function(){releaseDisabled()});

    (function(){
      $(".fade-img-box").css("height",window.innerHeight * 0.55);
      // 設定
      var interval = 6000; // 切り替わりの間隔（ミリ秒）
      var fade_speed = 1500;// フェード処理の早さ（ミリ秒）
      $(".fade-img-box img").hide();
      $(".fade-img-box img:first").addClass("active").show();      
      var changeImage = function(){
          var $active = $(".fade-img-box img.active");
          var $next = $active.next("img").length ? $active.next("img") : $(".fade-img-box img:first");
          $active.fadeOut(fade_speed).removeClass("active");
          $next.fadeIn(fade_speed).addClass("active");
      }
      
      setInterval(changeImage,interval);
    }());

if(document.querySelector("h2").clientWidth < 400){
  var imgs = document.querySelectorAll(".fade-img-box");
  for(var img of imgs){ img.style.width = "90%"; }
}