<div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center">Entrez votre code de vérification</h2>
        <form id="verification-form" method="POST" action="index.php?action=valideCode">
            <div class="mb-4">
                <label for="code_verification" class="block text-sm font-medium text-gray-700">Code de vérification</label>
                <input type="text" id="code_verification" name="code_verification" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Valider</button>
            </div>
        </form>
    </div>
</div>
