<?php

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
Route::get('/', function () {
    return redirect('/login');
});
// Route::get('/', 'TaskController@indexTask');

Route::get('/home', 'adminController@index');

Auth::routes();

Route::get('/AllTask', 'TaskController@indexTask');

// Route::group(['middleware','web'],function(){
//     Route::auth();
// });



// Route::group(['middleware'=>['web','auth']],function (){
//     Route::get('/', function (){
//         if (Auth::user()->role==0){
//             Route::get('/admin', 'adminController@index');
//         }elseif (Auth::user()->role==1){
//             Route::get('/leader', 'LeaderController@index');
//         }else{
//             Route::get('/member', 'MemberController@index');
//         }
//     });
// });

Route::get('/admin', 'adminController@index');
// Route::get('/admin/create', 'adminController@create');
// Route::post('/admin/store', 'adminController@store');
// Route::get('/admin/edit/{id}', 'adminController@edit');
// Route::post('/admin/update/{id}', 'adminController@update');
// Route::get('/admin/delete/{id}', 'adminController@destroy');

Route::get('/divisi', 'DivisiController@index');
Route::get('/divisi/create', 'DivisiController@create');
Route::post('/divisi/store', 'DivisiController@store');
Route::get('/divisi/edit/{id}', 'DivisiController@edit');
Route::post('/divisi/update/{id}', 'DivisiController@update');
Route::get('/divisi/delete/{id}', 'DivisiController@destroy');

// Route::get('/task', 'TaskController@index');
Route::get('/task/create/{id}', 'TaskController@create');
Route::post('/task/store', 'TaskController@store');
Route::get('/task/edit/{id}', 'TaskController@edit');
Route::post('/task/update/{id}', 'TaskController@update');
Route::get('/task/delete/{id}', 'TaskController@destroy');
Route::get('/task/create/get_sub/{id}','TaskController@get_sub');
Route::get('/task/get_sub/{id}','TaskController@get_subTask');

// Users Table -> Admin Access
Route::get('/users', 'UserController@index');
Route::get('/users/addusers','UserController@add');
Route::post('/users/store','UserController@store');
Route::get('/users/edit/{id}','UserController@edit');
Route::post('/users/update','UserController@update');
Route::get('/users/hapus/{id}','UserController@hapus');
// End Users Table

// Route::get('/leader', 'LeaderController@index');
// Route::get('/leader/create', 'LeaderController@create');
Route::post('/leader/store', 'LeaderController@store');
Route::get('/leader/edit/{id}', 'LeaderController@edit');
Route::post('/leader/update/{id}', 'LeaderController@update');
Route::get('/leader/delete/{id}', 'LeaderController@destroy');
Route::get('/get_sub/{id}','TaskController@get_sub');

Route::get('/leader/get_sub/{id}','LeaderController@get_subTask');
Route::post('/leader/test/{id}', 'LeaderController@test');
// Route::get('/leader/set', 'LeaderController@indexSet');
Route::get('/leader/back/{id}', 'LeaderController@revision');
Route::get('/leader/done/{id}', 'LeaderController@done');


Route::get('/member', 'MemberController@index');
Route::get('/member/detail/{id}', 'MemberController@detail');

// Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

Route::post('upload_image','CkeditorController@uploadImage')->name('upload');

Route::get('/pusher', function() {
    event(new App\Events\TaskEvent('Hi there Pusher!'));
    return "Event has been sent!";
});

Route::get('/project', 'projectController@index');
Route::get('/project/create', 'projectController@create');
Route::post('/project/store', 'projectController@store');
Route::get('/project/edit/{id}', 'projectController@edit');
Route::post('/project/update/{id}', 'projectController@update');
Route::get('/project/delete/{id}', 'projectController@destroy');

Route::get('/task/see/{id}', 'TaskController@see');
// Route::post('/task/see1/', 'TaskController@see1');
Route::get('/task/index/{id}', 'TaskController@index');
Route::get('/leader', 'projectController@index');
Route::get('/leader/set/{id}', 'LeaderController@indexSet');
Route::get('/leader/create/{id}', 'LeaderController@create');


Route::get('/cek', 'LeaderController@cek');
Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
 
    return "Cleared!";
 
 });

 Route::post('/leader/test2/{id}', 'LeaderController@test2');
 Route::get('/dev/see/{id}', 'TaskController@devsee');
 Route::get('/dev/AllTask', 'TaskController@indexTaskdev');
 Route::get('/task/get_sub/{pr}/{id}','TaskController@get_subTaske');
 Route::post('/task/addlinks', 'TaskController@addlinks');
 Route::get('/task/destlink/{id}', 'TaskController@destroylinks');
//  Route::get('/dev/member/', 'MemberController@indexproject');
 Route::get('/member/{id}', 'MemberController@indexGeser');
 Route::post('/leader/position','LeaderController@pos');

 Route::post('/comment/store', 'commentController@store');
