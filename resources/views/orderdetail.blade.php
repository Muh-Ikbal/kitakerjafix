<x-base-component.template>
    <x-base-component.navbar />
    @if (session('message') || isset($notificationMessage))
        <div class="alert alert-success">
            {{ session('message') ?? $notificationMessage }}
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

            <div class="shadow-xl p-6 bg-white w-full md:w-[85%] rounded-[8px]">
                <div class=" flex flex-col ">
                    <div class="">
                        <div class="mb-5">
                            <h2 class="font-bold text-xl">status : {{ $payment->status }}</h2>
                        </div>
                        <div class="">
                            <div>
                                <input type="hidden" name="id_user" value="{{ auth()->id() }}">
                            </div>
                            <div>
                                <input type="hidden" name="id_service" value="{{ $service->id }}">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="nama">Nama Pelanggan</label>
                                <input type="text" name="nama" id="nama" disabled
                                    class="w-full p-6 rounded-lg text-xl" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="phone">No. Telpon</label>
                                <input type="text" name="phone" id="phone" disabled
                                    class="w-full p-6 rounded-lg text-xl" value="{{ auth()->user()->phone }}">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="tanggal-order">Tanggal Order</label>
                                <input type="text" name="tanggal_order" id="tanggal_order" disabled
                                    class="w-full p-6 rounded-lg text-xl" value="{{ $payment->order->order_date }}">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="tanggal-order">Alamat</label>
                                <input type="text" name="tanggal_order" id="tanggal_order" disabled
                                    class="w-full p-6 rounded-lg text-xl" value="{{ $payment->order->description }}">
                            </div>
                            @php
                                $dp = 'DP';
                                if ($serviceCategory->category->name !== 'Pengembangan') {
                                    $dp = '';
                                }
                            @endphp
                            <div class="flex flex-col my-5">
                                <h3 class="font-medium">Harga {{ $dp }}</h3>
                                <span class="font-bold text-2xl">
                                    {{ number_format($service->price, 0, ',', '.') }}</span>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="mt-2">
                    @if ($serviceCategory->category->name == 'Pengembangan' && $payment->status == 'unpaid')
                        <button type="submit" id="pay-button"
                            class="bg-[#1E56A0] px-12 py-2 rounded-lg text-white">Bayar</button>
                    @elseif (
                        $serviceCategory->category->name == 'Instalasi & Perbaikan' &&
                            $payment->order->status == 'completed' &&
                            $payment->status == 'unpaid')
                        <button type="submit" id="pay-button"
                            class="bg-[#1E56A0] px-12 py-2 rounded-lg text-white">Bayar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from the server
            snap.pay('{{ $payment->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    // Kirim hasil transaksi ke server untuk diproses
                    fetch("{{ route('payment.notification') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                transaction_status: result.transaction_status,
                                order_id: result.order_id,
                                payment_type: result.payment_type,
                                transaction_time: result.transaction_time,
                                gross_amount: result.gross_amount
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message === "Payment status updated successfully") {
                                // Redirect ke halaman status pembayaran
                                window.location.href =
                                    "{{ route('myorder.detailorder', ['payment_id' => $payment->id,'message'=>'payment successfull']) }}";
                            } else {
                                console.error("Failed to update payment status:", data.message);
                            }
                        })
                        .catch(error => {
                            console.error("Error occurred while sending data:", error);
                        });
                },
                // Optional
                onPending: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
</x-base-component.template>
