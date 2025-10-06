@extends('artist_nav')

<style>
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

@section('title', 'แก้ไขคำร้อง(Artist)')

@section('content')

    <h2>แก้ไขคำร้อง</h2>

    <form method="POST" action="{{ route('artist.S_update', $souvenir->souvenirs_id) }}" enctype="multipart/form-data">
        @csrf
        <label>ชื่อของที่ระลึก:</label>
        <input type="text" class="form-control" name="souvenirs_name" value="{{ $souvenir->souvenirs_name }}"><br>

        <label>อัปโหลดรูปภาพใหม่ (ถ้ามี):</label>
        <input type="file" class="form-control" name="image_path"><br>
        @if ($souvenir->image_path)
            <img src="{{ $souvenir->image_path }}" alt="รูปของที่ระลึก" width="120" class="rounded shadow-sm"><br><br>
        @endif

        <label>จำนวน:</label>
        <input type="number" class="form-control" name="quantity_left" value="{{ $souvenir->quantity_left }}"
            min="1"><br>

        <label>รายละเอียด:</label>
        <textarea class="form-control" name="description">{{ $souvenir->description }}</textarea><br>

        <div class="btnbtn">
            <button class="btnn" type="submit"><img src="{{ asset('img/send.png') }}" alt="send">ส่งคำร้อง</button>
        </div>
    </form>

@endsection
