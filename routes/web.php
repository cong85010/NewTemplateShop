<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//FrontEnd
Route::get('/','HomeController@index');
Route::get('/trangchu','HomeController@index');
Route::post('/search','HomeController@search')->name('search');
Route::post('/search-pro-admin','ProductController@search_pro_admin')->name('search_pro_admin');
Route::post('/search-cate-admin','CategoryProduct@search_cate_admin')->name('search_cate_admin');
Route::post('/search-brand-admin','BrandProduct@search_brand_admin')->name('search_brand_admin');
Route::get('/admin','AdminController@index')->name('login');
Route::get('/logout','AdminController@logout');
Route::post('/login','AdminController@handleLogin')->name('handle-login');  


//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home')->name('show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home')->name('show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@details_product')->name('details_product');



Route::group(['middleware' => 'CheckLogin'],function(){
	//BackEnd
//thong ke
Route::get('/admin-dashboard','AdminController@show_dashboard')->name('admin-home');  
Route::post('/filter-by-date','AdminController@filter_by_date')->name('filter_by_date');
Route::post('/dashboard-filter','AdminController@dashboard_filter')->name('dashboard_filter');
Route::post('/day-order-30','AdminController@day_order_30')->name('day_order_30');

Route::get('/admin/dashboard','AdminController@dashboard')->name("dashboard");

Route::get('/admin/edit','AdminController@admin_edit')->name('admin_edit');

//Category-Product
Route::get('/add-category-product','CategoryProduct@add_category_product')->name('add_category');
Route::get('/edit-category-product/{id_edit}','CategoryProduct@edit_category_product')->name('edit_category');
Route::get('/delete-category-product/{id_delete}','CategoryProduct@delete_category_product')->name('delete_category');
Route::get('/all-category-product','CategoryProduct@all_category_product')->name('all_category');
Route::post('/save-category','CategoryProduct@save_category_product')->name('save_category');
Route::post('/update-category-product/{id_update}','CategoryProduct@update_category_product')->name('update_category');
Route::post('/import-csv','CategoryProduct@import_csv')->name('import_csv');
Route::post('/export-csv','CategoryProduct@export_csv')->name('export_csv');
 
//Brand Product
 Route::get('/all-brand','BrandProduct@all_brand')->name('all_brand');
 Route::get('/add-brand','BrandProduct@add_brand')->name('add_brand');
 Route::post('/save-brand','BrandProduct@save_brand_product')->name('save_brand');
 Route::get('/edit-brand/{id_edit}','BrandProduct@edit_brand')->name('edit_brand');
 Route::post('/update-brand/{id_update}','BrandProduct@update_brand')->name('update_brand');
 Route::get('/delete-brand/{id_delete}','BrandProduct@delete_brand')->name('delete_brand');

 //Product
 Route::get('/all-product','ProductController@all_product')->name('all_product');
 Route::get('/add-product','ProductController@add_product')->name('add_product');
 Route::post('/save-product','ProductController@save_product')->name('save_product');
 Route::get('/edit-product/{id_edit}','ProductController@edit_product')->name('edit_product');
 Route::post('/update-product/{id_update}','ProductController@update_product')->name('update_product');
 Route::get('/delete-product/{id_delete}','ProductController@delete_product')->name('delete_product');
 Route::post('/import-csv-product','ProductController@import_csv_product')->name('import_csv_product');
 Route::post('/export-csv-product','ProductController@export_csv_product')->name('export_csv_product');

//Active - unactive
 Route::get('/active-brand/{id_active}','BrandProduct@active_brand')->name('active_brand');
 Route::get('/unactive-brand/{id_unactive}','BrandProduct@unactive_brand')->name('unactive_brand'); 
 Route::get('/active-category/{id_active}','CategoryProduct@active_category')->name('active_category');
 Route::get('/unactive-category/{id_unactive}','CategoryProduct@unactive_category')->name('unactive_category');
 Route::get('/active-product/{id_active}','ProductController@active_product')->name('active_product');
 Route::get('/unactive-product/{id_unactive}','ProductController@unactive_product')->name('unactive_product');


 //Admin Profile
 Route::get('/profile_admin/{id_admin}','Profile_Admin@profile_admin')->name('profile_admin');
 Route::get('/update_admin/{id_admin}','Profile_Admin@update_admin')->name('update_admin');

 //BANNER
  Route::get('/manage-slider','SliderController@manage_slider')->name('manage_slider');
  Route::get('/add-slider','SliderController@add_slider')->name('add_slider');
  Route::post('/insert-slider','SliderController@insert_slider')->name('insert_slider');
  Route::get('/active-slide/{slide_id}','SliderController@active_slide')->name('active_slide');
  Route::get('/unactive-slide/{slide_id}','SliderController@unactive_slide')->name('unactive_slide');
  Route::get('/delete-slide/{slide_id}','SliderController@delete_slide')->name('delete_slide');

  //Mange order
  Route::get('/view-order/{order_code}','OrderController@view_order')->name('view_order');
  Route::get('/manage-order','OrderController@manage_order')->name('manage_order');
  
  Route::post('/update-order-qty','OrderController@update_order_qty')->name('update_order_qty');
  Route::post('/update-qty','OrderController@update_qty')->name('update_qty');

  //COUPON-CART
 

  Route::get('/insert-coupon','CouponController@insert_coupon')->name('insert_coupon');
  Route::get('/list-coupon','CouponController@list_coupon')->name('list_coupon');
  Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon')->name('delete_coupon');
  Route::post('/insert-coupon-code','CouponController@insert_coupon_code')->name('insert_coupon_code');

  //GALLERY IMAGE PRODUCT
  Route::get('/add-gallery/{product_id}','GalleryController@add_gallery')->name('add_gallery');
  Route::POST('/select-gallery','GalleryController@select_gallery')->name('select_gallery');
  Route::POST('/insert-gallery/{pro_id}','GalleryController@insert_gallery')->name('insert_gallery');
  Route::POST('delete-gallery','GalleryController@delete_gallery')->name('delete_gallery');
  Route::POST('update-gallery','GalleryController@update_gallery')->name('update_gallery');
});
 Route::post('/check-coupon','CartController@check_coupon')->name('check_coupon');
 Route::get('/unset-coupon','CouponController@unset_coupon')->name('unset_coupon');


  //CHECK OUT
  Route::get('/login-checkout','CheckoutController@login_checkout')->name('login_checkout');
  Route::get('/logout-checkout','CheckoutController@logout_checkout')->name('logout_checkout');
  Route::post('/add-customer','CheckoutController@add_customer')->name('add_customer');
  Route::get('/show-checkout','CheckoutController@checkout')->name('checkout');
  Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer')->name('save_checkout_customer');
  Route::post('/login-customer','CheckoutController@login_customer')->name('login_customer');
  Route::get('/payment','CheckoutController@payment')->name('payment');
  Route::post('/order','CheckoutController@order')->name('order');
  Route::post('/confirm-order','CheckoutController@confirm_order')->name('confirm_order');
  Route::get('/finish-order','CheckoutController@finish_order')->name('finish_order');
  Route::get('/print-order/{checkout_code}','OrderController@print_order')->name('print_order');
  Route::get('/profile-customer/{customer_id}','CheckoutController@profile_customer')->name('profile_customer');
  Route::POST('/update-customer/{customer_id}','CheckoutController@update_customer')->name('update_customer');

  

  Route::group(['middleware' => 'CheckLoginCustomer'],function()
  {
    //CART
  Route::post('/save-cart','CartController@save_cart')->name('save_cart');
  Route::get('/show-cart','CartController@show_cart')->name('show_cart');
  Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart')->name('delete_to_cart');
  Route::post('/update-cart-qty','CartController@update_cart_qty')->name('update_cart_qty');
  Route::post('/add-cart-ajax','CartController@add_cart_ajax')->name('add_cart_ajax');
  Route::get('/show-cart-ajax','CartController@show_cart_ajax')->name('show_cart_ajax');
  Route::post('/update-cart','CartController@update_cart')->name('update_cart');
  Route::get('/delete-product-cart/{session_id}','CartController@delete_product_cart')->name('delete_product');
  Route::get('/delete-all-cart','CartController@delete_all_cart')->name('delete_all_cart');
  });

  //history cart
  Route::get('/history','OrderController@history')->name('history');
  Route::get('/view-history-order/{order_code}','OrderController@view_history_order')->name('view_history_order');

  //quen mat khau - send mail
  // Route::get('/send-mail','AdminController@send_mail')->name('send_mail');
  Route::get('/quen-mat-khau','CheckoutController@quen_mat_khau')->name('quen_mat_khau');
  Route::post('/reset-pass','CheckoutController@reset_pass')->name('reset_pass');
  Route::get('/update-new-pass','CheckoutController@update_new_pass')->name('update_new_pass');
  Route::post('/reset-new-pass','CheckoutController@reset_new_pass')->name('reset_new_pass');
  Route::get('/quen-mat-khau-ad','AdminController@quen_mat_khau_ad')->name('quen_mat_khau_ad');
  Route::post('/reset-pass-ad','AdminController@reset_pass_ad')->name('reset_pass_ad');
  Route::get('/update-new-pass-ad','AdminController@update_new_pass_ad')->name('update_new_pass_ad');
  Route::post('/reset-new-pass-ad','AdminController@reset_new_pass_ad')->name('reset_new_pass_ad');

  
 
   