<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Roles') }}
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
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Roles</h3>
                                    <p class="mt-1 text-sm text-gray-600">You can edit the selected role.</p>
                                    @error('name')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="overflow-hidden shadow sm:rounded-md">
                                        <div class="bg-white px-4 py-5 sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="first-name"
                                                           class="block text-sm font-medium text-gray-700">Role
                                                        name</label>
                                                    <input type="text" value="{{ $role->name }}" name="name"
                                                           id="first-name" autocomplete="given-name"
                                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
                                                    class="relative text-black group-hover:text-white">Update Role</span>
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
                                        role.</p>
                                    @error('name')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <form action="{{ route('admin.roles.permissions', $role) }}" method="POST">
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
                                                            aria-label="Default select example">
                                                        @if($permissions)
                                                            @foreach($permissions as $permission)
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
                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Role Permissions</h3>
                                    <p class="mt-1 text-sm text-gray-600">You can view assigned permissions to the
                                        selected role.</p>
                                    @error('name')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    <div class="bg-white px-4 py-5 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="first-name"
                                                       class="block text-sm font-medium text-gray-700">Permissions</label>
                                                <div
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                    >
                                                    @if($role->permissions)
                                                        <div class="flex flex-col">
                                                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                                                    <div class="overflow-hidden">
                                                                        <table class="min-w-full">
                                                            <thead class="border-b">
                                                            <tr>
                                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Permission</th>
                                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Remove</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="border-b">
                                                                @foreach($role->permissions as $permission)
                                                                    <tr>
                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $permission->name }} </td>
                                                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                                <form method="POST" action="{{ route('admin.roles.permissions.revoke', [$role, $permission]) }}" onsubmit="return confirm('Are you sure?');">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 ">Remove</button></td>
                                                                                </form>
                                                                    </tr>
                                                                @endforeach
                                                        </tbody>
                                                        </table>
                                                    @endif
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
        </div>
    </div>
</x-admin-layout>
