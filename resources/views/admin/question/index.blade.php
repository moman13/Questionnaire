@if($status ==1)
    <main class="flex-1 relative z-0 overflow-y-auto pt-2 pb-6 focus:outline-none md:py-6" tabindex="0" x-data x-init="$el.focus()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8  ">
                <h1 class="text-2xl font-semibold text-gray-900">Questions</h1>
        </div>
        <div class=" max-w-7xl mx-auto px-4 sm:px-6 md:px-8  mb-2 flex flex-row-reverse">
             <span class="inline-flex rounded-md shadow-sm">
                  <button wire:click="create" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                   Create
                  </button>
            </span>
        </div>

        <x-input.search wire:model="full_name_search" />


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
                                        Title
                                    </th>

                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                </tr>
                                </thead>
                                <tbody>
                            @forelse  ($data as $i=>$row)
                                <tr class="{{$i%2?'bg-gray-50':'bg-white'}}">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{$row->title}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <div class="inline-flex  items-center px-4 py-2  text-sm leading-5 font-medium rounded-md text-gray-700 ">

                                            <x-button_icon.edit wire:click="edit({{$row->id}})"  />
                                            <x-button_icon.delete :object="$row"  />
                                        </div>


                                    </td>
                                </tr>
                            @empty
                                <x-nodata colspan="2"></x-nodata>
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
@else
    @include('admin.question.form')
@endif