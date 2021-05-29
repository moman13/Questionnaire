<div class="col-span-6 sm:col-span-6">
        <label for="photo" class="block text-sm leading-5 font-medium text-gray-700">
            Photo
        </label>
        <div class="mt-2 flex items-center">

                <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                @if($attributes['image_url'])
                        <img src="{{$attributes['image_url']}}" alt="Profile Photo" />
                @else
                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                             <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                @endif

                </span>
                 <input class="hidden" id="file" type="file" wire:model="{{ $attributes['wire:model'] }}">
                <span class="ml-5 rounded-md shadow-sm">
                        <label for="file"  class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                            Change
                        </label>
                      {{--<button type="button" class="">--}}
                        {{--Change--}}
                      {{--</button>--}}

                </span>
        </div>

</div>