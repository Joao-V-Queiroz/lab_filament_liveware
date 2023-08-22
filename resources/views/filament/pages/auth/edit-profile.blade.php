<div>
  <header>
     <h1 class="fi-header-heading text-2x1 font-bold tracking-tigh text-gray-950 dark:text-white sm:text-3x1">
        Meu Perfil
     </h1>
     <p class="fi-simple-header-subheading mt-2 text-left text-sm text-gray-500 dark:text-gray-400">
       Edite seu perfil de acesso aqui!
     </p>
  </header>
    {{--  <x-slot name="subheading">
        {{ $this->backAction }}
    </x-slot>  --}}
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}
        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
            alignment="right"
        />
    </x-filament-panels::form>
</div>
