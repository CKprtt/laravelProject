<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
    <Style>
        body {
            font-family: 'kanit', sans-serif;
            background-color: #EBE6E0;
            
        }
        .containeredit {
            background-color: #ffffff;
            padding: 20px;
            margin: 5% auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            height: 380px;

            
            
        }
        .containeredit button{
            float: right;
            
        }

        
    </Style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <div class="containeredit">
    <h2>Edit User</h2>
    <form action="{{ route('Manage.update', $user_edit->id) }}" method="POST">
        @csrf
        @method('POST')
        Name:
        <input type="text" class="form-control" name="name" value="{{ $user_edit->name }}" required><br>
        Email:
        <input type="email" class="form-control" name="email" value="{{ $user_edit->email }}" required><br>
        Role:
        <div id="container"><select name="usertype" class="form-select" required>
            <option value="user" {{ $user_edit->usertype == 'user' ? 'selected' : '' }}>User</option>
            <option value="artis" {{ $user_edit->usertype == 'artis' ? 'selected' : '' }}>Artis</option>
            <option value="admin" {{ $user_edit->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="super_admin" {{ $user_edit->usertype == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
        </select>
        </div> <br>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to Update this')">Update User</button>
    </form>
    </div>
    <a href="{{ route('ManageAccount') }}">Back</a>

</body>
</html>