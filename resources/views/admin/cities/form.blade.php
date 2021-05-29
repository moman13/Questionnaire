<div class=" px-4 py-2 max-w-7xl mx-auto px-4 sm:px-6 md:px-8  mb-2 flex flex-row-reverse">
    <span class="inline-flex rounded-md shadow-sm">

    </span>
</div>
<div class="container  mx-auto flex  max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="border border-gray-300 p-6 w-full  bg-white shadow-lg rounded-lg">
        <div class="md:flex-col">

            <form class="w-full " @if($status ==3) wire:submit.prevent="update" @else  wire:submit.prevent="save" @endif>
                <div class="md:flex  md:flex-no-wrap -mx-3 mb-6">
                    <div class="md:w-2/5 sm:w-full flex-none px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            Name (en)
                        </label>
                        <input wire:model="form.name_en" class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Jane">

                    </div>
                    <div class="md:w-2/5 sm:w-full flex-none px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            Name (ar)
                        </label>
                        <input wire:model="form.name_ar" class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="المدينة">

                    </div>
                    <div class="md:w-2/5 sm:w-full w-auto m-auto flex-none px-3">

                    <button style="
    padding: 15px;
    margin-top: 10px;
" class="rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-teal-500 hover:bg-teal-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">{{$button_type}}</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>