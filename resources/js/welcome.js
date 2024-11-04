function showMore() {
    document.getElementById('moreInfo').style.display = 'block';
}

function hideMore() {
    document.getElementById('moreInfo').style.display = 'none';
}

// Generar partículas de fondo
document.addEventListener("DOMContentLoaded", () => {
    const backgroundAnimation = document.querySelector(".background-animation");
    const numParticles = 50; // Ajusta el número de partículas

    for (let i = 0; i < numParticles; i++) {
        const particle = document.createElement("div");
        particle.classList.add("particle");
        
        // Posición inicial aleatoria
        particle.style.left = `${Math.random() * 100}vw`;
        particle.style.top = `${Math.random() * 100}vh`;
        
        // Tamaño aleatorio de las partículas
        const size = Math.random() * 8 + 4; // Tamaño entre 4px y 12px
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        
        // Duración de animación aleatoria
        particle.style.animationDuration = `${Math.random() * 8 + 5}s`;
        
        backgroundAnimation.appendChild(particle);
    }
});
