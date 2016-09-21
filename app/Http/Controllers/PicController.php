<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:34 AM
 */

namespace App\Http\Controllers;

use App\Pic;
use Illuminate\Http\Request;

class PicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function store(Request $request)
	{
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|string|max:255',
        ]);
        $id = $request->input('id');
        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ];

        Pic::create($data);

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

}