@extends('layout.app')

@section('content')
<div class="container">
    <h2>All customers</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Joined</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($users as $user)
               <tr>
                   <td>{{%user->id}}</td>
                   <td>{{%user->name}}</td>
                   <td>{{%user->email}}</td>
                   <td>{{%user->created_at->format('d/m/Y')}}</td>
                </tr>   
            @endforeach
        </tbody>    
    </table>
</div>    
@endsection
