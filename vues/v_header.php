

<?php
if (!$_SESSION['id']) {
    header('Location: ../index.php');
    exit();
} else {
?>



<!-- Navbar -->
<nav class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img 
                src="https://cdn.discordapp.com/attachments/851277725603463199/1312035303472500757/723BF288-5722-453F-853D-9564C448C1A1.png?ex=675d7c98&is=675c2b18&hm=891c21d7e510664507b077fe90779f6030783de4d75116762ca447b93e830c89&" 
                alt="GSB Logo" 
                class="h-12 w-12 rounded-full object-cover border-2 border-blue-500"
            >
            <a href="index.php?uc=accueil" class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition-colors">
                GSB
            </a>
        </div>

        <div class="hidden lg:flex items-center space-x-6">
            <?php if (isset($_SESSION['permission_id']) && $_SESSION['permission_id'] == 2): ?>
                <a href="index.php?uc=gestionproduits" class="text-gray-700 hover:text-blue-600 transition-colors px-3 py-2 rounded-lg hover:bg-blue-50">
                    Gestion des produits
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['permission_id']) && $_SESSION['permission_id'] == 3): ?>
                <a href="index.php?uc=adminpanel" class="text-gray-700 hover:text-blue-600 transition-colors px-3 py-2 rounded-lg hover:bg-blue-50">
                    Admin Panel
                </a>
                <a href="index.php?uc=gestionlogs" class="text-gray-700 hover:text-blue-600 transition-colors px-3 py-2 rounded-lg hover:bg-blue-50">
                    Logs Panel
                </a>
                <a href="index.php?uc=stats" class="text-gray-700 hover:text-blue-600 transition-colors px-3 py-2 rounded-lg hover:bg-blue-50">
                    Stats
                </a>
            <?php endif; ?>

            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <div class="font-semibold text-gray-800">
                        <?php echo htmlspecialchars($_SESSION['prenom']." ".$_SESSION['nom']); ?>
                    </div>
                    <div class="text-sm text-gray-500">Médecin</div>
                </div>

                <a href="index.php?uc=deconnexion&action=deconnexion" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition-colors flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Déconnexion</span>
                </a>
            </div>
        </div>

        <div class="lg:hidden">
            <button class="text-gray-700 hover:text-blue-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- Menu mobile caché par défaut, affiché en cliquant sur le bouton burger -->
<div id="mobile-menu" class="hidden lg:hidden bg-gray-800 text-white p-4 space-y-4 animate__animated animate__fadeIn">

    <!-- Lien vers gestion des visios, visible uniquement si permission_id == 2 -->
    <?php if (isset($_SESSION['permission_id']) && $_SESSION['permission_id'] == 2): ?>
        <a href="index.php?uc=gestionproduits" class="block px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Gestion des produits</a>
    <?php endif; ?>

    <!-- Lien vers le panneau d'administration, visible uniquement si permission_id == 3 -->
    <?php if (isset($_SESSION['permission_id']) && $_SESSION['permission_id'] == 3): ?>
        <a href="index.php?uc=adminpanel" class="block px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Admin Panel</a>
        <a href="index.php?uc=gestionlogs" class="block px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Logs Panel</a>
        <a href="index.php?uc=stats" class="block px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Stats</a>


    <?php endif; ?>

    <a href="index.php?uc=deconnexion&action=deconnexion" class="ml-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full transform transition duration-300 hover:scale-105">
    Déconnexion
</a>
</div>


<!-- Menu mobile caché par défaut, affiché en cliquant sur le bouton burger -->
<div id="mobile-menu" class="hidden lg:hidden bg-gray-800 text-white p-4 space-y-4 animate__animated animate__fadeIn">
    <a href="index.php?uc=etatFrais&action=selectionnerMois" class="block px-4 py-2 rounded hover:bg-gray-700 transition duration-300">M'inscrire à une visio</a>
    <?php if ($isChefProduit): ?>
        <a href="index.php?uc=gestionproduits" class="block px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Gestion des produits</a>
    <?php endif; ?>
    <?php if (isset($_SESSION['permission_id']) && $_SESSION['permission_id'] == 3): ?>
        <a href="index.php?uc=adminpanel" class="block px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Admin Panel</a>
        <a href="index.php?uc=gestionlogs" class="block px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Logs Panel</a>
        <a href="index.php?uc=stats" class="block px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Stats</a>


    <?php endif; ?>
    <a href="index.php?uc=deconnexion&action=deconnexion" class="ml-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full transform transition duration-300 hover:scale-105">
    Déconnexion
</a>
</div>



<?php
}; // Ferme la condition de session
?>