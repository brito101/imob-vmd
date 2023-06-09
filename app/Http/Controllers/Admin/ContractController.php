<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Models\User;
use App\Models\Property;
use App\Models\Contract;
use App\Http\Requests\Admin\Contract as ContractRequest;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Auth::user()->hasPermissionTo('Listar Contratos')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $contracts = Contract::with(['ownerObject', 'acquirerObject'])->orderBy('id', 'DESC')->get();
        return view('admin.contracts.index', [
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (!Auth::user()->hasPermissionTo('Cadastrar Contratos')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $lessors = User::lessors();
        $lessees = User::lessees();
        return view('admin.contracts.create', [
            'lessors' => $lessors,
            'lessees' => $lessees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request) {
        if (!Auth::user()->hasPermissionTo('Cadastrar Contratos')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $contractCreate = Contract::create($request->all());
        return redirect()->route('admin.contracts.edit', [
                    'contract' => $contractCreate->id
                ])->with(['message' => 'Contrato cadastrado com sucesso!', 'type' => 'success', 'icon' => 'check']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (!Auth::user()->hasPermissionTo('Editar Contratos')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $contract = Contract::where('id', $id)->first();
        if (empty($contract->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $lessors = User::lessors();
        $lessees = User::lessees();

        return view('admin.contracts.edit', [
            'contract' => $contract,
            'lessors' => $lessors,
            'lessees' => $lessees,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, $id) {
        if (!Auth::user()->hasPermissionTo('Editar Contratos')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $contract = Contract::where('id', $id)->first();
        if (empty($contract->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $contract->fill($request->all());
        $contract->save();

        if ($request->property) {
            $property = Property::where('id', $request->property)->first();

            if ($request->status === 'active') {
                $property->status = 0;
                $property->save();
            } else {
                $property->status = 1;
                $property->save();
            }
        }

        return redirect()->route('admin.contracts.edit', [
                    'contract' => $contract->id
                ])->with(['message' => 'Contrato atualizado com sucesso!', 'type' => 'success', 'icon' => 'check']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (!Auth::user()->hasPermissionTo('Remover Contratos')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $contract = Contract::where('id', $id)->first();
        if (empty($contract->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $contract->delete();
        return redirect()->route('admin.contracts.index')
                        ->with(['message' => 'Contrato removido com sucesso!', 'type' => 'success', 'icon' => 'trash']);
    }

    public function getDataOwner(Request $request) {
        $lessor = User::where('id', $request->user)->first([
            'id',
            'civil_status',
            'spouse_name',
            'spouse_document',
        ]);

        if (empty($lessor)) {
            $spouse = null;
            $companies = null;
            $properties = null;
        } else {
            $civilStatusSpouseRequired = [
                'married',
                'separated',
            ];

            if (in_array($lessor->civil_status, $civilStatusSpouseRequired)) {
                $spouse = [
                    'spouse_name' => $lessor->spouse_name,
                    'spouse_document' => $lessor->spouse_document,
                ];
            } else {
                $spouse = null;
            }

            $companies = $lessor->companies()->get([
                'id',
                'alias_name',
                'document_company'
            ]);

            $getProperties = $lessor->properties()->get();

            $property = [];
            foreach ($getProperties as $property) {
                $properties[] = [
                    'id' => $property->id,
                    'description' => '#' . $property->id . ' ' . $property->street . ', ' .
                    $property->number . ' ' . $property->neighborhood . ' ' .
                    $property->city . '/' . $property->state . ' (' . $property->zipcode . ')'
                ];
            }
        }

        $json['spouse'] = $spouse;
        $json['companies'] = (!empty($companies) && $companies->count() ? $companies : null);
        $json['properties'] = (!empty($properties) ? $properties : null);

        return response()->json($json);
    }

    public function getDataAcquirer(Request $request) {
        $lessee = User::where('id', $request->user)->first([
            'id',
            'civil_status',
            'spouse_name',
            'spouse_document',
        ]);

        if (empty($lessee)) {
            $spouse = null;
            $companies = null;
        } else {
            $civilStatusSpouseRequired = [
                'married',
                'separated',
            ];

            if (in_array($lessee->civil_status, $civilStatusSpouseRequired)) {
                $spouse = [
                    'spouse_name' => $lessee->spouse_name,
                    'spouse_document' => $lessee->spouse_document,
                ];
            } else {
                $spouse = null;
            }

            $companies = $lessee->companies()->get([
                'id',
                'alias_name',
                'document_company'
            ]);
        }

        $json['spouse'] = $spouse;
        $json['companies'] = (!empty($companies) && $companies->count() ? $companies : null);

        return response()->json($json);
    }

    public function getDataProperty(Request $request) {
        $property = Property::where('id', $request->property)->first();

        if (empty($property)) {
            $property = null;
        } else {
            $property = [
                'id' => $property->id,
                'sale_price' => $property->sale_price,
                'rent_price' => $property->rent_price,
                'tribute' => $property->tribute,
                'condominium' => $property->condominium
            ];
        }

        $json['property'] = $property;
        return response()->json($json);
    }

}
