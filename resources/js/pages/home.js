document.addEventListener('DOMContentLoaded', main);
function main() {
    // home
    if (document.querySelector('section.hero')) {
        document.addEventListener('mousemove', function (e) {
            document.querySelectorAll('section.hero .layer').forEach(el => {
                const speed = el.getAttribute('data-speed');
                const direction = el.getAttribute('data-direction');
                let applyX = true
                let applyY = true
                if (direction == 'x') applyY = false
                if (direction == 'y') applyX = false
                let x = 0
                let y = 0
                if (applyX) {
                    x = ((window.innerWidth - e.pageX * speed) / 100) + 30;
                }
                if (applyY) {
                    y = ((window.innerHeight - e.pageY * speed) / 100) + 30;
                }
                el.style.transform = `translateX(${x}px) translateY(${y}px)`;
            });
        });
    }
}
