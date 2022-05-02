<div class="py-16 sm:px-20 bg-white border-b border-gray-200">
    <x-jet-secondary-button wire:click="confirmSchemaAdd()" wire:loading.attr="disabled" class="mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        {{ __('Add Credential Schema') }}
    </x-jet-secondary-button>

    <x-jet-secondary-button wire:click="confirmConnectionAdd()" wire:loading.attr="disabled" class="mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        {{ __('Add New Connection') }}
    </x-jet-secondary-button>
    
    <x-jet-secondary-button wire:click="confirmCertificateIssue()" wire:loading.attr="disabled" class="mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        {{ __('Issue Certificate') }}
    </x-jet-secondary-button>


    {{-- Add Credential Schema modal --}}
    <div>
        <x-jet-dialog-modal wire:model="confirmingSchemaAdd">
            <x-slot name="title">
               {{ __('Add Schema') }}
            </x-slot>
    
            <x-slot name="content">
                Upload Schema
            </x-slot>
    
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingSchemaAdd')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
    
                <x-jet-button class="ml-3" wire:click="saveSchema()" wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-700 focus:bg-green-700 ml-2">
                    {{ __('Done') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>

    {{-- Add Connection modal --}}
    <div>
        <x-jet-dialog-modal wire:model="confirmingConnectionAdd">
            <x-slot name="title">
               {{ __('Add Connection') }}
            </x-slot>
    
            <x-slot name="content">
                <div class="flex justify-center text-xl tracking-widest">Scan the QR code below to connect to our agent:</div>
                <div class="flex justify-center p-6">
                    {!! QrCode::size(250)->generate("Tom")!!}
                </div>
            </x-slot>
    
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingConnectionAdd')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
    
                <x-jet-button class="ml-3" wire:click="saveConnection()" wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-700 focus:bg-green-700 ml-2">
                    {{ __('Done') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>

    {{-- Issue Certificate modal --}}
    <div>
        <x-jet-dialog-modal wire:model="confirmingCertificateIssue">
            <x-slot name="title">
               {{ __('Issue Covid-19 Certificate ') }}
            </x-slot>
    
            <x-slot name="content">
                <!-- Patient Name -->
            <div class="mb-4 col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Patient Name') }}" />
                <x-jet-input id="name" type="text" placeholder="Search name" class="mt-1 block w-full" wire:model.defer="patient.name" />
                <x-jet-input-error for="patient.name" class="mt-2" />
            </div>

            <!-- Certificate Schema -->
            <div class="mb-4 col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Certificate Schema') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="patient.email" />
                <x-jet-input-error for="patient.email" class="mt-2" />
            </div>

            <!--Test Result -->
            <div class="mb-4 col-span-6 sm:col-span-4">
                <x-jet-label for="phone_number" value="{{ __('Test Result') }}" />
                <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model.defer="patient.phone_number" />
                <x-jet-input-error for="patient.phone_number" class="mt-2" />
            </div>

            <!-- Test Date -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="phone_number" value="{{ __('Test Date') }}" />
                <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model.defer="patient.phone_number" />
                <x-jet-input-error for="patient.phone_number" class="mt-2" />
            </div>
            </x-slot>
    
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingCertificateIssue')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
    
                <x-jet-button class="ml-3" wire:click="issueCertificate()" wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-700 focus:bg-green-700 ml-2">
                    {{ __('Done') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
   
</div>
<br><br>

<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="flex justify-center items-center pt-8 sm:justify-start sm:pt-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="#04c4a1" viewBox="0 0 24 24" stroke="#04c4a1" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
        </svg>
        <p class="text-2xl text-gray-700">Statistics: Covid-19 Pandemic</p>
    </div>

    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center justify-center">
                    <div class="text-lg leading-7 font-semibold text-gray-900 dark:text-white">Immunized</div>
                </div>
                <div class="flex items-center justify-center">
                    <div class="border border-gray-400 rounded-full w-36 h-36">
                        <p class="flex justify-center mt-16">55 000</p>
                    </div>
                </div>   
            </div>

            <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                <div class="flex items-center justify-center">
                    <div class="text-lg leading-7 font-semibold text-gray-900 dark:text-white">Positive Cases</div>
                </div>

                <div class="flex items-center justify-center">
                    <div class="border border-gray-400 rounded-full w-36 h-36">
                        <p class="flex justify-center mt-16">3000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            <p class="w-6 h-6">&copy;2022</p>
        </div>
    </div>
</div>


 