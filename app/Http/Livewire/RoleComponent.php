<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\GeneralAttribute;
use Livewire\WithPagination;
use App\Role;
class RoleComponent extends Component
{
    use WithPagination , GeneralAttribute;
    public $user_permissions=[];
    public  $role = ['name'=>''];
    protected $listeners = ['Role_delete'=>'delete'];

    public function mount()
    {
        $this->search_name = request()->query('search_name',$this->search_name);
    }
    public function render()
    {
        $data =Role::query();
        if($this->search_name){
            $data->where('name','like',"%$this->search_name%");
        }
        $data = $data->orderBy('updated_at','desc')->paginate(12);
        return view('admin.role.index',
            [
                'data' => $data,
            ]);

    }
    public function create(){
        $this->rest();
        $this->status=2;
    }
    public function edit( $role){
        $role = Role::find($role);
        $permissions = $role->getPermissionByName();
        $this->user_permissions=$permissions;
        $this->role=$role;
        $this->status=3;

    }
    public function destroy($user)
    {
        $role = \App\Role::find($user);
        $role->delete();

    }
    function  rest(){
        $this->status = 1;
    }
    function delete(){

    }
}
