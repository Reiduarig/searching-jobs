<x-layout>
    
    <x-page-heading>Iniciar Sesión</x-page-heading>

    <x-forms.form method="POST" action="{{ route('login') }}">
        <x-forms.input label="Correo Electrónico" name="email" type="email" />
        <x-forms.input label="Contraseña" name="password" type="password" />

        <x-forms.button>Iniciar</x-forms.button>
    </x-forms.form>
</x-layout>