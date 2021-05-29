<main class="flex-1 relative z-0 overflow-y-auto pt-2 pb-6 focus:outline-none md:py-6" tabindex="0" x-data x-init="$el.focus()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 ">
        <h1 class="text-2xl font-semibold text-gray-900">{{$page_title}}</h1>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <!-- Replace with your content -->
        <div class="py-4">
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">

                    <div class="mt-5 md:mt-0 md:col-span-3">
                        <form action="@if($status==3){{route('permision_role.update',$role->id)}}@else {{route('permision_role.save')}} @endif" method="post">
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">Name</label>
                                        <input id="first_name"   type="text" name="name"  value="{{$role['name']}}" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                        @error('name')<span class="mt-2 text-sm text-red-600">{{ $message }}</span>@enderror
                                    </div>

                                </div>
                            </div>

                            <x-permission :data="$permissions" :permissions="$user_permissions" ></x-permission>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                @if($status==2)
                                    <button  class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                        Save
                                    </button>
                                @else
                                    <button  class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                        Update
                                    </button>
                                @endif
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>