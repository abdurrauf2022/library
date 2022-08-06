@extends('layouts.dashboard')

<!-- Title -->
<title>Nova knjiga | Online Biblioteka</title>

@section('content')

    <main class="flex flex-row small:hidden">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>
            <!-- End Sidebar -->

        <!-- Content -->
        <section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
            <!-- Heading of content -->
            <div class="heading">
                <div class="flex border-b-[1px] border-[#e4dfdf]">
                    <div class="pl-[30px] py-[10px] flex flex-col">
                        <div>
                            <h1>
                                Nova knjiga
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
                                        <a href="{{route('new-book')}}" class="text-[#2196f3] hover:text-blue-600">
                                            Nova knjiga
                                        </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <x-jquery></x-jquery>
            
         
    </main>




@endsection
