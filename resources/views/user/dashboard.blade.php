<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <section>
                        <div class="container p-4 mx-auto bg-white max-w-7xl sm:p-6 lg:p-8">
                            <div class="flex flex-wrap -mx-8">
                                <div class="w-full px-8 lg:w-1/2">
                                    <div class="pb-12 mb-12 border-b lg:mb-0 lg:pb-0 lg:border-b-0">
                                        <h2 class="mb-4 text-3xl font-bold lg:text-4xl font-heading light:text-black">
                                            Skills Job Match can be used to learn skills acquired in your degree programme and to research job opportunities.
                                        </h2>
                                        <p class="mb-8 leading-loose text-gray-800 light:text-gray-300">
                                            Skills are an essential part of higher education because they allow students to apply their knowledge and theories to real-world situations. This is especially important in fields that require hands-on experience, such as STEM, where students need to be able to use their knowledge to solve practical problems.
                                        </p>

                                        <div class="w-full md:w-1/3">
                                            <a href="{{ route('user.view.basic.search') }}" class="relative inline-block px-4 py-2 font-medium group">
                                                <span class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                                <span class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                                <span class="relative text-black group-hover:text-white">Search Skills</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full px-8 lg:w-1/2">
                                    <ul class="space-y-12">
                                        <li class="flex -mx-4">
                                            <div class="px-4">
                            <span class="flex items-center justify-center w-16 h-16 mx-auto text-2xl font-bold text-blue-600 rounded-full font-heading bg-blue-50">
                                1
                            </span>
                                            </div>
                                            <div class="px-4">
                                                <h3 class="my-4 text-xl font-semibold light:text-black">
                                                    Matching Skills to Practicals
                                                </h3>
                                                <p class="leading-loose text-gray-800 light:text-gray-500">
                                                    <a href="{{ route('user.view.practicals') }}" class="hover:bg-sky-200">Practical experiences</a> are an important part of higher education because they provide students with the opportunity to apply their knowledge and develop valuable skills in a real-world setting.
                                                </p>
                                            </div>
                                        </li>
                                        <li class="flex -mx-4">
                                            <div class="px-4">
                            <span class="flex items-center justify-center w-16 h-16 mx-auto text-2xl font-bold text-blue-600 rounded-full font-heading bg-blue-50">
                                2
                            </span>
                                            </div>
                                            <div class="px-4">
                                                <h3 class="my-4 text-xl font-semibold light:text-black">
                                                    Programme Modules
                                                </h3>
                                                <p class="leading-loose text-gray-800 light:text-gray-500">
                                                    You can access <a href="{{ route('user.show.modules') }}" class="hover:bg-sky-200">programme modules</a> to see the skills you have acquired in your degree programme.
                                                </p>
                                            </div>
                                        </li>
                                        <li class="flex -mx-4">
                                            <div class="px-4">
                            <span class="flex items-center justify-center w-16 h-16 mx-auto text-2xl font-bold text-blue-600 rounded-full font-heading bg-blue-50">
                                3
                            </span>
                                            </div>
                                            <div class="px-4">
                                                <h3 class="my-4 text-xl font-semibold light:text-black">
                                                    SkillsAI&trade;
                                                </h3>
                                                <p class="leading-loose text-gray-500 light:text-gray-500">
                                                    We are currently working on a machine learning based system to help you career development. This system will be available soon.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-user-layout>
