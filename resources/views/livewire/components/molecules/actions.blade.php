<!-- Actions panel -->
<div class="grid grid-cols-1 gap-4 lg:col-span-2 pt-6">
    <h2 class="text-lg leading-6 font-medium text-gray-900"></h2>
    <section aria-labelledby="quick-links-title">
        <div class="rounded-lg bg-gray-200 overflow-hidden shadow divide-y divide-gray-200 sm:divide-y-0 sm:grid sm:grid-cols-2 sm:gap-px">
            <h2 class="sr-only" id="quick-links-title">Quick links</h2>

            <x-include.atoms.sandbox-action to="{{ route('reference-channel') }}" wire:navigate icon="adjustments-vertical" name="Тип канала" description="Doloribus dolores nostrum quia qui natus officia quod et dolorem. Sit repellendu" />
            <x-include.atoms.sandbox-action to="{{ route('reference-traffic') }}" wire:navigate icon="arrows-up-down" name="Тип трафика" description="Doloribus dolores nostrum quia qui natus officia quod et dolorem. Sit repellendu" />
            <x-include.atoms.sandbox-action to="{{ route('reference-transmission') }}" wire:navigate icon="bolt" name="Тип среды передач" description="Doloribus dolores nostrum quia qui natus officia quod et dolorem. Sit repellendu" />
            <x-include.atoms.sandbox-action to="{{ route('reference-direction') }}" wire:navigate icon="arrows-pointing-out" name="Уровень/направление" description="Doloribus dolores nostrum quia qui natus officia quod et dolorem. Sit repellendu" />
            <x-include.atoms.sandbox-action to="{{ route('reference-type') }}" wire:navigate icon="cube-transparent" name="Вид" description="Doloribus dolores nostrum quia qui natus officia quod et dolorem. Sit repellendu" />
            <x-include.atoms.sandbox-action disabled icon="presentation-chart-line" name="Promotion campaign" description="Doloribus dolores nostrum quia qui natus officia quod et dolorem. Sit repellendu" />

        </div>
    </section>
</div>
