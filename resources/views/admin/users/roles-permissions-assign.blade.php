<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Roles & Permission') }} to <i>{{ $user->name }}</i>
        </h2>
    </x-slot>

    <div class="py-12 w-full">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-2">
                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Assign Roles</h3>
                                    <p class="mt-1 text-sm text-gray-600">Select roles to assign to the user.</p>
                                    @error('name')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <form action="{{ route('admin.users.roles.assign', $user) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="overflow-hidden shadow sm:rounded-md">
                                        <div class="bg-white px-4 py-5 sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="first-name"
                                                           class="block text-sm font-medium text-gray-700">Select
                                                        Role</label>
                                                    <select name="role" class="form-select appearance-none
                                                          mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                            aria-label="role">
                                                        @if($all_roles)
                                                            @foreach($all_roles as $role)
                                                                <option value="{{ $role->name }}"
                                                                        name="role">{{ $role->name }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex justify-end p-4">
                                            <button type="submit"
                                                    class="relative inline-block px-4 py-2 font-medium group">
                                                <span
                                                    class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                                <span
                                                    class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                                <span
                                                    class="relative text-black group-hover:text-white">Add Role</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Role Permissions</h3>
                                    <p class="mt-1 text-sm text-gray-600">You can assign permissions to the selected
                                        user.</p>
                                    @error('name')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <form action="{{ route('admin.users.permissions.assign', $user) }}" method="POST">
                                    @csrf
                                    <div class="overflow-hidden shadow sm:rounded-md">
                                        <div class="bg-white px-4 py-5 sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="first-name"
                                                           class="block text-sm font-medium text-gray-700">Select
                                                        Permission</label>
                                                    <select name="permission" class="form-select appearance-none
                                                          mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                            aria-label="Please select permission.">
                                                        @if($all_permissions)
                                                            @foreach($all_permissions as $permission)
                                                                <option value="{{ $permission->name }}"
                                                                        name="permission">{{ $permission->name }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex justify-end p-4">
                                            <button type="submit"
                                                    class="relative inline-block px-4 py-2 font-medium group">
                                                <span
                                                    class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                                <span
                                                    class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                                <span
                                                    class="relative text-black group-hover:text-white">Assign Permissions</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
</x-admin-layout>
