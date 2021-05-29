@props([
    'data',
    'permissions',
])
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
                                Permission
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                View
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Add
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Edit
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Delete
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- 'bg-gray-50':'bg-white'-->
                        @foreach($data as $i=>$object)

                            <tr class="{{$i%2?'bg-gray-50':'bg-white'}}">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                    {{$object['name']}}
                                </td>
                                @foreach($object['permissions'] as $item)
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                    <?php $name = 'permissions['.$i.']['.$item.']';?>

                                    <?php $checked_premission=in_array($item,$permissions);?>
                                    <x-checkout  :checked="$checked_premission" :name="$name" :value="$item" :title="$item"></x-checkout>
                                    {{--<div class="flex items-start">--}}
                                        {{--<div class="absolute flex items-center h-5">--}}
                                            {{--<input id="candidates" name="permissions[{{$i}}][{{$item}}]"  value="{{$item}}" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">--}}
                                        {{--</div>--}}
                                        {{--<div class="pl-7 text-sm leading-5">--}}
                                            {{--<label for="candidates" class="font-medium text-gray-700">{{$item}}</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- /End replace -->
</div>