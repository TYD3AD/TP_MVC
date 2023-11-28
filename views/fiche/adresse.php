<form action="/adresse?id=<?=$id?>" method="POST" class="flex flex-col">
    <div class="flex flex-row ">
        <div class="bg-gray-200 m-1 rounded p-2">
            <p class="font-bold">Nom</p>
            <input type="text" name="nom" required>
        </div>
        <div class="bg-gray-200 m-1 rounded p-2">
            <p class="font-bold">Rue</p>
            <input type="text" name="rue" required>
        </div>
        <div class="bg-gray-200 m-1 rounded p-2">
            <p class="font-bold">Code Postal</p>
            <input type="text" name="codePostal" required>
        </div>
        <div class="bg-gray-200 m-1 rounded p-2">
            <p class="font-bold">Ville</p>
            <input type="text" name="ville" required>
        </div>
        <div class="bg-gray-200 m-1 rounded p-2">
            <p class="font-bold">Envoyer</p>
            <input type="submit" value="Envoyer">
        </div>
</form>