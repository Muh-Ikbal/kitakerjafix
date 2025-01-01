<x-base-component.template>
    <x-base-component.navbar />
    <div class="main mt-24">
        <h1 class="title-card mt-28 mb-12 pt-6 font-bold text-gray-400">Jasa Kami</h1>
        <div class="cards block md:flex">
            @foreach ($services as $service)
                <x-layanan.card-layanan :services="$service" />
            @endforeach

        </div>

    </div>

</x-base-component.template>
