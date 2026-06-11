document.addEventListener('DOMContentLoaded', () => {    
    const card = document.getElementById('authCard');
    const body = document.documentElement;

    // 1. Fixed Create Account Toggle
    function toggleAuth() {
        card.classList.toggle('is-flipped');
    }

    // 2. Theme Toggle Engine
    function toggleTheme() {
        const isDark = body.getAttribute('data-theme') === 'dark';
        const newTheme = isDark ? 'light' : 'dark';
        body.setAttribute('data-theme', newTheme);
        document.getElementById('themeBtn').innerText = isDark ? '🌙 Dark Mode' : '☀️ Light Mode';
    }

    // 3. Form Handling Logic
    /* function handleAction(event, type) {
        event.preventDefault();
        const btn = event.target.querySelector('button');
        const originalText = btn.innerText;
        
        btn.innerText = "Processing...";
        btn.style.opacity = "0.6";

        setTimeout(() => {
            alert(`${type} Successful! Welcome to the platform.`);
            btn.innerText = originalText;
            btn.style.opacity = "1";
        }, 1000);
    } */

    // 4. Apple Pro 3D Tilt Logic
    document.addEventListener('mousemove', (e) => {
        if (window.innerWidth < 768) return;
        const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
        const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
        
        const currentRotation = card.classList.contains('is-flipped') ? 180 : 0;
        card.style.transform = `rotateY(${currentRotation + xAxis}deg) rotateX(${yAxis}deg)`;
    });

    // Reset Tilt
    document.addEventListener('mouseleave', () => {
        const currentRotation = card.classList.contains('is-flipped') ? 180 : 0;
        card.style.transform = `rotateY(${currentRotation}deg) rotateX(0deg)`;
    });
     
});