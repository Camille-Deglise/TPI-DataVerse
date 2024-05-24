<div class="mt-8">
    <h2 class="text-gray-700 text-center text-xl">Chercher un lieu</h2>
    <form action="{{route('home')}}" method="GET">
        <input type="text" name="search"  placeholder="NPA, Ville, Pays" 
        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
        <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
            Chercher
        </button>
    </form>
</div>