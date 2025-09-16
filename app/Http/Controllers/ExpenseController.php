<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function addexpenseETA(Request $request)
    {
        $validate = $request->validate([
            'ExpenseName'  => 'required|string|max:255',
            'ExpensePrice' => 'required|numeric',
        ]);

        $ExpenseData = Expense::create([
            'expenseuser_id'=> $request->expenseuserId,
            'expense_name' => $request->ExpenseName,
            'amount' => $request->ExpensePrice,
        ]);

        return redirect()->route('dashboardETA')->with('success','New Expense Add');
    }
}
