$(document).ready(function () {
    // --- Configuration & Cache ---
    const $window = $(window);
    const $header = $("header");
    const $navLinks = $(".nav-links");
    const headerHeight = 70;
    const scrollThreshold = 80;
    let lastScrollTop = 0;

    // --- 1. Refined Smooth Scrolling Logic ---
    // Combined both listeners into one efficient delegated handler
    $(document).on(
        "click",
        'a[href^="#"]:not([href="#"]):not([href="#0"])',
        function (event) {
            const target = $(this.hash);
            const $target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");

            if ($target.length) {
                event.preventDefault();

                $("html, body")
                    .stop()
                    .animate(
                        {
                            scrollTop: $target.offset().top - headerHeight,
                        },
                        800,
                        function () {
                            // Accessibility: update focus
                            $target.focus();
                            if (!$target.is(":focus")) {
                                $target.attr("tabindex", "-1").focus();
                            }
                        },
                    );

                // Mobile specific: Close menu on link click
                if ($window.width() <= 992) {
                    $navLinks.removeClass("active");
                    $(".mobile-icon").attr("name", "add-outline");
                    $(".dropdown-menu, .submenu").hide();
                }
            }
        },
    );

    // --- 2. Smart Header Logic (Fixed & Hide on Scroll) ---
    $window.on("scroll", function () {
        const st = $(this).scrollTop();

        if (st > scrollThreshold) {
            $header.addClass("is-fixed");
            // Hide header when scrolling down, show when scrolling up
            $header.toggleClass("nav-up", st > lastScrollTop);
        } else {
            $header.removeClass("is-fixed nav-up");
        }
        lastScrollTop = st;
    });

    // --- 3. Desktop Navigation (Hover) ---
    function handleDesktopHover() {
        if ($window.width() > 992) {
            $(".has-dropdown, .has-submenu").on(
                "mouseenter mouseleave",
                function (e) {
                    const $menu = $(this).children(".dropdown-menu, .submenu");
                    if (e.type === "mouseenter") {
                        $menu.stop(true, true).slideDown(200);
                    } else {
                        $menu.stop(true, true).slideUp(200);
                    }
                },
            );
        } else {
            $(".has-dropdown, .has-submenu").off("mouseenter mouseleave");
        }
    }

    // --- 4. Mobile Navigation (Click) ---
    $(".menu-icon").on("click", () => $navLinks.addClass("active"));
    $(".close-icon").on("click", () => $navLinks.removeClass("active"));

    $(".mobile-icon").on("click", function () {
        const $icon = $(this);
        const $submenu = $icon.siblings(".dropdown-menu, .submenu");

        $submenu.stop(true, true).slideToggle(300);

        // Toggle Icon state
        const isPlus = $icon.attr("name") === "add-outline";
        $icon.attr("name", isPlus ? "remove-outline" : "add-outline");
    });

    // --- 5. Resize Watcher ---
    $window
        .on("resize", function () {
            if ($window.width() > 992) {
                $navLinks.removeClass("active");
                $(".dropdown-menu, .submenu").removeAttr("style"); // Clear jQuery hide/show
                $(".mobile-icon").attr("name", "add-outline");
            }
            handleDesktopHover();
        })
        .trigger("resize"); // Run once on load
});

// --- 6. Splide Initialization ---
document.addEventListener("DOMContentLoaded", function () {
    const announcementBar = document.querySelector("#announcement-bar");
    if (announcementBar) {
        new Splide(announcementBar, {
            type: "loop",
            drag: "free",
            focus: "center",
            perPage: 1,
            autoplay: true,
            interval: 4000,
            speed: 800,
            arrows: false,
            pagination: false,
        }).mount();
    }
});
