<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserGroupController;
use App\Http\Controllers\admin\CollectionController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\WishlistsController;
use App\Http\Controllers\admin\ContactInquiriesController;
use App\Http\Controllers\admin\CatalogRequestsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/clear-all-cache', function () {
    Cache::forget('Collections');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    //Artisan::call('storage:link');
    return 'All caches cleared successfully!';
});

Route::get('/home-demo', [FrontController::class, 'indexnewdemo'])->name('home-demo');
Route::get('/login', [FrontController::class, 'login'])->name('login');

Route::get('/forget-password', [FrontController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget-password', [FrontController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [FrontController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [FrontController::class, 'resetPasswordPost'])->name('reset.password.post');



Route::middleware('auth')->group(function () {
    
    Route::get('/email/verify', [FrontController::class, 'verifyNotice'])->name('verification.notice');
    // email verification notice route
    Route::get('/email/verify/{id}/{hash}', [FrontController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', [FrontController::class, 'verifyHandler'])->middleware(['throttle:6,1'])->name('verification.send');
    
    
});






Route::get('/MyAccount', [FrontController::class, 'MyAccount'])->middleware('verified')->name('my_account');
Route::get('/AddressBook', [FrontController::class, 'AddressBook'])->name('address_book');
Route::get('/AccountInformation', [FrontController::class, 'AccountInformation'])->name('account_information');
Route::post('/updateuserinfo', [FrontController::class, 'updateUserInfo'])->name('update.user.info');
Route::get('/AccountInformation/Edit/{id}', [FrontController::class, 'EditAccountInformation'])->name('edit_account_information');
Route::post('/updateaddressbook', [FrontController::class, 'updateAddressBook'])->name('updateaddressbook');

Route::get('/add-to-wishlist/{id}', [WishlistController::class, 'addToWishlist'])->name('add_to_wishlist');
Route::get('/MyWishlist', [WishlistController::class, 'Wishlist'])->name('wishlist');
Route::get('/MyWishlistHistory', [WishlistController::class, 'MyWishlistHistory'])->name('wishlist_history');
Route::get('delete/wishlist-item/{id}', [WishlistController::class, 'deleteWishlistItem'])->name('delete.wishlist_item');
Route::post('/submit-wishlist', [WishlistController::class, 'submitWishlist'])->name('wishlist.submit');
Route::post('/update-wishlist', [WishlistController::class, 'updateWishlist'])->name('wishlist.update');
Route::get('/MyWishlistHistory/Details/{name}', [WishlistController::class, 'WishlistDetails'])->name('wishlist.details');




Route::post('/login-post', [FrontController::class, 'loginPost'])->name('login.post');
Route::get('/register', [FrontController::class, 'register'])->name('register');
Route::post('/register-post', [FrontController::class, 'registerPost'])->name('register.post');
Route::get('/shop/{slug}', [FrontController::class, 'productDetails'])->name('product.details');
Route::get('/shop', [FrontController::class, 'all_productDetails'])->name('all_product.details');
Route::get('/search', [FrontController::class, 'search'])->name('products.search');

Route::post('/filter-products', [FrontController::class, 'filterProducts'])->name('get_filter_product');
Route::post('/Newsletter', [FrontController::class, 'newsletter'])->name('newsletter');

Route::get('/reload-captcha', [FrontController::class, 'reloadCaptcha'])->name('reload-captcha');
Route::post('/submit-contact-form', [FrontController::class, 'submitContactForm'])->name('submit.contact.form');
Route::post('/submit-catalog-form', [FrontController::class, 'submitCatalogRequest'])->name('submit.catalog.form');




Route::get('/admin', [AuthController::class, 'index'])->name('admin');
// Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('admin-login', [AuthController::class, 'adminLogin'])->name('admin_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/404', [FrontController::class, 'error_404'])->name('not_found');

Route::get('state-by-country/{id}', [UserController::class, 'stateByCountry'])->name('stateByCountry');

Route::middleware('auth', 'role:admin')->group(function () {

    //Dashboard
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //Setting
    Route::get('admin/settings', [SettingController::class, 'settings'])->name('settings');
    Route::get('admin/general-settings', [SettingController::class, 'settings'])->name('general.setting');
    Route::post('admin/save-general-setting', [SettingController::class, 'save_general_setting'])->name('save_general_settings');
    Route::get('admin/company-settings', [SettingController::class, 'company_settings'])->name('company.setting');
    Route::post('admin/save-company-setting', [SettingController::class, 'save_company_setting'])->name('save_company_settings');
    Route::get('admin/email-settings', [SettingController::class, 'email_settings'])->name('email.setting');
    Route::post('admin/save-email-setting', [SettingController::class, 'save_email_setting'])->name('save_email_settings');

    //Logs
    Route::get('admin/logs', [AdminController::class, 'logs'])->name('admin.logs');

    //Profile
    Route::get('admin/profile/edit-profile', [AdminController::class, 'edit_profile'])->name('edit.profile');
    Route::post('admin/save-profile', [ProfileController::class, 'save_profile'])->name('save.profile');
    Route::get('admin/profile/view-profile', [AdminController::class, 'view_profile'])->name('view.profile');

    Route::post('change-password', [ProfileController::class, 'change_password'])->name('admin.change.password');

    //User
    Route::get('admin/customer', [UserController::class, 'users'])->name('admin.users');
    Route::get('admin/add-customer', [UserController::class, 'addUser'])->name('admin.add.user');
    Route::post('admin/add-customer-data', [UserController::class, 'addUserData'])->name('admin.add.user.data');
    Route::get('admin/edit-customer/{id}', [UserController::class, 'editUser'])->name('admin.edit.user');
    Route::post('admin/update-customer', [UserController::class, 'updateUser'])->name('admin.update.users');
    Route::get('delete/customer/{id}', [UserController::class, 'deleteUser'])->name('delete.user');

    //User Group
    Route::get('admin/customer-groups', [UserGroupController::class, 'userGroups'])->name('admin.user.groups');
    Route::get('admin/add-customer-groups', [UserGroupController::class, 'addUserGroup'])->name('admin.add.group');
    Route::post('admin/add-customergroup-data', [UserGroupController::class, 'addUserGroupData'])->name('admin.add.usergroup.data');
    Route::get('delete/customer-group/{id}', [UserGroupController::class, 'deleteGroup'])->name('delete.group');
    Route::get('admin/edit-customer-group/{id}', [UserGroupController::class, 'editGroup'])->name('admin.edit.group');
    Route::post('admin/update-customer-group', [UserGroupController::class, 'updateGroup'])->name('admin.update.user');

    // Collection
    Route::get('admin/collections', [CollectionController::class, 'collections'])->name('admin.collections');
    Route::get('admin/add-collection', [CollectionController::class, 'addCollection'])->name('admin.add.collection');
    Route::post('admin/add-collection-data', [CollectionController::class, 'addCollectionData'])->name('admin.add.collection.data');
    Route::get('admin/edit-collection/{id}', [CollectionController::class, 'editCollection'])->name('admin.edit.collection');
    Route::post('admin/update-collection', [CollectionController::class, 'updateCollection'])->name('admin.update.collection');
    Route::get('delete/collection/{id}', [CollectionController::class, 'deleteCollection'])->name('delete.collection');

    //Categories
    Route::get('admin/categories', [CategoryController::class, 'categories'])->name('admin.categories');
    Route::post('admin/add_category_data', [CategoryController::class, 'addCategoryData'])->name('admin.add_category_data');
    Route::get('admin/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('admin.edit_category');
    Route::post('admin/update-category', [CategoryController::class, 'updateCategory'])->name('admin.edit.category');
    Route::get('delete/category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');

    //Products
    Route::get('admin/products', [ProductController::class, 'products'])->name('admin.products');
    Route::get('admin/add-product', [ProductController::class, 'addProduct'])->name('admin.add_product');
    Route::post('admin/add-product-data', [ProductController::class, 'addProductData'])->name('admin.add.product.data');
    Route::get('admin/edit-product/{id}', [ProductController::class, 'editProduct'])->name('admin.edit_product');
    Route::post('admin/update-product', [ProductController::class, 'updateProduct'])->name('admin.update.product');
    Route::get('delete/product/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');
    Route::POST('bulk-product-import', [ProductController::class, 'importExcel'])->name('bulk-product-import');

    // Events
    Route::get('admin/events', [EventController::class, 'events'])->name('admin.events');
    Route::get('admin/add-event', [EventController::class, 'addEvent'])->name('admin.add_event');
    Route::post('admin/add-event-data', [EventController::class, 'addEventData'])->name('admin.add.event.data');
    Route::get('admin/edit-event/{id}', [EventController::class, 'editEvent'])->name('admin.edit_event');
    Route::post('admin/update-event', [EventController::class, 'updateEvent'])->name('admin.update.event');
    Route::get('delete/event/{id}', [EventController::class, 'deleteEvent'])->name('delete.event');

    //Pages
    Route::get('admin/pages', [PagesController::class, 'pages'])->name('admin.pages');
    Route::get('admin/add-page', [PagesController::class, 'addPage'])->name('admin.add.page');
    Route::post('admin/add-page-data', [PagesController::class, 'addPageData'])->name('admin.add.page.data');
    Route::get('admin/edit-page/{id}', [PagesController::class, 'editPage'])->name('admin.edit_page');
    Route::get('delete/page/{id}', [PagesController::class, 'deletePage'])->name('delete.page');
    Route::post('admin/update-page', [PagesController::class, 'editPageData'])->name('admin.update.page');

    //Banner
    Route::get('admin/banners', [BannerController::class, 'banners'])->name('admin.banners');
    Route::get('admin/add-banner', [BannerController::class, 'addBanner'])->name('admin.add.banner');
    Route::post('admin/add-banner-data', [BannerController::class, 'addBannerData'])->name('admin.add.banner.data');
    Route::get('admin/edit-banner/{id}', [BannerController::class, 'editBanner'])->name('admin.edit_banner');
    Route::get('delete/banner/{id}', [BannerController::class, 'deleteBanner'])->name('delete.banner');
    Route::post('admin/update-banner', [BannerController::class, 'editBannerData'])->name('admin.update.banner');

    //Subscribers
    Route::get('admin/subscribers', [SubscriberController::class, 'subscribers'])->name('admin.subscribers');
    Route::get('admin/add-subscriber', [SubscriberController::class, 'addSubscriber'])->name('admin.add.subscriber');
    Route::post('admin/add-subscriber-data', [SubscriberController::class, 'addSubscriberData'])->name('admin.add.subscriber.data');
    Route::get('admin/edit-subscriber/{id}', [SubscriberController::class, 'editSubscriber'])->name('admin.edit_subscriber');
    Route::post('admin/update-subscriber', [SubscriberController::class, 'editSubscriberData'])->name('admin.update.subscriber');
    Route::get('delete/subscriber/{id}', [SubscriberController::class, 'deleteSubscriber'])->name('delete.subscriber');

    //Subscribers
    Route::get('admin/wishlist', [WishlistsController::class, 'wishlists'])->name('admin.wishlists');
    Route::get('admin/view-wishlist/{id}', [WishlistsController::class, 'wishlistView'])->name('admin.view_wishlist');

    //Contact Inquiries
    Route::get('admin/contact-inquiries', [ContactInquiriesController::class, 'contactInquiries'])->name('admin.contact.inquiries');
    Route::get('admin/view-contact-inquiry/{id}', [ContactInquiriesController::class, 'contactInquiriesView'])->name('admin.view.contact.inquiries');

    //Catalog Requests
    Route::get('admin/catalog-requests', [CatalogRequestsController::class, 'catalogRequests'])->name('admin.catalog.requests');
    Route::get('admin/catalog-request-detail/{id}', [CatalogRequestsController::class, 'catalogRequestsView'])->name('admin.view.catalog.requests');

});

Route::get('category/{slug}', [FrontController::class, 'show_page_category_collection_all'])->name('show_page_category_collection_all');

Route::get('/{slug}/{id?}', [FrontController::class, 'show_page'])->name('show_page');
Route::get('category/{coll}/{id}', [FrontController::class, 'show_page_category_collection'])->name('show_page_category_collection');

