<x-base-component.template>
    <x-base-component.navbar />
    <div class="mt-28 px-8 m-auto">
        <div class="w-full p-4 bg-white rounded-lg">
            <h2 class="text-center font-bold text-2xl">My-Order</h2>
        </div>
        <div class="mt-8"></div>
        @if (session('success'))
            <div id="success-alert"
                class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-4"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>

            <script>
                // Hilangkan pesan setelah 5 detik (5000 ms)
                setTimeout(() => {
                    const alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.transition = "opacity 0.5s ease"; // Tambahkan animasi
                        alert.style.opacity = "0"; // Menghilangkan elemen dengan mengubah opacity
                        setTimeout(() => {
                            alert.remove(); // Hapus elemen dari DOM setelah animasi selesai
                        }, 500); // Tunggu waktu animasi selesai
                    }
                }, 5000); // 5 detik
            </script>
        @endif
        @foreach ($payments as $payment)
            <div class="my-2 w-full p-4 bg-white rounded-lg">
                <div class="order-header flex justify-end border-b-2 py-2">
                    @php
                        $color = 'gray';
                        $display = 'hidden';
                        if ($payment->order->status == 'completed') {
                            $color = 'green';
                            $display = 'flex';
                        } elseif ($payment->order->status == 'cancelled') {
                            $color = 'red';
                        }

                    @endphp
                    <span
                        class="inline-flex items-center rounded-md bg-{{ $color }}-50 px-2 py-1 text-xs font-medium text-{{ $color }}-700 ring-1 ring-inset ring-{{ $color }}-600/10">{{ $payment->order->status }}</span>
                </div>
                <div class="flex justify-between items-center my-2">
                    <div class="flex gap-8 items-center">
                        <img src="{{ asset('storage/' . $payment->order->service->image) }}" alt=""
                            class="w-[80px] h-[80px] border">
                        <a href="{{ route('myorder.detailorder', ['payment_id' => $payment->id]) }}"
                            class="font-bold text-[#1E56A0]">{{ $payment->order->service->name }}</a>
                    </div>
                    <div>
                        <span class="font-bold text-lg">
                            {{ number_format($payment->order->service->price, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="border-t-2 {{ $display }} justify-between items-center py-4">
                    <div>
                        <p>berikan feedback pada pelayanan kami</p>
                    </div>
                    <div>
                        <button class="px-6 py-2 rounded-lg text-white bg-[#1E56A0]">Nilai</button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</x-base-component.template>
