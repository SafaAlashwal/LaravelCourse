<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;



class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
   // public function __construct($status)
    //{
    //    $this->status=$status;
   // }    

    public function forStatus(int $status)
    {
        $this->status = $status;
        
        return $this;
    }

    public function forYear(int $Year)
    {
        $this->Year = $Year;
        
        return $this;
    }

    public function collection()
    {
        return User::all(['status','id','name','email'])
        ->where('status',$this->status);
    }

    //public function map($user): array
    //{
     //   return [
     //       'id'=>$user->id,
     //       'name'=>$user->name,
     //       'email'=>$user->email,
      //      'roles'=>$this->getRoleName($user->roles),
           // 'roles'=>$user->getRoleName(),
     //       'status'=>$user->status==1?"active":"blocked",
     //       'created_at'=>$user->created_at->format('Y-M-d'),
      //  ];
    //}
   // public function getRoleName($roles)
   // {
      //  $user_role='';
      //     foreach($roles as $role)
       //    $user_role.=$role->name.' ';
    //       return $user_role;
   // }    
    public function Query()
    {
            return User::query()
            ->whereYear('created_at',$this->Year)
            ->where('status',1);
    }    

    public function view(): View
    {
        return view('exports.users', [
            'users' => User::all()
        ]);
    }
}
