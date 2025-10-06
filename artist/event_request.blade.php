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

@section('title', 'ส่งคำร้อง(Artist)')

@section('content')

    <div class="hall">
        <label class="present"><a href="{{ url('/artist/request/create') }}">ส่งคำขอจัดนิทัศการ</a></label>
        <label><a href="{{ url('/artist/s/request/create') }}">ส่งคำขอของที่ระลึก</a></label>
    </div>

    <div class="container">
        <form method="POST" action="{{ route('artist.insertRequest') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>ชื่องาน:</label>
                    <input class="form-control" type="text" name="event_name" required><br>
                </div>

                <div class="col-md-6">
                    <label>ต้องการใช้โรงละคร:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_hall" value="Yes" id="hallYes">
                        <label class="form-check-label" for="hallYes">ใช้</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_hall" value="No" checked>
                        <label class="form-check-label">ไม่ใช้</label>
                    </div>
                    <br>
                </div>

                <div class="row mb-12">
                    <label>วันที่ต้องการจอง:</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control"  name="start_date" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" name="end_date" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <label>รายละเอียด:</label>
                    <textarea class="form-control" name="proposal"></textarea><br>

                    <label>อัปโหลดรูปภาพ:</label>
                    <input class="form-control" type="file" name="poster"><br>

                    <div class="btnbtn">
                        <button class="btnn" type="submit"><img src="{{ asset('img/send.png') }}"
                                alt="send">ส่งคำร้อง</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
