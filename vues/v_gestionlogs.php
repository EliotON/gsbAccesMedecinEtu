
<?php
 include('vues/v_header.php');
 ?>
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Gestion des Logs</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">ID Produit</th>
                        <th class="px-4 py-2 text-left">Type d'Opération</th>
                        <th class="px-4 py-2 text-left">Compte</th>
                        <th class="px-4 py-2 text-left">IP Address</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($logs as $log) {
                        echo '<tr class="border-b">';
                        echo '<td class="px-4 py-2">' . htmlspecialchars($log['produit_id']) . '</td>';
                        echo '<td class="px-4 py-2">' . htmlspecialchars($log['operation_type']) . '</td>';
                        echo '<td class="px-4 py-2">' . htmlspecialchars($log['compte']) . '</td>';
                        echo '<td class="px-4 py-2">' . htmlspecialchars($log['ip_address']) . '</td>';
                        echo '<td class="px-4 py-2">' . htmlspecialchars($log['description']) . '</td>';
                        echo '<td class="px-4 py-2">' . htmlspecialchars($log['operation_date']) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between mt-4">
        <div>
            <!-- Affichage du numéro de la page actuelle et du nombre total de pages -->
            <span>Page <?= $currentPage ?> sur <?= $totalPages ?></span>
        </div>
        <div>
            <!-- Liens de navigation pour changer de page -->
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>" class="text-blue-500 hover:text-blue-700">Précédente</a>
            <?php endif; ?>
            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>" class="text-blue-500 hover:text-blue-700">Suivante</a>
            <?php endif; ?>
        </div>
    </div>
</div>
