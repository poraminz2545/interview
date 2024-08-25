@extends('layout.nav')
@section('content')
    @if(session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @elseif(session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @php
        $data = App\Http\Controllers\DataController::fetch_data();
    @endphp
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Type Holiday</th>
                <th scope="col">Reason</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $d)
                <tr>
                    <th scope="row">{{$d->id}}</th>
                    <td>{{$d->name}}</td>
                    <td>{{$d->position}}</td>
                    <td>{{$d->email}}</td>
                    <td>{{$d->phone_number}}</td>
                    <td>{{$d->type_holiday}}</td>
                    <td>{{$d->reason}}</td>
                    <td>{{$d->date_holiday_from}}</td>
                    <td>{{$d->date_holiday_to}}</td>
                    <td>
                        <form action="{{ route('update_status') }}" method="POST" id="editForm-{{ $d->id }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $d->id }}">
                            <input type="hidden" name="type_holiday" value="{{ $d->type_holiday }}">
                            <select name="status" class="form-select">
                                <option value="รอพิจารณา" {{ $d->status == 'รอพิจารณา' ? 'selected' : '' }}>รอพิจารณา</option>
                                <option value="อนุมัติ" {{ $d->status == 'อนุมัติ' ? 'selected' : '' }}>อนุมัติ</option>
                                <option value="ไม่อนุมัติ" {{ $d->status == 'ไม่อนุมัติ' ? 'selected' : '' }}>ไม่อนุมัติ</option>
                            </select>
                            <button type="button" class="btn btn-primary mt-2" onclick="confirmEdit('{{ $d->id }}')">Edit Status</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('delete_data') }}" method="POST" id="deleteForm-{{ $d->id }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $d->id }}">
                            <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $d->id }}')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    <script>

        function confirmEdit(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to update the status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editForm-' + id).submit();
                }
            });
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            });
        }
    </script>
@endsection
