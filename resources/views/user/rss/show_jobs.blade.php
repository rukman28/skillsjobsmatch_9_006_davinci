<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Jobs') }} - {!! html_entity_decode(str_replace("- jobs.ac.uk", "", $title)) !!}
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
                                    <table class="w-full border text-left">
                                        <thead class="border-b bg-gray-800">
                                        <tr>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 border-r text-white">
                                                Job Title
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 border-r text-white">
                                                Job Description
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 border-r text-white">
                                                Visit Website
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($items as $item)
                                            <tr class="border-b hover:bg-slate-300">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $item->get_title() }}</td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                                    <p class="float-left">{!! html_entity_decode($item->get_description()) !!}</p>
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                                    <a onclick="return confirm('Are you sure you want to visit third-party website?')" target="_blank"
                                                       href="{{ $item->get_permalink() }}">
                                                        Apply Now
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
