<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Alert;
use App\Models\Stock;
use App\Models\Member;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Referral;
use App\Models\Supplier;
use App\Models\Attendance;
use App\Models\ClientAlert;
use App\Models\StockAssign;
use App\Models\TicketReply;
use App\Models\CategoryType;
use App\Models\Notification;
use App\Models\Prescription;
use App\Models\StockHistory;
use App\Models\StockTesting;
use App\Models\TicketAssign;
use App\Models\EmailTemplate;
use App\Models\StockTransfer;
use App\Observers\UserObserver;
use App\Events\Auth\LoggedEvent;
use App\Observers\AlertObserver;
use App\Observers\StockObserver;
use App\Observers\MemberObserver;
use App\Observers\TicketObserver;
use App\Observers\ProductObserver;
use App\Observers\ServiceObserver;
use App\Events\Ticket\CreatedEvent;
use App\Events\Ticket\RepliedEvent;
use App\Observers\CategoryObserver;
use App\Observers\EmployeeObserver;
use App\Observers\LocationObserver;
use App\Observers\ReferralObserver;
use App\Observers\SupplierObserver;
use App\Events\Account\AccountEvent;
use App\Events\Ticket\AssignedEvent;
use App\Observers\AttendanceObserver;
use App\Events\Stock\StockAssignEvent;
use App\Observers\ClientAlertObserver;
use App\Observers\StockAssignObserver;

use App\Observers\TicketReplyObserver;
use App\Events\Stock\StockHistoryEvent;
use App\Observers\CategoryTypeObserver;
use App\Observers\NotificationObserver;
use App\Observers\PrescriptionObserver;
use App\Observers\StockHistoryObserver;
use App\Observers\StockTestingObserver;
use App\Observers\TicketAssignObserver;
use App\Events\Notification\CreateEvent;
use App\Events\Notification\DeleteEvent;
use App\Events\Transaction\PaymentEvent;
use App\Observers\EmailTemplateObserver;
use App\Observers\StockTransferObserver;
use App\Listeners\Ticket\CreatedListener;
use App\Listeners\Ticket\RepliedListener;
use App\Listeners\Account\AccountListener;
use App\Listeners\Ticket\AssignedListener;
use App\Listeners\Stock\StockAssignListener;
use App\Events\Referral\ReferralCreatedEvent;
use App\Events\Referral\ReferralHistoryEvent;
use App\Listeners\Stock\StockHistoryListener;
use App\Listeners\Notification\CreateListener;
use App\Listeners\Notification\DeleteListener;
use App\Listeners\Transaction\PaymentListener;
use App\Events\Transaction\PaymentTransferEvent;
use App\Http\Requests\Admin\Ticket\CreateRequest;
use App\Listeners\Referral\ReferralCreatedListener;
use App\Listeners\Referral\ReferralHistoryListener;
use App\Listeners\Transaction\PaymentTransferListener;
use App\Events\Transaction\TransactionStatusChangeEvent;
use App\Listeners\Transaction\TransactionStatusChangeListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        /*
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        */
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        User::class => [UserObserver::class],
        // Role::class                 => [RoleObserver::class],
        // Permission::class           => [PermissionObserver::class],
    ];

    public function boot()
    {
        //
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}
