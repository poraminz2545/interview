<?php $__env->startSection('content'); ?>
    <?php if(session('error')): ?>
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: "<?php echo e(session('error')); ?>",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>
    <?php endif; ?>
    <?php if(session('success')): ?>
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: "<?php echo e(session('success')); ?>",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>
    <div class="container my-5">
        <form action="<?php echo e(route('regis_data')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Positon</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="position">
                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phonenumber">
                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Type Holiday</label>
                <select class="form-select" aria-label="Type Holiday" name="type_holiday">
                    <option value="0" selected>อื่นๆ</option>
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
                <label for="datePickerFrom" class="form-label">From</label>
                <input id="datepicker" width="276" name="from"/>
                <script>
                    $('#datepicker').datepicker({
                        uiLibrary: 'bootstrap5'
                    });
                </script>
                <label for="datePickerFrom" class="form-label">To</label>
                <input id="datepicker2" width="276" name="to"/>
                <script>
                    $('#datepicker2').datepicker({
                        uiLibrary: 'bootstrap5'
                    });
                </script>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\interview\holiday\resources\views/holiday_request_form.blade.php ENDPATH**/ ?>