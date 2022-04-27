<div>
    <!-- {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}} -->

    <div class="flex justify-center text-xl tracking-widest">Get your medical passport here.</div> <br>
    <div class="flex justify-center text-xl tracking-widest">To continue, scan the QR code below to connect to our agent:</div>
    <div class="flex justify-center p-6">
        {!! QrCode::size(250)->generate("Tom")!!}
    </div>

</div>
