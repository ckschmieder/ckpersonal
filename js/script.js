$(function() {

    console.log("status is good");
    
    var wheight = $(window).height(); //get the height of the window
  
    $('.fullheight').css('height', wheight); //set to window tallness  


    //recalculates height of .fullheight elements as window is resized
    $(window).resize(function() {
        wheight = $(window).height(); //get the height of the window
        $('.fullheight').css('height', wheight); //set to window tallness
    });

    //Use smooth scrolling when clicking on navigation
    $('.nav-menu a[href*=#]').click(function() {
      if (location.pathname.replace(/^\//, '') ===
        this.pathname.replace(/^\//, '') &&
        location.hostname === this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.outffset().top - topoffset + 2
          }, 500);
          return false;
        } //target.length
      } //click function
    }); //smooth scrolling


});

$(document).ready(function() {
    $('#fullpage').fullpage({
        sectionsColor: ['#f2f2f2', '#4BBFC3', '#7BAABE', 'whitesmoke', '#ccddff']
    });
});

/*

$(function(){

    $("#typed").typed({
        strings: ["Typed.js is a <strong>jQuery</strong> plugin.", "It <em>types</em> out sentences.", "And then deletes them.", "Try it out!"],
        stringsElement: $('#typed-strings'),
        typeSpeed: 30,
        backDelay: 500,
        loop: false,
        contentType: 'html', // or text
        // defaults to false for infinite loop
        loopCount: false,
        callback: function(){ foo(); },
        resetCallback: function() { newTyped(); }
    });

    $(".reset").click(function(){
        $("#typed").typed('reset');
    });

});

*/