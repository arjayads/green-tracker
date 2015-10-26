<?php

namespace app\Http\Controllers;

use app\Dto\EmployeeDto;
use app\Http\Requests;
use app\Models\Employee;
use app\Models\UserGroup;
use app\Repositories\EmployeeRepo;
use app\Services\EmployeeService;
use Illuminate\Support\Facades\Input;

class EmployeeController extends Controller
{
    public function __construct(EmployeeService $empService, EmployeeDto $empDto,  EmployeeRepo $empRepo)
    {
        $this->empService = $empService;
        $this->empDto = $empDto;
        $this->empRepo = $empRepo;

        parent::__construct();
    }

    public function index() {
        return view('emp.list');
    }

    public function create() {
        return view('emp.create');
    }

    public function store(Requests\CreateEmployeeRequest $request)
    {
        return $this->empService->save($request->except('_token'))->toArray();
    }

    public function detail($id)
    {
        $e = $this->empDto->findById($id);
        if ($e) {
            $ug = UserGroup::where('user_id', $e->user->id)->first();
            $e->group = $ug->group->name;

            $sup = Employee::where('id', $e->supervisor_id)->select(['first_name', 'last_name'])->first();
            if ($sup) {
                $e->supervisor = $sup;
            }
            return view('emp.detail', ['employee' => $e]);
        } else {
            abort(404);
        }
    }


    public function edit($id)
    {
        $e = $this->empDto->findById($id);
        if ($e) {
            return view('emp.edit', ['employee' => $e]);
        } else {
            abort(404);
        }
    }

    public function getForEdit($id)
    {
        $data = [];
        $e = $this->empDto->findById($id);
        if ($e) {
            $ug = UserGroup::where('user_id', $e->user->id)->first();

            $data['empId'] = $e->id;
            $data['id_number'] = substr($e->id_number, 4);
            $data['first_name'] = $e->first_name;
            $data['middle_name'] = $e->middle_name;
            $data['last_name'] = $e->last_name;
            $data['sex'] = $e->sex;
            $data['birthday'] = $e->birthday;
            $data['email'] = $e->user->email;
            $data['shift'] = ['id' => $e->shift->id];
            $data['group'] = ['id' => $ug->group->id];

            $sup = Employee::where('id', $e->supervisor_id)->select(['id', 'first_name', 'last_name'])->first();
            if ($sup) {
                $data['supervisor'] = [ 'id' => $sup->id, 'full_name' => $sup->last_name . ', ' . $sup->first_name];
            }
        }
        return $data;
    }

    public function empList()
    {
        $sortCol = Input::get('sortCol');
        $direction = Input::get('direction');
        $offset = Input::get('offset');
        $limit = Input::get('limit');
        $query = Input::get('q');

        return $this->empRepo->find(
            $sortCol ?: 'id_number',
            in_array(strtoupper($direction), ['ASC', 'DESC']) ? $direction : 'ASC',
            $offset ?: 0,
            $limit ?: 15,
            $query ?: ''
        );
    }

    public function countFind() {
        $query = Input::get('q');
        return $this->empRepo->countFind($query ?: '' );
    }

    public function find()
    {
        $query = Input::get('q');
        return ['names' => $this->empDto->findBasic($query)];
    }

}
