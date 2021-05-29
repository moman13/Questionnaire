<main class="flex-1 relative z-0 overflow-y-auto pt-2 pb-6 focus:outline-none md:py-6" tabindex="0" x-data x-init="$el.focus()">
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8  ">
        <h1 class="text-2xl font-semibold text-gray-900">Regins</h1>
</div>

@if($status == 1)
    <div class=" max-w-7xl mx-auto px-4 sm:px-6 md:px-8  mb-2 flex flex-row-reverse">
    <span class="inline-flex rounded-md shadow-sm">
      <button wire:click="create" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
       Create
      </button>
    </span>
    </div>
    <div class="container  mx-auto flex  max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="border border-gray-300 p-6 w-full  bg-white shadow-lg rounded-lg">
            <div class="flex-col">

                <form class="w-full "  wire:submit.prevent="search">
                    <div class="md:flex  md:flex-no-wrap -mx-3 mb-6">
                        <div class="md:w-2/5 sm:w-full flex-none px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Name
                            </label>
                            <input  autocomplete='false' wire:model="search_name" class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Jane">

                        </div>
                        <div class="md:w-2/5 sm:w-full flex-none px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="location">
                                City
                            </label>
                            <select autocomplete='false' wire:model="search_city_id" id="location" class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                <option  value="0" selected>Select </option>
                                 @foreach($cities as $city)
                                     <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
@else

        @include('admin.regins.form')
@endif

<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <!-- Replace with your content -->
    <div class="py-4">


        <div class="flex flex-col">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name (en)
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name (ar)
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                City
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse  ($data as $i=>$city)
                            <tr class="{{$i%2?'bg-white':'bg-gray-50'}}">
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                {{$city->translations['name']['en']}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                {{$city->translations['name']['ar']}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                {{$city->city->name}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                <div class="inline-flex  items-center px-4 py-2  text-sm leading-5 font-medium rounded-md text-gray-700 ">


                                    <x-button_icon.edit wire:click="edit({{$city->id}})" />
                                    <x-button_icon.delete :object="$city" />
                                </div>

                            </td>
                        </tr>
                        @empty
                            <x-nodata colspan="4"></x-nodata>
                        @endforelse
                        </tbody>

                    </table>
                </div>
            </div>


            {{ $data->links() }}

        </div>
    </div>
    <!-- /End replace -->
</div>
</main>
