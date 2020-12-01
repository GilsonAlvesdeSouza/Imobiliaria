<?php

namespace LaraDev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Http\Requests\Admin\PropertyRequest;
use LaraDev\Model\Admin\Property;
use LaraDev\Model\Admin\PropertyImage;
use LaraDev\User;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::orderBy('id', 'DESC')->get();
        return view('admin.properties.index', [
            'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.properties.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        try {
            $createProperty = Property::create($request->all());

            if($request->allFiles()){
                foreach ($request->allFiles()['files'] as $image){
                    $propertyImage = new PropertyImage();
                    $propertyImage->property = $createProperty->id;
                    $propertyImage->path = $image->store('properties/'.$createProperty->id);
                    $propertyImage->save();
                    unset($propertyImage);
                }
            }

            toast('Dados salvos com sucesso!', 'success');
            return redirect()->route('admin.properties.edit', [
                'property' => $createProperty->id
            ]);
        } catch (\Exception $exception) {
            toast("Ocorreu um erro ao tentar salvar os dados!", 'error');
            return redirect()->route('admin.properties.index');
        }
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
        $property = Property::where('id', $id)->first();
        $users = User::orderBy('name')->get();

        return view('admin.properties.edit', [
            'property' => $property,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        $property = Property::where('id', $id)->first();
        $property->fill($request->all());
        $property->setSaleAttribute($request->sale);
        $property->setRentAttribute($request->rent);
        $property->setAirConditioningAttribute($request->air_conditioning);
        $property->setBarAttribute($request->bar);
        $property->setLibraryAttribute($request->library);
        $property->setBarbecueGrillAttribute($request->barbecue_grill);
        $property->setAmericanKitchenAttribute($request->american_kitchen);
        $property->setFittedKitchenAttribute($request->fitted_kitchen);
        $property->setPantryAttribute($request->pantry);
        $property->setEdiculeAttribute($request->edicule);
        $property->setOfficeAttribute($request->office);
        $property->setBathtubAttribute($request->bathtub);
        $property->setFireplaceAttribute($request->fireplace);
        $property->setLavatoryAttribute($request->lavatory);
        $property->setFurnishedAttribute($request->furnished);
        $property->setPoolAttribute($request->pool);
        $property->setSteamRoomAttribute($request->steam_room);
        $property->setViewOfTheSeaAttribute($request->view_of_theSea);

        try {
        $property->save();
        if($request->allFiles()){
            foreach ($request->allFiles()['files'] as $image){
                $propertyImage = new PropertyImage();
                $propertyImage->property = $property->id;
                $propertyImage->path = $image->store('properties/'.$property->id);
                $propertyImage->save();
                unset($propertyImage);
            }
        }

            toast('Dados alterados com sucesso!', 'success');
            return redirect()->route('admin.properties.edit', [
                'property' => $property->id
            ]);
        } catch (\Exception $exception) {
            toast("Ocorreu um erro ao tentar alterar os dados!", 'error');
            return redirect()->route('admin.properties.edit', [
                'property' => $property->id
            ]);

        }
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


    public function imageSetCover()
    {
        return response()->json('você chegou até aqui');
    }
    public function imageRemove()
    {
        return response()->json('Você está no caminho para remover imagens');
    }
}
