OnStart();

function OnStart() {
    BackgroundSlideshow();
}

function BackgroundSlideshow() {
    let element = document.querySelector('#hero-container-slideshow');
    const backgrounds = [
        'https://ewdosbox.github.io/images/fraid1.jpg',
        'https://ewdosbox.github.io/images/fraid2.jpg',
        'https://ewdosbox.github.io/images/PlatBorne1.jpg',
        'https://ewdosbox.github.io/images/PlatBorne2.jpg',
        'https://ewdosbox.github.io/images/PlatBorne3.jpg'
    ];

    let currentIndex = 0;

    function changeBackground() {
        element.style.backgroundImage = backgrounds[currentIndex];
        currentIndex = (currentIndex + 1) % backgrounds.length; // Loop back to the first image
    }

    setInterval(changeBackground, 2000);
}