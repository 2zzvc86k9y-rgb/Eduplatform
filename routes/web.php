<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Controllers\Backend\CuponController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\ActiveController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Backend\SmtpSettingController;
use App\Http\Controllers\SslCommerzPaymentControllerNew;
use App\Http\Controllers\Frontend\TMoneyController;
use App\Http\Controllers\Backend\InstructorQuizController;
use App\Http\Controllers\Student\QuizController;



Route::get('/', [UserController::class, 'Index'])->name('index');
Route::post('/search', [UserController::class, 'Search'])->name('search');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'role:user', 'verified'])->name('dashboard');


// user controller only user can access

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/update/password', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');


    // //////////////// User Wishlist Controller all route parameters ////////////////

    Route::controller(WishListController::class)->group(function(){
        Route::get('/user/wishlist','AllWishList')->name('user.wishlist');
        Route::get('/get-wishlish-course','GetWishListCourse');
        Route::get('/remove-wishlist/{id}','RemoveWishList');
    });
    // //////////////// User course Controller all route parameters ////////////////

    Route::controller(OrdersController::class)->group(function(){
        Route::get('/user/courses','MyCourses')->name('my.course');
        Route::get('/course/view/{course_id}','MyCoursesView')->name('course.view');

    });
    // //////////////// User course related question all route parameters ////////////////

    Route::controller(QuestionController::class)->group(function(){
        Route::post('/user/question','UserQuestion')->name('user.question');
        // Route::get('/course/view/{course_id}','MyCoursesView')->name('course.view');

    });
    Route::controller(ChatController::class)->group(function(){
        Route::get('/live/chat','LiveChat')->name('live.chat');

    });


    // course for user front end
    Route::controller(CourseController::class)->group(function(){
        Route::get('/all/courses','AllCourses')->name('all.course.user');

    });








Route::post('/stripe/order', [CartController::class, 'StripeOrder'])->name('stripe.order');
Route::post('/mark-notification-as-read/{id}', [CartController::class, 'MarkRead']);
Route::post('/mark-notification-as-read/admin/{id}', [CartController::class, 'MarkReadAdmin']);



    Route::post('/lecture/mark-complete', [OrdersController::class, 'markLectureComplete'])->name('lecture.markComplete');

});
// =============================end Auth middleware==================================

require __DIR__.'/auth.php';

//========================================Admin part================================

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');


    // //////////////// Category Controller all route parameters ////////////////
//
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/category','StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('/update/category','UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
    });


    //////////////////////// All Sub Category Route ////////////////////////

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory','UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
    });


    // all instructor route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/instructor','AllInstructor')->name('all.instructor');
        Route::post('/update/userstatus','UpdateUserStatus')->name('update.userstatus');
    });


    Route::controller(CourseController::class)->group(function(){
        Route::get('admin/all/course','AdminAllCourse')->name('admin.all.course');
        Route::get('admin/add/course','AdminAddCourse')->name('admin.add.course');
        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
        Route::post('/admin/store/course','AdminStoreCourse')->name('admin.store.course');
        Route::get('/edit/course/{id}','EditCourse')->name('edit.course');
        Route::post('/update/course','UpdateCourse')->name('update.course');
        Route::post('/update/course/image','UpdateCourseImage')->name('update.course.image');
        Route::post('/update/course/video','UpdateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goals','UpdateCourseGoals')->name('update.course.goals');
        Route::get('/delete/course/{id}','DeleteCourse')->name('delete.course');
    });



    // all review route
    Route::controller(ReviewController::class)->group(function(){
        Route::get('/admin/pending/review','AdminPendingReview')->name('admin.pending.review');
        Route::post('/update/review/status','UpdateReviewStatus')->name('update.review.status');
        Route::get('/admin/active/review','AdminActiveReview')->name('admin.active.review');
    });


    // admin  all courses route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/all/courses','AllCourse')->name('admin.all.courses');
        Route::get('/admin/course/details/{id}','AdminCourseDetails')->name('admin.course.details');
        Route::post('/update/coursestatus','UpdateCourseStatus')->name('update.coursestatus');
    });

    // admin  all course cupons route
    Route::controller(CuponController::class)->group(function(){
        Route::get('/admin/all/cupon','AllCupon')->name('admin.all.cupon');
        Route::get('/admin/add/cupon','AdminAddCupon')->name('admin.add.cupon');
        Route::post('/admin/store/cupon','AdminStoreCupon')->name('admin.store.cupon');
        Route::get('/admin/edit/cupon/{id}','AdminEditCupon')->name('admin.edit.cupon');
        Route::post('/admin/update/cupon','AdminUpdateCupon')->name('admin.update.cupon');
        Route::get('/admin/delete/cupon/{id}','AdminDeleteCupon')->name('admin.delete.cupon');

    });
    // admin  all course order route
    Route::controller(OrdersController::class)->group(function(){
        Route::get('/admin/pending/order','AdminPendingOrder')->name('admin.pending.order');
        Route::get('admin/order/details/{payment_id}','AdminOrderDetails')->name('admin.order.details');
        Route::get('/admin/pending/confirm/{id}','AdminPendingConfirm')->name('pending-confirm');
        Route::get('/admin/confirm/order','AdminConfirmOrder')->name('admin.confirm.order');
    });


    // admin  all  Report route
    Route::controller(ReportController::class)->group(function(){
        Route::get('/admin/all/report/view','AllReportView')->name('admin.all.report.view');
         Route::post('/admin/search/by/date','AdminSearchByDate')->name('admin.search.by.date');
         Route::post('/admin/search/by/month','AdminSearchByMonth')->name('admin.search.by.month');
         Route::post('/admin/search/by/year','AdminSearchByYear')->name('admin.search.by.year');
    });

    // admin  all  user and instructor route
    Route::controller(ActiveController::class)->group(function(){
        Route::get('/admin/all/users','AllUsers')->name('admin.all.users');
        Route::get('/admin/all/instructor','AllInstructor')->name('admin.all.instructor');
    });

    // admin manage  all  blog related category  route
    Route::controller(BlogController::class)->group(function(){
        Route::get('/blog/category','AllBlogCategory')->name('blog.category');
        Route::post('/blog/category/store','BlogCategoryStore')->name('blog.category.store');
        Route::get('/edit/blog/category/{id}','EditBlogCategory');
        Route::post('/blog/category/update','BlogCategoryUpdate')->name('blog.category.update');
        Route::get('/blog/category/delete/{id}','DeleteCategoryUpdate')->name('delete.blog.category');
    });
    // admin manage  all  blog post  related   route
    Route::controller(BlogController::class)->group(function(){
        Route::get('/blog/posts','AllBlogPost')->name('blog.posts');
        Route::get('/add/blog/post','AddBlogPost')->name('add.blog.post');
        Route::post('/store/blog/post','StoreBlogPost')->name('store.blog.post');
        Route::get('/edit/blog/post/{id}','EditBlogPost')->name('edit.blog.post');
        Route::post('/update/blog/post','UpdateBlogPost')->name('update.blog.post');
        Route::get('/delete/blog/post/{id}','DeleteBlogPost')->name('delete.blog.post');
    });


    // admin  all  Smtp route
    Route::controller(SmtpSettingController::class)->group(function(){
        Route::get('/admin/all/smtp','AllSmtp')->name('admin.all.smtp');
         Route::post('/admin/update/smtp','AdminUpdateSmtp')->name('update.smtpsetting');
    });

    // admin  all  Smtp route
    Route::controller(SmtpSettingController::class)->group(function(){
        Route::get('/admin/front-page/settings','FrontPageSettings')->name('admin.frontend.sitesettings');
         Route::post('/admin/update/sitesettings','AdminUpdateSiteSettings')->name('update.siteSettings');
    });



    // admin  all  Permission route
    Route::controller(RoleController::class)->group(function(){
        Route::get('/admin/all/permission','AdminAllPermission')->name('admin.all.permission');
        Route::get('/admin/add/permission','AdminAddPermission')->name('add.permission');
        Route::post('/store/permission','AdminStorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}','AdminEditPermission')->name('edit.permission');
        Route::post('/update/permission','AdminUpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}','AdminDeletePermission')->name('delete.permission');

// permission import and export in exsl file .
        Route::get('/admin/import/permission','AdminImportPermission')->name('import.permission');
        Route::get('/admin/export/permission','AdminExportPermission')->name('export.permission');
        Route::post('/import/permission','ImportPermission')->name('import');
    });
    // admin  all  Role route
    Route::controller(RoleController::class)->group(function(){
        Route::get('/admin/all/role','AdminAllRole')->name('admin.all.role');
        Route::get('/admin/add/role','AdminAddRole')->name('add.roles');
        Route::post('/store/role','AdminStoreRole')->name('store.role');
        Route::get('/edit/role/{id}','AdminEditRole')->name('edit.role');
        Route::post('/update/role','AdminUpdateRole')->name('update.role');
        Route::get('/delete/role/{id}','AdminDeleteRole')->name('delete.role');


        //========================admin role in permission list =========================

        Route::get('/admin/role/permission','AdminRolePermission')->name('admin.role.permission');
        Route::get('/admin/all/role/in/permission','AdminAllRoleInPermission')->name('admin.all.role.permission');
        Route::post('/store/role/in/permission','AdminStoreRoleInPermission')->name('store.role.in.permission');
        Route::get('/edit/role/in/permission/{id}','AdminEditRoleInPermission')->name('edit.role.in.permission');
        Route::post('/update/role/in/permission/{id}','AdminUpdateRoleInPermission')->name('update.role.in.permission');
        Route::get('/delete/role/in/permission/{id}','AdminDeleteRoleInPermission')->name('delete.role.in.permission');






    });


    Route::controller(AdminController::class)->group(function(){
         //========================admin Manage all admin list =========================
        Route::get('/admin/manage/all/admin','AdminManageAllAdmin')->name('manage.all.admin');
        Route::get('/add/admin','AdminAddAdmin')->name('add.admin');
        Route::post('/store/admin/data','AdminStoreAdminData')->name('store.admindata');

        Route::get('/edit/admin/{id}','EditAdmin')->name('edit.admin');
        Route::post('/update/admindata/{id}','AdminUpdateData')->name('update.admindata');
        Route::get('/delete/admin/{id}','AdminDeleteData')->name('delete.admin');
    });






});




// admin login route
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

// become a instructor route

Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');

Route::post('/instructor/registration', [AdminController::class, 'InstructorRegistration'])->name('instructor.registration');








//instructor routes group
Route::middleware(['auth', 'role:instructor'])->group(function () {

    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');
    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])->name('instructor.password.update');


    // add course controller routes

    Route::controller(CourseController::class)->group(function(){
        Route::get('/all/course','AllCourse')->name('all.course');
        Route::get('/add/course','AddCourse')->name('add.course');
        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
        Route::post('/store/course','StoreCourse')->name('store.course');
        Route::get('/edit/course/{id}','EditCourse')->name('edit.course');
        Route::post('/update/course','UpdateCourse')->name('update.course');
        Route::post('/update/course/image','UpdateCourseImage')->name('update.course.image');
        Route::post('/update/course/video','UpdateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goals','UpdateCourseGoals')->name('update.course.goals');
        Route::get('/delete/course/{id}','DeleteCourse')->name('delete.course');
    });

    // add course section and lecture controller routes

    Route::controller(CourseController::class)->group(function(){
        Route::get('/add/course/lecture/{id}','AddCourseLecture')->name('add.course.lecture');
        Route::post('/add/course/section','AddCourseSection')->name('add.course.section');
        Route::post('/save-lecture','SaveLecture')->name('save-lecture');
        Route::get('/edit/lecture/{id}','EditLecture')->name('edit.lecture');
        Route::get('/delete/lecture/{id}','DeleteLecture')->name('delete.lecture');

        Route::post('/update/course/lecture','UpdateCourseLecture')->name('update.course.lecture');
        Route::post('/delete/section/{id}','DeleteSection')->name('delete.section');
    });

       // admin  all course order route
       Route::controller(OrdersController::class)->group(function(){
        Route::get('/instructor/all/order','InstructorAllOrder')->name('instructor.all.order');
        Route::get('/instructor/order/details/{id}','InstructorOrderDetails')->name('instructor.order.details');
        Route::get('/instructor/order/invoice/{id}','InstructorOrderInvoice')->name('instructor.order.invoice');
    });

       // admin  all course Questions route
       Route::controller(QuestionController::class)->group(function(){
        Route::get('/instructor/all/questions','InstructorAllQuestions')->name('instructor.all.questions');
        Route::get('/instructor/question/details/{id}','InstructorQuestionDetails')->name('instructor.question.details');
        Route::post('/instructor/replay','InstructorReply')->name('instructor.reply');
    });

    // instructor  all course cupons route
    Route::controller(CuponController::class)->group(function(){
        Route::get('/instructor/all/cupon','InstructorAllCupon')->name('instructor.all.cupon');
        Route::get('/instructor/add/cupon','InstructorAddCupon')->name('instructor.add.cupon');
        Route::post('/instructor/store/cupon','InstructorStoreCupon')->name('instructor.store.cupon');
        Route::get('/instructor/edit/cupon/{id}','InstructorEditCupon')->name('instructor.edit.cupon');
        Route::post('/instructor/update/cupon','InstructorUpdateCupon')->name('instructor.update.cupon');
        Route::get('/instructor/delete/cupon/{id}','InstructorDeleteCupon')->name('instructor.delete.cupon');

    });


     // all review route
     Route::controller(ReviewController::class)->group(function(){
        Route::get('/instructor/all/review','InstructorAllReview')->name('instructor.all.review');

    });





});

// ===============================================================================================
//                                 Accessable for all user
//=================================================================================================
Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/course/details/{id}/{slug}', [IndexController::class, 'CourseDetails']);

Route::get('/category/{id}/{slug}', [IndexController::class, 'CategoryCourse']);
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'SubCategoryCourse']);
Route::get('/instructor/details/{id}', [IndexController::class, 'InstructorDetails'])->name('instructor.details');

//wishlist an cart controller
Route::post('/add-to-wishlist/{course_id}', [WishListController::class, 'AddToWishList']);
Route::post('/cart/data/store/{course_id}', [CartController::class, 'AddToCart']);
Route::get('/cart/data', [CartController::class, 'CartData']);
Route::get('/course/mini/cart/', [CartController::class, 'AddMiniCart']);
Route::get('/mini-cart-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);
//buy this curse from course details page directly buy option
Route::post('/buy/this/course/{course_id}', [CartController::class, 'BuyToCart']);



// cupon code route
Route::post('/apply-cupon', [CartController::class, 'ApplyCupon']);
// Route::post('/instructor-apply-cupon', [CartController::class, 'InstructorApplyCupon']);
Route::get('/cupon-calculation', [CartController::class, 'CuponCalculation']);
Route::get('/cupon-remove', [CartController::class, 'CuponRemove']);


//checkout page  related route
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');









    Route::post('/payment', [CartController::class, 'Payment'])->name('payment');


Route::post('/store/review', [ReviewController::class, 'StoreReview'])->name('store.review');



















Route::get('/blog/details/{slug}', [BlogController::class, 'BlogDetailsPage']);
Route::get('/blog/category/list/{id}', [BlogController::class, 'BlogCategoryList']);
Route::post('/view/all/posts', [BlogController::class, 'ViewAllPosts']);
Route::get('/view/all/post', [BlogController::class, 'ViewAllPost']);



//================chat controller for user
Route::post('/send-message', [ChatController::class, 'SendMessage']);
Route::get('/get-all-users', [ChatController::class, 'GetAllUsers']);
Route::get('/get-user-message/{userId}', [ChatController::class, 'GetUserMessage']);

//instructor live chat
Route::get('/instructor/live-chat', [ChatController::class, 'InstructorLiveChat'])->name('instructor.live.chat');




 // all Cart route
Route::controller(CartController::class)->group(function(){
    Route::get('/mycart','MyCart')->name('mycart');
    Route::get('/get-cart-course','GetCartCourse');
    Route::get('/cart-course-remove/{rowId}','courseCartRemove');
});

// Routes TMoney
Route::post('/pay-via-tmoney', [TMoneyController::class, 'processPayment'])->name('pay-via-tmoney');
Route::post('/tmoney/callback', [TMoneyController::class, 'handleCallback'])->name('tmoney.callback');

// Quiz Management Routes for Instructors
Route::controller(InstructorQuizController::class)->group(function(){
    Route::get('/course/{course}/quizzes', 'index')->name('course.quizzes');
    Route::get('/course/{course}/quiz/create', 'create')->name('add.course.quiz');
    Route::post('/course/{course}/quiz', 'store')->name('store.course.quiz');
    Route::get('/course/{course}/quiz/{quiz}/edit', 'edit')->name('edit.course.quiz');
    Route::put('/course/{course}/quiz/{quiz}', 'update')->name('update.course.quiz');
    Route::delete('/course/{course}/quiz/{quiz}', 'destroy')->name('delete.course.quiz');
    
    // Routes pour la gestion des questions
    Route::get('/course/{course}/quiz/{quiz}/questions', 'manageQuestions')->name('manage.quiz.questions');
    Route::post('/course/{course}/quiz/{quiz}/questions', 'storeQuestion')->name('store.quiz.question');
    Route::put('/quiz-question/{question}', 'updateQuestion')->name('update.quiz.question');
    Route::delete('/quiz-question/{question}', 'deleteQuestion')->name('delete.quiz.question');
});

// Quiz Routes for Students
Route::controller(QuizController::class)->group(function(){
    Route::get('/course/{course}/quiz/{quiz}/attempt', 'start')->name('start.quiz');
    Route::get('/course/{course}/quiz/{quiz}/take', 'take')->name('student.quiz.take');
    Route::post('/course/{course}/quiz/{quiz}/submit', 'submit')->name('submit.quiz');
    Route::get('/course/{course}/quiz/{quiz}/result', 'result')->name('student.quiz.result');
    // Ajoute d'autres routes si besoin
});

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/mes-quiz', [QuizController::class, 'index'])->name('student.quiz.index');
});
