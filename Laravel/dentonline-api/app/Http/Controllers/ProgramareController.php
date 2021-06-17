<?php

namespace App\Http\Controllers;

use App\Models\Programare;
use App\Models\User;
use App\Models\Dentist;
use Illuminate\Http\Request;

class ProgramareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programari = Programare::all();
        return response()->json($programari);
    }

    public function getByDentist()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'dentist_name' => 'required',
            'user_name' => 'required',
            'date' => 'required',
            'comment' => 'required'
        ]);

        $dentist_id = Dentist::where("name", $request->input('dentist_name'))->first()->id;
        $user_id = User::where("name", $request->input('user_name'))->first()->id;

        $dentist_name = $request->input('dentist_name');

        $programare = Programare::create([
            'dentist_id' => $dentist_id,
            'dentist_name' => $dentist_name,
            'user_id' => $user_id,
            'user_name' => $request->input('user_name'),
            'date' => $request->input('date'),
            'comment' => $request->input('comment'),
            ]);
        return response()->json(['message'=> 'programare creata', 
        'programare' => $programare]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programare  $programare
     * @return \Illuminate\Http\Response
     */
    public function show(Programare $programare)
    {
        //
    }

    public function getByDentistID(Request $request) {
        $request->validate([
            'id' => 'required'
        ]);

        $programari = Programare::where("dentist_id", $request->input('id'))->get();

        return response()->json($programari);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programare  $programare
     * @return \Illuminate\Http\Response
     */
    public function edit(Programare $programare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programare  $programare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programare $programare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programare  $programare
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programare $programare)
    {
        //
    }
}
