<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modules By Level') }} - {{ $programme->title }}
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
                                                @foreach($modules_by_level as $level_title => $modules)
                                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-lg font-medium text-gray-500">{{ $level_title }}</dt>
                                                    <dd class="mt-1 text-base text-gray-900 sm:col-span-2 sm:mt-0">
                                                        <ul>
                                                            @foreach($modules as $module)
                                                                <li><a href="{{ route('user.programme_detail.traverser',['modules',$module->id]) }}" >{{$module->title}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </dd>
                                                </div>
                                                @endforeach
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
