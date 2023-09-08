<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 pt-10 pl-6">
    <a href="#" class="mx-auto">
        <img class="w-auto h-6 sm:h-10" src="https://www.jusanmobile.kz//public/img/jusan_mobile_logo.png" alt="">
    </a>

    <div class="flex flex-col items-center mt-6 -mx-2">
        <img class="object-cover w-24 h-24 mx-2 rounded-full" src="https://png.pngtree.com/png-vector/20190321/ourmid/pngtree-vector-users-icon-png-image_856952.jpg" alt="avatar">
        <h4 class="mx-2 mt-2 font-medium text-gray-800 dark:text-gray-200">{{ $user->fullname }}</h4>
        <p class="mx-2 mt-1 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $user->alias() }}</p>
    </div>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav>
            <x-include.molecules.sidebar-button-padded title="{{ __('ui.main_page') }}" icon="home" href="{{ route('dashboard') }}" wire:navigate />
            @hasanyrole('manager|admin')
            <x-include.molecules.sidebar-button-padded title="{{ __('ui.prebuilt_data') }}" icon="circle-stack" href="{{ route('reference') }}" wire:navigate />
            @endhasanyrole
            @role('admin')
            <x-include.molecules.sidebar-button-padded title="{{ __('ui.users') }}" icon="users" href="{{ route('users') }}" wire:navigate />
            <x-include.molecules.sidebar-button-padded title="{{ __('ui.accesses') }}" icon="eye" href="{{ route('access') }}" wire:navigate />
            @endrole
        </nav>
    </div>
</div>
{{--                    <x-include.molecules.sidebar-button-padded title="Projects" icon="folder" href="#" />--}}
{{--                    <x-include.molecules.sidebar-button-padded title="Calendar" icon="calendar" href="#" />--}}
{{--                    <x-include.molecules.sidebar-button-padded title="Documents" icon="inbox" href="#" />--}}
{{--                    <x-include.molecules.sidebar-button-padded title="Reports" icon="home" href="#" />--}}
