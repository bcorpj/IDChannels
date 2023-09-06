<a {{ $attributes }} class="flex items-center px-4 py-2 mt-3 {{ $active ? 'text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-gray-200' : 'text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700' }}">
    <x-include.atoms.icon :name="$icon" {{ $attributes['solid'] ? 'solid' : '' }} class="text-gray-{{ $active ? '500' : '400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-6 w-6" />

    <span class="mx-4 font-medium">{{ $title }}</span>
</a>
