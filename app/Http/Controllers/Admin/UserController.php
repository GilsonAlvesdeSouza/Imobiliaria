<?php

namespace LaraDev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Http\Requests\Admin\UserRequest;
use LaraDev\Suporte\Cropper;
use LaraDev\User;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        try {
            $userCreate = User::create($request->all());

            if (!empty($request->file('cover'))) {
                $userCreate->cover = $request->file('cover')->storeAs('user', str_slug($request->name) . '-' . str_replace('.', '', microtime(true)) . '.' . $request->file('cover')->extension());
                $userCreate->save();
            }
            toast('Dados salvos com sucesso!', 'success');
        } catch (\Exception $exception) {
            toast("Ocorreu um erro ao tentar salvar os dados!", 'error');
        }

        return redirect()->route('admin.users.edit', [
            'user' => $userCreate->id]);
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
        $user = User::where('id', $id)->first();

        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::where('id', $id)->first();

        $user->setLessorAttribute($request->lessor);
        $user->setLesseeAttribute($request->lessee);
        $user->setClientAttribute($request->client);
        $user->setAdminAttribute($request->admin);

        if (!empty($request->file('cover'))) {
            Storage::delete($user->cover);
            Cropper::flush($user->cover);
            $user->cover = '';
        }


        $user->fill($request->all());

        if (!empty($request->file('cover'))) {
            $user->cover = $request->file('cover')->storeAs('user', str_slug($request->name) . '-' . str_replace('.', '', microtime(true)) . '.' . $request->file('cover')->extension());
        }

        try {
            $user->save();
            toast('Dados alterados com sucesso!', 'success');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            toast("Ocorreu um erro ao tentar alterar os dados!", 'error');
            return redirect()->route('admin.users.index');
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

    public function team()
    {
        $users = User::where('admin', 1)->orderBy('name', 'ASC')->get();
        return view('admin.users.team', [
            'users' => $users,
        ]);
    }
}
