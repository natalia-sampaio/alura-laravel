<x-layout title="Editar série '{{$show->name}}'">
    <x-shows.form :action="route('shows.update', $show->id)" :name="$show->name" :update="true"/>
</x-layout>