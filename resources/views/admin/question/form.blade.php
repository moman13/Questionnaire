<main class="flex-1 relative z-0 overflow-y-auto pt-2 pb-6 focus:outline-none md:py-6" tabindex="0" x-data x-init="$el.focus()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 ">
            <h1 class="text-2xl font-semibold text-gray-900">{{$page_title}}</h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <!-- Replace with your content -->
            <div class="py-4">
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <form  class="mt-5 md:mt-0 md:col-span-3 " @if($status==2) method="post" action="{{route('answer.save')}}" @else method="post" action="{{route('answer.update',$question->id)}}" @endif enctype="multipart/form-data">
                            @csrf
                        <div class="mt-5 md:mt-0 md:col-span-3">

                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="title_en" class="block text-sm font-medium leading-5 text-gray-700">Title (en)</label>
                                                <input id="title_en" wire:model.debounce.500ms="form.title_en" type="text" name="title_en" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                                @error('title_en')<span class="mt-2 text-sm text-red-600">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="title_ar" class="block text-sm font-medium leading-5 text-gray-700">Title (ar)</label>
                                                <input id="title_ar" wire:model.debounce.500ms="form.title_ar" type="text" name="title_ar" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                                @error('title_ar')<span class="mt-2 text-sm text-red-600">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid-flow-row text-right">
                                            <button wire:click.prevent="addHeader" class=" text-white bg-green-400 hover:bg-green-100 hover:text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">

                                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                <span>Add Answer</span>
                                            </button>
                                        </div>
                                    </div>
                                    @if(count($answers))
                                    <div class="hidden sm:block">
                                        <div class="py-5">
                                            <div class="border-t border-gray-200"></div>
                                        </div>
                                    </div>
                                            <div class="px-4 py-5 bg-white sm:p-6">

                                                @foreach( $answers as $i => $a)
                                                <div class="grid grid-cols-6 gap-6 mt-4">
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="title_en" class="block text-sm font-medium leading-5 text-gray-700">Answer (en)</label>
                                                        <input   value="{{$a['answers_en']}}" type="text" name="question_ansers_array[{{ $i }}][answers_en]"  class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />

                                                    </div>
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="title_en" class="block text-sm font-medium leading-5 text-gray-700">Answer (ar)</label>
                                                        <input  type="text" value="{{$a['answers_ar']}}"   name="question_ansers_array[{{ $i }}][answers_ar]" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                                    </div>
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <div class="grid grid-flow-col">

                                                            <div class="md:w-20 px-3">
                                                                <label  class="block text-sm font-medium leading-5 text-gray-700">Rating</label>
                                                                <input  type="text"  value="{{$a['rating']}}" name="question_ansers_array[{{ $i }}][rating]"  class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                                            </div>
                                                            <div class=" m-auto px-3 mt-5 ">
                                                                <div class="grid grid-flow-col">
                                                                    <button wire:click.prevent="removeHeader({{$i}})"class=" text-white bg-red-700 hover:bg-red-100 hover:text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                                                        <span>remove</span>
                                                                    </button>

                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>

                                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                @if($status==2)
                                                <button  type="submit" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                                    Save
                                                </button>
                                                @else
                                                    <button type="submit"  class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                                        Update
                                                    </button>
                                                @endif
                                            </div>

                                    @endif
                                </div>

                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>


    </main>