<x-layout title="Nova Série">
    <x-shows.form :action="route('shows.store')" :name="old('name')" :update="false"/>
</x-layout>