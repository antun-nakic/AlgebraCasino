<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $naslov }}
    </h2>
    <ul>
      <li><a href={{route('igraTriBoje.index')}}>Natrag na igru</a></li>
    </ul>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div style="display:flex;justify-content:space-around;" class="p-6 bg-white border-b border-gray-200">
          <div style="flex-grow: 2;margin:0px 20px;">
            <h1>Najveći dobitci</h1>
            <ul>
              @foreach ($sortD as $korisnik => $dobitak)
              <li>{{$dobitak}} - {{$korisnik}}</li>
              @endforeach
            </ul>
          </div>
          <div style="flex-grow: 2;margin:0px 20px;">
            <h1>Najveći gubitci</h1>
            <ul>
              @foreach ($sortG as $item)
              <li>{{$item}}</li>
              @endforeach
            </ul>
          </div>
          <div style="flex-grow: 2;margin:0px 20px;">
            <h1>Highcore prema korisnica</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>