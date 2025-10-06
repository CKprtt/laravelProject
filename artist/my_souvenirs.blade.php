@extends('artist_nav')

@section('title', 'คำร้องของฉัน')

@section('content')
    {{-- ตารางติดตามสถานะคำร้องของที่ระลึก --}}
    <h2 class="mt-5">ติดตามสถานะแจกของที่ระลึก</h2>
    <table class="table table-bordered text-center align-middle">
        <thead class="table-secondary">
            <tr>
                <th>ชื่อของที่ระลึก</th>
                <th>รูปภาพที่อัปโหลด</th>
                <th>จำนวน</th>
                <th>รายละเอียด</th>
                <th>สถานะ</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($souvenirs as $s)
                <tr>
                    <td>{{ $s->souvenirs_name }}</td>
                    <td>
                        @if ($s->image_path)
                            <a href="{{ $s->image_path }}" target="_blank">
                                <img src="{{ $s->image_path }}" alt="รูปของที่ระลึก" width="100" class="rounded shadow-sm">
                            </a>
                        @endif
                    </td>
                    <td>{{ $s->quantity_left }}</td>
                    <td>{{ $s->description }}</td>
                    <td>
                        @if ($s->souvenirs_status === 'approved')
                            <span class="badge bg-success">อนุมัติแล้ว</span>
                        @elseif ($s->souvenirs_status === 'rejected')
                            <span class="badge bg-danger">ไม่อนุมัติ</span>
                        @else
                            <span class="badge bg-warning text-dark">รอดำเนินการ</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            {{-- ปุ่มแก้ไข --}}
                            @if ($s->souvenirs_status === 'approved')
                                <button class="btn btn-secondary btn-sm" disabled>แก้ไข</button>
                            @else
                                <a href="{{ route('artist.S_edit', $s->souvenirs_id) }}"
                                    class="btn btn-warning btn-sm">แก้ไข</a>
                            @endif

                            {{-- ปุ่มลบ --}}
                            <form action="{{ route('artist.S_destroy', $s->souvenirs_id) }}" method="POST"
                                onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบคำร้องนี้?')">
                                @csrf
                                @method('DELETE')
                                @if ($s->souvenirs_status === 'approved')
                                    <button class="btn btn-secondary btn-sm" disabled>ลบ</button>
                                @else
                                    <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                @endif
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
