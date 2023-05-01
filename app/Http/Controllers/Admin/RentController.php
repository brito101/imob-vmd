<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rent as RentRequest;
use App\Models\Property;
use App\Models\Rent;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RentController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('Listar Locações')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $rents = Rent::orderBy('id', 'desc')->get();

        return view('admin.rents.index', [
            'rents' => $rents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Listar Locações')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sales = Sale::all()->pluck('property');
        $rents = Rent::all()->pluck('property');
        $properties = Property::whereNotIn('id', $rents)->whereNotIn('id', $sales)->where('rent', true)->orderBy('id')->get();

        return view('admin.rents.create', [
            'properties' => $properties,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RentRequest $request)
    {
        if (!Auth::user()->hasPermissionTo('Listar Locações')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $rent = Rent::create($request->all());

        return redirect()->route('admin.rents.edit', [
            'rent' => $rent->id
        ])->with(['message' => 'Locação criada com sucesso!', 'type' => 'success', 'icon' => 'check']);
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
        if (!Auth::user()->hasPermissionTo('Listar Locações')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $rent = Rent::where('id', $id)->first();

        if (empty($rent->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $sales = Sale::where('id', '!=', $id)->get()->pluck('property');
        $rents = Rent::where('id', '!=', $id)->get()->pluck('property');
        $properties = Property::whereNotIn('id', $rents)->whereNotIn('id', $sales)->where('rent', true)->orderBy('id')->get();

        return view('admin.rents.edit', [
            'rent' => $rent,
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
    public function update(RentRequest $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('Listar Locações')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $rent = Rent::where('id', $id)->first();

        if (empty($rent->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $rent->fill($request->all());
        $rent->save();

        return redirect()->route('admin.rents.edit', [
            'rent' => $rent->id
        ])->with(['message' => 'Locação editada com sucesso!', 'type' => 'success', 'icon' => 'check']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermissionTo('Listar Locações')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $rent = Rent::where('id', $id)->first();

        if (empty($rent->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $rent->delete();
        return redirect()->route('admin.rents.index')
            ->with(['message' => 'Locação excluída com sucesso!', 'type' => 'success', 'icon' => 'trash']);
    }
}
