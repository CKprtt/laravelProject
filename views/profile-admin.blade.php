@extends('admin_nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #photo{
            width: 100px;
            height: 100px;
            border: 1px solid black;
            border-radius: 100%;
            background-color: lightgray;
            margin: 5px auto; 
        }
        .profile form lable{
            text-align: left;

        }
        .profile {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 50%;
            margin: 0px auto;
            margin-bottom: 20px;
            border-radius: 10px;
            
        }
        .profile form {
            width: 100%;
        
        }
        .profile button a{
            text-decoration: none;
            color: black;
            
            
        }
        fieldset{
            padding:0px;
        }
        
        fieldset legend{
            margin:-10px 10px 0px 10px;
        }
        body a{
            text-decoration: none;
            color: gray;
        }
        #button{
            display: flex;
            gap: 70px;
            margin: 10px auto;

        }
        #button_edit{
            
            margin: 10px auto auto 440px;

        }

    </style>
</head>
<body>
@section('content')
    <a href="/dashboard" ><<กลับหน้าแรก</a>
  @if(isset($profile_edit))
    <fieldset>
        <legend>Edit Profile</legend>
        <div class="profile">
            <div id="photo">
            </div >
        <form method="POST" action="{{ route('profile.update', $profile_edit->id) }}">
            @csrf
            <label for="name">ชื่อ :</label>
            <input type="text" class="form-control mb-2 "  id="name" name="name" value="{{ $profile_edit->name }}">

            <label for="email">Email :</label>
            <input type="email"  class="form-control mb-2 "  id="email" name="email" value="{{ $profile_edit->email }}">

            <label for="aboutme">คำอธิบาย :</label>
            <textarea type="text" class="form-control mb-2 "  id="aboutme" name="usertype" value="#"></textarea>
            <div id ="button_edit">
            <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('Are you sure you want upadte')">Save Changes</button>
            </div>
        </form>
        </div>
    </fieldset>
 
  @else
    <fieldset>
        <legend>Profile</legend>
        <div class="profile">
            <div id="photo">
            </div >
            <label for="name">ชื่อ :</label>
            <input type="text" class="form-control mb-2 text-secondary" id="name" name="name" value="{{ $user->name }}" disabled>

            <label for="email">Email :</label>
            <input type="email" class="form-control mb-2 text-secondary" id="email" name="email" value="{{ $user->email }}" disabled>

            <label for="aboutme">คำอธิบาย :</label>
            <textarea type="text" class="form-control mb-2 text-secondary" id="aboutme" name="usertype" value="#" disabled> </textarea>

            <div id ="button">
                <button type="button" class="btn btn-danger"><a href="{{ route('profile.destroy', $user->id) }}" onclick="return confirm('Are you sure you want to delete this')">Delete Profile </a></button>
                <button type="button" class="btn btn-warning"><a href="{{ route('profile.edit', $user->id) }}">Edit Profile</a> </button>
            </div>
        </div>


        
    </fieldset>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" onclick="return confirm('Are you sure you want logout')">Logout</button>
    </form>

 
@endsection

</body>
</html>