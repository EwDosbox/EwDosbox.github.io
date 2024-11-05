OnStart();

function OnStart() {
    BackgroundSlideshow();
}

function BackgroundSlideshow() {
    let element = document.querySelector('#hero-container-slideshow');
    const backgrounds = [
        'https://ewdosbox.github.io/images/fraid1.png',
        'https://ewdosbox.github.io/images/fraid2.png',
        'https://ewdosbox.github.io/images/PlatBorne1.png',
        'https://ewdosbox.github.io/images/PlatBorne2.png',
        'https://ewdosbox.github.io/images/PlatBorne3.png'
    ];

    let currentIndex = 0;

    function changeBackground() {
        element.style.backgroundImage = `url('${backgrounds[currentIndex]}')`;
        currentIndex = (currentIndex + 1) % backgrounds.length; // Loop back to the first image
    }

    setInterval(changeBackground, 2000);
}