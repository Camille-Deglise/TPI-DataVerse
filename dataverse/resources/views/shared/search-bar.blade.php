<div class="mt-8 relative">
    <h2 class="text-gray-700 text-center text-xl pb-3 first-letter:text-2xl">Chercher un lieu</h2>
    <form action="{{ route('home') }}" method="GET">
        <input type="text" name="search" placeholder="NPA, Ville, Pays"
            class="shadow-lg bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
        @if (isset($fromCombi) && $fromCombi)
            <input type="hidden" name="from_combi" value="true">
        @endif
        <button class="shadow-md absolute left-60 top-8 mt-2 bg-gray-200 hover:bg-cyan-700 focus:shadow-outline focus:outline-none text-gray-600 hover:text-gray-100 font-bold py-2 px-4 rounded" type="submit">
            Chercher
        </button>
    </form>
</div>