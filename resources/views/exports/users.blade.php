<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Role</th>
        <th>Email</th>
        <th>Phone</th>
        <th>status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td><div >
                   @foreach($user->roles as $role)
                       <span class="mx-1"> {{$role->name}} </span>
                   @endforeach
                </div>

            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>
@foreach($user->roles as $role )
          <span class="mx-1"> {{$role->name}}</td>
            @endforeach
    
            <td>{{$user->status}}</td>
       

        </tr>
    @endforeach
    </tbody>
</table>
