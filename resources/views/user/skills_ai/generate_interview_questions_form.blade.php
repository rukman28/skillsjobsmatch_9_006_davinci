<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            @include('user.skills_ai.skills_ai_navigation')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">

                    <div class="flex flex-col">
                        <section>
                            <header class="bg-white space-y-4 p-4 sm:px-8 sm:py-6 lg:p-4 xl:px-8 xl:py-6">
                                <!--create a flex container for the header content-->
                                <p class="mt-0 mb-4 text-gray-600">SkillsAI is an experimental tool which use artificial intelligence. </p>
                                <hr class="my-8 border-b-2 border-gray-200"/>
                                <div>
                                    <p>You can use the following field to enter job title and the SkillsAI tool will generate interview questions.</p>
                                    <p>You can use the generated questions to prepare for the interview.</p>
                                </div>

                                <form class="group relative" action="{{ route('user.generate.questions.answers') }}" method="post" name="form_search" id="form_search">
                                    @csrf
                                    <input class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-10 ring-1 ring-slate-200 shadow-sm" type="text" aria-label="Enter a job description" placeholder="Enter a job title to generate interview questions..." name="prompt"></input>
                                </form>

                                <div class="flex justify-end p-1">
                                    <button class="relative inline-block px-4 py-2 font-medium group" onclick="submit_skills_search();">
                                        <span class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                        <span class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                        <span class="relative text-black group-hover:text-white">Generate Interview Questions</span>
                                    </button>
                                </div>
                            </header>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submit_skills_search() {
            document.getElementById("form_search").submit();
        }
    </script>
</x-user-layout>
