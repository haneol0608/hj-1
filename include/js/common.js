$(function() {
//menu
  // $(".m2").find("ul").hide();

  $(".m1").click(function() {
    $(".m2 ul").hide();
    $(".m1 ul").show();
  });
  $(".m2").click(function() {
    $(".m1 ul").hide();
  });

  var mM = $("nav ul>li");

  mM.click(function() {
    mM.removeClass("activeM");
    $(this).addClass("activeM");

    if(mM.hasClass("activeM")) {
      // mM.find("ul").hide();
      $(this).find(".subNav").show();
    }

    $(".subNav").click(function() {
      $(".subNav>ul").hide();
      $(this).find("ul").show();
    });

  });

//quick btn
    function slideM() {
        if($("nav").hasClass("active")) {
            $("nav").animate({marginLeft:"0"});
        }else{
            $("nav").animate({marginLeft:"-100%"},1000);
        }
    }

    function openN() {
        $(".m_btn").hasClass("open");
        $("nav").toggleClass("active");
        slideM();
    }

    $(".m_btn").click(function(e) {
        e.preventDefault();
        $(".m_btn").toggleClass("on")
        $(".m_btn").toggleClass("open");

        //reset the menu style
        // $("nav ul li ul").hide();
        openN();
    });

    // nav scroll 자동이동
    $(".m_btn").click(function(e) {
      e.preventDefault();
         $('body,html').animate({ scrollTop: 0 }, 1000);
     });

    //sub04_01 도면 사이즈
    var drawing_1 = $(".drawing_table .sub04_dt tbody:nth-child(3) .drawing_frame");

    $(".d_sizer1").click(function() {
      $(drawing_1).toggleClass("shrink");

      if($(drawing_1).hasClass("shrink")) {
          $(drawing_1).css('display', 'none');
          $(".d_sizer1").html('-');
      }else{
          $(drawing_1).css('display', 'block');
          $(".d_sizer1").html('+');
      }
    });

    var drawing_2 = $(".drawing_table .sub04_dt tbody:nth-child(5) .drawing_frame");

    $(".d_sizer2").click(function() {
      $(drawing_2).toggleClass("shrink");

      if($(drawing_2).hasClass("shrink")) {
          $(drawing_2).css('display', 'none');
          $(".d_sizer2").html('-');
      }else{
          $(drawing_2).css('display', 'block');
          $(".d_sizer2").html('+');
      }
    });






    //sub0501 current nav

    // var processBtn = $(".product_menu a ");
    //
    // processBtn.click(function(){
    //   processBtn.removeClass("current_nav");
    //   $(this).addClass("current_nav");
    //
    // });





/***************************************** //거래처등록관리 - 신규등록 *****************************************/

    // $(function() {

      $(".add_btn>input").click(function() {
        $(".popup").css("display","none");
      });

      $(".add_").click(function(e) {
        e.preventDefault();
        $(".popup").css("display","block");
      });

    // });

});
