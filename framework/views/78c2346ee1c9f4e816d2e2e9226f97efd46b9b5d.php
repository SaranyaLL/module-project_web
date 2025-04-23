<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .div_center
        {
             text-align:center;
             padding-top:40px;
        }

        .h2_font
        {
            font-size:40px;
            padding-bottom:10px;
        }
        tr{
            color:black;
        }
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    td {
        /* background-color: #ffffff; */
        color:#fff;
    }
/* 
    tr:hover {
        background-color: #f5f5f5;
    } */

    .action-buttons {
        display: flex;
        justify-content: center;
    }

    .action-buttons a {
        margin-right: 5px;
    }
    .table {
        width: 20em;
        margin-top: 32px;
    }
   .center
   {
    margin:auto;
    width:50%;
    text-align:center;
    margin-top:30px;
    border:3px solid white;
   }
</style>
</head>
<body>
    <div class="container-scroller">
        <!-- Sidebar and header code goes here -->
        <?php echo $__env->make('admin.sidebars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <div class="main-panel">
            <div class="content-wrapper">
            <?php if(session()->has('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session()->get('message')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

                <div class="div_center">
                    <div id="message"></div>

                    <h2 class="h2_font" style="color:white;">Add Category</h2>
                    <form id="addCategoryForm">
                        <?php echo csrf_field(); ?>
                        <input class="input_color" type="text" id="categoryInput" placeholder="Write Category name">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            
                    <table class="table table-striped">
                    <table class="center">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($category->category_name); ?></td>
                                <td>
                                    <a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger" href="<?php echo e(url('delete_category', $category->id)); ?>">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="admin/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('addCategoryForm').addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent default form submission
                
                // Get category value from input
                var category = document.getElementById('categoryInput').value;

                // Construct the JSON object
                var data = {
                    category: category
                };

                // Send a POST request to the API endpoint
                fetch('<?php echo e(url('/add_category')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' // Include CSRF token for Laravel
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    // Check if the response status is success
                    if (data.status === 'success') {
                        // Show success message
                        alert('Category added successfully');
                        window.location.reload();
                    } else {
                        // Show error message
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>

<script>
    // Automatically close the alert after 3 seconds (3000 milliseconds)
    window.setTimeout(function() {
        $(".alert").alert('close');
    }, 3000);
</script>




</body>
</html>


<?php /**PATH C:\laravel\wood furniture\wood\resources\views\admin\category.blade.php ENDPATH**/ ?>