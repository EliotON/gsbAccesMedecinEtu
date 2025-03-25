<?php include('vues/v_header.php'); ?>

<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Panneau d'administration</h1>

    <div class="text-center mb-6">
        <p class="text-lg">
            <span class="font-medium">État actuel de la maintenance :</span>
            <span class="px-3 py-1 rounded-full text-white <?= $etatMaintenance ? 'bg-green-500' : 'bg-red-500' ?>">
                <?= $etatMaintenance ? 'Activé' : 'Désactivé' ?>
            </span>
        </p>
    </div>

    <div class="flex justify-center">
        <form action="index.php?uc=adminpanel" method="POST">
            <button 
                type="submit" 
                name="action" 
                value="<?= $etatMaintenance ? 'desactiver' : 'activer' ?>" 
                class="px-6 py-3 rounded-lg text-white font-bold transition duration-300 
                       <?= $etatMaintenance ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' ?>">
                <?= $etatMaintenance ? 'Désactiver la maintenance' : 'Activer la maintenance' ?>
            </button>
        </form>
    </div>
</div>
