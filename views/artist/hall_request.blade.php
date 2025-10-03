@extends('artist_nav')

@section('title', 'ส่งคำร้อง')

@section('content')
    <h1>ส่งคำขอจัดนิทรรศการ</h1>
    @if (session('success'))
        <p class="text-success">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('artist.storeRequest') }}" enctype="multipart/form-data">
        @csrf

        <label>ชื่องาน:</label>
        <input class="form-control" type="text" name="event_name" required><br>

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

        <label>รายละเอียด:</label>
        <textarea class="form-control" name="proposal"></textarea><br>

        <label>วันที่ต้องการจอง:</label>
        <input class="form-control" type="date" name="start_date" required>
        ถึง
        <input class="form-control" type="date" name="end_date" required><br>

        <label>อัปโหลดรูปภาพ:</label>
        <input class="form-control" type="file" name="poster"><br>

        <button type="submit" class="btn btn-primary">ส่งคำร้อง</button>
    </form>
@endsection