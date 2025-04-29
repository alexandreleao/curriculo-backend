<button id="darkModeToggle" class="absolute top-4 right-4 p-2 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-300">
    <span id="darkModeIcon" class="text-xl"></span>
</button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.getElementById('darkModeToggle');
        const darkModeIcon = document.getElementById('darkModeIcon');

        if (localStorage.getItem('darkMode') === 'enabled') {
            document.documentElement.classList.add('dark');
            darkModeIcon.textContent = '☀️';
        } else {
            darkModeIcon.textContent = '🌙';
        }

        toggleButton.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');

            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('darkMode', 'enabled');
                darkModeIcon.textContent = '☀️';
            } else {
                localStorage.setItem('darkMode', 'disabled');
                darkModeIcon.textContent = '🌙';
            }
        });
    });
</script>
