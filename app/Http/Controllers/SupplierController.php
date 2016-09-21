<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:34 AM
 */

namespace App\Http\Controllers;

use App\Supplier;
use App\Pic;
use App\PhoneProvider;
use App\Product;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
        $suppliers = Supplier::paginate(10);;
	    return view('suppliers.index', compact('suppliers'));
	}

	public function show($id)
	{
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.show', compact('supplier'));
	}

	public function create()
	{
        return view('suppliers.create');
	}

	public function store(Request $request)
	{
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'fax_num' => 'string|max:255',
            'tax_id' => 'required|string|max:255',
            'status' => 'required',
            'remarks' => 'required',
        ]);

        $data = [
            'supplier_name' => $request->input('name'),
            'supplier_address' => $request->input('address'),
            'supplier_city' => $request->input('city'),
            'phone_number' => $request->input('phone_number'),
            'fax_num' => $request->input('fax_num'),
            'tax_id' => $request->input('tax_id'),
            'status' => $request->input('status'),
            'remarks' => $request->input('remarks'),
        ];

        Supplier::create($data);

        return redirect(route('db.master.supplier'));

	}

	public function edit($id)
	{
        $supplier = Supplier::findOrFail($id);
        $pics = Pic::all();
        $phone_provider = PhoneProvider::all();
        $products = Product::all();

        return view('suppliers.edit', compact('supplier', 'phone_provider','pics','products'));
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