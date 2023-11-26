<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="p-6">
        <div>
            <form action="search" method="GET">
                <input type="text" name="client" id="recherche" placeholder="Rechercher un client" class="border border-gray-300 rounded-lg p-2">
            </form>
        </div>
        <div class="flex items-center justify-baseline h-10 border border-sky-500 rounded-lg mb-4">
            <h1 class="text-2xl font-semibold ml-5">Les clients</h1>
        </div>

        <div class="rounded-lg table-fixed w-full p-3 bg-gray-100">
            <table class="min-w-full table-auto border-collapse border border-gray-300 rounded-lg">
                <thead class="border border-sky-500">
                    <tr>
                        <th class="border-0 border-gray-300">ID</th>
                        <th class="border border-gray-300">Nom Prénom</th>
                        <th class="border border-gray-300">Téléphone</th>
                        <th class="border border-gray-300">Email</th>
                        <th class="border border-gray-300">
                            <div class="mt-4">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-full">Créer un client</button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($clients as $client) { ?>
                        <tr>
                            <td class='border border-gray-300'><?=$client->getID()?></td>
                            <td class='border border-gray-300'><?= $client->getNom() . ' ' . $client->getPrenom() ?></td>
                            <td class='border border-gray-300'><?= $client->getTelephone() ?></td>
                            <td class='border border-gray-300'><?= $client->getEmail() ?></td>
                            <td class='border border-gray-300'>
                                <form action="/client/<?=$client->getID()?>">
                                    <input type="hidden" name="id" value="<?= $client->getID() ?>">
                                    <input type="submit" class='bg-blue-500 text-white px-4 py-2 rounded-full' value="Modifier">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="flex flex-row items-center">
            <form action="liste" method="GET">
                <label for="nbLignesParPages">Ligne par page : </label>
                <select name="nbLignesParPages" id="nbLignesParPages" class="appearance-none">
                    <?php
                    if ($nbLignesParPages != 10 && $nbLignesParPages != 20 && $nbLignesParPages != 50 && $nbLignesParPages != 100) { ?>
                        <option selected value="<?= $nbLignesParPages ?>"><?= $nbLignesParPages ?>&#11206;</option>
                    <?php } ?>
                    <option value="10">10 </option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </form>
            <?php
            if ($page != 0) { ?>
                <a href="liste?page=<?= $page - 1 ?>&nbLignesParPages=<?= $nbLignesParPages ?>" class="m-2">
                    < </a>

                    <?php }

                if ($page != $nbPages) {
                    ?>
                        <a href="liste?page=<?= $page + 1 ?>&nbLignesParPages=<?= $nbLignesParPages ?>" class="m-2"> > </a>
                    <?php
                }
                    ?>
        </div>

        <script>
            document.getElementById('nbLignesParPages').addEventListener('change', function() {
                this.form.submit();
            });

            document.getElementById('recherche').addEventListener('change', function() {
                this.form.submit();
            });
        </script>

</body>

</html>