<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Contract;
use App\Models\Property;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        if (Auth::check() === true) {
            return redirect()->route('admin.home');
        }

        return view('admin.index');
    }

    public function home()
    {
        $lessors = User::lessors()->count();
        $lessees = User::lessees()->count();
        $team = User::where('admin', 1)->count();

        if (Auth::user()->hasRole('Administrador')) {
            $propertiesAvailable = Property::available()->count();
            $propertiesUnavailable = Property::unavailable()->count();
            $propertiesTotal = Property::all()->count();
            $contractsPendent = Contract::pendent()->count();
            $contractsActive = Contract::active()->count();
            $contractsCanceled = Contract::canceled()->count();
            $contractsTotal = Contract::all()->count();
        } else {
            $propertiesAll = Property::where('broker', Auth::user()->id)->get();
            $propertiesAvailable = Property::where('broker', Auth::user()->id)->available()->count();
            $propertiesUnavailable = Property::where('broker', Auth::user()->id)->unavailable()->count();
            $propertiesTotal = Property::where('broker', Auth::user()->id)->count();
            $contractsPendent = Contract::pendent()->whereIn('property', $propertiesAll)->count();
            $contractsActive = Contract::active()->whereIn('property', $propertiesAll)->count();
            $contractsCanceled = Contract::canceled()->whereIn('property', $propertiesAll)->count();
            $contractsTotal = Contract::whereIn('property', $propertiesAll)->count();
        }


        $contracts = Contract::orderBy('id', 'DESC')->limit(10)->get();

        if (Auth::user()->hasRole('Administrador')) {
            $properties = Property::orderBy('id', 'DESC')->limit(3)->get();
        } else {
            $properties = Property::where('broker', Auth::user()->id)->orderBy('id', 'DESC')->limit(3)->get();
        }



        return view('admin.dashboard', [
            'lessors' => $lessors,
            'lessees' => $lessees,
            'team' => $team,
            'propertiesAvailable' => $propertiesAvailable,
            'propertiesUnavailable' => $propertiesUnavailable,
            'propertiesTotal' => $propertiesTotal,
            'contractsPendent' => $contractsPendent,
            'contractsActive' => $contractsActive,
            'contractsCanceled' => $contractsCanceled,
            'contractsTotal' => $contractsTotal,
            'contracts' => $contracts,
            'properties' => $properties,
        ]);
    }

    public function login(Request $request)
    {

        if (in_array('', $request->only('email', 'password'))) {
            $json['message'] = $this->message->error('Ooops, informe todos os dados para efetuar o login')->render();
            return response()->json($json);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $json['message'] = $this->message->error('Ooops, informe um e-mail válido')->render();
            return response()->json($json);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            $json['message'] = $this->message->error('Ooops, usuário e senha não conferem')->render();
            return response()->json($json);
        }

        if (!$this->isAdmin()) {
            Auth::logout();
            $json['message'] = $this->message->error('Ooops, usuário não tem permissão para acessar o painel de controle')->render();
            return response()->json($json);
        }

        $this->authenticated($request->getClientIp());

        $json['redirect'] = route('admin.home');
        return response()->json($json);
    }

    private function isAdmin()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->admin == 1 || $user->broker == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.home');
    }

    private function authenticated(string $ip)
    {
        $user = User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip,
        ]);
    }
}
