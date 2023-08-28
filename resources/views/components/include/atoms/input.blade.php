<div>
    <div class="flex justify-between">
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700"> {{ $label }} </label>
        @if($showError and isset($errors))
            <span class=" text-sm text-gray-900"> {{ $errors->first() }} </span>
        @endif
    </div>
    <div class="mt-1">
        <input {{ $attributes }} name="{{ $name }}" id="{{ $name }}" class="{{ $class ?? 'appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm' }}">
    </div>
</div>
