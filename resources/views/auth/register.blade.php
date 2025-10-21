<x-layout>
    
    <x-page-heading>Regístrate</x-page-heading>

    <x-forms.form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        <x-forms.input label="Tu nombre" name="name" />
        <x-forms.input label="Tu correo electrónico" name="email" type="email" />
        <x-forms.input label="Contraseña" name="password" type="password" />
        <x-forms.input label="Confirma tu contraseña" name="password_confirmation" type="password" />

        <x-forms.divider />

        <x-forms.input label="Nombre del empleador" name="employer" />
        <x-forms.input label="Logo del empleador" name="logo_url" type="file" />

        <x-forms.button>Creat cuenta</x-forms.button>
    </x-forms.form>
</x-layout>