<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skills Result Suggestions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-1">
                    <div class="flex flex-col">
                        <div class="bg-blue-100 rounded-lg py-3 px-6 text-base text-red-700 mb-2 mt-2" role="alert">
                            <p>
                                <strong>No results found!</strong>
                                Your search - {{ $user_input_skill }} - did not match any skill.
                            </p>
                        </div>
                        <div class="table-responsive">
                            <table class="w-full border text-left">
                                <thead class="border-b bg-gray-800">
                                <tr>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-900 px-6 py-4 border-r text-white">Skill
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($suggestion_list as $skill)
                                    <tr class="border-b hover:bg-slate-300">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">
                                            <a href='{{ route('user.basic.skill.details',$skill->id) }}'>{{ $skill->title }}</a>
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
</x-user-layout>
