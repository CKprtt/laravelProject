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
        width: 180px;
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

    <div class="container">
        <form method="POST" action="{{ route('artist.updateRequest', $event->event_requests_id) }} "
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>ชื่องาน:</label>
                    <input class="form-control" type="text" name="event_name" value="{{ $event->event_name }}"><br>
                </div>

                <div class="col-md-6">
                    <label>ต้องการใช้โรงละคร:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_hall" value="Yes"
                            {{ $event->type_hall == 'Yes' ? 'checked' : '' }}> ใช้
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_hall" value="No"
                            {{ $event->type_hall == 'No' ? 'checked' : '' }}> ไม่ใช้
                    </div><br>
                </div>

                <div class="row mb-12">
                    <label>วันที่ต้องการจอง:</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="date" name="start_date" value="{{ $event->start_date }}"><br>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" type="date" name="end_date" value="{{ $event->end_date }}"><br>
                    </div>
                </div>

                <div class="col-md-12">
                    <label>รายละเอียด:</label>
                    <textarea class="form-control" name="proposal">{{ $event->proposal }}</textarea><br>

                    <label>อัปโหลดรูปภาพใหม่ (ถ้ามี):</label>
                    <input type="file" name="poster" class="form-control"><br>
                    @if ($event->poster_path)
                        <img src="{{ $event->poster_path }}" width="150">
                    @endif
                    <br><br>

                    <div class="btnbtn">
                        <button class="btnn" type="submit" class="btn btn-primary"><img src="{{ asset('img/send.png') }}"
                                alt="send">อัปเดตคำร้อง</button></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
