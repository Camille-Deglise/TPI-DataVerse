<div class="mt-8">
    <h2 class="text-gray-700 text-center text-lg">Chercher un contributeur </h2>
    <form action="{{route('admin.search')}}" method="get">
        <input type="text" name="search"  placeholder="Chercher par nom de famille ou email" 
        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
        <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
            Chercher
        </button>
    </form>
</div>
