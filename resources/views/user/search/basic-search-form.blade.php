<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Skills') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">

                    <div class="flex flex-col">
                        <section>
                            <header class="bg-white space-y-4 p-4 sm:px-8 sm:py-6 lg:p-4 xl:px-8 xl:py-6">
                                <div class="flex items-center justify-between">
                                    <h2 class="font-semibold text-slate-900">You can use this form to search for skills. You can insert resulted skills in your CV.</h2>
                                </div>
                                <form class="group relative" action="{{ route('user.basic.search.result') }}" method="post" name="form_search" id="form_search">
                                    @csrf
                                    <svg width="20" height="20" fill="currentColor" class="absolute left-3 top-1/2 -mt-2.5 text-slate-400 pointer-events-none group-focus-within:text-blue-500" aria-hidden="true">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                    </svg>
                                    <input class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-10 ring-1 ring-slate-200 shadow-sm" type="text" aria-label="Search Skills" placeholder="Enter skill to search..." name="skill">
                                </form>

                                <div class="flex justify-end p-1">
                                    <button class="relative inline-block px-4 py-2 font-medium group" onclick="submit_skills_search();">
                                        <span class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                        <span class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                        <span class="relative text-black group-hover:text-white">Search Skills</span>
                                    </button>
                                </div>
                            </header>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
<script>
    function submit_skills_search() {
        document.getElementById("form_search").submit();
    }
</script>
