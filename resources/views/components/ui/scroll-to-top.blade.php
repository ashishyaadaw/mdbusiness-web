<button 
    id="scrollToTop" 
    class="fixed bottom-8 right-8 z-50 p-4 rounded-full bg-blue-600 text-white shadow-lg cursor-pointer transition-all duration-300 translate-y-20 opacity-0 hover:bg-blue-700 hover:scale-110 active:scale-95 focus:outline-none"
    title="Go to top"
>
    <ion-icon name="arrow-up-outline" class="text-2xl block"></ion-icon>
</button>

@push('script')
<script>
    $(document).ready(function() {
        const $btn = $('#scrollToTop');

        // 1. Show/Hide button based on scroll position
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 300) {
                // Show button: slide up and fade in
                $btn.removeClass('translate-y-20 opacity-0').addClass('translate-y-0 opacity-100');
            } else {
                // Hide button: slide down and fade out
                $btn.removeClass('translate-y-0 opacity-100').addClass('translate-y-20 opacity-0');
            }
        });

        // 2. Smooth Scroll to top on click
        $btn.on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 600); // 600ms for a smooth, natural feel
            return false;
        });
    });
</script>
@endpush