<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB - extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gradient-to-br from-blue-100 to-white">
<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md">    
    <div class="relative w-full max-w-md mx-auto">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden transform transition-all duration-300 hover:scale-105">
            <div class="px-8 py-10 bg-gradient-to-r from-blue-500 to-blue-600">
                <div class="flex justify-center mb-6">
                    <img 
                        src="https://cdn.discordapp.com/attachments/851277725603463199/1312035303472500757/723BF288-5722-453F-853D-9564C448C1A1.png?ex=675d7c98&is=675c2b18&hm=891c21d7e510664507b077fe90779f6030783de4d75116762ca447b93e830c89&" 
                        alt="GSB Logo" 
                        class="h-20 w-20 rounded-full border-4 border-white shadow-lg"
                    >
                </div>
                <h2 class="text-3xl font-bold text-center text-white mb-2">Créer un compte</h2>
                <p class="text-center text-blue-100 mb-6">Espace réservé aux médecins</p>
            </div>
            
            <form method="post" action="index.php?uc=creation&action=valideCreation" class="p-8 space-y-6">
                <div class="space-y-4">
                    <input 
                        name="login" 
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300" 
                        type="email" 
                        placeholder="Email professionnel"
                        required
                    >
                    <input 
                        name="mdp" 
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300" 
                        type="password" 
                        placeholder="Mot de passe"
                        required
                    >
                    <div class="flex space-x-4">
                        <input 
                            name="prénom" 
                            class="w-1/2 p-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300" 
                            type="text" 
                            placeholder="Prénom"
                            required
                        >
                        <input 
                            name="nom" 
                            class="w-1/2 p-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300" 
                            type="text" 
                            placeholder="Nom"
                            required
                        >
                    </div>
                </div>

                <div class="flex items-center">
                    <input 
                        id="accept-policy" 
                        name="accept_policy" 
                        type="checkbox" 
                        class="mr-3 h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        required
                    >
                    <label for="accept-policy" class="text-sm text-gray-700">
                        J'ai lu et accepté la <a href="vues/v_politiqueprotectiondonnees.php" class="text-blue-600 hover:underline">politique de protection des données</a>
                    </label>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                >
                    Créer mon compte
                </button>
            </form>
            
            <div class="px-8 pb-8 text-center">
                <p class="text-sm text-gray-500">
                    Vous avez déjà un compte ? 
                    <a href="index.php?uc=connexion" class="text-blue-600 hover:underline">Connectez-vous</a>
                </p>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>