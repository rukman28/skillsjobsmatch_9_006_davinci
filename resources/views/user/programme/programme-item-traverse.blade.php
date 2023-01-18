<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Practicals By Module') }}
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

                                    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                                        <div class="border-t border-gray-200">
                                            <dl>

                                                <div
                                                    class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-lg font-medium text-gray-500">{{ $collectionOwnerName }}
                                                        : {{$collectionOwner->title}}</dt>
                                                    <dd class="mt-1 text-base text-gray-900 sm:col-span-2 sm:mt-0">

                                                            @if($collectionName === 'skill')
                                                            <ul class="bg-white border border-gray-200 w-full text-gray-900">
                                                                @foreach($collection as $key => $item)
                                                                <li class="px-6 py-2 border-b border-gray-200 w-full">
                                                                    <a href="" class="p-3">Skill Category: {{ $key }}</a>
                                                                    <ul class="bg-white border border-gray-200 w-full text-gray-900">
                                                                        @foreach($item as $skill)
                                                                            <li class="px-6 py-2 border-b border-gray-200 w-full">
                                                                                <a href="{{ route('user.basic.skill.details',[$skill->id]) }}">{{$skill->title}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                            @else
                                                                @php
                                                                    $i = 1
                                                                @endphp
                                                                <h5 class="border-b bg-gray-200 p-2">Practicals</h5>
                                                                <ul class="bg-white border border-gray-200 w-full text-gray-900">
                                                                    @foreach($collection as $key => $item)
                                                                    <li class="px-6 py-2 border-b border-gray-200 w-full">
                                                                        <a href="{{ route('user.programme_detail.traverser',[$item->getTable(),$item->id]) }}"> {{ ucfirst($item->title) }}</a>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>

                                                            @endif
                                                        </ul>
                                                    </dd>
                                                </div>

                                            </dl>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
