<?php

namespace App\Http\Controllers;

use App\Models\GymMember;
use Illuminate\Http\Request;

class GymMemberController extends Controller
{
    public function index()
    {
        // Paginamos los miembros del usuario logueado

        if(auth()->user()->role == "Employee") {
            $members = GymMember::where('user_id', auth()->id())->paginate(10);
        }else {
            $members = GymMember::paginate(10);
        }


        return view('members.index', compact('members'));
    }


    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|string|max:15',
            'membership_type' => 'required|string|max:50',
            'membership_start_date' => 'required|date|max:50',
            'membership_end_date' => 'required|date|max:50',
        ]);

        // Asignar el ID del usuario autenticado
        $request->merge(['user_id' => auth()->id()]);

        // Crear el member con la relación al usuario
        GymMember::create($request->all());

        return redirect()->route('members.index')->with('success', 'GymMember added successfully!');
    }

    public function edit($id)
    {
        $member = GymMember::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'membership_type' => 'required|string|max:50',
            'membership_start_date' => 'required|date|max:50',
            'membership_end_date' => 'required|date|max:50',
        ]);

        $member = GymMember::findOrFail($id);

        // Asegurarse de que el miembro pertenece al usuario autenticado
        if ($member->user_id !== auth()->id()) {
            return redirect()->route('members.index')->with('error', 'You cannot edit this member.');
        }

        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'GymMember updated successfully!');
    }



    public function destroy($id)
    {
        $member = GymMember::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'GymMember deleted successfully!');
    }



    public function dashboard()
    {
        // Contar los miembros de cada tipo
        $totalMembers = GymMember::count();
        $basicMembers = GymMember::where('membership_type', 'Basic')->count();
        $premiumMembers = GymMember::where('membership_type', 'Premium')->count();
        $vipMembers = GymMember::where('membership_type', 'VIP')->count();

        // Pasar estos datos a la vista del dashboard
        return view('dashboard', compact('totalMembers', 'basicMembers', 'premiumMembers', 'vipMembers'));
    }



}
