<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Employee;
use App\City;
use App\State;
use App\Country;
use App\Department;
use App\Division;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::table('employees')
        ->leftJoin('cities', 'employees.cities_id', '=', 'cities.id')
        ->leftJoin('departments', 'employees.departments_id', '=', 'departments.id')
        ->leftJoin('states', 'employees.states_id', '=', 'states.id')
        ->leftJoin('countries', 'employees.countries_id', '=', 'countries.id')
        ->leftJoin('divisions', 'employees.divisions_id', '=', 'divisions.id')
        ->select('employees.*', 'departments.name as departments_name', 'departments.id as departments_id', 'divisions.name as divisions_name', 'divisions.id as divisions_id')
        ->paginate(5);

         //return $employees;

        return view('employee-management.index', compact('employees'));

        //$employees = Employee::all();

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $states = State::all();
        $countries = Country::all();
        $departments = Department::all();
        $divisions = Division::all();
        return view('employee-management.create', ['cities' => $cities, 'states' => $states, 'countries' => $countries,
            'departments' => $departments, 'divisions' => $divisions]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validateInput($request);
        // Upload image
        $path = $request->file('picture')->store('avatars');
        $keys = ['lastname', 'firstname', 'middlename', 'address', 'cities_id', 'states_id', 'countries_id', 'zip',
        'age', 'birthdate', 'date_hired', 'departments_id', 'departments_id', 'divisions_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['picture'] = $path;
        Employee::create($input);*/

        $employee = new Employee();
        $this->validate(request(),[
            'lastname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'address' => 'required',
            'cities_id' => 'required',
            'states_id' => 'required',
            'countries_id' => 'required',
            'zip' => 'required',
            'age' => 'required',
            'birthdate' => 'required',
            'date_hired' => 'required',
            'departments_id' => 'required',
            'divisions_id' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,JPG,jpg,gif,svg|dimensions:width>=300,height>=300',
        ]);     

        $employee->lastname = $request->lastname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->address = $request->address;
        $employee->cities_id = $request->cities_id;
        $employee->states_id = $request->states_id;
        $employee->countries_id = $request->countries_id;
        $employee->zip = $request->zip;
        $employee->age = $request->age;
        $employee->birthdate = $request->birthdate;
        $employee->date_hired = $request->date_hired;
        $employee->departments_id = $request->departments_id;
        $employee->divisions_id = $request->divisions_id;
        $employee->picture = $request->picture->store('picture','public');
        $employee->save();

        //return $employee;

        return redirect()->intended('/employee-management/employee')->with('msg-success', 'Employee successful created');
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
        $employee = Employee::find($id);
        // Redirect to state list if updating state wasn't existed
        if ($employee == null || count($employee) == 0) {
            return redirect()->intended('/employee-management/employee');
        }
        $cities = City::all();
        $states = State::all();
        $countries = Country::all();
        $departments = Department::all();
        $divisions = Division::all();
        return view('employee-management.edit', ['employee' => $employee, 'cities' => $cities, 'states' => $states, 'countries' => $countries,
            'departments' => $departments, 'divisions' => $divisions]);
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
        $employee = Employee::findOrFail($id);
        $this->validateInput($request);
        // Upload image
        $keys = ['lastname', 'firstname', 'middlename', 'address', 'cities_id', 'states_id', 'countries_id', 'zip',
        'age', 'birthdate', 'date_hired', 'departments_id', 'departments_id', 'divisions_id'];
        $input = $this->createQueryInput($keys, $request);
        if ($request->file('picture')) {
            $path = $request->file('picture')->store('avatars');
            $input['picture'] = $path;
        }

        Employee::where('id', $id)
        ->update($input);

        return redirect()->intended('/employee-management/employee')->with('msg-success', 'Employee successful updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     Employee::where('id', $id)->delete();
     return redirect()->intended('/employee-management/employee')->with('msg-success', 'Employee successful deleted');
 }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
        'firstname' => $request['firstname'],
        'departments.name' => $request['departments_name']
        ];
        $employees = $this->doSearchingQuery($constraints);
        $constraints['departments_name'] = $request['departments_name'];
        return view('employee-management.index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('employees')
        ->leftJoin('cities', 'employees.cities_id', '=', 'cities.id')
        ->leftJoin('departments', 'employees.departments_id', '=', 'departments.id')
        ->leftJoin('states', 'employees.states_id', '=', 'states.id')
        ->leftJoin('countries', 'employees.countries_id', '=', 'countries.id')
        ->leftJoin('divisions', 'employees.divisions_id', '=', 'divisions.id')
        ->select('employees.firstname as employees_name', 'employees.*','departments.name as departments_name', 'departments.id as departments_id', 'divisions.name as divisions_name', 'divisions.id as divisions_id');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

     /**
     * Load image resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
     public function load($name) {
         $path = storage_path().'/app/avatars/'.$name;
         if (file_exists($path)) {
            return Response::download($path);
        }
    }

    private function validateInput($request) {
        $this->validate($request, [
            'lastname' => 'required|max:60',
            'firstname' => 'required|max:60',
            'middlename' => 'required|max:60',
            'address' => 'required|max:120',
            'cities_id' => 'required',
            'states_id' => 'required',
            'countries_id' => 'required',
            'zip' => 'required|max:10',
            'age' => 'required',
            'birthdate' => 'required',
            'date_hired' => 'required',
            'departments_id' => 'required',
            'divisions_id' => 'required'
            ]);
    }

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}
