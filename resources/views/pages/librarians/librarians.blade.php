@extends('layouts.dashboard')

@section('title')

<!-- Title -->
<title>Bibliotekari | Online Biblioteka</title>
    
@endsection

@section('content')
{{-- JQuery CDN --}}
<x-jquery.jquery></x-jquery.jquery>
{{-- Searching functionality --}}
<x-jquery.search></x-jquery.search>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- Preloader --}}
<div id="loader"></div>
    
<div style="display:none;" id="myDiv">

<!-- Content -->
<section class="w-screen h-screen py-4 pl-[80px] text-[#333333]">
    <!-- Heading of content -->
    <div class="heading mt-[7px]" style="margin-top: 10px">
        <h1 style="font-size: 30px" class="pl-[30px] pb-[22px] border-b-[1px] border-[#e4dfdf] ">
            Bibliotekari

{{-- Session message for librarian create --}}
@if (session()->has('success-librarian'))
<div id="hideDiv" class="flex p-2 mt-2 mb-1 text-sm text-green-700 bg-green-200 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
    <span class="sr-only">Info</span>
    <div>
      <span class="font-medium">Success!</span> {{session('success-librarian')}}
    </div>
  </div>
@endif

{{-- Session message for librarian delete --}}
@if (session()->has('librarian-deleted'))
<div id="hideDiv" class="flex p-2 mt-2 mb-1 text-sm text-red-700 bg-red-200 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
    <span class="sr-only">Info</span>
    <div>
      <span class="font-medium">Success!</span> {{session('librarian-deleted')}}
    </div>
</div>
@endif
        </h1>
    </div>

    <!-- Space for content -->
    <div class="scroll height-dashboard">
        <div class="flex items-center justify-between px-[30px] py-4 space-x-3 rounded-lg">
            <a href="{{ route('new-librarian') }}" class="btn-animation inline-flex items-center text-sm py-2.5 px-5 rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE]">
                <i class="fas fa-plus mr-[15px]"></i> Novi bibliotekar
            </a>
            <div class="flex items-center">
                
                <style>
                    #pagination {
                        border-left: 1px solid #4558BE;
                        border-bottom: 0.4px solid #000;
                        cursor: pointer;
                    }
                </style>
                <form> 
                    Broj redova po strani:
                    <select id="pagination">
                        <option value="5" @if($items == 5) selected @endif >5</option>
                        <option value="10" @if($items == 10) selected @endif >10</option>
                        <option value="25" @if($items == 25) selected @endif >25</option>
                        <option value="50" @if($items == 50) selected @endif >50</option>
                        <option value="100" @if($items == 100) selected @endif >100</option>
                        <option
                        title="{{$show_all}}"
                        value="{{$show_all}}" @if($items == $show_all) selected @endif>Prikaži sve</option>
                    </select>
                </form>

                <script>
                    document.getElementById('pagination').onchange = function() {
                        window.location = "{{ $librarians->url(1) }}&items=" + this.value;
                    };
                </script>

                <div class="relative text-gray-600 focus-within:text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </span>
                    <input id="myInput" type="search" name="q"
                        class="py-2 pl-10 text-sm text-white bg-white rounded-md focus:outline-none focus:bg-white focus:text-gray-900"
                        placeholder="Traži..." autocomplete="off">
                </div>
            </div>
        </div>
        
        <div class="inline-block min-w-full px-[30px] pt-3 align-middle bg-white rounded-bl-lg rounded-br-lg shadow-dashboard">

            @if (count($librarians) <= 0)

            <div class="mx-[50px]">
                <div class="w-[400px] flex items-center px-6 py-4 my-4 text-lg bg-[#3f51b5] rounded-lg">                       
                    <svg viewBox="0 0 24 24" class="w-5 h-5 mr-3 text-white sm:w-5 sm:h-5">
                        <path fill="currentColor"
                                d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                        </path>
                    </svg>
                    <p class="font-medium text-white">Trenutno nema registrovanih bibliotekara! </p>
                </div>
            </div>  
                
            @endif

            @if (count($librarians) > 0)

            <button type="submit" class="btn-animation inline-flex items-center text-sm py-2.5 px-5 rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE] button delete-all"  data-url="">
                <div class="icon">
                    <svg class="top">
                        <use xlink:href="#top">
                    </svg>
                    <svg class="bottom">
                        <use xlink:href="#bottom">
                    </svg>
                </div>
                <span>Izbriši</span>
            </button>
            
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="top">
                    <path d="M15,4 C15.5522847,4 16,4.44771525 16,5 L16,6 L18.25,6 C18.6642136,6 19,6.33578644 19,6.75 C19,7.16421356 18.6642136,7.5 18.25,7.5 L5.75,7.5 C5.33578644,7.5 5,7.16421356 5,6.75 C5,6.33578644 5.33578644,6 5.75,6 L8,6 L8,5 C8,4.44771525 8.44771525,4 9,4 L15,4 Z M14,5.25 L10,5.25 C9.72385763,5.25 9.5,5.47385763 9.5,5.75 C9.5,5.99545989 9.67687516,6.19960837 9.91012437,6.24194433 L10,6.25 L14,6.25 C14.2761424,6.25 14.5,6.02614237 14.5,5.75 C14.5,5.50454011 14.3231248,5.30039163 14.0898756,5.25805567 L14,5.25 Z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="bottom">
                    <path d="M16.9535129,8 C17.4663488,8 17.8890201,8.38604019 17.9467852,8.88337887 L17.953255,9.02270969 L17.953255,9.02270969 L17.5309272,18.3196017 C17.5119599,18.7374363 17.2349366,19.0993109 16.8365446,19.2267053 C15.2243631,19.7422351 13.6121815,20 12,20 C10.3878264,20 8.77565288,19.7422377 7.16347932,19.226713 C6.76508717,19.0993333 6.48806648,18.7374627 6.46907425,18.3196335 L6.04751853,9.04540766 C6.02423185,8.53310079 6.39068134,8.09333626 6.88488406,8.01304774 L7.02377738,8.0002579 L16.9535129,8 Z M9.75,10.5 C9.37030423,10.5 9.05650904,10.719453 9.00684662,11.0041785 L9,11.0833333 L9,16.9166667 C9,17.2388328 9.33578644,17.5 9.75,17.5 C10.1296958,17.5 10.443491,17.280547 10.4931534,16.9958215 L10.5,16.9166667 L10.5,11.0833333 C10.5,10.7611672 10.1642136,10.5 9.75,10.5 Z M14.25,10.5 C13.8703042,10.5 13.556509,10.719453 13.5068466,11.0041785 L13.5,11.0833333 L13.5,16.9166667 C13.5,17.2388328 13.8357864,17.5 14.25,17.5 C14.6296958,17.5 14.943491,17.280547 14.9931534,16.9958215 L15,16.9166667 L15,11.0833333 C15,10.7611672 14.6642136,10.5 14.25,10.5 Z"></path>
                </symbol>
            </svg>

            <style>
  .button {
  --background: #3F51B5;
  --text: #fff;
  --icon: #fff;
  display: -webkit-box;
  display: flex;
  outline: none;
  cursor: pointer;
  border: 0;
  min-width: 113px;
  padding: 9px 20px 9px 12px;
  margin-bottom: 8px;
  line-height: 24px;
  overflow: hidden;
  color: var(--text);
  background: var(--b, var(--background));
  -webkit-transition: background 0.4s, -webkit-transform 0.3s;
  transition: background 0.4s, -webkit-transform 0.3s;
  transition: transform 0.3s, background 0.4s;
  transition: transform 0.3s, background 0.4s, -webkit-transform 0.3s;
  -webkit-transform: scale(var(--scale, 1)) translateZ(0);
  transform: scale(var(--scale, 1)) translateZ(0);
  -webkit-appearance: none;
  -webkit-tap-highlight-color: transparent;
  -webkit-mask-image: -webkit-radial-gradient(white, black);
}
.button:active {
  --scale: 0.95;
}

.button .icon,
.button span {
  display: inline-block;
  vertical-align: top;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
}
.button .icon {
  width: 24px;
  height: 24px;
  position: relative;
  z-index: 1;
  margin-right: 8px;
  color: var(--text);
}
.button .icon svg {
  width: 96px;
  height: 96px;
  display: block;
  position: absolute;
  left: -36px;
  top: -36px;
  will-change: transform;
  fill: var(--icon);
  -webkit-transform: scale(0.254) translateZ(0);
  transform: scale(0.254) translateZ(0);
  -webkit-animation: var(--name, var(--name-top, none)) 2000ms ease forwards;
  animation: var(--name, var(--name-top, none)) 2000ms ease forwards;
}
.button .icon svg.bottom {
  --name: var(--name-bottom, none);
}
.button span {
  -webkit-animation: var(--name-text, none) 2000ms ease forwards;
  animation: var(--name-text, none) 2000ms ease forwards;
}
.button.delete {
  --name-top: trash-top;
  --name-bottom: trash-bottom;
  --name-text: text;
}

@-webkit-keyframes trash-bottom {
  25%,
  32% {
    -webkit-transform: translate(32px, 19px) scale(1) translateZ(0);
    transform: translate(32px, 19px) scale(1) translateZ(0);
  }
  70%,
  80% {
    -webkit-transform: translate(32px, 0) scale(0.254) translateZ(0);
    transform: translate(32px, 0) scale(0.254) translateZ(0);
  }
  100% {
    -webkit-transform: scale(0.254) translateZ(0);
    transform: scale(0.254) translateZ(0);
  }
}

@keyframes trash-bottom {
  25%,
  32% {
    -webkit-transform: translate(32px, 19px) scale(1) translateZ(0);
    transform: translate(32px, 19px) scale(1) translateZ(0);
  }
  70%,
  80% {
    -webkit-transform: translate(32px, 0) scale(0.254) translateZ(0);
    transform: translate(32px, 0) scale(0.254) translateZ(0);
  }
  100% {
    -webkit-transform: scale(0.254) translateZ(0);
    transform: scale(0.254) translateZ(0);
  }
}
@-webkit-keyframes trash-top {
  25%,
  32% {
    -webkit-transform: translate(38px, 4px) scale(1) rotate(-20deg)
      translateZ(0);
    transform: translate(38px, 4px) scale(1) rotate(-20deg) translateZ(0);
  }
  70%,
  80% {
    -webkit-transform: translate(32px, 0) scale(0.254) translateZ(0);
    transform: translate(32px, 0) scale(0.254) translateZ(0);
  }
  100% {
    -webkit-transform: scale(0.254) translateZ(0);
    transform: scale(0.254) translateZ(0);
  }
}
@keyframes trash-top {
  25%,
  32% {
    -webkit-transform: translate(38px, 4px) scale(1) rotate(-20deg)
      translateZ(0);
    transform: translate(38px, 4px) scale(1) rotate(-20deg) translateZ(0);
  }
  70%,
  80% {
    -webkit-transform: translate(32px, 0) scale(0.254) translateZ(0);
    transform: translate(32px, 0) scale(0.254) translateZ(0);
  }
  100% {
    -webkit-transform: scale(0.254) translateZ(0);
    transform: scale(0.254) translateZ(0);
  }
}
@-webkit-keyframes text {
  25% {
    -webkit-transform: translate(-4px, -4px) rotate(-20deg) translateZ(0);
    transform: translate(-4px, -4px) rotate(-20deg) translateZ(0);
  }
  70% {
    opacity: 1;
    -webkit-transform: translate(-12px, 48px) rotate(-80deg) scale(0.2)
      translateZ(0);
    transform: translate(-12px, 48px) rotate(-80deg) scale(0.2) translateZ(0);
  }
  71% {
    opacity: 0;
  }
  72%,
  90% {
    opacity: 0;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
  }
  100% {
    opacity: 1;
  }
}
@keyframes text {
  25% {
    -webkit-transform: translate(-4px, -4px) rotate(-20deg) translateZ(0);
    transform: translate(-4px, -4px) rotate(-20deg) translateZ(0);
  }
  70% {
    opacity: 1;
    -webkit-transform: translate(-12px, 48px) rotate(-80deg) scale(0.2)
      translateZ(0);
    transform: translate(-12px, 48px) rotate(-80deg) scale(0.2) translateZ(0);
  }
  71% {
    opacity: 0;
  }
  72%,
  90% {
    opacity: 0;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
  }
  100% {
    opacity: 1;
  }
}
            </style>
<script>
    document.querySelectorAll(".button").forEach(button =>
  button.addEventListener("click", e => {
    if (!button.classList.contains("delete")) {
      button.classList.add("delete");

      setTimeout(() => button.classList.remove("delete"), 2200);
    }
    e.preventDefault();
  })
);
</script>
            
            <table id="sort" class="shadow-lg rounded-xl min-w-full border-[1px] border-[#e4dfdf]" id="myTable">
                <thead class="bg-[#EFF3F6]">
                    <tr class="border-[1px] border-[#e4dfdf]">
                        <td class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="check_all">
                            </label>
                        </td>

                        <td class="px-3 py-5 leading-4 tracking-wider text-left sakriveno checkme2">
                            <button
                            onclick="showProfile()"
                            style="outline: none;border: none;font-weight: bold;"
                                class="flex w-full px-1 text-sm leading-5 text-left text-blue-600 outline-none"
                                role="menuitem">
                                <i class="far fa-file mr-[5px] ml-[5px] py-1"></i>
                                <span style="padding-top: 1px;">Pogledaj detalje</span>
                            </button>
                        </td>

                        <th class="px-4 py-4 leading-4 tracking-wider text-left checkme" id="arrow">
                            Ime i prezime
                        </th>
                       
                        <th class="px-4 py-4 leading-4 tracking-wider text-left changeme" id="arrow">
                            Email
                        </th>

                        <th class="px-4 py-4 leading-4 tracking-wider text-left changeme" id="arrow">
                            Tip korisnika
                        </th>
                      
                        <th class="px-4 py-4 leading-4 tracking-wider text-left changeme" id="arrow">
                            Zadnji pristup sistemu
                        </th>

                        <td class="px-4 py-4"></td>
                    </tr>
                </thead>
                <tbody class="bg-white" id="tablex">

                    @foreach ($librarians as $librarian)
                    <tr class="hover:bg-gray-200 hover:shadow-md border-[1px] border-[#e4dfdf]">
                        <td class="px-4 py-4 whitespace-no-wrap">
                            <label class="inline-flex items-center">
                                <input 
                                type="checkbox" 
                                name="fruit" 
                                id="check" 
                                value="{{$librarian->username}}" 
                                class="form-checkbox checkbox"
                                data-id="{{$librarian->id}}">
                            </label>
                        </td>
                        <td class="flex flex-row items-center px-4 py-4">
                            
                            <img class="object-cover w-8 h-8 mr-2 rounded-full" src="{{$librarian->photo == 'placeholder' ? '/img/profileImg-default.jpg' : '/storage/librarians/' . $librarian->photo}}"
                            alt="Profilna slika bibliotekara: {{$librarian->name}}"
                            title="Profilna slika bibliotekara: {{$librarian->name}}" />

                            <a href="{{route('show-librarian', $librarian->username)}}">
                                <span class="font-medium text-center">{{$librarian->name}}</span>
                            </a>
                        </td>
                        <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">
                            {{$librarian->email}}
                        </td>
                        <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">
                        {{$librarian->gender->id == 1 ? 'Bibliotekar' : 'Bibliotekarka'}}
                        </td>
                        <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">{{$librarian->login_count == 0 ? 'Korisnik se nikada nije ulogovao.' : $librarian->last_login_at->diffForHumans()}}</td>
                        <td class="px-4 py-4 text-sm leading-5 text-right whitespace-no-wrap">
                            <p class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsLibrarian hover:text-[#606FC7]">
                                <i class="fas fa-ellipsis-v"></i>
                            </p>
                            <div
                                class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-librarian">
                                <div class="absolute right-[25px] w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                    aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                    <div class="py-1">
                                        <a href="{{route('show-librarian', $librarian->username)}}" tabindex="0"
                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                            role="menuitem">
                                            <i class="far fa-file mr-[5px] ml-[5px] py-1"></i>
                                            <span class="px-4 py-0">Pogledaj detalje</span>
                                        </a>
                                        
                                        <a 
                                        href="{{route('edit-librarian', $librarian->username)}}" tabindex="0"
                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                            role="menuitem">
                                            <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                            <span class="px-3 py-0">
                                                @if (Auth::id() == $librarian->id)
                                                Izmijeni svoj nalog 
                                                @elseif ($librarian->gender->id == 1)
                                                Izmijeni bibliotekara
                                                @else 
                                                Izmijeni bibliotekarku
                                                @endif
                                            </span>
                                        </a>
                                            <button 
                                            data-id="{{ $librarian->id }}" 
                                            data-action="{{ route('librarians.destroy', $librarian->id) }}" onclick="deleteConfirmation({{$librarian->id}})"
                                            style="outline: none;border: none;"
                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600">
                                            <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                            <span class="px-4 py-0">
                                            @if (Auth::id() == $librarian->id)
                                            Izbriši svoj nalog 
                                            @elseif ($librarian->gender->id == 1)
                                            Izbriši bibliotekara
                                            @else 
                                            Izbriši bibliotekarku
                                            @endif
                                            </span>
                                            </button> 
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @endforeach

                </tbody>

            </table>

            <script src="https://cdn.tailwindcss.com"></script>
            <div class="m-3">{!! $librarians->links() !!}</div>

            </div>

            @endif
        </div>
    </div>
</div>
</section>
<!-- End Content -->
</main>
<!-- End Main content -->

<style>
  .swal2-popup .swal2-styled:focus {
   box-shadow: none !important;
}
 </style>

<script type="text/javascript">
   function deleteConfirmation(id) {
       swal({
           title: "Izbriši?",
           text: "Da li ste sigurni da želite da izbrišete bibliotekara?",
           type: "warning",
           showCancelButton: !0,
           timer: '5000',
           animation: true,
           allowEscapeKey: true,
           allowOutsideClick: false,
           confirmButtonText: "Da, siguran sam!",
           cancelButtonText: "Ne, odustani",
           reverseButtons: !0,
           confirmButtonColor: '#14de5e',
           cancelButtonColor: '#f73302',
       }).then(function (e) {
           if (e.value === true) {
               var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
               swal(
                   'Uspješno!',
                   'Bibliotekar je uspješno izbrisan.',
                   'success'
                   ).then(function() {
                    window.location.href = "/bibliotekari";
                   });
               $.ajax({
                   type: 'POST',
                   url: "{{url('/librarians')}}/" + id,
                   data: {_token: CSRF_TOKEN},
                   dataType: 'JSON',
                   success: function (results) {
                   }
               });
           } else {
               e.dismiss;
           }
       }, function (dismiss) {
           return false;
       })
   }
   $(document).ajaxStop(function(){
// window.location.reload();
// window.location.href = "/bibliotekari";
});

// Script for show profile top header
function showProfile() {
var username = $('#check:checked').val();
window.location.href = "/bibliotekar/" + username;
}

</script>

<style>
    .show {
        display: inline-block !important;
    }
    .hidden_header {
        display: none !important;
    }
    .sakriveno {display: none !important}
    .sakriveno_email {display: none !important}
</style>
<script>

$('input#check').on('change', function() {     
    if($(this).is(":checked")) {
        $('.checkme').addClass('hidden_header');    
        $('.checkme2').addClass('show');    
        $('.checkme2').removeClass('sakriveno');   
    } else {
        $('.checkme').removeClass('hidden_header');    
        $('.checkme2').removeClass('show');    
        $('.checkme2').addClass('sakriveno');    
        
    }
});
</script>

<script type="text/javascript">
    $(document).ready(function () {
    $('#check_all').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
    $(".checkbox").prop('checked', true);  
    } else {  
    $(".checkbox").prop('checked',false);  
    }  
    });
    $('.checkbox').on('click',function(){
    if($('.checkbox:checked').length == $('.checkbox').length){
    $('#check_all').prop('checked',true);
    }else{
    $('#check_all').prop('checked',false);
    }
    });
    $('.delete-all').on('click', function(e) {
    var idsArr = [];  
    $(".checkbox:checked").each(function() {  
    idsArr.push($(this).attr('data-id'));
    });  
    if(idsArr.length <=0)  
    {  

    swal({
     title: "Greška!",
     text: "Morate selektovati makar jednog bibliotekara.",
     type: "error",
     timer: 1500,
     confirmButtonText: 'U redu',
     allowEscapeKey: false,
     allowOutsideClick: false,
     });

    }  else {  
    if(confirm("Da li ste sigurni?")){  
    var strIds = idsArr.join(","); 
    $.ajax({
    url: "{{ route('delete-all') }}",
    type: 'DELETE',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: 'ids='+strIds,
    success: function (data) {
    if (data['status']==true) {
    $(".checkbox:checked").each(function() {  
    $(this).parents("tr").remove();
    });
    alert(data['message']);
    } 
    else {
    swal({
     title: "Uspješno!",
     type: "success",
     timer: 1000,
     confirmButtonText: 'U redu',
     allowEscapeKey: false,
     allowOutsideClick: false,
     }).then(function() {
        window.location.href = "/bibliotekari";
     });
    
    }
    },
    error: function (data) {
    alert(data.responseText);
    }
    });
    }  
    }  
    });
    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
    element.closest('form').submit();
    }
    });   
    });
    </script>

@endsection


