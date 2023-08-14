<?php

namespace App\Http\Controllers\Accountadmin;

use App\Order;
use App\Sale;
use App\SaleType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SaleTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $saleTypes = SaleType::all(['pk_sales_type', 'sale_type']);
        return view('accountadmin.sale-types.index', compact('saleTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('accountadmin.sale-types.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_type' => 'bail|required|string|max:30|unique:kbt_sales_type,pk_sales_type'
        ]);

        SaleType::create($validated);

        session()->flash('success', 'Sale type added successfully.');

        return redirect()->route('accountadmin.sale-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SaleType $saleType
     * @return Application|Factory|View
     */
    public function edit(SaleType $saleType)
    {
        return view('accountadmin.sale-types.edit', compact('saleType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SaleType $saleType
     * @return RedirectResponse
     */
    public function update(Request $request, SaleType $saleType)
    {
        $validated = $request->validate([
            'sale_type' => 'bail|required|string|max:30|unique:kbt_sales_type,pk_sales_type,' . $saleType->pk_sales_type . ',pk_sales_type',
        ]);

        $saleType->update($validated);

        session()->flash('success', 'Sale type updated successfully.');

        return redirect()->route('accountadmin.sale-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SaleType $saleType
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(SaleType $saleType)
    {
        $saleType->delete();

        session()->flash('success', 'Sale type deleted successfully.');

        return redirect()->route('accountadmin.sale-types.index');
    }
}
