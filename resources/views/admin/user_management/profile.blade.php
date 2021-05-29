<main class="flex-1 relative z-0 overflow-y-auto pt-2 pb-6 focus:outline-none md:py-6" tabindex="0" x-data x-init="$el.focus()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 ">
        <h1 class="text-2xl font-semibold text-gray-900">{{$page_title}}</h1>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <!-- Replace with your content -->
        <div class="py-4">
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">

                    <div class="mt-5 md:mt-0 md:col-span-2">

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">Name</label>
                                        <input id="first_name" wire:model.debounce.500ms="form.name" type="text" name="name" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('form.name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                        @error('form.name')<span class="mt-2 text-sm text-red-600">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="last_name" class="block text-sm font-medium leading-5 text-gray-700">Email</label>
                                        <input id="last_name" wire:model.debounce.500ms="form.email" type="text" name="email" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('form.email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                        @error('form.email')<span class="mt-2 text-sm text-red-600">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">Password</label>
                                        <input id="password" wire:model.debounce.500ms="form.password"  name="password" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('form.password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                        @error('form.password')<span class="mt-2 text-sm text-red-600">{{ $message }}</span>@enderror
                                    </div>

                                    @if($photo)
                                        <x-image_upload image_url="{{$photo->temporaryUrl()}}" wire:model="photo"  ></x-image_upload>
                                    @else
                                        <x-image_upload image_url="{{$form['image_url']}}" wire:model="photo"  ></x-image_upload>
                                    @endif



                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button wire:click="update" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                        Update
                                    </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</main>
