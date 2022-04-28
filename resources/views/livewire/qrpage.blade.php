
    <!-- {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}} -->

    {{-- <div class="flex justify-center text-xl tracking-widest">Get your medical passport here.</div> <br>
    <div class="flex justify-center text-xl tracking-widest">To continue, scan the QR code below to connect to our agent:</div>
    <div class="flex justify-center p-6">
        {!! QrCode::size(250)->generate("Tom")!!}
    </div> --}}


<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <x-jet-secondary-button wire:click="" wire:loading.attr="disabled" class="mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        {{ __('Add schema') }}
    </x-jet-secondary-button>

    <x-jet-secondary-button wire:click="confirmConnectionAdd()" wire:loading.attr="disabled" class="mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        {{ __('Add New Connection') }}
    </x-jet-secondary-button>
    
    <x-jet-secondary-button wire:click="$toggle('issueCredential')" wire:loading.attr="disabled" class="mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        {{ __('Issue Credential') }}
    </x-jet-secondary-button>


    @if ($issueCredential)
        <p>Test successful</p>
    @endif

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
   
</div>

 