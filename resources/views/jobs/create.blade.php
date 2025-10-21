<x-layout>
    <x-page-heading>Nueva oferta de trabajo</x-page-heading>

    <x-forms.form method="POST" action="{{ route('jobs.store') }}">
        <x-forms.input name="title" label="Título del puesto" placeholder="Ej. Desarrollador Backend" required />
        <x-forms.input name="salary" label="Salario" placeholder="Ej. 30000" type="number" required />
        <x-forms.input name="location" label="Ubicación" placeholder="Ej. Remoto, Madrid, Barcelona" required />

        <x-forms.select name="schedule" label="Jornada laboral" placeholder="Selecciona una opción" required>
            <option value="full-time">Jornada completa</option>
            <option value="part-time">Media jornada</option>
            <option value="contract">Contrato</option>
        </x-forms.select>

        <x-forms.input name="url" label="URL de la oferta" placeholder="Ej. https://empresa.com/oferta" type="url" required />
        <x-forms.checkbox name="featured" label="Destacar (Costes Extra)" />
        
        <x-forms.divider />
    
        <x-forms.input name="tags" label="Etiquetas (separadas por comas)" placeholder="Ej. Laravel, Remote, Full-Time" required />
        
        <x-forms.button>Publicar oferta</x-forms.button>
    </x-forms.form>
</x-layout>