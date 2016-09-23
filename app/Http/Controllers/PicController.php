<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:34 AM
 */

namespace App\Http\Controllers;

use App\Pic;
use App\PhoneProvider;
use App\PhoneNumber;
use App\Lookup;
use Illuminate\Http\Request;

class PicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function store(Request $request, $id)
	{
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|string|max:255',
        ]);
        $id = $request->input('id');
        $data = [
            'supplier_id' => $id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ];

        $pic = Pic::create($data);
        $pic->supplier()->attach($id);
        return redirect('dashboard/master/supplier/edit/'.$id);

	}

	public function edit($id)
	{
        $supplier = Supplier::findOrFail($id);
        $phone_provider = PhoneProvider::all();

        return view('suppliers.edit', compact('supplier', 'phone_provider'));
	}

	public function update(Request $request, $id)
	{
        $supplier = Supplier::findOrFail($id);

        if ($supplier) {
            $supplier->supplier_name = $request->input('name');
            $supplier->supplier_address = $request->input('address');
            $supplier->supplier_city = $request->input('city');
            $supplier->phone_number = $request->input('phone_number');
            $supplier->fax_num = $request->input('fax_num');
            $supplier->tax_id = $request->input('tax_id');
            $supplier->status = $request->input('status');
            $supplier->remarks = $request->input('remarks');
            $supplier->update();
            return redirect(route('db.master.supplier'));
        }
	}

	public function delete($id)
	{
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();
        return redirect(route('db.master.supplier'));
	}

    public function createPhone($id)
    {
        $pics = Pic::all();
        $phone_provider = PhoneProvider::all();
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('suppliers.phone.create',compact('phone_provider','statusDDL'))->with('id', $id);
    }

    public function storePhone(Request $request, $id)
    {
        $pics = Pic::find($id);

        $this->validate($request,[
            'number' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $data = [
            'phone_provider_id' => $request->provider,
            'status' => $request->status,
            'remarks' => $request->remarks,
            'number' => $request->number,
        ];
        $phone = PhoneNumber::create($data);
        $pics->phone()->attach($phone->id);

        return redirect('dashboard/master/supplier/');
    }
}