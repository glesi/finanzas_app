<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalIncomes = Income::where('user_id', auth()->id())->sum('amount');
        $totalExpenses = Expense::where('user_id', auth()->id())->sum('amount');
        $balance = $totalIncomes - $totalExpenses;

        return view('home', compact('totalIncomes', 'totalExpenses', 'balance'));
    }
}