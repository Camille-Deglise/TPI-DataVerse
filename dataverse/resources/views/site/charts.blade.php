<h2 class="text-center  bg-gray-200 mb-6">Graphique </h2>
<div class="inline-flex space-x-40">

    @if($combiChart instanceof \App\Util\NoChartData)
        <p>{{ $combiChart->message }}</p>
    @else
        <div class="combi-chart">
            {!! $combiChart->container() !!}
            {!! $combiChart->script() !!} 
        </div>
    @endif
</div>