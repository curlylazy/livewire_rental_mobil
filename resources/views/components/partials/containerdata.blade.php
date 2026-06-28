<div>
    @if(count($dataRows) == 0)
        <div class="flex flex-col items-center text-center">
            <div class="mb-3">
                <img src="{{ asset('static/notfound.png') }}" class="w-[350px]" />
            </div>
            <div class="text-xl font-semibold">Tidak Ada Data</div>
        </div>
    @else
        {{ $slot }}
    @endif
</div>
