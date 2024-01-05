<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AlertController;
use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\BlockUserController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\HauoraPlanController;
use App\Http\Controllers\Admin\MedicationController;
use App\Http\Controllers\Admin\UserHealthController;
use App\Http\Controllers\Admin\ClientAlertController;
use App\Http\Controllers\Admin\StockAssignController;
use App\Http\Controllers\Admin\ImmunizationController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\StockTestingController;
use App\Http\Controllers\Admin\MemberProfileController;
use App\Http\Controllers\Admin\StockTransferController;
use App\Http\Controllers\Admin\UserHouseholdController;
use App\Http\Controllers\Admin\ClientFamilyTreeController;
use App\Http\Controllers\Admin\EmergencyContactController;
use App\Http\Controllers\Admin\ClientProfileVisitingHistoryController;

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

Auth::routes();

Route::group(['middleware' => 'role:admin'], function () {

    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    Route::get('/dashboard', 'HomeController@dashboard')->name('home.dashboard');
    //cache
    Route::get('/cache/clear/fd', [CacheController::class, 'clear'])->name('clear.cache');

    // Route::get('/attendance', [AttendanceController::class, 'all'])->name('attendance.all');

    // All Attendance
    Route::group(['prefix' => 'attendance', 'as' => 'attendance.', 'controller' => AttendanceController::class], function () {
        Route::get('/list', 'all')->name('all')->middleware('permission:attendance_all');
        Route::get('/alert', 'alert')->name('alert')->middleware('permission:attendance_all');
        Route::post('/{attendance}/alert-stop', 'alertStop')->name('alert_stop')->middleware('permission:attendance_all');
    });

    // Users
    Route::group(['prefix' => 'users', 'as' => 'user.', 'controller' => UserController::class], function () {

        Route::post('/{user}/update-status-api', 'updateStatusApi')->name('update_status.api')->middleware('permission:user_update_status');
        Route::post('/{user}/update-password-api', 'updatePasswordApi')->name('update_password.api')->middleware('permission:user_update_password');
        Route::post('/{user}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:user_delete');
        Route::post('/{id}/restore-api', 'restoreApi')->name('restore.api')->middleware('permission:user_restore');
        Route::get('/{user}', 'show');
    });

    // Members
    Route::group(['prefix' => 'members', 'as' => 'member.', 'controller' => MemberController::class], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:member_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:member_create');
        Route::post('/create', 'create')->middleware('permission:member_create');
        Route::get('/{member}/update', 'showUpdateForm')->name('update')->middleware(['permission:member_update', 'is_user_blocked']);
        Route::post('/{member}/update', 'update')->middleware(['permission:member_update', 'is_user_blocked']);
        Route::get('/{member}/show', 'show')->name('show')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/{member}/show/client_alert', 'showAlert')->name('show.alert')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/{member}/show/note', 'showNote')->name('show.note')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/{member}/show/attachment', 'showAttachment')->name('show.attachment')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/{member}/show/hauora_plan', 'showHauoraPlan')->name('show.hauora.plan')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/{member}/show/medication', 'showMedication')->name('show.medication')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/{member}/show/immunization', 'showImmunization')->name('show.immunization')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/{member}/show/family_tree', 'showFamilyTree')->name('show.family.tree')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/{member}/show/assigned_stock', 'showAssignedStock')->name('show.assigned.stock')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/{member}/show/client_referral', 'showReferral')->name('show.referral')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/prescriptions/{member}', 'prescriptions')->name('prescription')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/prescriptions/private/{member}', 'privatePrescriptions')->name('private.prescription')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::get('/prescriptions/mynote/{member}', 'myNote')->name('mynote')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::post('/{assign}/stock/accept', 'acceptStock')->name('accept_stock')->middleware(['permission:member_show', 'is_user_blocked']);
        Route::post('/stock/status/change', 'stockStatusChange')->name('stock_status_change')->middleware(['permission:member_show', 'is_user_blocked']);

        Route::group(['controller' => MemberProfileController::class, 'middleware' => 'is_user_blocked'], function () {
            Route::get('/{member}/show/details', 'showDetails')->name('show.details')->middleware('permission:member_show');
            Route::get('/{member}/show/address', 'showAddress')->name('show.address')->middleware('permission:member_show');
            Route::get('/{member}/show/contact', 'showContact')->name('show.contact')->middleware('permission:member_show');
            Route::get('/{member}/show/household', 'showHousehold')->name('show.household')->middleware('permission:member_show');
            Route::get('/{member}/show/health', 'showHealth')->name('show.health')->middleware('permission:member_show');
        });

        // Hauora Plan
        Route::group(['prefix' => 'hauora_plan', 'as' => 'hauora_plan.', 'controller' => HauoraPlanController::class], function () {
            Route::get('/{member}', 'index')->name('index')->middleware('permission:hauora_plan_index');
            Route::get('/{member}/create', 'create')->name('create')->middleware('permission:hauora_plan_create');
            Route::post('/store/{member}', 'store')->name('store')->middleware('permission:hauora_plan_create');
            Route::get('/{hauora_plan}/edit', 'edit')->name('edit')->middleware('permission:hauora_plan_update');
            Route::get('/{hauora_plan}/show', 'show')->name('show')->middleware('permission:hauora_plan_show');
            Route::post('/{hauora_plan}/update', 'update')->name('update')->middleware('permission:hauora_plan_update');
            Route::post('/{hauora_plan}/delete', 'destroy')->name('delete')->middleware('permission:hauora_plan_delete');
            Route::post('/{hauora_plan}/update-status', 'updateStatus')->name('update_status')->middleware('permission:hauora_plan_update');
            Route::get('/{hauora_plan}/follow_up', 'followUp')->name('follow_up.create')->middleware('permission:hauora_plan_update');
            Route::post('/{hauora_plan}/follow_up', 'followUpStore')->name('follow_up.store')->middleware('permission:hauora_plan_update');
            Route::get('/follow_up/edit/{hauoraPlanDetail}', 'followUpEdit')->name('follow_up.edit')->middleware('permission:hauora_plan_update');
            Route::post('/follow_up/update/{hauoraPlanDetail}', 'followUpUpdate')->name('follow_up.update')->middleware('permission:hauora_plan_update');
        });

        // Client Alert
        Route::group(['prefix' => 'client_alert', 'as' => 'client_alert.', 'controller' => ClientAlertController::class], function () {
            Route::get('/{member}', 'index')->name('index')->middleware('permission:client_alert_index');
            Route::post('/store/{member}', 'store')->name('store')->middleware('permission:client_alert_create');
            Route::get('/{client_alert}/show', 'show')->name('show')->middleware('permission:client_alert_show');
            Route::post('/{client_alert}/update', 'update')->name('update')->middleware('permission:client_alert_update');
            Route::post('/{client_alert}/delete', 'destroy')->name('delete')->middleware('permission:client_alert_delete');
        });

        // Medication
        Route::group(['prefix' => 'medication', 'as' => 'medication.', 'controller' => MedicationController::class], function () {
            Route::get('/{member}', 'index')->name('index')->middleware('permission:medication_index');
            Route::get('/{member}/create', 'create')->name('create')->middleware('permission:medication_create');
            Route::post('/store/{member}', 'store')->name('store')->middleware('permission:medication_create');
            Route::get('/{medication}/edit', 'edit')->name('edit')->middleware('permission:medication_update');
            Route::get('/{medication}/show', 'show')->name('show')->middleware('permission:medication_show');
            Route::post('/{medication}/update', 'update')->name('update')->middleware('permission:medication_update');
            Route::post('/{medication}/delete', 'destroy')->name('delete')->middleware('permission:medication_delete');
        });

        // Attachment
        Route::group(['prefix' => 'attachment', 'as' => 'attachment.', 'controller' => ClientAttachmentController::class], function () {
            Route::get('/{member}', 'index')->name('index')->middleware('permission:client_attachment_index');
            Route::get('/create/{member}', 'create')->middleware('permission:client_attachment_create');
            Route::post('/store/{member}', 'store')->name('store')->middleware('permission:client_attachment_create');
            Route::get('/{attachment}/edit', 'edit')->name('edit')->middleware('permission:client_attachment_update');
            Route::post('/{attachment}/update', 'update')->name('update')->middleware('permission:client_attachment_update');
            Route::post('/{attachment}/delete', 'destroy')->name('delete')->middleware('permission:client_attachment_delete');
        });

        // Immunization
        Route::group(['prefix' => 'immunization', 'as' => 'immunization.', 'controller' => ImmunizationController::class], function () {

            Route::get('/{member}', 'index')->name('index')->middleware('permission:immunization_index');
            Route::get('/{member}/create', 'create')->name('create')->middleware('permission:immunization_create');
            Route::post('/store/{member}', 'store')->name('store')->middleware('permission:immunization_create');
            Route::get('/{immunization}/edit', 'edit')->name('edit')->middleware('permission:immunization_update');
            Route::post('/{immunization}/update', 'update')->name('update')->middleware('permission:immunization_update');
            Route::get('/{immunization}/show', 'show')->name('show')->middleware('permission:immunization_show');
            Route::post('/{immunization}/delete', 'destroy')->name('delete')->middleware('permission:immunization_delete');
            Route::get('/{immunization}/done', 'done')->name('done')->middleware('permission:immunization_done');
            Route::post('/{immunization}/status-update-api', 'statusUpdate')->name('status.update.api')->middleware('permission:immunization_update');
        });

        // Client Family Tree
        Route::group(['prefix' => 'family', 'as' => 'family.', 'controller' => ClientFamilyTreeController::class], function () {

            Route::get('/{user_id}', 'index')->name('index')->middleware('permission:client_family_index');
            Route::post('/store/{member}', 'store')->name('store')->middleware('permission:client_family_create');
            Route::get('/', 'familyTree')->name('list')->middleware('permission:client_family_list');
            Route::get('/{family}/edit', 'edit')->name('edit')->middleware('permission:client_family_update');
            Route::post('/{family}/update', 'update')->name('update')->middleware('permission:client_family_update');
        });

        // Client Referral feature
        Route::group(['prefix' => '{member}/referrals', 'as' => 'referral.', 'controller' => ReferralController::class], function () {

            Route::get('/', 'index')->name('index')->middleware('permission:referral_index');
            Route::get('/create', 'create')->name('create')->middleware('permission:referral_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:referral_create');
            Route::get('/{referral}/edit', 'edit')->name('edit')->middleware('permission:referral_update');
            Route::post('/{referral}/update', 'update')->name('update')->middleware('permission:referral_update');
            Route::get('/{referral}/show', 'show')->name('show')->middleware('permission:referral_show');
        });


        // prescription
        Route::group(['prefix' => 'prescriptions', 'as' => 'prescription.', 'controller' => PrescriptionController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:prescription_index');
            Route::get('/{member}/create', 'create')->name('create')->middleware('permission:prescription_create');
            Route::post('/store/{member}', 'store')->name('store')->middleware('permission:prescription_create');
            Route::get('/{prescription}/edit', 'edit')->name('edit')->middleware('permission:prescription_update');
            Route::get('/{prescription}/show', 'show')->name('show')->middleware('permission:prescription_show');
            Route::post('/{prescription}/update', 'update')->name('update')->middleware('permission:prescription_update');
            Route::post('/{prescription}/delete', 'destroy')->name('delete')->middleware('permission:prescription_delete');
        });
    });

    // Client Family Tree
    Route::group(['prefix' => 'clients/family', 'as' => 'client.family.', 'controller' => ClientFamilyTreeController::class], function () {
        Route::post('/store/{member}', 'store')->name('store')->middleware('permission:client_family_create');
        Route::get('/', 'familyTree')->name('list')->middleware('permission:client_family_list');
        Route::get('/{family}/edit', 'edit')->name('edit')->middleware('permission:client_family_update');
        Route::post('/{family}/update', 'update')->name('update')->middleware('permission:client_family_update');
    });

    Route::group(['prefix' => '{user_type}', 'as' => 'user.'], function () {

        // User Edit Address
        Route::group(['prefix' => 'address', 'as' => 'address.', 'controller' => AddressController::class], function () {
            Route::post('/{address}/update', 'update')->name('update')->middleware('permission:house_hold_update');
        });

        // User Household
        Route::group(['prefix' => 'house_hold', 'as' => 'house_hold.', 'controller' => UserHouseholdController::class], function () {
            Route::get('/{user}/create', 'create')->name('create')->middleware('permission:house_hold_create');
            Route::post('/store/{user}', 'store')->name('store')->middleware('permission:house_hold_create');
            Route::get('/{user_house_hold}/edit', 'edit')->name('edit')->middleware('permission:house_hold_update');
            Route::post('/{user_house_hold}/update', 'update')->name('update')->middleware('permission:house_hold_update');
        });

        // User Health
        Route::group(['prefix' => '{user}/health', 'as' => 'health.', 'controller' => UserHealthController::class], function () {
            Route::get('/create', 'create')->name('create')->middleware('permission:health_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:health_create');
            Route::get('/{user_health}/edit', 'edit')->name('edit')->middleware('permission:health_update');
            Route::post('/{user_health}/update', 'update')->name('update')->middleware('permission:health_update');
        });
    });

    // Employees
    Route::group(['prefix' => 'employees', 'as' => 'employee.', 'controller' => EmployeeController::class], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:employee_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:employee_create');
        Route::post('/create', 'create')->middleware('permission:employee_create');
        Route::get('/{employee}/update', 'showUpdateForm')->name('update')->middleware('permission:employee_update');
        Route::post('/{employee}/update', 'update')->middleware('permission:employee_update');
        Route::post('/{employee}/security/update', 'securityUpdate')->name('security.update')->middleware('permission:employee_update');
        Route::get('/{employee}/show', 'show')->name('show')->middleware('permission:employee_show');

        Route::get('/{employee}/tickets', 'ticketIndex')->name('ticketIndex')->middleware('permission:ticket_index');
        Route::post('/{assign}/stock/accept', 'acceptStock')->name('accept_stock')->middleware(['permission:employee_update']);
        Route::post('/stock/status/change', 'stockStatusChange')->name('stock_status_change')->middleware(['permission:employee_update']);

        // Attendance
        Route::group(['prefix' => 'attendance', 'as' => 'attendance.', 'controller' => AttendanceController::class], function () {
            Route::get('/{employee}', 'index')->name('index')->middleware('permission:attendance_index');
            Route::post('/store/{employee}', 'store')->name('store')->middleware('permission:attendance_create');
            Route::get('/{attendance}/show', 'show')->name('show')->middleware('permission:attendance_show');
            Route::post('/{attendance}/update', 'update')->name('update')->middleware('permission:attendance_update');
        });

        // Attachment
        Route::group(['prefix' => 'attachment', 'as' => 'attachment.', 'controller' => AttachmentController::class], function () {
            Route::get('/{employee}', 'index')->name('index')->middleware('permission:attachment_index');
            Route::get('/create/{employee}', 'create')->middleware('permission:attachment_create');
            Route::post('/store/{employee}', 'store')->name('store')->middleware('permission:attachment_create');
            Route::get('/{attachment}/edit', 'edit')->name('edit')->middleware('permission:attachment_update');
            Route::post('/{attachment}/update', 'update')->name('update')->middleware('permission:attachment_update');
            Route::post('/{attachment}/delete', 'destroy')->name('delete')->middleware('permission:attachment_delete');
        });

        // Certificate
        Route::group(['prefix' => '{employee}/certificates', 'as' => 'certificate.', 'controller' => TrainingController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:certificate_create');
            Route::get('/create', 'create')->name('create')->middleware('permission:certificate_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:certificate_create');
            Route::get('/{training}/edit', 'edit')->name('edit')->middleware('permission:certificate_update');
            Route::post('/{training}/update', 'update')->name('update')->middleware('permission:certificate_update');
            Route::post('/{training}/delete', 'destroy')->name('delete')->middleware('permission:certificate_delete');
        });

        // Post
        Route::group(['prefix' => '{employee}/posts', 'as' => 'post.', 'controller' => PostController::class], function () {
            Route::get('/', 'employeePostIndex')->name('index')->middleware('permission:post_show');
            Route::get('/{post}/show', 'showOnEmployee')->name('show')->middleware('permission:post_show');
            Route::get('/{post}/test', 'postTest')->name('test')->middleware('permission:post_show');
            Route::post('/{post}/test', 'answerSubmit')->middleware('permission:post_show');
        });
    });

    // Emergency Contact
    Route::group(['prefix' => 'emergency', 'as' => 'emergency.', 'controller' => EmergencyContactController::class], function () {

        Route::get('/{user}/create', 'showCreateForm')->name('create')->middleware('permission:emergency_contact_create');
        Route::post('/{user}/create', 'create')->middleware('permission:emergency_contact_create');
        Route::get('/{emergency}/update', 'showUpdateForm')->name('update')->middleware('permission:emergency_contact_update');
        Route::post('/{emergency}/update', 'update')->middleware('permission:emergency_contact_update');
        Route::post('/{emergency}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:emergency_contact_delete');
    });

    // Logins & Activities
    Route::group(['prefix' => 'logs', 'as' => 'log.', 'controller' => LogController::class], function () {

        Route::get('/logins', 'loginIndex')->name('login.index')->middleware('permission:log_login_index');
        Route::post('/{login}/delete-api', 'deleteLoginApi')->name('delete_login.api')->middleware('permission:log_delete_login');

        Route::get('/activity', 'activityIndex')->name('activity.index')->middleware('permission:log_activity_index');
        Route::get('/activity/{activity}/show', 'activityShow')->name('activity.show')->middleware('permission:log_activity_show');
        Route::post('/activity/{activity}/delete', 'deleteActivity')->name('activity.delete')->middleware('permission:log_activity_delete');

        Route::get('/emails', 'emailIndex')->name('email.index')->middleware('permission:log_email_index');
        Route::get('/emails/{email}/show', 'emailShow')->name('email.show')->middleware('permission:log_email_show');
        Route::post('/emails/{email}/delete', 'deleteEmail')->name('email.delete')->middleware('permission:log_email_delete');
    });

    // Profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'controller' => ProfileController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:profile_index');
        Route::get('/update', 'showUpdateForm')->name('update')->middleware('permission:profile_update');
        Route::post('/update', 'update')->middleware('permission:profile_update');
        Route::get('/update-password', 'showUpdatePasswordForm')->name('update_password')->middleware('permission:profile_update_password');
        Route::post('/update-password', 'updatePassword')->middleware('permission:profile_update_password');
        Route::get('/notification/all', 'showAllNotifications')->name('notification')->middleware('permission:profile_all_notification');
    });

    // Tickets
    Route::group(['prefix' => 'tickets', 'as' => 'ticket.', 'controller' => TicketController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:ticket_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:ticket_create');
        Route::post('/create', 'create')->middleware('permission:ticket_create');
        Route::get('/{ticket}/update', 'showUpdateForm')->name('update')->middleware('permission:profile_update');
        Route::post('/{ticket}/update', 'update')->middleware('permission:profile_update');
        Route::get('/{ticket}/show', 'show')->name('show')->middleware('permission:ticket_show');
        Route::post('/{ticket}/reply', 'reply')->name('reply')->middleware('permission:ticket_reply');
        Route::post('/{ticket}/assignee', 'changeAssignee')->name('assignee')->middleware('permission:ticket_assignee');
        Route::post('/{ticket}/change-status', 'changeStatus')->name('change_status')->middleware('permission:ticket_change_status');
        Route::get('/{ticket}/reopen', 'reOpen')->name('reopen')->middleware('permission:ticket_reopen');
    });

    // Post
    Route::group(['prefix' => 'posts', 'as' => 'post.', 'controller' => PostController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:post_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:post_create');
        Route::post('/create', 'create')->middleware('permission:post_create');
        Route::get('/{post}/update', 'showUpdateForm')->name('update')->middleware('permission:profile_update');
        Route::post('/{post}/update', 'update')->middleware('permission:profile_update');
        Route::get('/{post}/show', 'show')->name('show')->middleware('permission:post_show');
        Route::get('/{post}/delete', 'destroy')->name('delete')->middleware('permission:post_delete');
        Route::post('/question/{question}/delete', 'qusDelete')->name('qus_delete')->middleware('permission:post_delete');
        Route::post('/{recipient}/resend-api', 'resend')->name('resend.api')->middleware('permission:post_index');
    });

    // Config
    Route::group(['prefix' => 'configs', 'as' => 'config.', 'controller' => ConfigController::class], function () {

        // Roles & Permissions
        Route::group(['prefix' => 'roles', 'as' => 'role.', 'controller' => RoleController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:role_index');
            Route::get('/{role}/show-api', 'showApi')->name('show.api')->middleware('permission:role_show');
            Route::post('/create', 'createApi')->name('create.api')->middleware('permission:role_create');
            Route::post('/{role}/update-api', 'updateApi')->name('update.api')->middleware('permission:role_update');
            Route::post('/{role}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:role_delete');
            Route::get('/{role}/permissions', 'permissions')->name('permission')->middleware('permission:role_permission');
            Route::post('/{role}/permissions/update', 'updatePermissions')->name('permission.update')->middleware('permission:role_permission_update');
        });

        // Dropdowns
        Route::group(['prefix' => 'dropdowns', 'as' => 'dropdown.'], function () {
            Route::get('/', 'dropdownMenu')->name('menu')->middleware('permission:config_dropdown_menu');
            Route::get('/{dropdown}', 'dropdowns')->name('index')->middleware('permission:config_dropdown_index');
            Route::post('/{dropdown}/create-api', 'createDropdownApi')->name('create.api')->middleware('permission:config_dropdown_create');
            Route::post('/{dropdown}/{id}/update-api', 'updateDropdownApi')->name('update.api')->middleware('permission:config_dropdown_update');
            Route::post('/{dropdown}/{id}/delete-api', 'deleteDropdownApi')->name('delete.api')->middleware('permission:config_dropdown_delete');
        });

        Route::get('/general-settings', 'general')->name('general.settings')->middleware('permission:config_genaral_settings_show');
        Route::post('/general', 'updateGeneralSettings')->name('general.settings.update')->middleware('permission:config_genaral_settings_update');

        Route::group(['prefix' => 'more-settings', 'as' => 'more_settings.', 'controller' => ConfigController::class], function () {
            Route::get('/', 'moreSettings')->name('index');
            Route::get('/email-settings', 'emailSettings')->name('email.settings')->middleware('permission:config_email_settings_show');
            Route::post('/update-email-settings', 'updateEmailSettings')->name('email.settings.update')->middleware('permission:config_email_settings_update');
            Route::post('/send-test-email', 'sendTestMail')->name('send.test.email')->middleware('permission:config_email_settings_show');
            Route::get('/social-link', 'socialLink')->name('social.link')->middleware('permission:config_social_link_show');
            Route::post('/social-link', 'updateSocialLink')->name('social.link.update')->middleware('permission:config_social_link_update');

            // Alert
            Route::group(['prefix' => 'alert', 'as' => 'alert.', 'controller' => AlertController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:config_alert_index');
                Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:config_alert_create');
                Route::post('/create', 'create')->middleware('permission:config_alert_create');
                Route::get('/{alert}/update', 'showUpdateForm')->name('update')->middleware('permission:config_alert_update');
                Route::post('/{alert}/update', 'update')->middleware('permission:config_alert_update');
                Route::get('/{alert}/show', 'show')->middleware('permission:config_alert_show');
                Route::post('/{alert}/delete', 'destroy')->name('delete')->middleware('permission:config_alert_delete');
            });

            // Location
            Route::group(['prefix' => 'location', 'as' => 'location.', 'controller' => LocationController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:config_location_index');
                Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:config_location_create');
                Route::post('/create', 'create')->middleware('permission:config_alert_create');
                Route::get('/{location}/update', 'showUpdateForm')->name('update')->middleware('permission:config_location_update');
                Route::post('/{location}/update', 'update')->middleware('permission:config_location_update');
                Route::get('/{location}/show', 'show')->middleware('permission:config_location_show');
                Route::post('/{location}/delete', 'delete')->name('delete')->middleware('permission:config_location_delete');
            });

            // Service
            Route::group(['prefix' => 'services', 'as' => 'service.', 'controller' => ServiceController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:config_service_index');
                Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:config_service_create');
                Route::post('/create', 'create')->middleware('permission:config_service_create');
                Route::get('/{service}/update', 'showUpdateForm')->name('update')->middleware('permission:config_service_update');
                Route::post('/{service}/update', 'update')->middleware('permission:config_service_update');
                Route::get('/{service}/show-api', 'show')->name('show')->middleware('permission:config_service_show');
                Route::post('/{service}/delete', 'delete')->name('delete')->middleware('permission:config_service_delete');
            });

            // Email templates
            Route::group(['prefix' => 'email-templates', 'as' => 'email_template.'], function () {
                Route::get('/', 'emailTemplates')->name('index')->middleware('permission:config_email_template_index');
                Route::get('/{email_template}/update', 'updateEmailTemplateForm')->name('update')->middleware('permission:config_email_templete_update');
                Route::post('/{email_template}/update', 'updateEmailTemplate')->middleware('permission:config_email_templete_update');
            });

            // Email Signature
            Route::group(['prefix' => 'email-signature', 'as' => 'email_signature.', 'controller' => EmailSignatureController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:config_email_signature_index');
                Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:config_email_signature_create');
                Route::post('/create', 'create')->middleware('permission:config_email_signature_create');
                Route::get('/{emailSignature}/update', 'showUpdateForm')->name('update')->middleware('permission:config_email_signature_update');
                Route::post('/{emailSignature}/update', 'update')->middleware('permission:config_email_signature_update');
                Route::get('/{emailSignature}/show-api', 'show')->name('show')->middleware('permission:config_email_signature_show');
                Route::post('/{emailSignature}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:config_email_signature_delete');
            });
        });
    });

    // Notifications
    Route::group(['prefix' => 'notifications', 'as' => 'notification.', 'controller' => NotificationController::class], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:notification_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:notification_create');
        Route::post('/create', 'create')->middleware('permission:notification_create');
        Route::post('/{notification}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:notification_delete');
    });

    // Start AMS Module
    Route::group(['prefix' => 'ams', 'as' => 'ams.'], function () {
        // Category Type
        Route::group(['prefix' => 'category-types', 'as' => 'category_type.', 'controller' => CategoryTypeController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:category_type_index');
            Route::get('/create', 'create')->name('create')->middleware('permission:category_type_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:category_type_create');
            Route::get('/{category_type}/edit', 'edit')->name('edit')->middleware('permission:category_type_update');
            Route::post('/{category_type}/update', 'update')->name('update')->middleware('permission:category_type_update');
            Route::get('/{category_type}/delete', 'destroy')->name('delete')->middleware('permission:category_type_delete');
            Route::post('/{category_type}/status-change', 'changeStatus')->name('change_status')->middleware('permission:category_type_status');
        });

        // Category
        Route::group(['prefix' => 'category', 'as' => 'category.', 'controller' => CategoryController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:category_index');
            Route::get('/create', 'create')->name('create')->middleware('permission:category_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:category_create');
            Route::get('/{category}/edit', 'edit')->name('edit')->middleware('permission:category_update');
            Route::post('/{category}/update', 'update')->name('update')->middleware('permission:category_update');
            Route::get('/{category}/delete', 'destroy')->name('delete')->middleware('permission:category_delete');
            Route::post('/{category}/status-change', 'changeStatus')->name('change_status')->middleware('permission:category_status');
        });

        // Supplier
        Route::group(['prefix' => 'supplier', 'as' => 'supplier.', 'controller' => SupplierController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:supplier_index');
            Route::get('/create', 'create')->name('create')->middleware('permission:supplier_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:supplier_create');
            Route::get('/{supplier}/edit', 'edit')->name('edit')->middleware('permission:supplier_update');
            Route::post('/{supplier}/update', 'update')->name('update')->middleware('permission:supplier_update');
            Route::get('/{supplier}/delete', 'destroy')->name('delete')->middleware('permission:supplier_delete');
            Route::post('/{supplier}/status-change', 'changeStatus')->name('change_status')->middleware('permission:supplier_status');
        });

        // Product
        Route::group(['prefix' => 'product', 'as' => 'product.', 'controller' => ProductController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:product_index');
            Route::get('/create', 'create')->name('create')->middleware('permission:product_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:product_create');
            Route::get('/{product}/edit', 'edit')->name('edit')->middleware('permission:product_update');
            Route::post('/{product}/update', 'update')->name('update')->middleware('permission:product_update');
            Route::post('/{product}/delete', 'destroy')->name('delete')->middleware('permission:product_delete');
            Route::get('/{product}/show', 'show')->name('show')->middleware('permission:product_show');
            Route::post('/{product}/status-change', 'changeStatus')->name('change_status')->middleware('permission:product_status');
        });

        // Room
        Route::group(['prefix' => 'room', 'as' => 'room.', 'controller' => RoomController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:room_index');
            Route::get('/create', 'create')->name('create')->middleware('permission:room_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:room_create');
            Route::get('/{room}/edit', 'edit')->name('edit')->middleware('permission:room_update');
            Route::post('/{room}/update', 'update')->name('update')->middleware('permission:room_update');
            Route::get('/{room}/delete', 'destroy')->name('delete')->middleware('permission:room_delete');
            Route::post('/{room}/status-change', 'changeStatus')->name('change_status')->middleware('permission:room_status');
        });

        // Stock
        Route::group(['prefix' => 'stocks', 'as' => 'stock.', 'controller' => StockController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:stock_index');
            Route::post('/supplier', 'getSupplier')->name('supplier')->middleware('permission:stock_create');
            Route::get('/create', 'create')->name('create')->middleware('permission:stock_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:stock_create');
            Route::get('/{stock}/edit', 'edit')->name('edit')->middleware('permission:stock_update');
            Route::post('/{stock}/update', 'update')->name('update')->middleware('permission:stock_update');
            Route::post('/{stock}/delete', 'destroy')->name('delete')->middleware('permission:stock_delete');
            Route::get('/{stock}', 'showApi');
            Route::get('/{stock}/show', 'show')->name('show')->middleware('permission:stock_show');
            Route::post('/{stock}/change-status', 'changeStatus')->name('change_status')->middleware('permission:stock_change_status');
            Route::get('/by/{location}', 'getStockByLocation');
        });

        // Product Assign
        Route::group(['prefix' => 'stock-assign', 'as' => 'stock_assign.', 'controller' => StockAssignController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:stock_assign_index');
            Route::get('/create', 'create')->name('create')->middleware('permission:stock_assign_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:stock_assign_create');
            Route::get('/{stock_assign}/edit', 'edit')->name('edit')->middleware('permission:stock_assign_update');
            Route::post('/{stock_assign}/update', 'update')->name('update')->middleware('permission:stock_assign_update');
            Route::post('/{stock_assign}/delete', 'destroy')->name('delete')->middleware('permission:product_delete');
        });

        // Stock Transfer
        Route::group(['prefix' => 'stock-transfer', 'as' => 'stock_transfer.', 'controller' => StockTransferController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:stock_transfer_index');
            Route::get('/create', 'create')->name('create')->middleware('permission:stock_transfer_create');
            Route::post('/store', 'store')->name('store')->middleware('permission:stock_transfer_create');
            Route::get('/{stock_transfer}/edit', 'edit')->name('edit')->middleware('permission:stock_transfer_update');
            Route::post('/{stock_transfer}/update', 'update')->name('update')->middleware('permission:stock_transfer_update');
            Route::get('/{stock_transfer}/delete', 'destroy')->name('delete')->middleware('permission:stock_transfer_delete');
            Route::post('/{stock_transfer}/status-change', 'changeStatus')->name('change_status')->middleware('permission:stock_transfer_status');
            Route::post('/get-stock', 'getStock')->name('get_stock')->middleware('permission:stock_transfer_status');
        });

        // Stock Testing
        Route::group(['prefix' => 'stock-testing', 'as' => 'stock_testing.', 'controller' => StockTestingController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:stock_testing_index');
            Route::get('/{stock}/test', 'showTest')->name('test')->middleware('permission:stock_testing_test');
            Route::post('/test', 'storeTest')->name('store_test')->middleware('permission:stock_testing_test');
            Route::get('/{stock}/view', 'view')->name('view')->middleware('permission:stock_testing_show');
        });
    });
    // End AMS Module



    // Admin Referral feature
    Route::group(['prefix' => 'referrals', 'as' => 'referral.', 'controller' => ReferralController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:referral_index');
        Route::get('/create', 'create')->name('create')->middleware('permission:referral_create');
        Route::post('/store', 'store')->name('store')->middleware('permission:referral_create');
        Route::get('/{referral}/edit', 'edit')->name('edit')->middleware('permission:referral_update');
        Route::post('/{referral}/update', 'update')->name('update')->middleware('permission:referral_update');
        Route::get('/{referral}/show', 'show')->name('show')->middleware('permission:referral_show');

        Route::post('/{referral}/status-update-api', 'statusUpdate')->name('status.update.api')->middleware('permission:referral_status_change');
        Route::post('/{referral}/rerefer-api', 'reRefer')->name('rerefer.api')->middleware('permission:referral_status_change');
    });

    //Advanced
    Route::group(['prefix' => 'advanced', 'as' => 'advanced.'], function () {
        // Logins & Activities
        Route::group(['prefix' => 'client-profile-visiting-history', 'as' => 'client_profile_visiting_history.', 'controller' => ClientProfileVisitingHistoryController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:more_client_profile_visit_index');
        });

        // BlockUser
        Route::group(['prefix' => 'block-users', 'as' => 'block_user.', 'controller' => BlockUserController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:more_block_user_index');
            Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:more_block_user_create');
            Route::post('/create', 'create')->middleware('permission:more_block_user_create');
            Route::post('/{block_user}/delete', 'destroy')->name('delete')->middleware('permission:more_block_user_delete');
        });
    });

    // Report
    Route::group(['prefix' => 'report', 'as' => 'report.', 'controller' => ReportController::class], function () {
        Route::get('/users', 'user')->name('user');
        Route::get('/ams', 'ams')->name('ams');
        Route::get('/referrals', 'referral')->name('referral');
        Route::get('/notes', 'note')->name('note');
        Route::get('/alerts', 'alert')->name('alert');
        Route::get('/emergency-contacts', 'contact')->name('contact');
        Route::get('/referral-list', 'referralList')->name('referral.list');
        Route::get('/referral-history', 'referralHistory')->name('referral.history');
    });
});
