<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $naslov }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h3>Uputa:</h3>
          <p>Odaberite iznos za igru te pritisnite zavrti. Kada dobijete sve 3 iste boje pobijedili ste</p>
          <div style="display: flex;height: 150px;justify-content: space-evenly;margin:15px 0px;">
            <div id="prvaKocka"
              style="background-color: {{isset($boje[0]) ? $boje[0] : 'blue'}};border: 1px solid rgb(2, 2, 77);width:150px;">
            </div>
            <div id="drugaKocka"
              style="background-color: {{isset($boje[1]) ? $boje[1] : 'red'}};border: 1px solid rgb(119, 3, 3);width:150px;">
            </div>
            <div id="trecaKocka"
              style="background-color: {{isset($boje[2]) ? $boje[2] : 'yellow'}};border: 1px solid rgb(138, 138, 2);width:150px;">
            </div>
          </div>
          @isset($pobjeda)
          @if($pobjeda)
          <div
            style="background-color: cornflowerblue;border-radius: 30px;padding: 10px;margin: 10px auto;width: 50%;text-align: center;">
            Pobijedili ste. Zavrtite ponovno, možda opet bude sreće.</div>
          @else
          <div
            style="background-color: crimson;color:white;border-radius: 30px;padding: 10px;margin: 10px auto;width: 50%;text-align: center;">
            Izgubili ste. Zavrtite ponovno, možda bude sreće.</div>
          @endif
          @endisset
          <form method="POST" style="text-align: center" action="{{ url()->current() }}">
            @csrf
            <!-- Input za unos -->
            <label for="ulog"> Unesite ulog: </label>
            <input id="ulog" type="number" name="ulog" required />
            <!-- Submit button -->
            <button style="margin-left:30px;border: 1px solid black; background-color: powderblue;
            border-radius: 10px;
            padding: 10px;">
              Zavrti
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>