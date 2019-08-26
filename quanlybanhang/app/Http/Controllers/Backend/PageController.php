<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\ActivationMailer;

class PageController extends Controller
{
    public function dashboard() {
        return view('backend.pages.dashboard');
    }

    public function testMail() {
        // hotro.nentangtoituonglai@gmail.com  => phucuong@ctu.edu.vn
        Mail::to('phucuong@ctu.edu.vn')
            ->send(new ActivationMailer([]));
    }
}
