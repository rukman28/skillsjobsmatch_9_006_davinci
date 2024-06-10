<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rukman Bernard Fernando Pulle">
    <meta name="description" content="This web application has been developed to help students by letting them track all the skills they have practiced in the programme.">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>SkillTool</title>
</head>

<body class=" screen_height:h-screen bg-gradient-to-t from-blue-500 to-slate-300 ">
    {{-- header --}}
    <section class="">
        <div class="flex justify-center ">
            <h1 class=" text-2xl font-Fjualla font-bold text-green-900">S<span class=" text-4xl font-bold font-roboto text-red-900">K</span>ilL <span class=" text-4xl font-bold font-roboto text-red-900">T</span>ooL</h1>
        </div>
        <div class="flex justify-center mb-5">
            <h3 class="font-roboto font-bold text-blue-900 text-xs uppercase">Horizon Campus</h3>
        </div>

    </section>
    {{-- end of header --}}

    {{-- banner information --}}
    <section class="">
        <div class=" flex flex-col tablet:flex-row tablet:mb-10 gap-4  mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">
            <div class="tablet:rotate-6 tablet:hover:rotate-0 tablet:duration-150 relative mx-auto max-w-sm rounded-3xl  p-0.5 shadow-md shadow-lime-800 bg-red-700 border-4 border-pink-500">
                <div class=" p-7 rounded-3xl ">
                    <h1 class="font-bold text-xl text-black mb-2">Students' Skills</h1>
                    <p class=" text-slate-200">Tracking and developing students' skills enhances career readiness, personal growth, academic success, institutional improvement, and workforce alignment.</p>
                </div>
            </div>

            <div class="relative mx-auto max-w-sm rounded-3xl  p-0.5 bg-green-700 border-4 border-red-900 shadow-md shadow-neutral-900">
                <div class=" p-7 rounded-3xl ">
                    <h1 class="font-bold text-xl mb-2 text-black">Skill Shortage</h1>
                    <p class=" text-slate-200">Addressing skill shortages requires targeted training, education programs, industry partnerships, upskilling, and reskilling of the current workforce.</p>
                </div>
            </div>

            <div class="relative mx-auto max-w-sm rounded-3xl tablet:-rotate-6 tablet:hover:rotate-0 tablet:duration-150  p-0.5 bg-yellow-600 border-4 border-green-500 shadow-md shadow-orange-900">
                <div class=" p-7 rounded-3xl ">
                    <h1 class="font-bold text-xl mb-2 text-black">Skill Training</h1>
                    <p class="text-slate-200">Skill training involves structured programs designed to develop specific competencies, enhance job performance, and meet industry demands.</p>
                </div>
            </div>

        </div>
    </section>
    {{-- end of banner information --}}

    {{-- cards --}}
    <section class="">
        <div class="flex flex-col tablet:flex-row mt-10 gap-4 mx-auto max-w-7xl  items-center grow">
                {{-- univeristy picture --}}

                <div class=" overflow-hidden tablet:h-[380px] basis-1/4 max-w-sm bg-gradient-to-r from-red-600 to-green-600 border border-gray-200 rounded-3xl shadow-xl dark:bg-gray-800 dark:border-gray-700">

                        <img class="rounded-t-3xl w-full" src="{{asset('images/university.jpg')}}" alt="" />

                    <div class="p-5">

                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black ">Horizon Campus</h5>
                            <p class="  mb-3 font-normal text-slate-200 dark:text-gray-400">Empower Your Future: Discover, Develop, and Excel in the Skills Needed for Tomorrow's Careers at Our University.</p>


                    </div>
                </div>

                {{-- end of university picture --}}

                {{-- student image and button --}}

                <div class=" overflow-hidden tablet:h-[380px] basis-1/4 max-w-sm bg-gradient-to-r from-yellow-600 to-red-600 border border-gray-200 rounded-3xl shadow-xl dark:bg-gray-800 dark:border-gray-700">

                        <img class="rounded-t-3xl w-full" src="{{asset('images/student.jpg')}}" alt="" />

                    <div class="p-5">

                        <div class="flex justify-end">

                            <a href="#" class=" py-2.5 px-6 rounded-lg text-sm font-medium text-white hover:bg-blue-800 bg-blue-900">Student</a>
                        </div>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black dark:text-white"> Students</h5>

                        <p class=" font-normal text-slate-200 dark:text-gray-400">Enhance your skills with our University Skill Tracker. Sign up or log in now to start your journey!</p>
                    </div>

                </div>
                {{-- end of student image and button --}}

                {{-- admin image and button --}}

                <div class=" overflow-hidden tablet:h-[380px] basis-1/4 max-w-sm bg-gradient-to-r from-green-600 to-yellow-600 border border-gray-200 rounded-3xl shadow-xl dark:bg-gray-800 dark:border-gray-700">

                        <img class="rounded-t-3xl w-full" src="{{asset('images/admin.jpg')}}" alt="" />

                    <div class="p-5">

                        <div class="flex justify-end">

                            <a href="#" class="py-2.5 px-6 rounded-lg text-sm font-medium text-white hover:bg-blue-800 bg-blue-900">Admin</a>
                        </div>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black dark:text-white">Administration</h5>

                        <p class="  font-normal text-slate-200 dark:text-gray-400">Our administration fosters excellence and innovation for every student's success.</p>
                    </div>
                </div>

                {{-- end of admin image and button --}}


                {{-- Skill tool card --}}
                <div class=" overflow-hidden tablet:h-[380px] basis-1/4 max-w-sm bg-gradient-to-r from-red-600 to-yellow-600 border border-gray-200 rounded-3xl shadow-xl dark:bg-gray-800 dark:border-gray-700">
                    <div>
                            <img class="rounded-t-3xl w-full" src="{{asset('images/tool.jpg')}}" alt="" />

                        <div class="p-5">

                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> Skill Tool</h5>

                            <p class="mb-3 font-normal text-slate-200 dark:text-gray-400">Announcing our new Skill Tracker! Easily monitor, develop, and showcase your abilities, empowering your academic and career journey. </p>

                        </div>
                    </div>
                </div>
                {{-- end of skill tool card --}}


            </div>
        </div>
    </section>

{{-- testimonials --}}
<section class=" ">
    <div class=" flex flex-col tablet:mt-10 tablet:mb-9 mt-10 tablet:flex-row max-w-[400px] relative overflow-hidden  mx-auto gap-6 tablet:max-w-7xl items-center">
        <div class="max-w-7xl mx-auto ">
          <div class="relative group ">
            <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative bg-gradient-to-r from-red-600 to-green-600 ring-1 ring-gray-900/5 rounded-full leading-none flex items-top justify-start space-x-6">
              <div class=" flex items-center">
                <img class="rounded-full h-24 mr-2" src="{{asset('images/student-01.jpg')}}" alt="">
                <div class="flex flex-col">
                     <h3 class=" font-bold">Ms.Ann Livera</h3>
                     <p class=" font-semibold text-slate-800 mr-2">Simplified skill tracking, diverse resources. Skill Tool is a must-have for student advancement.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="max-w-7xl mx-auto">
          <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative bg-gradient-to-r from-red-600 to-yellow-600 ring-1 ring-gray-900/5 rounded-full leading-none flex items-top justify-start space-x-6">
              <div class=" flex items-center">
                <img class="rounded-full h-24 mr-2" src="{{asset('images/student-02.jpg')}}" alt="">
                <div class="flex flex-col">
                     <h3 class=" font-bold">Mr.Tony Brown</h3>
                     <p class=" font-semibold text-slate-800 mr-2">Easy tracking, rich resources, user-friendly. Skill Tool is essential for student growth.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="max-w-7xl mx-auto">
          <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative bg-gradient-to-r from-green-600 to-yellow-600 ring-1 ring-gray-900/5 rounded-full leading-none flex items-top justify-start space-x-6">
              <div class=" flex items-center">
                <img class="rounded-full h-24 mr-2" src="{{asset('images/student-03.jpg')}}" alt="">
                <div class="flex flex-col">
                     <h3 class=" font-bold">Mr.Lean Witerbrow</h3>
                     <p class=" font-semibold text-slate-800 mr-2">Seamless skill monitoring, vast resources. Skill Tool is indispensable for student success.</p>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
</section>

{{-- end of testimonials --}}




{{-- footer --}}
<section class=" ">
    <div class="flex flex-row justify-center mt-5">
        <div>
            <p>Copyright &copy; 2024 - All rights reserved by R B Fernando </p>
        </div>
    </div>
</section>

{{-- end of footer --}}

</body>

</html>
