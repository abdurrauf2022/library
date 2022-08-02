@extends('layouts.dashboard')

<!-- Title -->
<title>Izmijeni Profil | Online Biblioteka</title>

@section('content')

 <!-- Content -->
 <section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
     <!-- Heading of content -->
     <div class="heading">
         <div class="flex border-b-[1px] border-[#e4dfdf]">
             <div class="pl-[30px] py-[10px] flex flex-col">
                 <div>
                     <h1 class="">

                        {{-- Librarian update flash message --}}
                        @if (session()->has('librarian-updated'))
                        <div class="flex p-2 mt-2 mb-1 text-sm text-green-700 bg-green-200 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Success!</span> {{session('librarian-updated')}}
                            </div>
                        </div>
                        @endif

                         Izmijeni podatke

                     </h1>
                 </div>
                 <div>
                     <nav class="w-full rounded">
                         <ol class="flex list-reset">
                             <li>
                                 <a href="{{route('all-librarian')}}" class="text-[#2196f3] hover:text-blue-600">
                                     Svi bibliotekari
                                 </a>
                             </li>
                             <li>
                                 <span class="mx-2">/</span>
                             </li>
                             <li>
                                 <a href="{{route('edit-librarian', $librarian->id)}}" class="text-gray-400 hover:text-blue-600">
                                     Izmijeni podatke
                                 </a>
                             </li>
                         </ol>
                     </nav>
                 </div>
             </div>
         </div>
     </div>
     <!-- Space for content -->
     <div class="scroll height-content section-content">
         <form class="text-gray-700 text-[14px]" method="POST" action="{{route('update-librarian', $librarian->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
             <div class="flex flex-row ml-[30px]">
                 <div class="w-[50%] mb-[100px]">
                     <div class="mt-[20px]">
                         <span>Ime i prezime <span class="text-red-500">*</span></span>
                         <input type="text" name="name" id="name" value="{{$librarian->name}}" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsNameBibliotekarEdit()"/>
                         <div id="validateNameBibliotekarEdit"></div>
                     </div>

                     <div class="mt-[20px]">
                         <span>Tip korisnika</span>
                         <select class="flex w-[90%] mt-2 px-2 py-2 border bg-gray-300 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]" name="user_type_id" disabled>
                             <option value="2">
                                 Bibliotekar
                             </option>
                         </select>
                     </div>

                     <div class="mt-[20px]">
                         <span>JMBG <span class="text-red-500">*</span></span>
                         <input type="text" name="JMBG" id="JMBG" value="{{$librarian->JMBG}}" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsJmbgBibliotekarEdit()"/>
                         <div id="validateJmbgBibliotekarEdit"></div>
                     </div>

                     <div class="mt-[20px]">
                         <span>E-mail <span class="text-red-500">*</span></span>
                         <input type="email" name="email" id="email" value="{{$librarian->email}}" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsEmailBibliotekarEdit()"/>
                         <div id="validateEmailBibliotekarEdit"></div>
                     </div>

                     <div class="mt-[20px]">
                         <span>Korisničko ime <span class="text-red-500">*</span></span>
                         <input type="text" name="username" id="username" value="{{$librarian->username}}" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsUsernameBibliotekarEdit()"/>
                         <div id="validateUsernameBibliotekarEdit"></div>
                     </div>

                     <div class="mt-[20px]">
                         <span>Šifra <span class="text-red-500">*</span></span>
                         <input type="password" name="password" id="password" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsPwBibliotekarEdit()"/>
                         <div id="validatePwBibliotekarEdit"></div>
                     </div>

                     <div class="mt-[20px]">
                         <span>Ponovi šifru <span class="text-red-500">*</span></span>
                         <input type="password" name="password" id="password" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsPw2BibliotekarEdit()"/>
                         <div id="validatePw2BibliotekarEdit"></div>
                     </div>
                 </div>

                 <div class="mt-[50px]">
                     <label class="mt-6 cursor-pointer">
                         <div id="empty-cover-art" class="relative w-48 h-48 py-[48px] text-center border-2 border-gray-300 border-solid">
                             <div class="py-4">
                                 <svg class="mx-auto feather feather-image mb-[15px]" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                     <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                     <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                     <polyline points="21 15 16 10 5 21"></polyline>
                                 </svg>
                                 <span class="px-4 py-2 mt-2 leading-normal">Dodaj fotografiju</span>
                                 <input type='file' name="photo" for="photo" id="photo" class="hidden" :accept="accept" onchange="loadFileLibrarian(event)" />
                             </div>
                             <img 
                             name="photo"
                             class="absolute w-48 h-[188px] bottom-0" 
                             id="image-output-librarian"
                             src="{{$librarian->photo == 'placeholder' ? '/img/profileExample.jpg' : '/storage/librarians/' . $librarian->photo}}"/> 	
                         </div>
                     </label>  
                 </div>
             </div>

             <div class="absolute bottom-0 w-full">
                 <div class="flex flex-row">
                     <div class="inline-block w-full text-right py-[7px] mr-[100px] text-white">
                        <button 
                        type="button"
                        onclick="history.back()"
                        class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                        Poništi <i class="fas fa-times ml-[4px]"></i> 
                         </button>
                         <button type="submit"
                                 class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]" onclick="validacijaBibliotekarEdit()">
                                 Sačuvaj <i class="fas fa-check ml-[4px]"></i> 
                         </button>
                     </div>
                 </div>        
             </div>
             
         </form>
     </div>
 </section>
 <!-- End Content -->

@endsection