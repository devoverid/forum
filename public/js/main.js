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
        let sticky = $('.sticky')
        let offset = 50;
        if (sticky.length == 0) return 
        if( $(document).scrollTop() >= sticky.offset().top - offset ) {
            sticky.css({ position: 'sticky', top: offset })
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
        }, 1000)
    });
    $(window).bind('beforeunload', function(){
        $('#app').addClass('hidden');
        $('.loading').css('display', 'flex');
    }); 
})();