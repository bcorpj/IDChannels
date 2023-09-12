<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <main class="flex-1">
        <div class="relative max-w-4xl mx-auto md:px-8 xl:px-0">
            <div class="pt-10 pb-16">
                <div class="px-4 sm:px-6 md:px-0">
                    <div class="py-6">

                        <!-- Description list with inline editing -->
                        <div class="mt-10 divide-y divide-gray-200">
                            <div class="space-y-1">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('ui.profile') }}</h3>
                                <p class="max-w-2xl text-sm text-gray-500">{{ __('ui.warns.public_info') }}</p>
                            </div>
                            <div class="mt-6">
                                <dl class="divide-y divide-gray-200">
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">{{ __('ui.fullname') }}</dt>
                                        <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <span class="flex-grow">{{ $this->user->fullname }}</span>
                                            <span class="ml-4 flex-shrink-0">
                                                {{ $this->updateName() }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                                        <dt class="text-sm font-medium text-gray-500">{{ __('ui.photo') }}</dt>
                                        <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <span class="flex-grow">
                                                <img class="h-8 w-8 rounded-full"
                                                        src="https://png.pngtree.com/png-vector/20190321/ourmid/pngtree-vector-users-icon-png-image_856952.jpg"
                                                        alt="">
                                            </span>
                                            <span class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                                <button type="button"
                                                        class="bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Update</button>
                                                <span class="text-gray-300" aria-hidden="true">|</span>
                                                <button type="button"
                                                        class="bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Remove</button>
                                            </span>
                                        </dd>
                                    </div>
{{--                                    <div--}}
{{--                                        class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-b sm:border-gray-200">--}}
{{--                                        <dt class="text-sm font-medium text-gray-500">Job title</dt>--}}
{{--                                        <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">--}}
{{--                                            <span class="flex-grow">Human Resources Manager</span>--}}
{{--                                            <span class="ml-4 flex-shrink-0">--}}
{{--                                                <button type="button"--}}
{{--                                                        class="bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Update</button>--}}
{{--                                            </span>--}}
{{--                                        </dd>--}}
{{--                                    </div>--}}
                                </dl>
                            </div>
                        </div>

                        <div class="mt-10 divide-y divide-gray-200">
                            <div class="space-y-1">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('ui.account') }}</h3>
                                <p class="max-w-2xl text-sm text-gray-500">{{ __('ui.warns.manage_account') }}</p>
                            </div>
                            <div class="mt-6">
                                <dl class="divide-y divide-gray-200">
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">{{ __('ui.language') }}</dt>
                                        <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <span class="flex-grow">English</span>
                                            <span class="ml-4 flex-shrink-0">
                                                @foreach(config('app.supported_locales') as $locale)
                                                    @if(App::getLocale() == $locale)
                                                        <a class="cursor-default">{{ $locale }}</a>
                                                    @else
                                                        <a class="cursor-pointer underline" wire:click="changeLocale('{{ $locale }}')">{{ $locale }}</a>
                                                    @endif
                                                @endforeach
                                            </span>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-filament-actions::modals />
</div>
