<!DOCTYPE html>
<html lang="en">
  <head>

    <base href="/public">

    <?php echo $__env->make('admin.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style type="text/css">

     .div_center
     {
      text-align:center;
      padding-top:40px;
     }
     .font_size
     {
      font-size:40px;
      padding-bottom:40px;
     }
      .text_color
      {
        color:black;
        padding-bottom:20px;
      }
      label
      {
        display:inline-block;
        width:200px;
      }

      .div_design
      {
        padding-bottom:15px;
      }

</style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
<?php echo $__env->make('admin.sidebars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

            <?php if(session()->has('message')): ?>
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <?php echo e(session()->get('message')); ?>

                </div>
                <?php endif; ?>
              
            <div class="div_center">

            <h1 class="font_size">Update Product</h1>
        <div class="div_design">

        <form action="<?php echo e(url('update_product_confirm',$product->id)); ?>"method="POST" enctype="multipart/form-data">

        <?php echo csrf_field(); ?>
            <label>Product Title</label>
            <input class="text_color" type="text" name="title" placeholder="write a title" required="" value="<?php echo e($product->title); ?>">
        
          </div>

          <div class="div_design">

             <label>Description</label>
<input class="text_color" type="text" name="description" placeholder="write a description" required="" value="<?php echo e($product->description); ?>">

</div>

<div class="div_design">

<label>Product Price</label>
<input class="text_color" type="number" name="price" placeholder="Enter Price" required="" value="<?php echo e($product->price); ?>">

</div>

<div class="div_design">

<label>Product Quantity</label>
<input class="text_color" type="number" min="0" name="quantity" placeholder="write a  Quantity" required="" value="<?php echo e($product->quantity); ?>">

</div>
<div>

<label  class="div_design">Product Category:</label>
<select class="text_color" name="category" required="">
  <option value="<?php echo e($product->category); ?>" selected=""><?php echo e($product->category); ?></option>
  
  <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($category->category_name); ?>">
  <?php echo e($category->category_name); ?></option>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </select>
</div>

<div>

<label class="div_design">Current Product Image Here:</label>
<img style="margin:auto;"heigth="100" width="100" src="/product/<?php echo e($product->image); ?>">

</div>

<div>

<label class="div_design">Change Product Image Here:</label>
<input type="file" name="image" >

</div>
<div class="div_design">

<input type="Submit" value="Update product" class="btn btn-primary">

</div>
    </form>
    </div>
</div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="admin/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- inject:js -->
    <script src="admin/assets/js/off-canvas.js"></script>
    <script src="admin/assets/js/hoverable-collapse.js"></script>
    <script src="admin/assets/js/misc.js"></script>
    <script src="admin/assets/js/settings.js"></script>
    <script src="admin/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="admin/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
  
</html><?php /**PATH C:\laravel\wood furniture\wood\resources\views\admin\update_product.blade.php ENDPATH**/ ?>