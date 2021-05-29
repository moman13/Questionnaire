<div>

    <main class="flex-1 relative z-0 overflow-y-auto pt-2 pb-6 focus:outline-none md:py-6" tabindex="0" x-data x-init="$el.focus()">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <!-- Replace with your content -->
        {{--<div class="py-4">--}}
        {{--<div class="border-4 border-dashed border-gray-200 rounded-lg h-96"></div>--}}
        {{--</div>--}}
        <!-- /End replace -->
            <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                                Delegates
                            </dt>
                            <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                {{\App\User::count()}}
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                                Customers
                            </dt>
                            <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                {{\App\Customer::count()}}
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                                Questions
                            </dt>
                            <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                {{\App\Question::count()}}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="flex flex-col mt-8">

                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Company name
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Commissioner name
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    phone
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    address
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    whatsapp
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    email
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse  ($data as $i=>$user)

                                <tr class="{{$i%2?'bg-gray-50':'bg-white'}}">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{$user->company_name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{$user->commissioner_name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{$user->phone}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{$user->address}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{$user->whatsapp}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{$user->email}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">


                                        <button   wire:click="edit({{$user->id}})" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">

                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                            <span>Edit</span>
                                        </button>
                                        {{--<button class="bg-white-300 hover:bg-red-400 text-red-800 font-bold py-2 px-4 rounded inline-flex items-center">--}}
                                        <button wire:click="destroy({{$user->id}})" class="  inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                            <svg  class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            <span>Delete</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <x-nodata colspan="7"></x-nodata>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>


                {{ $data->links() }}

            </div>
        </div>


    </main>
</div>
