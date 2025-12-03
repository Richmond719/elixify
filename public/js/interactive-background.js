// Vanta.js Globe Background - Black and White Theme
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('background-canvas');
    if (!canvas) return;

    // Load Three.js first
    const script1 = document.createElement('script');
    script1.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js';
    script1.onload = () => {
        // Then load Vanta.js Globe
        const script2 = document.createElement('script');
        script2.src = 'https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.globe.min.js';
        script2.onload = () => {
            // Initialize Vanta Globe with black lines and white background
            if (typeof VANTA !== 'undefined') {
                VANTA.GLOBE({
                    el: '#background-canvas',
                    mouseControls: true,
                    touchControls: true,
                    gyroControls: false,
                    minHeight: window.innerHeight,
                    minWidth: window.innerWidth,
                    scale: 1.0,
                    scaleMobile: 1.0,
                    color: 0x000000,
                    color2: 0x000000,
                    backgroundColor: 0xffffff,
                    wireframe: false,
                    xyFactor: 100,
                    zFactor: 75,
                    size: 0.8,
                    speed: 0.4,
                    spacing: 15.0
                });
            }
        };
        document.head.appendChild(script2);
    };
    document.head.appendChild(script1);
});
