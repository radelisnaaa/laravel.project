<?php



namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan model User sudah ada
use App\Models\Notification; // Pastikan model Notification sudah ada
use App\Models\Event; // Pastikan model Event sudah ada
use App\Models\Ticket; // Pastikan model Ticket sudah ada
use App\Models\Order; // Pastikan model Order sudah ada


class UserProfileController extends Controller

{
    /**
     * Menampilkan halaman profil pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    /**
     * Menampilkan halaman edit profil pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    /**
     * Memproses pembaruan profil pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Update data pengguna
        $user->update($request->only(['name', 'email', 'phone']));

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('user.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Menampilkan riwayat pembelian tiket pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function purchaseHistory()
    {
        // Ambil riwayat pesanan pengguna
        $orders = Auth::user()->orders()->with('event')->latest()->get();  // Pastikan ada relasi 'orders' di model User
        return view('user.profile.history', compact('orders'));
    }

    /**
     * Menampilkan halaman detail notifikasi untuk pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        // Ambil notifikasi terbaru untuk pengguna
        $notifications = Auth::user()->notifications()->latest()->paginate(10);
        return view('user.notifications.index', compact('notifications'));
    }
}
