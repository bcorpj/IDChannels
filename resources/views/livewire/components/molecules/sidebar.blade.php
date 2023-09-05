<div>
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="border-r border-gray-200 pt-5 flex flex-col flex-grow bg-white overflow-y-auto">
            <div class="flex-shrink-0 px-4 flex items-center">
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
            </div>
            <div class="flex-grow mt-5 flex flex-col">
                <nav class="flex-1 px-2 pb-4 space-y-1">
                    <x-include.molecules.sidebar-button title="Главная" icon="home" href="{{ route('dashboard') }}" />
                    <x-include.molecules.sidebar-button title="Данные" icon="circle-stack" href="{{ route('reference') }}" />
                </nav>
            </div>
        </div>
    </div>
</div>
{{--                    <x-include.molecules.sidebar-button title="Team" icon="users" href="#" />--}}
{{--                    <x-include.molecules.sidebar-button title="Projects" icon="folder" href="#" />--}}
{{--                    <x-include.molecules.sidebar-button title="Calendar" icon="calendar" href="#" />--}}
{{--                    <x-include.molecules.sidebar-button title="Documents" icon="inbox" href="#" />--}}
{{--                    <x-include.molecules.sidebar-button title="Reports" icon="home" href="#" />--}}
