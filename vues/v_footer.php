<!-- v_footer.php -->
<footer class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50 ">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">
            <div class="flex items-center space-x-4">
                <img 
                    src="https://cdn.discordapp.com/attachments/851277725603463199/1312035303472500757/723BF288-5722-453F-853D-9564C448C1A1.png?ex=675d7c98&is=675c2b18&hm=891c21d7e510664507b077fe90779f6030783de4d75116762ca447b93e830c89&" 
                    alt="GSB Logo" 
                    class="h-12 w-12 rounded-full"
                >
                <div>
                    <p class="text-sm font-semibold">&copy; <?php echo date('Y'); ?> GSB</p>
                    <p class="text-xs text-gray-400">Tous droits réservés</p>
                </div>
            </div>

            <nav>
                <ul class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                    <li>
                        <a href="vues/v_politiqueprotectiondonnees.php" class="text-gray-700 hover:text-blue-600 transition-colors px-3 py-2 rounded-lg hover:bg-blue-50">
                            Politique de protection des données
                        </a>
                    </li>
                    <?php if (estConnecte()): ?>
                        <li>
                            <a href="index.php?uc=droits&action=portabilites" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 text-sm">
                                Mes données
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</footer>
</body>
</html>
