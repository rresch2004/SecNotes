<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>{{Auth::user()->name}}, willkommen bei ihren Notizen</h1>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (session()->has('success'))
                <div class="p-6 font-medium text-2xl text-green-500">
                    <p>{{session('success')}}</p>
                </div>
                @endif
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/notes" method="post">

                        @csrf

                        <div>

                            @error('title')
                            <div class="text-2xl text-red-500 font-medium">
                                {{$message}}
                            </div>
                            @enderror

                            <label for="title">
                                {{__('Title')}}
                            </label>
                            <input type="text" id="title" value="{{old('title')}}" name="title">
                        </div>
                        <div>
                            @error('title')
                            <div class="text-2xl text-red-500 font-medium">
                                {{$message}}
                            </div>
                            @enderror
                            <label for="content">
                                {{__('Content')}}
                            </label>
                            <input type="text" id="content" value="{{old('content', 'Vorgabe')}}" name="content">
                        </div>

                        <div>
                            <x-primary-button>{{__('Save')}}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">
                    @foreach(Auth::user()->notes as $note)
                        <div class="flex justify-between">
                            <h2>{{$note->title}}</h2>
                            <div class="flex items-center space-x-6">

                                <form action="/notes/{{ $note->id }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button> <x-trash class="text-red-500"/></button>
                                    <span class="sr-only">Remove note</span>
                                </form>

                                <form action="/notes/{{ $note->id }}" method="post" >
                                    @csrf
                                    @method('PATCH')

                                    <button> <x-star  class="text-yellow-500" /> </button>
                                    <span class="sr-only">{{ __('favourite note') }}</span>
                                </form>

                                <a href="/notes/{{$note->id}}/edit">
                                    <x-pen />
                                    <span class="sr-only">{{ __('Edit note') }}</span>
                                </a>
                                <a href="/notes/{{$note->id}}/show">
                                    <x-lupe />
                                    <span class="sr-only">{{ __('Show note') }}</span>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
