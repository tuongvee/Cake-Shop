<!-- Khai báo sử dụng layout admin -->
@extends('admin.layout.index')

<!-- Khai báo định nghĩa phần main-container trong layout admin-->
@section('main-container')
<!-- Page Heading -->
<div class="mb-3">
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-primary font-weight-bold">Tạo Mới</h1>
    <h5><a class="text-primary mb-5" href="{{url('admin/user/list')}}">Người dùng</a>  / Tạo Mới</h5>
</div>
<!-- Page Body -->
<div class="card">
    <div class="card-body">
        <!-- Content Row -->
        <form class="conatainer" action="{{ asset('admin/user/create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-between">

                {{-- nửa form bên trái --}}
                <div class="col-md-5">
                    <h4 class="mb-5">Thông tin</h4>

                    <!-- tên -->
                    <div class="form-group row">
                        <label for="user_name" class="col-md-3 col-form-label">Tên</label>
                        <div class="col-sm-8">
                            <input type="text" name="user_name" class="form-control" id="user_name"
                                placeholder="Nhập tên" pattern=".{5,40}" title="Tối thiểu 5 ký tự và tối đa 40 ký tự" required />
                        </div>
                    </div>

                    <!-- điện thoại -->
                    <div class="form-group row">
                        <label for="user_phone" class="col-md-3 col-form-label">Điện thoại</label>
                        <div class="col-sm-8">
                            <input type="number" name="user_phone" class="form-control" id="user_phone"
                                placeholder="Nhập điện thoại" pattern=".{10,15}" title="Tối thiểu 10 ký tự và tối đa 15 ký tự" required />
                        </div>
                    </div>

                    <!-- loại người dùng -->
                    <div class="form-group row">
                        <label for="user_permission" class="col-md-3 col-form-label">Quyền người dùng</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="user_permission" id="user_permission">
                                <option value="1">Nhân viên</option>
                                <option value="2">Quản trị</option>
                            </select>
                        </div>
                    </div>

                    <!-- ảnh -->
                    <div class="form-group row">
                        <label for="user_image" class="col-md-3 col-form-label">Ảnh đại diện</label>
                        <div class="col-sm-8">
                            <input type="file" name="user_image" class="form-control mb-3 p-1" accept="image/*" id="user_image"
                                required>
                            <img id="output" src="{{ asset('images/default.png')}}" width="300" style="border:2px solid #000; border-radius: 5px;"/>
                        </div>
                    </div>

                </div>
                {{-- nửa form bên phải --}}
                <div class="col-md-5">
                    <h4 class="mb-5">Tài khoản</h4>

                    <!-- email -->
                    <div class="form-group row">
                        <label for="user_email" class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-8">
                            <input type="email" name="user_email" class="form-control" id="user_email"
                                placeholder="Nhập email" pattern=".{10,50}" title="Tối thiểu 10 ký tự và tối đa 50 ký tự" required />
                        </div>
                    </div>

                    <!-- mật khẩu -->
                    <div class="form-group row">
                        <label for="user_password" class="col-md-3 col-form-label">Mật khẩu</label>
                        <div class="col-md-8">
                            <input type="password" name="user_password" class="form-control" id="user_password" placeholder="Nhập mật khẩu" pattern=".{6,30}" title="Tối thiểu 6 ký tự và tối đa 30 ký tự" required />
                        </div>
                    </div>

                </div>
            </div>

            <!-- submit -->
            <div class="row d-flex justify-content-center">
                <button class="btn btn-success mr-3" type="submit">Lưu</button>
                <a href="{{ url('admin/user/list') }}" class="btn btn-secondary">Hủy</a>
            </div>

        </form>

        <!-- errors -->
        <div class="row">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                {{$error}}<br>
                @endforeach
            </div>
            @endif
        </div>
        <!-- end card body -->
    </div>
    <!-- kết thúc main-container -->
    @endsection @section('script')
    <script>
        // Kiểm tra biến errors từ server gửi về. Nếu có lỗi xuất popup thông báo
        @if (count($errors) > 0)
            Swal.fire({
                title: 'Thất Bại',
                text: 'Vui lòng kiểm tra lại thông tin',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        @endif

        // Kiểm tra biến result
        @if (isset($result))
            @if ($result == "fail")
            Swal.fire({
                title: 'Thất Bại',
                text: "{{ $message }}",
                icon: 'error',
                confirmButtonText: 'OK'
            })
        @endif
        @endif

        // Hiển thị ảnh upload
        let image_input_DOM = document.querySelector("#user_image");
        image_input_DOM.addEventListener("input", () => {
            let reader = new FileReader();
            let output = document.querySelector("#output");

            reader.onload = (e) => {
                console.log(e.target);
                console.log(output);
                output.src = e.target.result;
            };

            reader.readAsDataURL(image_input_DOM.files[0]);
        });
    </script>
    @endsection