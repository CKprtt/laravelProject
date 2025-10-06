@extends('admin_nav')

@section('title', 'จัดการคำร้อง(Admin)')

@section('content')
    <h2>จัดการคำร้องขอแจกของที่ระลึก</h2>
    <table class="table table-bordered">
        <tr>
            <th>ชื่อของที่ระลึก</th>
            <th>รูปที่อัปโหลด</th>
            <th>คำอธิบาย</th>
            <th>จำนวน</th>
            <th>สถานะ</th>
            <th>การจัดการ</th>
        </tr>
        @foreach ($souvenirs as $s)
            <tr>
                <td>{{ $s->souvenirs_name }}</td>
                <td>
                    @if ($s->image_path)
                        <img src="{{ $s->image_path }}" alt="รูปของที่ระลึก" width="100">
                    @else
                    @endif
                </td>
                <td>{{ $s->description }}</td>
                <td>{{ $s->quantity_left }}</td>
                <td>{{ $s->souvenirs_status }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.S_approve', $s->souvenirs_id) }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-success">อนุมัติ</button>
                    </form>
                    <form method="POST" action="{{ route('admin.S_reject', $s->souvenirs_id) }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">ปฏิเสธ</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
