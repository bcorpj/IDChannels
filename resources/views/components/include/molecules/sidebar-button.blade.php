<a {{ $attributes }} class="{{ $active ? "bg-gray-100 text-gray-900" : "text-gray-600 hover:bg-gray-50 hover:text-gray-900" }} group rounded-md py-2 px-2 flex items-center text-sm font-medium cursor-pointer">
    <x-include.atoms.icon :name="$icon" {{ $attributes['solid'] ? 'solid' : '' }} class="text-gray-{{ $active ? '500' : '400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-6 w-6" />
    {{ $title }}
</a>
