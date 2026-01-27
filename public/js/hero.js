$(document).ready(function () {
    // Subtle parallax effect on scroll
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        // Moves the background image slower than the text
        $(".absolute.inset-0 img").css({
            transform: "translateY(" + scroll * 0.3 + "px)",
        });

        // Darken the overlay as you scroll down
        $("#hero-overlay").css("opacity", 0.5 + scroll / 1000);
    });
});

$(document).ready(function () {
    const $video = $("#bg-video");

    // When the video is ready to play, fade it in
    $video.on("canplaythrough", function () {
        $(this).removeClass("opacity-0").addClass("opacity-100");
    });

    // Check if video is already cached/loaded
    if ($video[0].readyState >= 3) {
        $video.removeClass("opacity-0").addClass("opacity-100");
    }
});
