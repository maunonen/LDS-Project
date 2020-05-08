<footer id="main-footer" class="text-center p-4">
  <div class="container">
    <div class="row">
        <div class="col">
            <p>Copyright &copy; <span id="year"></span> <?php echo SITENAME; ?></p>
        </div>
    </div>
  </div>
</footer>

<script
  src="http://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
</script>
<script 
  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
  crossorigin="anonymous">
</script>
<script 
  src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
  crossorigin="anonymous">
</script>
<script 
  src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" 
  integrity="sha256-Y1rRlwTzT5K5hhCBfAFWABD4cU13QGuRN6P5apfWzVs=" 
  crossorigin="anonymous">
</script>
<script>
    // get the current year for the copyright
  $('#year').text(new Date().getFullYear()); 
  
  // configure slider 
  $('.carousel').carousel({
    interval : 6000, 
    pause : 'hover'
  })

  // Ligthbox Init 

  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
  });

  // Video Play 
  $(function () {
      // Auto play modal video
      $(".video").click(function () {
        var theModal = $(this).data("target"),
          videoSRC = $(this).attr("data-video"),
          videoSRCauto = videoSRC + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1";
        $(theModal + ' iframe').attr('src', videoSRCauto);
        $(theModal + ' button.close').click(function () {
          $(theModal + ' iframe').attr('src', videoSRC);
        });
      });
    });

</script>

</body>
</html>