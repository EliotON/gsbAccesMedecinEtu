<!-- v_gestionproduits -->
<?php
include('vues/v_header.php');
?>

  <style>
    .modal {
      transition: opacity 0.25s ease;
    }

    .modal-background {
  background-color: rgba(0, 0, 0, 0.8);
  bottom: 0;
  left: 0;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 30;
  display: flex; /* Ajouté pour centrer le contenu */
  justify-content: center; /* Centrage horizontal */
  align-items: center; /* Centrage vertical */
  animation: fadeIn 0.5s ease-out forwards;
}


    .modal-content {
      background-color: white;
      border-radius: 0.5rem;
      margin: 0 1rem;
      max-width: 500px;
      padding: 1.5rem;
      position: relative;
      top: 50%;
      transform: translateY(-50%);
      width: 100%;
      animation: zoomIn 0.5s ease-out forwards;
    }

    .modal-close {
      background-color: transparent;
      border: none;
      cursor: pointer;
      font-size: 1.5rem;
      position: absolute;
      right: 1rem;
      top: 1rem;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    @keyframes zoomIn {
      0% {
        transform: translateY(-50%) scale(0.95);
      }
      100% {
        transform: translateY(-50%) scale(1);
      }
    }
  </style>
</head>
<body class="bg-gray-100 font-sans">
  <div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Gestion des Produits</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Produits Existants</h2>
        <button type="button" id="btn-add-product" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg">Ajouter un produit</button>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full table-auto">
          <thead>
            <tr class="bg-gray-200">
              <th class="px-4 py-2 text-left">ID</th>
              <th class="px-4 py-2 text-left">Nom</th>
              <th class="px-4 py-2 text-left">Objectif</th>
              <th class="px-4 py-2 text-left">Information</th>
              <th class="px-4 py-2 text-left">Effet Indésirable</th>
              <th class="px-4 py-2 text-left">Images</th>
              <th class="px-4 py-2 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $produits = PdoGsb::getPdoGsb()->getProduits();
            foreach ($produits as $produit) {
              echo '<tr class="border-b">';
              echo '<form method="post" enctype="multipart/form-data">';
              echo '<td class="px-4 py-2">' . htmlspecialchars($produit['id']) . '</td>';
              echo '<td class="px-4 py-2"><input type="text" name="nom2" value="' . htmlspecialchars($produit['nom']) . '" class="border border-gray-300 rounded-lg px-2 py-1 w-full"></td>';
              echo '<td class="px-4 py-2"><input type="text" name="objectif2" value="' . htmlspecialchars($produit['objectif']) . '" class="border border-gray-300 rounded-lg px-2 py-1 w-full"></td>';
              echo '<td class="px-4 py-2"><textarea name="information2" class="border border-gray-300 rounded-lg px-2 py-1 w-full h-16">' . htmlspecialchars($produit['information']) . '</textarea></td>';
              echo '<td class="px-4 py-2"><textarea name="effetIndesirable2" class="border border-gray-300 rounded-lg px-2 py-1 w-full h-16">' . htmlspecialchars($produit['effetIndesirable']) . '</textarea></td>';
              
              $imagePath = 'images/produits/' . htmlspecialchars($produit['id']) . '.png';
              if (file_exists($imagePath)) {
                echo '<td class="px-4 py-2"><img src="' . $imagePath . '" alt="Image du produit" class="w-16 h-16 object-cover rounded-lg">';
                echo '<label for="image" class="block font-medium mt-2">Changer l\'image :</label>';
              } else {
                echo '<td class="px-4 py-2">Pas d\'image<br>';
                echo '<label for="image" class="block font-medium mt-2">Ajouter une image :</label>';
              }
              echo '<input type="file" name="image" class="border border-gray-300 rounded-lg px-2 py-1 w-full"></td>';
              
              echo '<td class="px-4 py-2">';
              echo '<input type="hidden" name="id" value="' . htmlspecialchars($produit['id']) . '">';
              echo '<button type="submit" name="action" value="modifier" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg mr-2">Modifier</button>';
              echo '<button type="submit" name="action" value="supprimer" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce produit ?\');">Supprimer</button>';
              echo '</td>';
              echo '</form>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Formulaire d'ajout de produit en modal -->
    <div id="add-product-modal" class="modal hidden">
      <div class="modal-background">
        <div class="modal-content">
          <button type="button" id="btn-close-modal" class="modal-close">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <h2 class="text-2xl font-bold mb-4">Ajouter un Produit</h2>
          <form method="POST" action="" enctype="multipart/form-data" class="grid grid-cols-1 gap-4">
            <input type="hidden" name="action" value="ajouter">
            <div>
              <label for="nom" class="block font-medium mb-1">Nom du produit :</label>
              <input type="text" name="nom" required class="border border-gray-300 rounded-lg px-4 py-2 w-full">
            </div>
            <div>
              <label for="objectif" class="block font-medium mb-1">Objectif :</label>
              <input type="text" name="objectif" required class="border border-gray-300 rounded-lg px-4 py-2 w-full">
            </div>
            <div>
              <label for="information" class="block font-medium mb-1">Information :</label>
              <textarea name="information" required class="border border-gray-300 rounded-lg px-4 py-2 w-full h-24"></textarea>
            </div>
            <div>
              <label for="effetIndesirable" class="block font-medium mb-1">Effet indésirable :</label>
              <textarea name="effetIndesirable" required class="border border-gray-300 rounded-lg px-4 py-2 w-full h-24"></textarea>
            </div>
            <div>
              <label for="image" class="block font-medium mb-1">Image du produit :</label>
              <input type="file" name="image" class="border border-gray-300 rounded-lg px-4 py-2 w-full">
            </div>
            <div class="flex justify-end">
              <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg">Ajouter le produit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Overlay lorsque le modal est ouvert -->
    <div id="overlay" class="fixed z-0 inset-0 bg-gray-800 opacity-50 hidden"></div>

    <script>
      document.getElementById('btn-add-product').addEventListener('click', function() {
        document.getElementById('add-product-modal').classList.remove('hidden');
        document.getElementById('overlay').classList.remove('hidden');
      });

      document.getElementById('btn-close-modal').addEventListener('click', function() {
        document.getElementById('add-product-modal').classList.add('hidden');
        document.getElementById('overlay').classList.add('hidden');
      });
    </script>
  </div>
</body>
