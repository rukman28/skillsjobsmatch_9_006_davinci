<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Modules') }} - {{ $programme->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <form action="{{ route('user.store.modules') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <table class="w-full border text-center">
                                            <thead class="border-b bg-gray-800">
                                            <tr>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 border-r text-white">
                                                    Module Code
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 border-r text-white">
                                                    Module Title
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 border-r text-white">
                                                    Module Selection
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($available_modules)
                                                @foreach($available_modules as $module)
                                                    <tr class="border-b">
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $module->code }}</td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                                            <p class="float-left">{{ $module->title }}</p>
                                                        </td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                                            <div class="form-check">
                                                                <input name="module_ids[]" value="{{ $module->id }}" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="flexCheckChecked">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>

                                        <div class="flex justify-end p-4">
                                            <button type="submit"
                                                    class="relative inline-block px-4 py-2 font-medium group">
                                                <span
                                                    class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                                <span
                                                    class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                                <span
                                                    class="relative text-black group-hover:text-white">Add Selected Modules</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
