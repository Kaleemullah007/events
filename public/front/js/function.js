// Auto Update Copyright Year in a Website Dynamically
document.getElementById("year").innerHTML = new Date().getFullYear();


// Back to Top
$(window).scroll(function(){
    if ($(this).scrollTop() > 1) {
        $('.back-to-top').css({bottom:"25px"});
    } else {
        $('.back-to-top').css({bottom:"-100px"});
    }
});
$('.back-to-top').click(function(){
    $('html, body').animate({scrollTop: '0px'}, 800);
    return false;
});