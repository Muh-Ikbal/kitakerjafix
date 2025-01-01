<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Order;
use App\Models\ServiceCategory;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request, $name)
    {
        $id = $request->input('id');

        $service = Services::find($id);

        if ($service) {
            $serviceCategory = ServiceCategory::where('service_id', $service->id)->first();

            // Jika ingin mengirim kategori juga ke view
            return view('order', compact('service', 'serviceCategory'));
        } else {
            return abort(404, 'Service not found');
        }
    }

    public function create(Request $request)
    {
        $service = Services::find($request->input('id_service'));
        if (!$service) {
            return back()->withErrors(['id_service' => 'Service tidak ditemukan.']);
        }

        $validateData = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_service' => 'required|exists:services,id',
            'budget' => 'required|numeric|min:' . $service->price,
            'deskripsi' => 'required|string',
            'tanggal_order' => 'required|date|after_or_equal:today',
            'jam' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    // Validasi jam agar minimal 30 menit dari waktu sekarang jika tanggal adalah hari ini
                    $tanggalOrder = $request->input('tanggal_order');

                    $currentDate = date('Y-m-d');
                    $selectedTime = strtotime("$tanggalOrder $value");

                    if ($tanggalOrder === $currentDate && $selectedTime < strtotime("+30 minutes")) {
                        $fail('Waktu harus minimal 30 menit dari waktu sekarang.');
                    }
                },
            ]
        ]);

        $order = new Order();
        $order->user_id = $validateData['id_user'];
        $order->service_id = $validateData['id_service'];
        $order->order_date = $validateData['tanggal_order'] . ' ' . $validateData['jam'];
        $order->budget = $validateData['budget'];
        $order->description = $validateData['deskripsi'];
        $order->status = 'pending';
        $order->save();
        return redirect()->route('payment.create', ['order_id' => $order->id])->with('success', 'Order berhasil dibuat.');


        // Redirect dengan pesan sukses

    }

    public function myorder()
    {
        $user_id = Auth::user()->id;
        $payments = Payment::whereHas('order', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
            ->with(['order.service']) // Memastikan memuat relasi order dan service
            ->join('orders', 'payments.order_id', '=', 'orders.id') // Gabungkan tabel orders untuk pengurutan
            ->orderByRaw("FIELD(orders.status, 'completed', 'cancelled') ASC") // Prioritas status
            ->orderByDesc('orders.created_at') // Urutkan berdasarkan waktu terbaru
            ->select('payments.*') // Pilih kolom payments agar query tidak ambigu
            ->get();

        return view('myorder', compact('payments'));
    }

    public function detailOrder(Request $request)
    {
        // Validasi input
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
        ]);

        // Ambil data payment beserta relasi order dan service
        $payment = Payment::with('order.service')->find($request->input('payment_id'));

        if (!$payment) {
            return abort(404, 'Payment not found.');
        }
        $notificationMessage = $request->query('message', null);
        // Ambil kategori layanan
        $service = $payment->order->service;
        $serviceCategory = ServiceCategory::where('service_id', $service->id)->with('category')->first();
        return view('orderdetail', compact('payment', 'service', 'serviceCategory', 'notificationMessage'));
    }
}
