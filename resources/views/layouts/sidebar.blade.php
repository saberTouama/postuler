<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Responsive</title>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('sidebar', () => ({
                isOpen: false, // État de la sidebar (ouverte/fermée)
                toggleSidebar() {
                    this.isOpen = !this.isOpen;
                }
            }));
        });
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">
    <div x-data="sidebar" class="flex">
        <!-- Sidebar -->
        <div
            :class="{ '-translate-x-full': !isOpen, 'translate-x-0': isOpen }"
            class="fixed inset-y-0 left-0 w-64 bg-blue-800 text-white transition-transform duration-300 ease-in-out transform lg:translate-x-0 lg:static lg:inset-0"
        >
            <div class="p-4">
                <h2 class="text-2xl font-bold">Sidebar</h2>
                <nav class="mt-4">
                    <a href="#" class="block py-2 hover:bg-blue-700">Accueil</a>
                    <a href="#" class="block py-2 hover:bg-blue-700">Profil</a>
                    <a href="#" class="block py-2 hover:bg-blue-700">Paramètres</a>
                    <a href="#" class="block py-2 hover:bg-blue-700">Aide</a>
                </nav>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1">
            <!-- Bouton pour ouvrir/fermer la sidebar (visible uniquement sur les petits écrans) -->
            <button
                @click="toggleSidebar"
                class="fixed top-4 left-4 p-2 bg-blue-800 text-white rounded-lg lg:hidden"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Contenu -->
            <div class="p-4">
                <h1 class="text-2xl font-bold">Contenu Principal</h1>
                <p class="mt-4">Ceci est un exemple de contenu principal. La sidebar est responsive et s'adapte à la taille de l'écran.</p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
    Alpine.data('sidebar', () => ({
        isOpen: false, // État initial de la sidebar
        toggleSidebar() {
            this.isOpen = !this.isOpen; // Bascule l'état
        }
    }));
});
    </script>
</body>
</html>
