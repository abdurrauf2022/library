@extends('layouts.dashboard')

@section('title')

<!-- Title -->
<title>Knjiga | Online Biblioteka</title>

@endsection

@section('content')

    <main class="flex flex-row small:hidden">

        <!-- Content -->
        <section class="w-screen h-screen pl-[80px] pb-2 text-gray-700">
            <!-- Heading of content -->
            <div class="heading">
                <div class="flex flex-row justify-between border-b-[1px] border-[#e4dfdf]">
                    <div class="py-[10px] flex flex-row">
                        <div class="w-[77px] pl-[30px]">
                            <img src="{{'/storage/book-covers/' . $book->gallery->photo}}" alt="Naslovna" title="Naslovna">
                        </div>
                        <div class="pl-[15px]  flex flex-col">
                            <div>
                                <h1>
                                    {{$book->title}}
                                </h1>
                            </div>
                            <div>
                                <nav class="w-full rounded">
                                    <ol class="flex list-reset">
                                        <li>
                                            <a href="{{route('all-books')}}" class="text-[#2196f3] hover:text-blue-600">
                                                Evidencija knjiga
                                            </a>
                                        </li>
                                        <li>
                                            <span class="mx-2">/</span>
                                        </li>
                                        <li>
                                            <a href="{{route('show-book', $book->id)}}"
                                               class="text-[#2196f3] hover:text-blue-600">
                                                ID-{{$book->id}}
                                            </a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="pt-[24px] mr-[30px]">
                        <a href="otpisiKnjigu.php" class="inline hover:text-blue-600">
                            <i class="fas fa-level-up-alt mr-[3px]"></i>
                            Otpiši knjigu
                        </a>
                        <a href="{{route('rent-book', $book->id)}}" class="inline hover:text-blue-600 ml-[20px] pr-[10px]">
                            <i class="far fa-hand-scissors mr-[3px]"></i>
                            Izdaj knjigu
                        </a>
                        
                        @if ($book->rent->contains('id', 1))
                            
                        <a href="{{route('return-book', $book->id)}}" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                            <i class="fas fa-redo-alt mr-[3px] "></i>
                            Vrati knjigu
                        </a>

                        @endif
                        
                        <a href="rezervisiKnjigu.php" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                            <i class="far fa-calendar-check mr-[3px] "></i>
                            Rezerviši knjigu
                        </a>
                        <p class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-[#e4dfdf] dotsKnjigaOsnovniDetalji hover:text-[#606FC7]">
                            <i
                                class="fas fa-ellipsis-v"></i>
                        </p>
                        <div
                            class="z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-knjiga-osnovni-detalji">
                            <div class="absolute right-0 w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                 aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                <div class="py-1">
                                    <a href="{{route('edit-book', $book->id)}}" tabindex="0"
                                       class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                       role="menuitem">
                                        <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                        <span class="px-4 py-0">Izmijeni knjigu</span>
                                    </a>
                                    <form action="{{route('destroy-book', $book->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button style="outline: none" type="submit"  tabindex="0"
                                       class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                       role="menuitem">
                                        <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                        <span class="px-4 py-0">Izbriši knjigu</span>
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-row overflow-auto height-osnovniDetalji">
                <div class="w-[80%]">
                    <div class="border-b-[1px] py-4 text-gray-500 border-[#e4dfdf] pl-[30px]">
                        <a href="knjigaOsnovniDetalji.php" class="inline active-book-nav hover:text-blue-800">
                            Osnovni detalji
                        </a>
                        <a href="knjigaSpecifikacija.php" class="inline ml-[70px] hover:text-blue-800 ">
                            Specifikacija
                        </a>
                        <a href="iznajmljivanjeIzdate.php" class="inline ml-[70px] hover:text-blue-800">
                            Evidencija iznajmljivanja
                        </a>
                        <a href="evidencijaKnjigaMultimedija.php" class="inline ml-[70px] hover:text-blue-800">
                            Multimedija
                        </a>
                    </div>
                    <div class="">
                        <!-- Space for content -->
                        <div class="pl-[30px] section- mt-[20px]">
                            <div class="flex flex-row justify-between">
                                <div class="mr-[30px]">
                                    <div class="mt-[20px]">
                                        <span class="text-gray-500 text-[14px]">Naziv knjige</span>
                                        <p class="font-medium">{{$book->title}}</p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Kategorija</span>
                                        <p class="font-medium">
                                            @foreach ($book->categories as $category)
                                            {{$category->category->name}}
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Žanr</span>
                                        <p class="font-medium">
                                        @foreach ($book->genres as $genre)
                                        {{$genre->genre->name}}
                                        @endforeach
                                        </p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Autor/i</span>
                                        <p class="font-medium">
                                        @foreach ($book->authors as $author)
                                        {{$author->author->NameSurname}}
                                        @endforeach
                                        </p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Izdavač</span>
                                        <p class="font-medium">{{$book->publisher->name}}</p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Godina izdavanja</span>
                                        <p class="font-medium">{{$book->year}}</p>
                                    </div>
                                </div>
                                <div class="mr-[70px] mt-[20px] flex flex-col max-w-[600px]">
                                    <div>
                                        <h4 class="text-gray-500 ">
                                            Kratki sadržaj
                                        </h4>
                                        <p class="addReadMore showlesscontent my-[10px]">
                                            {!! $book->body !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="min-w-[20%] border-l-[1px] border-[#e4dfdf] ">
                    <div class="border-b-[1px] border-[#e4dfdf]">
                        <div class="ml-[30px] mr-[70px] mt-[20px] flex flex-row justify-between">
                            <div class="text-gray-500 ">
                                <p>Na raspolaganju:</p>
                                <p class="mt-[20px]">Rezervisano:</p>
                                <p class="mt-[20px]">Izdato:</p>
                                <p class="mt-[20px]">U prekoračenju:</p>
                                <p class="mt-[20px]">Ukupna količina:</p>
                            </div>
                            <div class="text-center pb-[30px]">
                                <p class=" bg-green-200 text-green-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">{{$book->quantity_count - ($book->rented_count + $book->reserved_count)}} primjeraka</p>
                                <a href="iznajmljivanjeAktivne.php"><p
                                        class=" mt-[16px] bg-yellow-200 text-yellow-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                        {{$book->reserved_count}} primjeraka</p></a>
                                <a href="iznajmljivanjeIzdate.php"><p
                                        class=" mt-[16px] bg-blue-200 text-blue-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                        {{$book->rented_count}} primjeraka</p></a>
                                <a href="iznajmljivanjePrekoracenje.php">  <p
                                        class=" mt-[16px] bg-red-200 text-red-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                        X</p></a>
                                <p
                                    class=" mt-[16px] border-[1px] border-green-700 text-green-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    {{$book->quantity_count}} primjeraka</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-[40px] mx-[30px]">

                @if ($book->rent->contains('id', 1))

                @foreach ($book->rent as $rent)

                   <div class="mt-[40px] flex flex-col max-w-[304px]">
                      <div class="text-gray-500 ">
                          <p class="inline uppercase">
                              Izdavanja knjige
                          </p>
                          <span>
                              - {{$rent->issue_date}}
                          </span>
                      </div>
                      <div>
                          <p>
                              <a href="{{route('show-librarian', $rent->librarian->username)}}" class="text-[#2196f3] hover:text-blue-600">
                                  {{$rent->librarian->name}}
                              </a>
                              je izdao/la knjigu
                              <a href="{{route('show-student', $rent->borrow->username)}}" class="text-[#2196f3] hover:text-blue-600">
                                  {{$rent->borrow->name}}
                              </a>
                              dana
                              <span class="font-medium">
                                  {{$rent->issue_date}}
                              </span>
                          </p>
                      </div>
                      <div>
                          <a href="izdavanjeDetalji.php" class="text-[#2196f3] hover:text-blue-600">
                              pogledaj detaljnije >>
                          </a>
                      </div>
                   </div>

                @endforeach

                @else 
                
                <div class="mx-[50px]">
                    <div class="w-[400px] flex items-center px-6 py-4 my-4 text-lg bg-[#3f51b5] rounded-lg">                       
                        <svg viewBox="0 0 24 24" class="w-5 h-5 mr-3 text-white sm:w-5 sm:h-5">
                            <path fill="currentColor"
                                    d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                            </path>
                        </svg>
                        <p class="font-medium text-white">Trenutno nema aktivnosti! </p>
                    </div>
                </div>
                       
                @endif
           

                        <div class="mt-[40px]">
                            <a href="{{route('dashboard-activity')}}" class="text-[#2196f3] hover:text-blue-600">
                                <i class="fas fa-history"></i> Prikaži sve
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Content -->
    </main>
    <!-- End Main content -->
@endsection
