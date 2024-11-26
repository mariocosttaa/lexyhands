// Theme handling function
function setTheme(theme) {
    document.documentElement.setAttribute('data-bs-theme', theme);
    document.body.setAttribute('data-bs-theme', theme);
    document.body.style.backgroundColor = theme === 'dark' ? 'var(--dark-bg)' : 'var(--light-bg)';
    
    const themeSwitch = document.getElementById('themeSwitch');
    themeSwitch.innerHTML = theme === 'dark' ? 
        '<i class="bi bi-moon-stars fs-4"></i>' : 
        '<i class="bi bi-sun fs-4"></i>';
}

// Initialize theme based on system preference or default to light
function initializeTheme() {
    const storedTheme = localStorage.getItem('preferred-theme');
    
    if (storedTheme) {
        setTheme(storedTheme);
    } else {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            setTheme('dark');
        } else {
            setTheme('light');
        }
    }
}

// Call initializeTheme immediately when script loads
initializeTheme();

// Theme Switcher click handler
document.getElementById('themeSwitch').addEventListener('click', function() {
    const currentTheme = document.body.getAttribute('data-bs-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    setTheme(newTheme);
    localStorage.setItem('preferred-theme', newTheme);
});

// Listen for system theme changes
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
    if (!localStorage.getItem('preferred-theme')) {
        setTheme(event.matches ? 'dark' : 'light');
    }
});

// Mobile menu handling
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const closeSidebar = document.getElementById('closeSidebar');

    function toggleSidebar(event) {
        event.preventDefault();
        event.stopPropagation();
        sidebar.classList.toggle('active');
        
        // Overlay handling
        if (sidebar.classList.contains('active')) {
            const overlay = document.createElement('div');
            overlay.classList.add('sidebar-overlay');
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
            overlay.style.zIndex = '1040';
            document.body.appendChild(overlay);
            
            // Close sidebar when clicking overlay
            overlay.addEventListener('click', closeSidebarFunction);
        } else {
            removeOverlay();
        }
    }

    function closeSidebarFunction() {
        sidebar.classList.remove('active');
        removeOverlay();
    }

    function removeOverlay() {
        const overlay = document.querySelector('.sidebar-overlay');
        if (overlay) {
            overlay.remove();
        }
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }

    if (closeSidebar) {
        closeSidebar.addEventListener('click', closeSidebarFunction);
    }

    // Remove overlay and reset sidebar on window resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            closeSidebarFunction();
        }
    });
});




    // Traffic Chart
const trafficChart = new Chart(document.getElementById('trafficChart'), {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Website Traffic',
            data: [30, 45, 35, 50, 40, 60],
            borderColor: '#5c6bc0',
            tension: 0.4,
            fill: true,
            backgroundColor: 'rgba(92, 107, 192, 0.1)'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});



// User Distribution Chart
const userChart = new Chart(document.getElementById('userChart'), {
    type: 'doughnut',
    data: {
        labels: ['Desktop', 'Mobile', 'Tablet'],
        datasets: [{
            data: [55, 35, 10],
            backgroundColor: ['#5c6bc0', '#7986cb', '#9fa8da']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});