<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\AdmissionType;
use App\Models\Branch;
use App\Models\Setting;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        $AcademicYears = AcademicYear::all();
        $AdmissionTypes = AdmissionType::all();
        $Branches = Branch::all();
        foreach($settings as $setting){
            if($setting->public_form ==1)
            {
                //return 'Done';
                return view('index', compact('AcademicYears','AdmissionTypes','Branches'));
            }
            else{
                return view('noreg');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'parents_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:dns', 'max:255', 'unique:'.Student::class],
            'phone' => ['required','digits:10','numeric'],
            'parmanent_address' => ['required', 'string', 'max:255'],
            'communication_address' => ['required', 'string', 'max:255'],
        ]);

        $student = Student::create([
            'referal_agent_id' => 1,
            'academic_year_id' => $request->academic_year_id,
            'admission_type_id' => $request->admission_type_id,
            'branch_id' => $request->branch_id,
            'full_name' => $request->full_name,
            'parents_name' => $request->parents_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'parmanent_address' => $request->parmanent_address,
            'communication_address' => $request->communication_address,
            'student_status' => 'Hold',
            'payment_status' => 0,
        ]);

        return view('thanks', compact('student'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
