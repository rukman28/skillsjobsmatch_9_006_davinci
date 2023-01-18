<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Result for your search....') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">

                    <div class="flex flex-col">
                        <!-- A simple testimonial card -->
                        <div class="w-full p-4">
                            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">We found {{ $count }} skills from the description.</h1>
                            <p class="text-lg py-3">{!!  isset($new_text) ? $new_text : '' !!}</p>

                            <div class="flex justify-end p-1 pr-3">
                                <a class="relative inline-block px-4 py-2 font-medium group" href="{{ route('user.view.job.description.form') }}">
                                    <span class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                    <span class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                    <span class="relative text-black group-hover:text-white">Search again.</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
