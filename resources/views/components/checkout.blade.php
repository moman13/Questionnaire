@props([
    'name',
    'value',
    'title',
    'checked'=>false,
    'livewire'=>false
])
<div class="flex items-start">
    <div class="absolute flex items-center h-5">
        <input id="candidates" @if($livewire) wire:model.debounce.500ms="{!! $livewire !!}" @endif {{$checked?'checked' : ''}} name="{{$name}}"  value="{{$value}}" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
    </div>
    <div class="pl-7 text-sm leading-5">
        <label for="candidates" class="font-medium text-gray-700">{{$title}}</label>
    </div>
</div>