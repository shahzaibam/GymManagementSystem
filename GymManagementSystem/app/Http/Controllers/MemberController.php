<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
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

        Member::create($request->all());
        return redirect()->route('members.index')->with('success', 'Member added successfully!');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|email',
            'phone' => 'required|string|max:15',
            'membership_type' => 'required|string|max:50',
            'membership_start_date' => 'required|date|max:50',
            'membership_end_date' => 'required|date|max:50',
        ]);

        $member = Member::findOrFail($id);
        $member->update($request->all());
        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }



    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }



    public function dashboard()
    {
        // Contar los miembros de cada tipo
        $totalMembers = Member::count();
        $basicMembers = Member::where('membership_type', 'Basic')->count();
        $premiumMembers = Member::where('membership_type', 'Premium')->count();
        $vipMembers = Member::where('membership_type', 'VIP')->count();

        // Pasar estos datos a la vista del dashboard
        return view('dashboard', compact('totalMembers', 'basicMembers', 'premiumMembers', 'vipMembers'));
    }



}
