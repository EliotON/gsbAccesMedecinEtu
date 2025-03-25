<?php include('vues/v_header.php'); ?>

<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Tableau de Bord - Statistiques</h1>

    <!-- Section Cartes Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Nombre de Produits -->
        <div class="bg-gradient-to-r from-green-400 to-blue-500 text-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Nombre de Produits</h2>
            <p class="text-4xl font-bold"><?= $nombreProduits ?></p>
        </div>
        <!-- Nombre d'Utilisateurs -->
        <div class="bg-gradient-to-r from-purple-400 to-pink-500 text-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Nombre d'Utilisateurs</h2>
            <p class="text-4xl font-bold"><?= $nombreUsers ?></p>
        </div>
        <!-- Nombre de Logs -->
        <div class="bg-gradient-to-r from-red-400 to-yellow-500 text-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Nombre de Logs</h2>
            <p class="text-4xl font-bold"><?= $logs ?></p>
        </div>
    </div>

    <!-- Section Graphiques -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-6 text-center">Courbes de Statistiques</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Graphique Produits -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <canvas id="chartProduits"></canvas>
            </div>
            <!-- Graphique Utilisateurs -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <canvas id="chartUsers"></canvas>
            </div>
        </div>
    </div>

    <!-- Liste des Produits -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4">Liste des Produits</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white -left border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Objectif</th>
                        <th class="px-4 py-2">Information</th>
                        <th class="px-4 py-2">Effets Indésirables</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $produit): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?= htmlspecialchars($produit['id']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($produit['nom']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($produit['objectif']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($produit['information']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($produit['effetIndesirable']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Intégration des Graphiques avec Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique Produits
    const ctxProduits = document.getElementById('chartProduits').getContext('2d');
    new Chart(ctxProduits, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'], // Exemple de labels mensuels
            datasets: [{
                label: 'Produits Créés',
                data: [10, 15, 20, 25, 30, 35], // Exemple de données
                borderColor: '#4CAF50',
                fill: false,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: { enabled: true }
            }
        }
    });

    // Graphique Utilisateurs
    const ctxUsers = document.getElementById('chartUsers').getContext('2d');
    new Chart(ctxUsers, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'], // Exemple de labels mensuels
            datasets: [{
                label: 'Utilisateurs Inscrits',
                data: [5, 10, 15, 20, 25, 30], // Exemple de données
                borderColor: '#FF5733',
                fill: false,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: { enabled: true }
            }
        }
    });
</script>
