<?php
include('vues/v_header.php');
?>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg max-w-md w-full p-6 space-y-6">
        <h1 class="text-3xl font-bold text-blue-600 text-center">Gérez vos données</h1>
        <p class="text-gray-700 text-center">
            Conformément au RGPD, vous avez le droit de télécharger, archiver ou supprimer vos données personnelles.
        </p>
        <div class="space-y-6">

            <!-- Form to trigger data download -->
            <form method="POST" action="index.php?uc=droits&action=telechargerDonnees">
                <div class="flex items-center space-x-3">
                    <input type="checkbox" name="exporter" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="exporter" class="text-gray-600">Je comprends que mes données seront téléchargées.</label>
                </div>
                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg w-full font-semibold hover:bg-blue-700 transition" type="submit">Télécharger mes données</button>
            </form>

            <!-- Form to request data deletion -->
            <form method="POST" action="index.php?uc=droits&action=supprimerDonnees">
                <div class="flex items-center space-x-3">
                    <input type="checkbox" name="supprimer" value="1" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                    <label for="supprimer" class="text-gray-600">Je confirme vouloir supprimer toutes mes données personnelles.</label>
                </div>
                <button class="bg-red-600 text-white px-6 py-2 rounded-lg w-full font-semibold hover:bg-red-700 transition" type="submit">Supprimer mes données</button>
            </form>

            <!-- Form to request data archiving -->
            <form method="POST" action="index.php?uc=droits&action=archiverDonnees">
                <div class="flex items-center space-x-3">
                    <input type="checkbox" name="archiver" value="1" class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded">
                    <label for="archiver" class="text-gray-600">Je souhaite archiver mes données personnelles pour consultation ultérieure.</label>
                </div>
                <button class="bg-yellow-600 text-white px-6 py-2 rounded-lg w-full font-semibold hover:bg-yellow-700 transition" type="submit">Archiver mes données</button>
            </form>

        </div>
        <p class="text-sm text-gray-500 text-center">
            Pour plus d'informations, consultez notre <a href="v_politiqueprotectiondonnees.php" class="text-blue-500 underline">Politique de confidentialité</a>.
        </p>
    </div>
</div>
