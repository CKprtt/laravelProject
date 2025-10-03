@extends('artist_nav')

@section('title', 'ส่งคำร้อง')

@section('content')
    <h1>ส่งคำขอจัดนิทรรศการ</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('artist.storeRequest') }}" enctype="multipart/form-data">
        @csrf
        <label>ชื่อศิลปิน:</label>
        <input class="form-control" type="text" name="event_name" required><br><br>

        <label>ชื่องาน:</label><br>
        <input class="form-control" type="text" name="event_name" required><br><br>

        <label>ต้องการใช้โรงละคร:</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault1">
            <label class="form-check-label" for="radioDefault1">
                ใช้
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault2" checked>
            <label class="form-check-label" for="radioDefault2">
                ไม่ใช้
            </label>
        </div>
        <br><br>

        <label>รายละเอียด:</label><br>
        <textarea class="form-control" name="proposal"></textarea><br><br>

        <label>วันที่ต้องการจอง:</label><br>
        <input class="form-control" type="date" name="start_date" required> ถึง
        <input class="form-control" type="date" name="end_date" required><br><br>

        <label>อัปโหลดรูปภาพ:</label><br>
        <input class="form-control" type="file" name="poster"><br><br>

        <button type="submit" class="btn btn-primary">ส่งคำร้อง</button>
    </form>
@endsection
