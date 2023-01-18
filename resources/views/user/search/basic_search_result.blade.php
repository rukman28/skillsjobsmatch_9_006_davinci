<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skills Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-1">
                    <div class="flex flex-col">
                        <div class="bg-blue-100 rounded-lg py-3 px-6 text-base text-black-700 mb-2 mt-2" role="alert">
                            <p>
                                Result for <b><i>{{ key($skill_result) }}</i></b>
                            </p>
                            <p>Academic Programme: {{ $user_programme->title }}</p>
                            <p>Skill Category: {{ \App\Models\SkillCategory::find( (\App\Models\Skill::where('title',key($skill_result))->first()->skill_category_id))->title }}</p>
                            <p>You have practised the <u>{{ key($skill_result) }}</u> skill {{ $skill_practiced_times }} times during your studies.</p>
                        </div>
                        @foreach($skill_result[key($skill_result)] as $module_id => $practicals)
                        <details class="w-full bg-black text-white text-gray-900 border border-gray-800 cursor-pointer mb-3">
                            <summary class="w-full bg-gray-800 text-white flex justify-between px-4 py-3  after:content-['+']">{{ \App\Models\Module::find($module_id)->code }}: {{ \App\Models\Module::find($module_id)->title }}</summary>
                            <p class="px-4 py-3 bg-gray-300 text-black">
                                Practicals
                            </p>
                            <ol class="px-4 py-3 bg-white text-black">
                                @foreach ($practicals as $practical)
                                    <li class="px-4 py-2">{{ $practical->title }}</li>
                                @endforeach
                            </ol>
                        </details>
                        @endforeach


                        <!-- THE CSS -->
                        <style>
                            details summary::-webkit-details-marker {
                                display: none;
                            }


                            details[open] summary {
                                /*background: blue;*/
                                color: white
                            }

                            details[open] summary::after {
                                content: "-";
                            }

                            details[open] summary ~ * {
                                animation: slideDown 0.3s ease-in-out;
                            }

                            details[open] summary p {
                                opacity: 0;
                                animation-name: showContent;
                                animation-duration: 0.6s;
                                animation-delay: 0.2s;
                                animation-fill-mode: forwards;
                                margin: 0;
                            }

                            @keyframes showContent {
                                from {
                                    opacity: 0;
                                    height: 0;
                                }
                                to {
                                    opacity: 1;
                                    height: auto;
                                }
                            }
                            @keyframes slideDown {
                                from {
                                    opacity: 0;
                                    height: 0;
                                    padding: 0;
                                }

                                to {
                                    opacity: 1;
                                    height: auto;
                                }
                            }
                        </style>








                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
