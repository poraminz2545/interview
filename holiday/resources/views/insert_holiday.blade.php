@extends('layout.nav')
@section('content')
    <div class="container my-5">
        <form action="{{route('regis_data')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="name">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Positon</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="position">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="email">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="phonenumber">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Type Holiday</label>
                <select class="form-select" aria-label="Type Holiday" name="type_holiday">
                    <option value="0" selected="">อื่นๆ</option>
                    <option value="1">ลาป่วย</option>
                    <option value="2">ลากิจ</option>
                    <option value="3">พักร้อน</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="reason"></textarea>
                    <label for="floatingTextarea">Reason</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="datePickerTo" class="form-label">To</label>
                <input id="datepicker" name="from" width="276" />
                <script>
                    $('#datepicker').datepicker({
                        uiLibrary: 'bootstrap5'
                    });
                </script>
            </div>
            <div class="mb-3">
                <label for="datePickerTo" class="form-label">To</label>
                <input id="datepicker2" name="to" width="276" />
                <script>
                    $('#datepicker2').datepicker({
                        uiLibrary: 'bootstrap5'
                    });
                </script>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
