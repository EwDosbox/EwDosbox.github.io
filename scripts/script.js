OnStart();

function OnStart() {
    BackgroundSlideshow();
}
function BackgroundSlideshow() {
    let element = document.querySelector('#hero-container-slideshow');
    const backgrounds = [
        './images/fraid1.png',
        './images/fraid2.png',
        './images/PlatBorne1.png',
        './images/PlatBorne2.png',
        './images/PlatBorne3.png'
    ];

    let currentIndex = 0;

    function changeBackground() {
        element.style.backgroundImage = `url('${backgrounds[currentIndex]}')`;
        currentIndex = (currentIndex + 1) % backgrounds.length; // Loop back to the first image
    }

    setInterval(changeBackground, 2000);

    // Apply CSS based on window width
    function applyResponsiveStyles() {
        if (window.innerWidth < 968) {
            element.style.backgroundSize = 'auto';
            element.style.backgroundPosition = 'center';
        } else {
            element.style.backgroundSize = 'cover';
            element.style.backgroundPosition = 'center';
        }
    }

    // Initial call
    applyResponsiveStyles();

    // Update styles on window resize
    window.addEventListener('resize', applyResponsiveStyles);
}
