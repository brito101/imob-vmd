<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Storage;
use App\Support\Cropper;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('Listar Usuários')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $user = User::where('lessor', 1)->orWhere('lessee', 1)->get();;
        return view('admin.clients.index', [
            'users' => $user
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Usuários')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Usuários')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $userCreate = User::create($request->all());
        if (!empty($request->file('cover'))) {
            $userCreate->cover = $request->file('cover')
                ->storeAs('user', Str::slug($request->name) . '-' . str_replace('.', '', microtime(true)) . '.' . $request->file('cover')
                    ->extension());
            $userCreate->save();
        }
        return redirect()->route('admin.clients.edit', [
            'client' => $userCreate->id
        ])->with(['message' => 'Cliente criado com sucesso!', 'type' => 'success', 'icon' => 'check']);
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
        if (!Auth::user()->hasPermissionTo('Editar Usuários')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $user = User::where('id', $id)->first();
        if (empty($user->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $roles = Role::all();
        foreach ($roles as $role) {
            if ($user->hasRole($role->name)) {
                $role->can = true;
            } else {
                $role->can = false;
            }
        }
        return view('admin.clients.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Usuários')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $user = User::where('id', $id)->first();
        if (empty($user->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $user->setLessorAttribute($request->lessor);
        $user->setLesseeAttribute($request->lessee);

        if (!empty($request->file('cover'))) {
            Storage::delete($user->cover);
            Cropper::flush($user->cover);
            $user->cover = '';
        }
        $user->fill($request->all());
        if (!empty($request->file('cover'))) {
            $user->cover = $request->file('cover')
                ->storeAs('user', Str::slug($request->name) . '-' . str_replace('.', '', microtime(true)) . '.' . $request->file('cover')
                    ->extension());
        }
        if (!$user->save()) {
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.clients.edit', [
            'client' => $user->id
        ])->with(['message' => 'Cliente atualizado com sucesso!', 'type' => 'success', 'icon' => 'check']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermissionTo('Remover Usuários')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.clients.index')
                ->with([
                    'message' => 'Exclusão não realizada! Por segurança, você não pode excluir seu usuário.',
                    'type' => 'warning', 'icon' => 'exclamation-triangle'
                ]);
        }
        $user = User::where('id', $id)->first();
        if (empty($user->id)) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }
        $user->delete();
        return redirect()->route('admin.clients.index')
            ->with(['message' => 'Cliente excluído com sucesso!', 'type' => 'success', 'icon' => 'trash']);
    }
}
