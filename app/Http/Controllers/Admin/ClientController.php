<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy("name", "asc")->get();
        return view('admin.pages.clients.index', [
            'all_client' => $clients,
            'form_type'  => 'create',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:clients',
            'photo' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $img = $request->file('photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter=Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/clients/').$file_name);
            
        } 

        Client::create([
            'name' => $request->name,
            'photo' => $file_name,
        ]);

        return back()->with('success', 'Client created successfully');
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
        $clients = Client::orderBy("name", "asc")->get();
        $client = Client::findOrFail($id);
        return view('admin.pages.clients.index', [
            'all_client' => $clients,
            'form_type'  => 'edit',
            'edit'  => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_date = Client::findOrFail($id);

        if ($request->hasFile('new_photo')) {
            $img = $request->file('new_photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $img->move(public_path('storage/clients/'), $file_name);
            unlink('storage/clients/' . $request->old_photo);
        } else {
            $file_name = $request->old_photo;
        }
        $update_date->update([
            'name' => $request->name,
            'photo' => $file_name,
        ]);

        return back()->with('success', 'Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id = Client::findOrFail($id);
        $delete_id->delete();
        unlink('storage/clients/' . $delete_id->photo);

        return back()->with('success-main', 'Client Deleted successfully');
    }
}
