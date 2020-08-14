<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\CompUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\ThumbMaker as Thumb;
use File;

class CompanyController extends Controller
{
    public function index()
    {
        if (! Gate::allows('companies')) {

            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');

        }
        $companies = Company::orderBy('id', 'DESC')->paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.add');
    }

    public function store(Request $request)
    {
        $user_id = auth()->id();
        $rules = [
            'name' => 'required|string|max:100',
            'phone' => 'required|regex:/^\+?\d{10,14}$/',
            'email' => 'required|email|max:100',
            'address' => 'required|string|max:150',
            'employment' => 'required|string|max:150',
            'website' => 'url|max:150',
            'description' => 'required|string|max:2000',
            'company_logo' => 'required|image|max:4000',
            'status' => 'in:0,1',
        ];
        $this->validate(request(), $rules);
        $company = Company::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'employment' => $request->employment,
            'website' => $request->website,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $imgpath = 'companies/photos';
        $dir = 'public/' . $imgpath . '/' . $company->id;
        if (is_dir($dir) === false ) {
            File::makeDirectory($dir, 0777);
        }
        /*******************************************/
        // image path
        $thumb1 = new Thumb();
        $imgpath1 = $thumb1->saveImage($request->company_logo, $imgpath, $company->id, 'company_logo');
        /******************/
        // inserting images path.
        $company->update([ 'company_logo' => $imgpath1 ]);
        /*************************/
        return redirect()->route('companies.create')->with('success', 'Company has been created successfully');
    }

    public function show($id)
    {
        $company = Company::find($id);
        if ($company != null) {
            $company->user_id = $company->user->name;
            $company->status = $company->status == 0 ? 'Inactive' : 'Active';
            $company->company_logo = $company->company_logo != null ? url('public/' . $company->company_logo) : null;
            return response()->json([
                'status' => true,
                'data' => $company
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function edit(Company $company)
    {
        if ($company != null) {
            return view('admin.companies.edit', ['company' => $company]);
        } else {
            return back();
        }
    }

    public function update(Request $request, Company $company)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'phone' => 'required|regex:/^\+?\d{10,14}$/',
            'email' => 'required|email|max:100',
            'address' => 'required|string|max:150',
            'employment' => 'required|string|max:150',
            'website' => 'required|url|max:150',
            'description' => 'required|string|max:2000',
            'company_logo' => 'image|max:4000',
            'status' => 'in:0,1',
        ];
        $this->validate(request(), $rules);
        $company->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'employment' => $request->employment,
            'website' => $request->website,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        $imgpath = 'companies/photos';
        $dir = 'public/' . $imgpath . '/' . $company->id;
        if ($request->hasFile('company_logo')) {
            if (is_dir($dir) === false ) {
                File::makeDirectory($dir, 0777);
            } else {
                if (file_exists($dir . '/' . $request->company_logo)) {
                    unlink($dir . '/' . $request->company_logo);
                }
            }
            /*******************************************/
            // image path
            $thumb1 = new Thumb();
            $imgpath1 = $thumb1->saveImage($request->company_logo, $imgpath, $company->id, 'company_logo');
            /******************/
            // inserting images path.
            $company->update([ 'company_logo' => $imgpath1 ]);
        }
        /*************************/
        return redirect()->route('companies.index')->with('success', 'Company has been updated successfully');
    }

    public function destroy(Company $company)
    {
        $dir = 'public/companies/photos/';
        // Delete company image
        if (is_dir($dir . $company->id) != false) {
            File::deleteDirectory($dir . $company->id);
        }
        /******************************/
        // Delete all user belongs to company
        CompUser::where('company_id', $company->id)->delete();
        $company->delete();
        /******************************/
        return response()->json([
            'status' => true,
            'message' => 'Company has been deleted successfully'
        ]);
    }
}
