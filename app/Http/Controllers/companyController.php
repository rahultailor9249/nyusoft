<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class companyController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'file' => 'required|mimes:csv,txt'
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->fails()],404);
        }

        $data = new Helpers\Helper();
        $employeeData = $data->csvToArray($request->file);

        $company = Company::where('email', $request->email)->first();
        if (!$company) {
            $company = new Company();
        }
        $company->name = $request->name;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->save();
        foreach ($employeeData as $key => $data) {
            $employee = User::where('company_id', $company->id)->where('email', $data['email'])->first();
            if (!$employee) {
                $employee = new User();
            }

            $employee->name = $data['name'];
            $employee->email = $data['email'];
            $employee->age = $data['age'];
            $employee->earing2016 = $data['earning2016'];
            $employee->earing2017 = $data['earning2017'];
            $employee->earing2018 = $data['earning2018'];
            $employee->company_id = $company->id;
            $employee->save();
        }
        return response()->json(['message'=>'data sucesfully inserted or updated'],201);
    }

    public function companyList()
    {
        $data['companyName'] = Company::pluck('name')->toArray();
        $data['companies'] = Company::with('employee')->get();
        if(!$data['companies']) {
            return response()->json(['message'=>'Data not found'], 422);
        }
        $totalArr = [];
        foreach ($data['companies'] as $company) {
            $total = 0;
            foreach ($company->employee as $value) {
                $total = $total + $value->earing2016 + $value->earing2017 + $value->earing2018;
            }
            array_push($totalArr,$total);
        }
        $data['total'] = $totalArr;
        return view('welcome',$data);
    }
    public function getCompanyData(Request $request,$companyId) {
        $data['company']= Company::with('employee')->where('id',$companyId)->first();
        $earning2016 = User::where('company_id',$companyId)->pluck('earing2016')->sum();
        $earning2017 = User::where('company_id',$companyId)->pluck('earing2017')->sum();
        $earning2018 = User::where('company_id',$companyId)->pluck('earing2018')->sum();
        $data['Yeartotal'] = [$earning2016,$earning2017,$earning2018];
        if(!$data['company']) {
            return response()->json(['message'=>'Data not found'], 422);
        }
        return view('company',$data);
    }

    public function allCompanyChart(Request $request) {
        $companies= Company::with('employee')->get();
        $name = $company = Company::select('name')->get();

        if(!$companies) {
            return response()->json(['message'=>'Data not found'], 422);
        }
        $companydata = [];
        foreach ($companies as $company) {
            $total = 0;
            foreach ($company->employee as $value) {
                $total = $total + $value->earing2016 + $value->earing2017 + $value->earing2018;
            }
            $tempArr = [
                  'total'=>$total,
                  'name'=>$company->name,
              ];
            array_push($companydata,$tempArr);
        }
        return view('welcome',compact($name));
    }
}
