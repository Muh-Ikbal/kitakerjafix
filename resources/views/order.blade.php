<x-base-component.template>
    <x-base-component.navbar />
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mt-32 h-fit block md:flex mb-16">
        {{-- card --}}
        <div class="flex-none p-4 w-full mb-6 md:mb-0 md:w-[32%] ">
            <div class="bg-white shadow-md md:shadow-lg w-full md:w-[70%] rounded-lg m-auto">
                <div class="w-full h-[200px] rounded-sm bg-center bg-no-repeat"
                    style="background-image:url({{ asset('storage/' . $service->image) }});background-size:cover">
                </div>
                <div class="p-4 ">
                    <h2 class="font-bold text-xl md:text-2xl">{{ $service->name }}</h2>
                    <p class="mt-2 text-clip text-wrap overflow-hidden">{{ $service->description }}</p>
                    <span class="block mt-5">Mulai dari</span>
                    <p class="card_price font-medium text-xl md:text-2xl">Rp.
                        {{ number_format($service->price, 0, ',', '.') }}</p>
                </div>
            </div>

        </div>
        <div class="flex-1 p-4">
            <form action="/order" method="post">
                @csrf
                <div class="shadow-xl p-6 bg-white w-full md:w-[85%] rounded-[8px]">
                    <div class=" flex flex-col lg:grid grid-cols-2 ">
                        <div class="">
                            <div class="mb-5">
                                <h2 class="font-bold text-xl">Jam Operasional 07:00 - 17:00</h2>
                            </div>
                            <div class="">
                                <div>
                                    <input type="hidden" name="id_user" value="{{ auth()->id() }}">
                                </div>
                                <div>
                                    <input type="hidden" name="id_service" value="{{ $service->id }}">
                                </div>
                                <div class="flex flex-col my-4">
                                    <label for="tanggal-order">Tanggal Order</label>
                                    <input type="date" name="tanggal_order" id="tanggal_order"
                                        class="w-64 p-6 rounded-lg text-xl">
                                </div>
                                <div class="flex flex-col my-4">
                                    <label for="jam">Jam Operasional</label>
                                    <input type="time" id="jam" name="jam"
                                        class="w-64 p-6 rounded-lg text-xl font-bold active:border-[#1E56A0]">
                                </div>
                                <div class="hidden flex-col my-4">
                                    <div class="mt-2">
                                        <div
                                            class="flex w-64 p-6 items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 has-[input:focus-within]:outline has-[input:focus-within]:outline-2 has-[input:focus-within]:-outline-offset-2 has-[input:focus-within]:outline-indigo-600">
                                            <div class="shrink-0 select-none text-xl px-3 text-gray-500 sm:text-sm/6">Rp
                                            </div>
                                            <input type="hidden" name="budget" id="budget"
                                                class="block font-semibold border-none outline-none min-w-0 grow text-xl text-gray-900 placeholder:text-gray-400 focus:ring-0 focus:outline-none active:outline-none sm:text-2xl"
                                                placeholder="0.00" value="{{ $service->price }}"
                                                min="{{ $service->price }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col my-5">
                                    <h3 class="font-medium">Harga Mulai</h3>
                                    <span class="font-bold text-2xl">
                                        {{ number_format($service->price, 0, ',', '.') }}</span>
                                    <div class="note text-xs text-slate-400">harga bisa berubah tergantung kerumitannya
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="deskripsi" class="mb-3 font-semibold">Alamat</label>
                                <textarea type="text" name="deskripsi" id="deskripsi" autocomplete="keluhan"
                                    class="block w-full h-64 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-[#1E56A0] sm:text-sm/6"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="bg-[#1E56A0] px-12 py-2 rounded-lg text-white">Order</button>
                    </div>
                </div>


            </form>

        </div>
    </div>
</x-base-component.template>
