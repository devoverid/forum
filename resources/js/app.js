(function() {
    // drawer
    let appDrawerState = false;
    const handleAppDrawer = (e) => {
        e.preventDefault()
        appDrawerState = !appDrawerState
        let appDrawer = $('.app-drawer');
        if (appDrawerState) {
            appDrawer.css('right', 0 - appDrawer.width()).removeClass('hidden').animate({ right: 0 });
            $('.app-drawer-bg').fadeIn(1000, () => $(this).removeClass('hidden'));
            $('body').css('overflow', 'hidden');
        } else {
            appDrawer.animate({ right: 0 - appDrawer.width() }, { complete: () => appDrawer.addClass('hidden') });
            $('.app-drawer-bg').fadeOut(500, () => $(this).addClass('hidden'));
            $('body').css('overflow', 'auto');
        }
    }
    $('.app-drawer-bg').on('click', handleAppDrawer);
    $('.app-drawer-btn').on('click', handleAppDrawer);

    // sticky
    $(document).on("scroll", () => {
        const items = document.querySelectorAll('.sticky')
        if (items.length == 0) return
        for (let i = 0; i < items.length; i++) {
            const item = items[i]
            const offset = item.getAttribute('data-sticky-offset') || 50
            if ($(document).scrollTop() >= item.offsetTop - offset) {
                item.style.position = 'sticky'
                item.style.top = offset + 'px'
                item.setAttribute('data-sticky-position', item.style.position)
            } else {
                item.style.position = (item.getAttribute('data-sticky-position') || 'static')
            }
        }
    })

    // reloaded animation
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            $('#app').removeClass('hidden');
            $('.loading').fadeOut();

            // set
            $('.min-h-full').each((index, el) => {
                let outer = $('.footer').height() + $('nav.nav').height();
                let total = $(window).height() - outer;
                $('.min-h-full').css('min-height', total + 'px');
            });
        }, 100)
    });
    $(window).bind('beforeunload', function(e){
        $('#app').addClass('hidden');
        $('.loading').css('display', 'flex');
    });

    // pages
    require('./pages/home');
    require('./pages/discussion')
})();
