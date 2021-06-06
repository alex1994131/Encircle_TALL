<h4 class="text-lg mb-3">
    {{ $title }}
</h4>
<div class="relative flex flex-col rounded bg-white break-words shadow">
    <div class="flex-auto">


        @if(isset($subtitle))
        <h5 class="text-gray-600 text-sm">
            {{ $subtitle }}
        </h5>
        @endif

        {{ $slot }}
    </div>
</div>
