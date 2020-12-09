<?php

namespace LaraDev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Http\Requests\Admin\ContractsRequest;
use LaraDev\Model\Admin\Contract;
use LaraDev\Model\Admin\Property;
use LaraDev\User;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::with('ownerObject',
            'acquirerObject',
            'ownerCompanyObject',
            'acquirerCompanyObject'
        )->orderBy('id', 'DESC')->get();

        return view('admin.contracts.index', [
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessors = User::lessors();
        $lessees = User::lessees();

        return view('admin.contracts.create', [
            'lessors' => $lessors,
            'lessees' => $lessees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractsRequest $request)
    {

        try {
            $contractCreate = Contract::Create($request->all());
            toast('Dados salvos com sucesso!', 'success');
        } catch (\Exception $exception) {
            toast("Ocorreu um erro ao tentar salvar os dados!", 'error');
        }

        return redirect()->route('admin.contracts.edit', [
            'contract' => $contractCreate->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lessors = User::lessors();
        $lessees = User::lessees();
        $contract = Contract::where('id', $id)->first();

        return view('admin.contracts.edit', [
            'contract' => $contract,
            'lessors' => $lessors,
            'lessees' => $lessees
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractsRequest $request, $id)
    {
        $contract = Contract::where('id', $id)->first();
        $contract->fill($request->all());

        try {
            $contract->save();
            toast('Dados alterados com sucesso!', 'success');
        } catch (\Exception $exception) {
            toast("Ocorreu um erro ao tentar alterar os dados!", 'error');
        }

        return redirect()->route('admin.contracts.edit', [
            'contract' => $contract->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDataOwner(Request $request)
    {
        $lessor = User::where('id', $request->user)->first([
            'id',
            'civil_status',
            'spouse_name',
            'spouse_document'
        ]);


        if (empty($lessor)) {
            $spouse = null;
        } else {
            $civilStatusSpouseRequired = [
                'married',
                'separated',
            ];

            if (in_array($lessor->civil_status, $civilStatusSpouseRequired)) {
                $spouse = [
                    'spouse_name' => $lessor->spouse_name,
                    'spouse_document' => $lessor->spouse_document
                ];
            } else {
                $spouse = null;
            }
        }

        $companies = '';
        if (!empty($lessor)) {
            $companies = $lessor->Companies()->get([
                'id',
                'alias_name',
                'document_company'
            ]);
        }

        $properties [] = '';
        if (!empty($lessor)) {
            $getProperties = $lessor->Properties()->get();
            foreach ($getProperties as $property) {
                $properties[] = [
                    'id' => $property->id,
                    'description' => $property->street . ' N°:' . $property->number . ' ' . $property->complement . ' ' .
                        $property->neighborhood . ' ' . $property->city . '/' . $property->state . ' CEP:' . $property->zipcode
                ];
            }
        }

        $json = [
            'spouse' => $spouse,
            'companies' => $companies,
            'properties' => $properties
        ];

        return response()->json($json);
    }

    public function getDataAcquirer(Request $request)
    {
        $lessee = User::where('id', $request->user)->first([
            'id',
            'civil_status',
            'spouse_name',
            'spouse_document'
        ]);


        if (empty($lessee)) {
            $spouse = null;
        } else {
            $civilStatusSpouseRequired = [
                'married',
                'separated',
            ];

            if (in_array($lessee->civil_status, $civilStatusSpouseRequired)) {
                $spouse = [
                    'spouse_name' => $lessee->spouse_name,
                    'spouse_document' => $lessee->spouse_document
                ];
            } else {
                $spouse = null;
            }
        }

        $companies = '';
        if (!empty($lessee)) {
            $companies = $lessee->Companies()->get([
                'id',
                'alias_name',
                'document_company'
            ]);
        }

        $json = [
            'spouse' => $spouse,
            'companies' => $companies,
        ];

        return response()->json($json);
    }

    public function getDataProprety(Request $request)
    {

        $property = Property::where('id', $request->property)->first([
            'id',
            'sale_price',
            'rent_price',
            'tribute',
            'condominium'
        ]);

        $json = [
            'property' => ($property ? $property : ''),
        ];

        return response()->json($json);
    }
}
