<?php

namespace Vialoja\Http\Controllers\Tests;

use Illuminate\Http\Request;
use Vialoja\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Vialoja\Models\User;

class PdfviewController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $data['user'] = $this->user->all();
        return PDF::loadView('tests.pdf.dompdf', $data)
            ->stream();
    }
}
