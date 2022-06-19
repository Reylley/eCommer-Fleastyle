<?php

include("connection.php");


function getProducts() {
    $conn = Connection();

    if (!isset($_GET['category'])) {
        if(!isset($_GET['brand'])){

        $select_query = "SELECT * FROM `products` order by rand()";
        $res_query = mysqli_query($conn, $select_query);
        // $row = mysqli_fetch_assoc($res_query);
        // echo $row['product_title'];

        while ($row= mysqli_fetch_assoc($res_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_des = $row['product_description'];
            $product_keyword = $row['product_keyword'];
            $product_img1 = $row['product_image1'];
            $product_img2 = $row['product_image2'];
            $product_img3 = $row['product_image3'];
            $product_price = $row['product_price'];

            echo "<div class='card m-3 text-center' style='width: 15rem;'>
      <img src='./admin/storage/$product_img1' class='card-img-top' alt=''>
      <div class='card-body'>
          <h5 class='card-title bg-info rounded-3 p-2'>$product_title </h5>
          <p>₱ $product_price</p>
          <a href='product.php?add_to_cart=$product_id' class='btn btn-warning m-2'><i class='fa-solid fa-cart-plus'></i> Add to Cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-buy m-2 text-white'><i class='fa-solid fa-eye'></i> View move</a>
      </div>
  </div>";
        }
        
    }
}
}


// Get unique categories

function getUniqueCategories() {
    $conn = Connection();

    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM `products` where category_id=$category_id";
        $res_query = mysqli_query($conn, $select_query);
        $num_rows = mysqli_num_rows($res_query);
        if ($num_rows==0) {
            echo"<h2 class='text-center bg-white text-warning my-4 rounded-3 p-4'>No product in this category!</h2";
        }
        // $row = mysqli_fetch_assoc($res_query);
        // echo $row['product_title'];

        while ($row= mysqli_fetch_assoc($res_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_des = $row['product_description'];
            $product_keyword = $row['product_keyword'];
            $product_img1 = $row['product_image1'];
            $product_img2 = $row['product_image2'];
            $product_img3 = $row['product_image3'];
            $product_price = $row['product_price'];

            echo "<div class='card m-3 text-center' style='width: 15rem;'>
      <img src='./admin/storage/$product_img1' class='card-img-top' alt=''>
      <div class='card-body'>
          <h5 class='card-title bg-info rounded-3 p-2'>$product_title </h5>
          <p>₱ $product_price</p>
          <a href='product.php?add_to_cart=$product_id' class='btn btn-warning m-2'><i class='fa-solid fa-cart-plus'></i> Add to Cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-buy m-2 text-white'><i class='fa-solid fa-eye'></i> View move</a>
      </div>
  </div>";
        }
    }
}
function getUniqueBrands() {
    $conn = Connection();

    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "SELECT * FROM `products` where brand_id=$brand_id";
        $res_query = mysqli_query($conn, $select_query);
        $num_rows = mysqli_num_rows($res_query);
        if($num_rows==0){
            echo"<h2 class='text-center bg-white text-warning my-4 rounded-3 p-4'>No product in this Brand yet!!</h2";
        }
        // $row = mysqli_fetch_assoc($res_query);
        // echo $row['product_title'];

        while ($row= mysqli_fetch_assoc($res_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_des = $row['product_description'];
            $product_keyword = $row['product_keyword'];
            $product_img1 = $row['product_image1'];
            $product_img2 = $row['product_image2'];
            $product_img3 = $row['product_image3'];
            $product_price = $row['product_price'];

            echo "<div class='card m-3 text-center' style='width: 15rem;'>
      <img src='./admin/storage/$product_img1' class='card-img-top' alt=''>
      <div class='card-body'>
          <h5 class='card-title bg-info rounded-3 p-2'>$product_title </h5>
          <p>₱ $product_price</p>
          <a href='product.php?add_to_cart=$product_id' class='btn btn-warning m-2'><i class='fa-solid fa-cart-plus'></i> Add to Cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-buy m-2 text-white'><i class='fa-solid fa-eye'></i> View move</a>
      </div>
  </div>";
        }
       
}



}
function getCategory() {
    $conn = Connection();
    $collect = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $collect);
                        // $row = mysqli_fetch_assoc($result);
                        // echo $row['category_title'];

    while ($row=mysqli_fetch_assoc($result)) {
        $cat_title = $row['category_title'];
        $cat_id = $row['category_id'];

        echo "<li class='nav-item text-center'>
        <a href='product.php?category=$cat_id' class='nav-link text-center bg-dark rounded-3 text-white m-3'>$cat_title</a>
        </li>";
    }
}

function getBrands() {
    $conn = Connection();
    $collect = "SELECT * FROM `brands`";
    $result = mysqli_query($conn, $collect);
                        // $row = mysqli_fetch_assoc($result);
                        // echo $row['category_title'];

    while($row=mysqli_fetch_assoc($result)){
    $brand_title = $row['brand_title'];
    $brand_id = $row['brand_id'];

    echo "<li class='nav-item text-center'>
    <a href='product.php?brand=$brand_id' class='nav-link text-center bg-dark rounded-3 text-white m-3'>$brand_title</a>
    </li>";
    }
}


function ViewDetails() {
    $conn = Connection();
    if (isset($_GET['product_id'])) {
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $product_id=$_GET['product_id'];
            $select_query = "SELECT * FROM `products` WHERE product_id=$product_id";
            $res_query = mysqli_query($conn, $select_query);
            while ($row= mysqli_fetch_assoc($res_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_des = $row['product_description'];
                $product_keyword = $row['product_keyword'];
                $product_img1 = $row['product_image1'];
                $product_img2 = $row['product_image2'];
                $product_img3 = $row['product_image3'];
                $product_price = $row['product_price'];

                echo "<div class='row'>
                <div class='col-md-4'>
                <div class='card m-3 text-center' style='width: 15rem;'>
                    <img src='./admin/storage/$product_img1' class='card-img-top' alt='$product_img1'>
                    <div class='card-body'>
                        <h5 class='card-title bg-info rounded-3 p-2'>$product_title </h5>
                        <p class='bg-dark text-white p-2 rounded'>₱ $product_price</p>
                        <a href='product.php?add_to_cart=$product_id' class='btn btn-warning m-2'><i class='fa-solid fa-cart-plus'></i> Add to Cart</a>
            
                    </div>
                </div>
                </div>
                <div class='col-md-8'>
                            <h4 class='text-center text-white mb-5'>More images</h4>
                        </div>
                        <div class='col-md-6 p-3'>
                        <img src='./admin/storage/$product_img2' class='card-img-top' alt=''>
                        </div>
                        <div class='col-md-6 p-3'>
                        <img src='./admin/storage/$product_img3' class='card-img-top' alt=''>
                        </div>
                    </div>";
            }
        }
    }
}
}


function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  


function cart() {
    $conn = Connection();
    if(isset($_GET['add_to_cart'])){
        global $conn;

        $get_ip_add = getIPAddress();

        $get_product_id= $_GET['add_to_cart'];

        $select_query = "SELECT * FROM `cart_details` WHERE id_address=$get_ip_add and 
        product_id=$get_product_id";

        $res_query = mysqli_query($conn, $select_query);

        $num_rows=mysqli_num_rows($res_query);
        if($num_rows>0){
            echo"<script>alert('This item is already in you cart')</script";
            echo "<script>window.open('product.php', '_self')</script>";
        }else{
            $i_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($get_product_id, '$get_ip_add', 0)";
        }
    }
}
?>