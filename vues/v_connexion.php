

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
                <h2 class="text-3xl font-bold text-center text-white mb-2">Connexion</h2>
                <p class="text-center text-blue-100 mb-6">Espace réservé aux médecins</p>
            </div>
            
            <form method="post" action="index.php?uc=connexion&action=valideConnexion" class="p-8 space-y-6">
                <div class="space-y-4">
                    <input 
                        name="login" 
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300" 
                        type="text" 
                        placeholder="Login"
                        required
                    >
                    <input 
                        name="mdp" 
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300" 
                        type="password" 
                        placeholder="Mot de passe"
                        
                    >
                    <div class="text-center text-red-700 font-bold">
                        Phase de développement : pas de mot de passe requis
                    </div>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                >
                    Se connecter
                </button>
            </form>
            
            <div class="px-8 pb-8 text-center">
                <p class="text-sm text-gray-500">
                    Vous n'avez pas de compte ? 
                    <a href="index.php?uc=creation&action=demandeCreation" class="text-blue-600 hover:underline">
                        Créer un compte médecin
                    </a>
                </p>
            </div>
        </div>
        </div>
    </div>
</div>

