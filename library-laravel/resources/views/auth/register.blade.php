{{-- Title --}}
<title>Registruj se - Online Biblioteka</title>

{{-- Icon --}}
<link rel="icon" type="image/x-icon" href="{{ asset('img/library-favicon.ico') }}">

{{-- Style --}}
<link rel="stylesheet" href="{{ asset('custom-style/style.css') }}">

<!DOCTYPE html>

<html lang="en">

<head>
    <!-- Meta -->
    <x-meta></x-meta>

    <!-- Styles -->
    <x-styles></x-styles>
    <!-- End Styles --> 
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Main content -->
    {{-- Background photo customize /public/style.css --}}
    <main class="h-screen small:hidden bg-register">
        <div class="flex items-center justify-center pt-[13%]">\
            <div class="w-full max-w-md">
                <form class="px-12 pt-6 pb-4 mb-4 bg-white rounded shadow-lg" method="POST" action="{{route('register')}}">
                    @csrf
                    <div class="flex justify-center py-2 mb-4 text-2xl text-gray-800 border-b-2">
                        Online Biblioteka 
                        <img height="5px" width="34px" class="ml-2" src="{{ asset('img/library-favicon.ico') }}" alt="Online Biblioteka" title="Online Biblioteka">
                    </div>

                    <div class="mb-4">

                        <label for="name" class="block mt-2 mb-2 text-sm font-normal text-gray-700">
                            Ime i prezime &nbsp;
                            @error('name')
                            <span style="color: #CD1A2B;font-size: 15px">/ {{$message}}</span>
                            @enderror
                        </label>
                        <input
                            class="w-full px-3 py-2 text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('name') border-2 border-rose-500 @enderror"
                            id="name"
                            name="name" 
                            type="text" 
                            required 
                            autofocus 
                            value="{{old('name')}}"/>
                    </div> 

                    <div class="mb-4">
                    
                        <label for="email" class="block mt-2 mb-2 text-sm font-normal text-gray-700">
                            Email adresa &nbsp;
                            @error('email')
                            <span style="color: #CD1A2B;font-size: 15px">/ {{$message}}</span>
                            @enderror
                        </label>
                        <input
                            class="w-full px-3 py-2 text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('email') border-2 border-rose-500 @enderror"
                            id="email"
                            name="email" 
                            v-model="form.email" 
                            type="email" 
                            required 
                            autofocus 
                            value="{{old('email')}}"/>
                    </div> 

                    <div class="mb-4">
                    
                        <label for="JMBG" class="block mt-2 mb-2 text-sm font-normal text-gray-700">
                            JMBG &nbsp;
                            @error('JMBG')
                            <span style="color: #CD1A2B;font-size: 15px">/ {{$message}}</span>
                            @enderror
                        </label>
                        <input
                            class="w-full px-3 py-2 text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('JMBG') border-2 border-rose-500 @enderror"
                            id="JMBG"
                            name="JMBG" 
                            type="number" 
                            required 
                            autofocus 
                            value="{{old('JMBG')}}"/>
                    </div> 

                    <div class="mb-4">
                        <label for="username" class="block mt-2 mb-2 text-sm font-normal text-gray-700">
                            Korisničko ime &nbsp;
                            @error('username')
                            <span style="color: #CD1A2B;font-size: 15px">/ {{$message}}</span>
                            @enderror
                        </label>
                        <input
                            class="w-full px-3 py-2 text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('username') border-2 border-rose-500 @enderror"
                            id="username"
                            name="username" 
                            type="text" 
                            required 
                            autofocus 
                            value="{{old('username')}}"/>
                    </div> 

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-normal text-gray-700" for="password">
                            Lozinka &nbsp;
                            @error('password')
                            <span style="color: #CD1A2B;font-size: 15px">/ {{$message}}</span>
                            @enderror
                        </label>
                        <input
                            class="w-full px-3 py-2 mb-3 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('password') border-2 border-rose-500 @enderror"
                            v-model="form.password" 
                            type="password" 
                            name="password" 
                            required
                            id="password"
                            autocomplete="current-password" />
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-normal text-gray-700" for="password_confirmation">
                            Potvrdi lozinku
                        </label>
                        <input
                            class="w-full px-3 py-2 mb-4 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            v-model="form.password" 
                            type="password" 
                            name="password_confirmation" 
                            required
                            id="password_confirmation"
                            autocomplete="current-password" />
                    </div>

                    <div class="flex items-center justify-between">

                        <button
                        type="submit"
                        class="inline-block px-4 py-2 text-white bg-blue-500 rounded shadow-lg btn-animation hover:bg-blue-600 focus:bg-blue-700">Registruj se</button>
                            
                    @if (Route::has('password.request'))
                    <a 
                    class="inline-block text-sm font-normal text-black align-baseline transition-custom hover:text-blue-800"
                    href="{{route('login')}}">
                            Imate nalog?
                    </a>
                    @endif
                        
                    </div>
                    <p class="text-xs text-center mt-[30px] text-gray-500">
                        &copy; @php echo date('Y') @endphp ICT Cortex. Sva prava zadržana.
                    </p>
                </form>

            </div>
        </div>
    </main>
    <!-- End Main content -->

    <!-- Notification for small devices -->
    <x-inProgress></x-inProgress>

    <!-- Scripts -->
    <x-scripts></x-scripts>
    <!-- End Scripts -->

</body>

</html>



















