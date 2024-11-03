OnStart();

function OnStart() {
    BackgroundSlideshow();
}

function BackgroundSlideshow() {
    let element = document.querySelector('#hero-container-slideshow');
    const backgrounds = [
        'url(images/hero_bg/hero_bg_1.jpg)',
        'url(images/hero_bg/hero_bg_2.jpg)',
        'url(images/hero_bg/hero_bg_3.jpg)',
        'url(images/hero_bg/hero_bg_4.jpg)',
        'url(images/hero_bg/hero_bg_5.jpg)'
    ];

    let currentIndex = 0;

    function changeBackground() {
        element.style.backgroundImage = backgrounds[currentIndex];
        currentIndex = (currentIndex + 1) % backgrounds.length; // Loop back to the first image
    }

    setInterval(changeBackground, 2000);
}