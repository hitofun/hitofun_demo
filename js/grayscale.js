/*!
 * Start Bootstrap - Grayscale Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery to collapse the navbar on scroll
function collapseNavbar() {
    // if ($(".navbar").offset().top > 10) {
    //     $(".navbar-fixed-top").addClass("top-nav-collapse");
    //     // $('.page-scroll').css("color", "white");
    // } else {
    //     $(".navbar-fixed-top").removeClass("top-nav-collapse");
    //     // $('.page-scroll').css("color", "black");
    // }
}

$(window).scroll(collapseNavbar);
$(document).ready(collapseNavbar);