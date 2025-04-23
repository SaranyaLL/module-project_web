<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">

        .center
        {
            margin:auto;
            width:50%;
            border:2px solid white;
            text-align:center;
            margin-top:4
        }
        .font_size
        {
          text-align: center;
          font-size:40px;
          padding-top:20px;
        }
        .img_size
        {
          width:150px;
          height:150px;
        }
        .th_color
        {
          background:#78ab9d;
        }
        .th_deg
        {
          padding: 30px;
        }
</style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
@include('admin.sidebars')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
             
            @if(session()->has('message'))
            <div class="alert alert-success">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif



            
            <h2 class="font_size">All Products<h2>
            <table class="center">
                <tr class="th_color">
                   <th class="th_deg">Title</th>
                   <th class="th_deg">Description</th>
                   <th class="th_deg">Price</th>
                   <th class="th_deg">Category</th>
                   <th class="th_deg">Quantity</th>
                   <th class="th_deg">Product image</th>
                   <th class="th_deg">Delete</th>
                   <th class="th_deg">Edit</th>
                </tr>

                @foreach($product as $product)

                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                    <img class="img_size"src="/product/{{$product->image}}">
                    </td>
                    <td>
                      <a class="btn btn-danger" onclick="return confirm('Are You Sure to Delete this')"href="{{url('delete_product',$product->id)}}">Delete</a>
                    </td>
                    <td>
                      <a class="btn btn-success" href="{{url('update_product',$product->id)}}">Edit</a>
                    </td>
                </tr>
                 
                @endforeach

            </table>
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
  
</html>