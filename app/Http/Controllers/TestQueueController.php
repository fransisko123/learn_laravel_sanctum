<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\Debugbar\Facades\Debugbar;

class TestQueueController extends Controller
{
    public function index()
    {
        Debugbar::error('Error!');
        return view('testqueue.index');
    }

    public function sendMail(Request $request)
    {
        $email = $request->email; // Ganti dengan alamat email penerima
        $subject = 'Hello from Laravel'; // Subjek email
        $message = 'This is a static email content.'; // Konten statis email

        try {
            SendMailJob::dispatch($email, $subject, $message);
            return redirect()->back()->with('success', 'Berhasil');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', 'Gagal, pesan : ' . $error->getMessage());
        }
    }
}
