<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sale as SaleRequest;
use App\Models\Property;
use App\Models\Rent;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('Listar Vendas')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sales = Sale::orderBy('id', 'desc')->get();

        return view('admin.sales.index', [
            'sales' => $sales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Listar Vendas')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sales = Sale::all()->pluck('property');
        $rents = Rent::all()->pluck('property');
        $properties = Property::whereNotIn('id', $sales)->whereNotIn('id', $rents)->where('sale', true)->orderBy('id')->get();

        return view('admin.sales.create', [
            'properties' => $properties,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        if (!Auth::user()->hasPermissionTo('Listar Vendas')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sale = Sale::create($request->all());

        return redirect()->route('admin.sales.edit', [
            'sale' => $sale->id
        ])->with(['message' => 'Venda criada com sucesso!', 'type' => 'success', 'icon' => 'check']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Listar Vendas')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sale = Sale::where('id', $id)->first();

        if (empty($sale->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sales = Sale::where('id', '!=', $id)->get()->pluck('property');
        $rents = Rent::where('id', '!=', $id)->get()->pluck('property');
        $properties = Property::whereNotIn('id', $sales)->whereNotIn('id', $rents)->where('sale', true)->orderBy('id')->get();

        return view('admin.sales.edit', [
            'sale' => $sale,
            'properties' => $properties,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('Listar Vendas')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sale = Sale::where('id', $id)->first();

        if (empty($sale->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sale->fill($request->all());
        $sale->save();

        return redirect()->route('admin.sales.edit', [
            'sale' => $sale->id
        ])->with(['message' => 'Venda editada com sucesso!', 'type' => 'success', 'icon' => 'check']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermissionTo('Listar Vendas')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sale = Sale::where('id', $id)->first();

        if (empty($sale->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sale->delete();
        return redirect()->route('admin.sales.index')
            ->with(['message' => 'Venda excluída com sucesso!', 'type' => 'success', 'icon' => 'trash']);
    }
}
