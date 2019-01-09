(function() {
    $('button').removeClass('display-none');

    //login button(user) id
    let buttonId,
        manualMode = false;

    /* make thumbnail link not to able to click */
    $('.thumbnail li a').on('click', function(e) {
        // e.preventDefault();
    });

    /* when link from the footer is clicked it will go up with an animation */
    $('footer a.to-top').on('click', function(e) {
    e.preventDefault();
    let hash = this.hash;

    if(hash) {
       $('html, body').animate({
           scrollTop: $(hash).offset().top
       }, 900, function() {
         window.location.hash = hash;
       })
    }
  });

    /* image-thumbnail will go up from below and pager will come from left or right */
    $(window).on('scroll', function() {

      $('.animate-slide-up-vs-hidden').each(function() {
          let pos = $(this).offset().top;

          if($(window).scrollTop() + 800 > pos) {
            $(this).addClass('slide-up-animate');
          }
      });

      //for previous page to animate from left to right
      let prevPage = $('.animate-slide-left-vs-hidden');
      let prevPagerPos = prevPage.offset().top;
      if($(window).scrollTop() + 600 > prevPagerPos) {
         prevPage.addClass('slide-left-animate');
      }

      //for next page to animate from right to left
      let nextPage = $('.animate-slide-right-vs-hidden');
      let nextPagePos = nextPage.offset().top;

      if($(window).scrollTop() + 600 > nextPagePos) {
          nextPage.addClass('slide-right-animate');
      }

    });

    $('.qrcode-text-btn').on('click', function(e) {
        $('.modal .form-group input[type="text"]').focus();
    });

    $('.thumbnail button').on('click', function() {
        buttonId = $(this).attr('id');
    });


    $('.qrcode-text').on('focus', function() {
        let ajaxRequestURI = window.location.origin,
            inputLength = $(this).val().length,
            data = {
                id: buttonId,
                qrCode : $(this).val()
            };

        if(inputLength >= 16 || manualMode === true) {

            $('.modal .form-group input[type="text"]').blur();

            //show loading things
            $('.loading-message').removeClass('display-none');

            //ajax request to validate qr-code and vote contestant
            ajaxRequestToValidateNStore(ajaxRequestURI, data);

        } else {
            $(this).on('keyup', function() {
                if($(this).val().length >= 16) {
                    manualMode = true;
                    $(this).focus();
                    $(this).val('');
                    manualMode = false;
                }
            })
        }

    });


})();