@extends('artist_nav')

<style>
    .hall {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
    }

    .hall label {
        width: 50%;
        font-size: 2em;
        background-color: white;
        border: 0.75px solid black;
        border-radius: 50px;
        padding: 10px 20px;
        margin: 5px;
        text-align: center;
    }

    .hall a {
        color: black;
        text-decoration: none;
    }

    .hall label a:hover {
        color: #7B5E3C;
    }

    .hall .present {
        background-color: #E0C2A5;
        font-weight: bold;
        border-color: #7B5E3C;
    }

    .btnbtn {
        text-align: right;
        margin-top: 10px;
    }

    .btnbtn .btnn {
        color: white;
        font-size: 1.2em;
        font-weight: lighter;
        width: 150px;
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        background-color: #A88E7A;
        transition: all 0.3s ease;
    }

    .btnbtn .btnn img {
        width: 20px;
        height: 20px;
        margin: 0 10px 0 0;
    }

    .btnbtn .btnn:hover {
        background-color: #7B5E3C;
        transform: scale(1.05);
    }
</style>

@section('title', 'ส่งคำขอของที่ระลึก(Artist)')

@section('content')

    <div class="hall">
        <label><a href="{{ url('/artist/request/create') }}">ส่งคำขอจัดนิทัศการ</a></label>
        <label class="present"><a href="{{ url('/artist/s/request/create') }}">ส่งคำขอของที่ระลึก</a></label>
    </div>
    
    <form method="POST" action="{{ route('artist.S_insert') }}" enctype="multipart/form-data">
        @csrf
        <label>ชื่อของที่ระลึก:</label>
        <input type="text" class="form-control" name="souvenirs_name" required><br>

        <label>อัปโหลดรูปภาพ:</label>
        <input type="file" class="form-control" name="image_path" required><br>

        <label>จำนวน:</label>
        <input type="number" class="form-control" name="quantity_left" min="1" required><br>

        <label>รายละเอียด:</label>
        <textarea class="form-control" name="description"></textarea><br>

        <div class="btnbtn">
            <button class="btnn" type="submit"><img src="{{ asset('img/send.png') }}" alt="send">ส่งคำร้อง</button>
        </div>
    </form>

@endsection
