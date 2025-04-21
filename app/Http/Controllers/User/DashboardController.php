<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;   
use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Notification;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil event yang diikuti oleh pengguna yang sedang login
        $myEvents = Auth::user()->events()->withPivot('order_id')->get();

        // Ambil rekomendasi event (logika rekomendasi perlu diimplementasikan)
        $recommendedEvents = $this->getRecommendedEvents(Auth::id());

        // Ambil notifikasi terbaru untuk pengguna
        $notifications = Notification::where('user_id', Auth::id())
                                     ->orderBy('created_at', 'desc')
                                     ->take(5) // Ambil beberapa notifikasi terbaru
                                     ->get();

        // Format data event untuk kalender (FullCalendar)
        $calendarEvents = $recommendedEvents->map(function ($event) {
            return [
                'title' => $event->name,
                'start' => $event->date->format('Y-m-d'), // pastikan formatnya sesuai
                'url' => route('public.events.show', $event->id),
            ];
        });

        return view('user.dashboard', compact('myEvents', 'recommendedEvents', 'notifications', 'calendarEvents'));
    }

    /**
     * Logika untuk mendapatkan rekomendasi event berdasarkan preferensi pengguna.
     * Ini adalah contoh sederhana dan perlu disesuaikan dengan kebutuhan Anda.
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    protected function getRecommendedEvents(int $userId)
    {
        // Contoh: Ambil 3 event terbaru yang bukan diikuti oleh pengguna
        return Event::whereNotIn('id', Auth::user()->events()->pluck('events.id'))
                    ->orderBy('date', 'asc')
                    ->take(3)
                    ->get();
    }

    /**
     * Menampilkan detail satu event yang diikuti pengguna.
     *
     * @param int $eventId
     * @return \Illuminate\View\View
     */
    public function showEvent(int $eventId)
    {
        $event = Auth::user()->events()->findOrFail($eventId);
        return view('user.events.show', compact('event'));
    }

    /**
     * Menampilkan halaman edit profil pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        return view('user.profile.edit');
    }

    /**
     * Memproses pembaruan profil pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        Auth::user()->update($request->only(['name', 'email', 'phone']));

        return redirect()->route('user.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Menampilkan riwayat pembelian tiket pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function purchaseHistory()
    {
        $orders = Auth::user()->orders()->with('event')->latest()->get(); // Asumsi Anda memiliki relasi 'orders' di model User
        return view('user.profile.history', compact('orders'));
    }

    /**
     * Menampilkan daftar lengkap notifikasi pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::id())
                                     ->orderBy('created_at', 'desc')
                                     ->paginate(10); // Contoh paginasi
        return view('user.notifications.index', compact('notifications'));
    }
}

    
