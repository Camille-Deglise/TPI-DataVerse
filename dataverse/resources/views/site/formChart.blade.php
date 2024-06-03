
<div class="mt-2 px-4 mr-6 mb-4">
    <form action="{{ route('combinaison', ['id' => $location->id ?? 0]) }}" method="POST">
        @csrf
        @method('POST')
        <p class="first-letter:text-xl font-bold mb-2 text-center">Choisissez une catégorie</p>
        @php
            $categories = [
                'precipitation' => 'Précipitations',
                'sunshine' => 'Ensoleillement',
                'snow' => 'Neige',
                'wind' => 'Vent',
                'temperature' => 'Température',
                'humidity' => 'Humidité'
            ];
        @endphp

            <div class="pl-2 border-2 rounded-3xl border-cyan-700 my-4 py-2">
                @foreach ($categories as $value => $label)
                <div class="pl-2 ">
                <label class="first-letter:text-xl pl-2" for="{{ $value }}">{{ $label }}</label> 
                <input class=" w-4 h-4 text-cyan-600 ml-14 align-middle" 
                type="radio" name="category" value="{{ $value }}" {{ (isset($category) && $category == $value) ? 'checked' : '' }}>
                </div>
                @endforeach 
            </div>
            
        <p class="first-letter:text-xl font-bold mb-2 text-center">Choisir le mois et l'année de début <br> et le mois et l'année de fin</p>
        <div class="pl-2 border-2 rounded-3xl border-cyan-700 my-4  py-4 px-4">
            
            <div class="mb-6 flex items-center">
                <label class="block text-gray-500 font-bold mr-4" for="begin_month" style="min-width: 100px;">
                    Mois de début
                </label>
                <select id="begin_month" name="begin_month" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
                    @foreach($availableMonths as $month)
                        <option value="{{ $month }}" {{ (isset($beginMonth) && $beginMonth == $month) ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6 flex items-center ">
                <label class="block text-gray-500 font-bold mr-4" for="begin_year" style="min-width: 100px;">
                    Année de début
                </label>
                <select id="begin_year" name="begin_year" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ (isset($beginYear) && $beginYear == $year) ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6 flex items-center">
                <label class="block text-gray-500 font-bold mr-4" for="end_month" style="min-width: 100px;">
                    Mois de fin
                </label>
                <select id="end_month" name="end_month" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
                    @foreach($availableMonths as $month)
                        <option value="{{ $month }}" {{ (isset($endMonth) && $endMonth == $month) ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6 flex items-center">
                <label class="block text-gray-500 font-bold mr-4" for="end_year" style="min-width: 100px;">
                    Année de fin
                </label>
                <select id="end_year" name="end_year" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ (isset($endYear) && $endYear == $year) ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="shadow bg-gray-300 hover:bg-cyan-700 hover:text-gray-200 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded type="submit">
            Créer
        </button>
    </form>  
</div>
