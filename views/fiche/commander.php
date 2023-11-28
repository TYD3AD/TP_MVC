<form action="/commander?id=<?=$id?>" method="POST" class="flex flex-col">
    <div class="flex flex-row ">
        <div class="bg-gray-200 m-1 rounded p-2">
            <p class="font-bold">Nom</p>
            <input type="text" name="Nom" required>
        </div>
        <div class="bg-gray-200 m-1 rounded p-2">
            <p class="font-bold">description</p>
            <input type="text" name="description" required>
        </div>
        <div class="bg-gray-200 m-1 rounded p-2">
            <p class="font-bold">prix</p>
            <input type="text" name="prix" required>
        </div>
        <div class="bg-gray-200 m-1 rounded p-2">
            <p class="font-bold">Envoyer</p>
            <input type="submit" value="Envoyer">
        </div>
</form>