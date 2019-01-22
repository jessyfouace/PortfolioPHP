 <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/js/plugins.js"></script>
  <script src="../assets/js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>
  <script>
    AOS.init();
  </script>
  <script>
   let loader = document.getElementById('loader');
   let interval = setInterval(functionLoader, 1500);

   function functionLoader() {
      let animation = document.createAttribute('data-aos')
      animation.value = "fade-down";
      loader.setAttributeNode(animation);
      let intervalVue = setInterval(functionDissapear, 200);
      function functionDissapear() {
        loader.classList.add('d-none');
        clearInterval(intervalVue);
      }
      clearInterval(interval);
   }
  </script>
  <script>
    ScrollReveal().reveal('.firstanim', { duration: 300 });
    ScrollReveal().reveal('.secondanim', { duration: 600 });
    ScrollReveal().reveal('.thirdanim', { duration: 900 });
    ScrollReveal().reveal('.foranim', { duration: 1200 });
    ScrollReveal().reveal('.fiveanim', { duration: 1400 });
  </script>
</body>

</html>

