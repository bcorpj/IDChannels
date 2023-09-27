<div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative">

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-12 w-auto" src="{{ asset('icon.png') }}" alt="Workflow">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ __('Sign in to your account') }}</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="flex flex-row justify-end">
                <span>
                @foreach(config('app.supported_locales') as $locale)
                    @if(App::getLocale() == $locale)
                        <a class="cursor-default">{{ $locale }}</a>
                    @else
                        <a class="cursor-pointer underline" wire:click="changeLocale('{{ $locale }}')">{{ $locale }}</a>
                    @endif
                @endforeach
                </span>
            </div>
            <form class="space-y-6" wire:submit="in">

                <x-include.atoms.input autocomplete="off" required name="login" label="{{ __('Login') }}" wire:model="login" show-error />

                <x-include.atoms.input required name="password" label="{{ __('Password') }}" type="password" wire:model="password" />

                <div class="flex items-center justify-between">
                    <x-include.atoms.checkbox wire:model="remember" title=" {{ __('Remember me') }} " name="remember-me"/>
                    <x-include.atoms.link title="{{ __('Forgot your password?') }}"  />
                </div>
                <div>

                    <button @disabled($isSuccess) wire:loading.class="bg-gray-200" wire:loading.attr="disabled" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Sign in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
