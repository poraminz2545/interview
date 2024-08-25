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
    <?php elseif(session('success')): ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: "<?php echo e(session('success')); ?>",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>
    <?php
        $data = App\Http\Controllers\DataController::fetch_data();
    ?>
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
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($d->id); ?></th>
                    <td><?php echo e($d->name); ?></td>
                    <td><?php echo e($d->position); ?></td>
                    <td><?php echo e($d->email); ?></td>
                    <td><?php echo e($d->phone_number); ?></td>
                    <td><?php echo e($d->type_holiday); ?></td>
                    <td><?php echo e($d->reason); ?></td>
                    <td><?php echo e($d->date_holiday_from); ?></td>
                    <td><?php echo e($d->date_holiday_to); ?></td>
                    <td>
                        <form action="<?php echo e(route('update_status')); ?>" method="POST" id="editForm-<?php echo e($d->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($d->id); ?>">
                            <input type="hidden" name="type_holiday" value="<?php echo e($d->type_holiday); ?>">
                            <select name="status" class="form-select">
                                <option value="รอพิจารณา" <?php echo e($d->status == 'รอพิจารณา' ? 'selected' : ''); ?>>รอพิจารณา</option>
                                <option value="อนุมัติ" <?php echo e($d->status == 'อนุมัติ' ? 'selected' : ''); ?>>อนุมัติ</option>
                                <option value="ไม่อนุมัติ" <?php echo e($d->status == 'ไม่อนุมัติ' ? 'selected' : ''); ?>>ไม่อนุมัติ</option>
                            </select>
                            <button type="button" class="btn btn-primary mt-2" onclick="confirmEdit('<?php echo e($d->id); ?>')">Edit Status</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo e(route('delete_data')); ?>" method="POST" id="deleteForm-<?php echo e($d->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($d->id); ?>">
                            <button type="button" class="btn btn-danger" onclick="confirmDelete('<?php echo e($d->id); ?>')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\interview\holiday\resources\views/alldata.blade.php ENDPATH**/ ?>