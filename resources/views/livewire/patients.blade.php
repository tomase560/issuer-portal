<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    @if (session()->has('message'))
        <div class="flex items-center bg-green-500 rounded-md text-white text-md font-bold px-4 py-3 relative" role="alert" x-data="{show: true}" x-show="show">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>{{session('message')}}</p>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" x-on:click="show = false">
                <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif
    <div class="mt-8 flex justify-between items-center">
        <div class="text-2xl">Patients</div>
        <div>
            <x-jet-button wire:click="confirmPatientAdd" class="bg-sky-500 hover:bg-sky-700">
                Add New Patient
            </x-jet-button>
        </div>
    </div>
    <div class="mt-3">
        <input wire:model="search" type="search" name="search" placeholder="Search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
    </div>
    <div class="mt-8">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('id')">ID</button>
                            <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('name')">Name</button>
                            <x-sort-icon sortField="name" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('email')">Email</button>
                            <x-sort-icon sortField="email" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            Phone Number
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $patient->id }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $patient->name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $patient->email }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $patient->phone_number }}
                        </td>
                        <td class="flex justify-center border border-gray-300 px-4 py-2">
                            <x-jet-button wire:click="confirmPatientEdit( {{ $patient->id }} )" class="bg-green-500 hover:bg-green-700">
                                Edit
                            </x-jet-button>
                            <x-jet-danger-button wire:click="confirmPatientDeletion( {{ $patient->id }} )" class="ml-2" wire:loading.attr="disabled">
                                Delete
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $patients->links() }}
    </div>
    <x-jet-confirmation-modal wire:model="confirmingPatientDeletion">
        <x-slot name="title">
            {{ __('Delete Patient') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this patient?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('confirmingPatientDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="deletePatient({{ $confirmingPatientDeletion }})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <x-jet-dialog-modal wire:model="confirmingPatientAdd">
        <x-slot name="title">
            {{ isset($this->patient->id) ? 'Edit Patient' : 'Add Patient' }}
        </x-slot>

        <x-slot name="content">
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="patient.name" />
                <x-jet-input-error for="patient.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="patient.email" />
                <x-jet-input-error for="patient.email" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="phone_number" value="{{ __('Phone Number') }}" />
                <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model.defer="patient.phone_number" />
                <x-jet-input-error for="patient.phone_number" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingPatientAdd')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="savePatient()" wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-700 focus:bg-green-700 ml-2">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>