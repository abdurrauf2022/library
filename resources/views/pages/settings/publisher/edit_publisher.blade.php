@extends('layouts.dashboard')

@section('title')

<!-- Title -->
<title>{{__('Izmijeni izdavača | Online biblioteka')}}</title>

@endsection

@section('content')

<!-- Content -->
<section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
    <!-- Heading of content -->
    <div class="heading">
        <div class="flex border-b-[1px] border-[#e4dfdf]">
            <div class="pl-[30px] py-[10px] flex flex-col">
                <div>
                    <h1>
                        {{__('Izmijeni podatke')}}
                    </h1>
                </div>
                <div>
                    <nav class="w-full rounded">
                        <ol class="flex list-reset">
                            <li>
                                <a href="{{route('setting-policy')}}"
                                   class="text-[#2196f3] hover:text-blue-600">
                                    {{__('Podešavanja')}}
                                </a>
                            </li>
                            <li>
                                <span class="mx-2">/</span>
                            </li>
                            <li>
                                <a href="{{route('setting-publisher')}}"
                                   class="text-[#2196f3] hover:text-blue-600">
                                    {{__('Izdavači')}}
                                </a>
                            </li>
                            <li>
                                <span class="mx-2">/</span>
                            </li>
                            <li>
                                <a href="{{route('edit-publisher', $publisher->id)}}"
                                   class="text-gray-400 hover:text-blue-600">
                                    {{__('Izmijeni podatke')}}
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
        <form class="text-gray-700" method="POST"
              action="{{route('update-publisher', $publisher->id)}}">
            @csrf @honeypot
            @method('PUT')
            <div class="flex flex-row ml-[30px]">
                <div class="w-[50%] mb-[150px]">
                    <div class="mt-[20px]">
                        <span>{{__('Naziv izdavača')}} <span class="text-red-500">* @error('name'){{$message}} @enderror</span></span>
                        <input type="text" name="name" id="name"
                               value="{{$publisher->name}}"
                               class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                               onkeydown="clearErrorsNazivIzdavacEdit()"/>
                        <div id="validateNazivIzdavacEdit"></div>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 w-full">
                <div class="flex flex-row">
                    <div class="inline-block w-full text-white text-right py-[7px] mr-[100px]">
                        <button type="button" onclick="history.back()"
                                class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                            {{__('Poništi')}} <i class="fas fa-times ml-[4px]"></i>
                        </button>
                        <button id="sacuvajIzdavacEdit" type="submit"
                                class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                            {{__('Sačuvaj')}}
                             <i class="fas fa-check ml-[4px]"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- End Content -->

@endsection
