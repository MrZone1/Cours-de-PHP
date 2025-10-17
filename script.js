// === Gestion du thème clair/sombre ===

const toggle = document.getElementById("themeToggle");

// Déterminer le thème initial
function initTheme() {
    const saved = localStorage.getItem("theme");
    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    const theme = saved || (prefersDark ? "dark" : "light");
    
    document.documentElement.setAttribute("data-theme", theme);
    updateToggleUI(theme);
}

// Mettre à jour l'interface du toggle
function updateToggleUI(theme) {
    const knob = toggle?.querySelector(".knob");
    if (knob) {
        knob.textContent = theme === "dark" ? "🌙" : "🌞";
    }
    if (toggle) {
        toggle.setAttribute("aria-pressed", theme === "dark");
    }
}

// Basculer le thème
function toggleTheme() {
    const current = document.documentElement.getAttribute("data-theme");
    const nextTheme = current === "dark" ? "light" : "dark";
    
    document.documentElement.setAttribute("data-theme", nextTheme);
    localStorage.setItem("theme", nextTheme);
    updateToggleUI(nextTheme);
}

// Écouteurs d'événements
if (toggle) {
    toggle.addEventListener("click", toggleTheme);
    toggle.addEventListener("keypress", (e) => {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            toggleTheme();
        }
    });
}

// Initialiser le thème au chargement
document.addEventListener("DOMContentLoaded", initTheme);
initTheme();


// === Effets visuels sur les cartes ===

document.addEventListener("mouseover", (e) => {
    if (e.target.classList.contains("list-group-item")) {
        e.target.style.transition = "transform 0.15s ease";
        e.target.style.transform = "scale(1.02)";
    }
});

document.addEventListener("mouseout", (e) => {
    if (e.target.classList.contains("list-group-item")) {
        e.target.style.transform = "scale(1)";
    }
});