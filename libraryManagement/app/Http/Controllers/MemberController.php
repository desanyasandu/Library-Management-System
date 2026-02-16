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
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'phone' => 'required',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Member registered successfully.');
    }

    
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

   
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone' => 'required',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

   
    public function destroy(Member $member)
    {
       
        if ($member->borrowRecords()->whereNull('returned_at')->exists()) {
            return back()->with('error', 'Cannot delete member with active book loans.');
        }

        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
