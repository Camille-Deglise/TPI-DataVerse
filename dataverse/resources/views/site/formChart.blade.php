
<form action="{{ route('combinaison', ['id' => $location->id]) }}" method="POST">
    @csrf
    @method('POST')
    <p>Choisissez une catégorie</p>
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
    @foreach ($categories as $value => $label)
        <label for="{{ $value }}">{{ $label }}</label> 
        <input type="radio" name="category" value="{{ $value }}" {{ (isset($category) && $category == $value) ? 'checked' : '' }}>
    @endforeach

    <p>Choisir des mois et années</p>
    <div class="mb-6 flex items-center">
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
        <label class="block text-gray-500 font-bold mr-4" for="begin_month" style="min-width: 100px;">
            Mois de début
        </label>
        <select id="begin_month" name="begin_month" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
            @foreach($availableMonths as $month)
                <option value="{{ $month }}" {{ (isset($beginMonth) && $beginMonth == $month) ? 'selected' : '' }}>{{ $month }}</option>
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

    <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
        Créer
    </button>
</form>