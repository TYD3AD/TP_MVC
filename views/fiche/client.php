<?php /* var_dump($adresses); die() */ ?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/style/main.css">
</head>

<body class="bg-slate-300">
    <div class="w-9/12">


        <div>
            <h4 class="font-bold p-1 border rounded w-50 m-2">Client / <?= $infos->prenom . ' ' . $infos->nom ?> / Informations</h4>
        </div>

        <div class="bg-gray-100 rounded w-50">
            <h4 class="font-bold mb-2 p-2">Données générales</h4>

            <div class="flex flex-row ">
                <div class="bg-gray-200 m-1 rounded p-2">
                    <p class="font-bold">Nom</p>
                    <p><?= $infos->nom ?></p>
                </div>
                <div class="bg-gray-200 m-1 rounded p-2">
                    <p class="font-bold">Prénom</p>
                    <p><?= $infos->prenom ?></p>
                </div>
                <div class="bg-gray-200 m-1 rounded p-2">
                    <p class="font-bold">Téléphone</p>
                    <p><?= $infos->telephone ?></p>
                </div>
                <div class="bg-gray-200 m-1 rounded p-2">
                    <p class="font-bold">Email</p>
                    <p><?= $infos->email ?></p>
                </div>
            </div>
        </div>

        <h4 class="font-bold p-1 border rounded w-50 m-2">Les produits</h4>

        <div class="w-full">
            <table>
                <thead>
                    <tr class="bg-gray-300">
                        <th class="w-40 p-2">Id</th>
                        <th class="w-40 p-2">Nom</th>
                        <th class="flex-grow p-2">Description</th>
                        <th class="w-40 p-2">Prix</th>
                        <th class="w-40 p-2">Créé le</th>
                        <th class="w-40 p-2 bg-green-200"><a href="/commander?id=<?=$infos->id?>">+ Commander</a></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($produits as $produit) { ?>
                        <tr>
                            <td><?= $produit->id ?></td>
                            <td><?= $produit->nom ?></td>
                            <td><?= $produit->description ?></td>
                            <td><?= $produit->prix ?></td>
                            <td><?= $produit->date ?></td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>

        <h4 class="font-bold p-1 border rounded w-50 m-2">Les adresses</h4>

        <div class="w-9/12">
            <table>
                <thead>
                    <tr>
                        <th class="w-3/12 p-2">Nom</th>
                        <th class="flex-grow p-2">Rue</th>
                        <th class="w-3/12 p-2">Code postal</th>
                        <th class="w-3/12 p-2">Ville</th>
                        <th class="w-3/12 p-2 bg-green-200"><a href="/adresse?id=<?=$infos->id?>">+ Ajouter</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($adresses as $adresse) { ?>
                        <tr>
                            <td><?= $adresse->nom ?></td>
                            <td><?= $adresse->rue ?></td>
                            <td><?= $adresse->codePostal ?></td>
                            <td><?= $adresse->ville ?></td>
                            <td><a href="/supprimer?id=<?= $adresse->id ?>">Supprimer</a></td>
                        </tr>
                    <?php
                    }
                    ?>
            </table>

        </div>
    </div>
</body>