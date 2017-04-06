<?php

namespace Vialoja\Http\Controllers\Desk;

use Illuminate\Http\Request;
use Vialoja\Http\Controllers\Controller;

use Artesaos\SEOTools\Facades\SEOMeta;

class DashboardController extends Controller
{

    public function dashboard()
    {

        SEOMeta::setTitle('HelpDesk - Suporte Via Ticket');

        return view('desk.dashboard');
    }

}
