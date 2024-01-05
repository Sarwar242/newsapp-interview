<?php

namespace App\Library;

class Enum
{
    //Vite Resources Path
    public const LOGO_PATH = 'resources/images/logo.png';
    public const LOGO_WHITE_PATH = 'resources/images/logowhhite.png';
    public const LOGO2_PATH = 'resources/images/logo2.png';
    public const NO_AVATAR_PATH = 'resources/images/no_avatar.png';
    public const NO_IMAGE_PATH = 'resources/images/noimage.jpg';
    public const LOGIN_BACKGROUND_PATH = 'resources/images/Background.jpg';
    public const MARK_CHECK_IMAGE_PATH = 'resources/images/mark.jpg';

    public const ROLE_ADMIN_SLUG = 'admin';
    public const QRCODE_DIR = 'storage/qrcode/';
    public const MEMBER_PROFILE_IMAGE_DIR = 'storage/member/profile';
    public const CONFIG_IMAGE_DIR = 'storage/config';
    public const MEMBER_NID_IMAGE_DIR = 'storage/member/nid';
    public const AMS_PRODUCT_IMAGE_DIR = 'storage/ams/product';
    public const EMPLOYEE_PROFILE_IMAGE = 'storage/employee/profile';
    public const TICKET_ATTACHMENT_DIR = 'storage/ticket';
    public const EMPLOYEE_CONTACT_PERSION_IMAGE = 'storage/employee/contact';
    public const SUPPLIER_LOGO = 'storage/supplier/logo';
    public const ATTACHMENT_FILE_DIR = 'storage/attachment';
    public const EMPLOYEE_TRAINING_FILE_DIR = 'storage/employee/training';

    public const PROJECT_ID_TAG = 'Test';

    public const USER_ARTICLE_THUMB_DIR = 'storage/article/thumb';
    public const USER_ARTICLE_DIR = 'storage/article/picture';
    public const USER_AVATAR_DIR = 'storage/user/avatar';
    public const USER_PHOTO_ID_DIR = 'storage/user/photo_id';
    public const TRAINING_DOCUMENTS = 'storage/training_documents';
    public const POST_DOCUMENT = 'storage/post_documents';

    //===========------- Email Settings Start ----================//
    public const EMAIL_TICKET_CREATE = 'ticket_create';
    public const EMAIL_TICKET_ASSIGN = 'ticket_assign';
    public const EMAIL_TICKET_REPLY = 'ticket_reply';

    //post
    public const EMAIL_POST_CREATE = 'post_create';

    public const EMAIL_REFERRAL_CREATE = 'referral_create';

    public const EMAIL_STOCK_ASSIGN = 'stock_assign';

    //===========------- Email Settings End ----================//

    /* ============== USER MODULE ===================*/
    public const USER_TYPE_ADMIN = 'admin';
    public const USER_TYPE_EMPLOYEE = 'employee';
    public const USER_TYPE_MEMBER = 'member';
    public const USER_TYPE_ROOM = 'room';

    public static function getUserType(mixed $type = null)
    {
        $types = [
            self::USER_TYPE_ADMIN    => 'Administrator',
            self::USER_TYPE_EMPLOYEE => 'Employee',
            self::USER_TYPE_MEMBER   => 'Client',
            self::USER_TYPE_ROOM     => 'Room',
        ];

        if (is_array($type) && !empty($type)) {
            foreach ($type as $value) {
                $result[$value] = $types[$value];
            }

            return $result;
        }

        return $type ? $types[$type] : $types;
    }

    public const USER_STATUS_PENDING = 1;
    public const USER_STATUS_ACTIVE = 2;
    public const USER_STATUS_HOLD = 3;
    public const USER_STATUS_INACTIVE = 4;

    public static function getUserStatus(int $type = null)
    {
        $types = [
            self::USER_STATUS_PENDING  => "Pending",
            self::USER_STATUS_ACTIVE   => "Active",
            self::USER_STATUS_HOLD     => "Hold",
            self::USER_STATUS_INACTIVE => "Inactive"
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    public const IMMUNIZATION_STATUS_PENDING = 1;
    public const IMMUNIZATION_STATUS_COMPLETE = 2;
    public const IMMUNIZATION_STATUS_CANCELED = 3;

    public static function getImmunizationStatus(int $type = null)
    {
        $types = [
            self::IMMUNIZATION_STATUS_PENDING  => "Pending",
            self::IMMUNIZATION_STATUS_COMPLETE => "Completed",
            self::IMMUNIZATION_STATUS_CANCELED => "Canceled",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    /* ============== END ===================*/

    /* ============== EMPLOYEE MODULE ===================*/
    public const EMPLOYEE_TYPE_DOCTOR = 'dr';
    public const EMPLOYEE_TYPE_NURSE = 'nurse';

    public static function getEmployeeType(string $type = null)
    {
        $types = [
            self::EMPLOYEE_TYPE_DOCTOR => "Dr",
            self::EMPLOYEE_TYPE_NURSE  => "Nurse"
        ];

        return $type ? $types[$type] : $types;
    }

    public const CONTACT_TYPE_EMAIL = 'email';
    public const CONTACT_TYPE_PHONE = 'phone';
    public const CONTACT_TYPE_FACE_TO_FACE = 'face_to_face';

    public static function getContactType(string $type = null)
    {
        $types = [
            self::CONTACT_TYPE_EMAIL        => "Email",
            self::CONTACT_TYPE_PHONE        => "Phone Call",
            self::CONTACT_TYPE_FACE_TO_FACE => 'Face to Face'
        ];

        return $type ? $types[$type] : $types;
    }

    public const EMPLOYMENT_STATUS_EMPLOYED = 'employed';
    public const EMPLOYMENT_STATUS_UNEMPLOYED = 'unemployed';

    public static function getEmploymentStatus(string $type = null)
    {
        $types = [
            self::EMPLOYMENT_STATUS_EMPLOYED   => "Employed",
            self::EMPLOYMENT_STATUS_UNEMPLOYED => "Unemployed",
        ];

        return $type ? $types[$type] : $types;
    }

    public const REFERRAL_STATUS_PENDING = 'pending';
    public const REFERRAL_STATUS_ENROLLED = 'enrolled';
    public const REFERRAL_STATUS_DISCHARGE = 'discharge';
    public const REFERRAL_STATUS_DECLINED = 'declined';
    // public const REFERRAL_STATUS_RE_REFER = 're-refer';

    public static function getReferralStatus(string $type = null)
    {
        $types = [
            self::REFERRAL_STATUS_PENDING   => "Pending",
            self::REFERRAL_STATUS_ENROLLED  => "Enrolled",
            self::REFERRAL_STATUS_DISCHARGE => "Discharge",
            self::REFERRAL_STATUS_DECLINED  => "Declined",
            // self::REFERRAL_STATUS_RE_REFER  => "Re-refer",
        ];

        return $type ? $types[$type] : $types;
    }

    public const REFERRAL_DECLINED_BY_KAIMAHI = 'kaimahi';
    public const REFERRAL_DECLINED_BY_CLIENT = 'client';

    public static function getReferralDeclinedBy(string $type = null)
    {
        $types = [
            self::REFERRAL_DECLINED_BY_KAIMAHI => "Kaimahi",
            self::REFERRAL_DECLINED_BY_CLIENT  => "Client",
        ];

        return $type ? $types[$type] : $types;
    }

    public const HAUORA_PLAN_TYPE_JOINT = 'joint';
    public const HAUORA_PLAN_TYPE_INDIVIDUAL = 'individual';

    public static function getHauoraPlanType(string $type = null)
    {
        $types = [
            self::HAUORA_PLAN_TYPE_JOINT      => "Joint",
            self::HAUORA_PLAN_TYPE_INDIVIDUAL => "Individual",
        ];

        return $type ? $types[$type] : $types;
    }

    public const HAUORA_PLAN_STATUS_ACTIVE = 'active';
    public const HAUORA_PLAN_STATUS_HOLD = 'hold';
    public const HAUORA_PLAN_STATUS_COMPLETED = 'completed';

    public static function getHauoraPlanStatus(string $type = null)
    {
        $types = [
            self::HAUORA_PLAN_STATUS_ACTIVE    => "Active",
            self::HAUORA_PLAN_STATUS_HOLD      => "Hold",
            self::HAUORA_PLAN_STATUS_COMPLETED => "Completed",
        ];

        return $type ? $types[$type] : $types;
    }

    public const ATTENDANCE_TYPE_EMPLOYEE = 'employee';
    public const ATTENDANCE_TYPE_VISITOR = 'visitor';

    public static function getAttendanceType(string $type = null)
    {
        $types = [
            self::ATTENDANCE_TYPE_EMPLOYEE => "Employee",
            self::ATTENDANCE_TYPE_VISITOR  => "Visitor",
        ];

        return $type ? $types[$type] : $types;
    }


    public const SIGN_OUT_TYPE_LEAVING = 'leaving';
    public const SIGN_OUT_TYPE_BREAK = 'break';
    public const SIGN_OUT_TYPE_HOME_VISIT = 'home_visit';
    public const SIGN_OUT_TYPE_HOSPITAL_VISIT = 'hospital_visit';
    public const SIGN_OUT_TYPE_TRAVELING_OTHER_OFFICE = 'traveling_other_office';

    public static function getSignOutType(string $type = null)
    {
        $types = [
            self::SIGN_OUT_TYPE_LEAVING                => "Leaving",
            self::SIGN_OUT_TYPE_BREAK                  => "Break",
            self::SIGN_OUT_TYPE_HOME_VISIT             => "Home Visit",
            self::SIGN_OUT_TYPE_HOSPITAL_VISIT         => "Hospital Visit",
            self::SIGN_OUT_TYPE_TRAVELING_OTHER_OFFICE => "Traveling to Other Office",
        ];

        return $type ? $types[$type] : $types;
    }

    /* ============== TICKET MODULE ===================*/
    public const TICKET_STATUS_OPEN = 1;
    public const TICKET_STATUS_HOLD = 2;
    public const TICKET_STATUS_CLOSED = 3;

    public static function getTicketStatus(int $status = null)
    {
        $status_arr = [
            self::TICKET_STATUS_OPEN   => 'Open',
            self::TICKET_STATUS_HOLD   => 'Hold',
            self::TICKET_STATUS_CLOSED => 'Closed',
        ];

        return $status ? $status_arr[$status] : $status_arr;
    }

    public const TICKET_PRIORITY_LOW = 1;
    public const TICKET_PRIORITY_MEDIUM = 2;
    public const TICKET_PRIORITY_HIGH = 3;

    public static function getTicketPriority(int $priority = 0)
    {
        $priority_arr = [
            self::TICKET_PRIORITY_LOW    => "Low",
            self::TICKET_PRIORITY_MEDIUM => "Medium",
            self::TICKET_PRIORITY_HIGH   => 'High'
        ];

        return $priority ? $priority_arr[$priority] : $priority_arr;
    }

    /* ============== CONFIG MODULE ===================*/
    public const CONFIG_DROPDOWN_EMP_DESIGNATION = 'emp_designation';
    public const CONFIG_DROPDOWN_TICKET_DEPARTMENT = 'ticket_department';
    public const CONFIG_DROPDOWN_NOTIFICATION_TYPE = 'notification_type';
    public const CONFIG_DROPDOWN_AMS_BRAND = 'ams_brand';
    public const CONFIG_DROPDOWN_AMS_LOCATION = 'location';
    public const CONFIG_DROPDOWN_GENDER = 'gender';
    public const CONFIG_DROPDOWN_PRONOUN = 'pronoun';
    public const CONFIG_DROPDOWN_ETHNICITY = 'ethnicity';
    public const CONFIG_DROPDOWN_IWI = 'iwi';
    public const CONFIG_DROPDOWN_JOB_TITLE = 'job_title';
    public const CONFIG_DROPDOWN_EMPLOYMENT_STATUS = 'employment_status';
    public const CONFIG_DROPDOWN_ENTITLEMENT_TO_WORK = 'entitlement_to_work';
    public const CONFIG_DROPDOWN_TYPE_OF_CERTIFICATION = 'type_of_certification';
    public const CONFIG_DROPDOWN_PRESCRIPTION_CATEGORY = 'prescription_category';
    public const CONFIG_DROPDOWN_ALERT_CATEGORY = 'alert_category';
    public const CONFIG_DROPDOWN_SUPPLIER_TYPE = 'supplier_type';

    public static function getConfigDropdown(string $key = null)
    {
        $dropdowns = [
            self::CONFIG_DROPDOWN_EMP_DESIGNATION       => "Employee Designation",
            self::CONFIG_DROPDOWN_TICKET_DEPARTMENT     => "Ticket Department",
            self::CONFIG_DROPDOWN_NOTIFICATION_TYPE     => "Notification Type",
            self::CONFIG_DROPDOWN_AMS_BRAND             => "Brand",
            self::CONFIG_DROPDOWN_GENDER                => "Gender",
            self::CONFIG_DROPDOWN_PRONOUN               => "Pronoun",
            self::CONFIG_DROPDOWN_ETHNICITY             => "Ethnicity",
            self::CONFIG_DROPDOWN_IWI                   => "Iwi",
            self::CONFIG_DROPDOWN_JOB_TITLE             => "Job Title",
            self::CONFIG_DROPDOWN_EMPLOYMENT_STATUS     => "Employment Status",
            self::CONFIG_DROPDOWN_ENTITLEMENT_TO_WORK   => "Entitlement To Work",
            self::CONFIG_DROPDOWN_TYPE_OF_CERTIFICATION => "Type Of Certification",
            self::CONFIG_DROPDOWN_PRESCRIPTION_CATEGORY => "Note Type",
            self::CONFIG_DROPDOWN_ALERT_CATEGORY        => "Alert Category",
            self::CONFIG_DROPDOWN_SUPPLIER_TYPE         => "Supplier Type",
        ];

        return $key ? $dropdowns[$key] : $dropdowns;
    }

    /* ============== END ===================*/

    public static function systemShortcodesWithValues()
    {
        return [
            'current_date'     => now()->format('Y-m-d'),
            'current_datetime' => '',
            'current_time'     => '',
            'system_url'       => '',
            'app_name'         => ''
        ];
    }

    // Categories entry type
    public const CATEGORY_BULK = 0;
    public const CATEGORY_INDIVIDUAL = 1;

    public static function getCategoryEntryType(int $type = null)
    {
        $types = [
            self::CATEGORY_BULK       => "Bulk",
            self::CATEGORY_INDIVIDUAL => "Individual",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    // Stock status
    public const STOCK_AVAILABLE = 1;
    public const STOCK_ASSIGNED = 2;
    public const STOCK_WARRANTY = 3;
    public const STOCK_DAMAGED = 4;
    public const STOCK_MISSING = 5;
    public const STOCK_EXPIRED = 6;
    public const STOCK_RETURN = 7;
    public const STOCK_OUT = 8;

    public static function getStockStatus(int $type = null)
    {
        $types = [
            self::STOCK_AVAILABLE => "Available",
            self::STOCK_ASSIGNED  => "Assigned",
            self::STOCK_WARRANTY  => "Warranty",
            self::STOCK_DAMAGED   => "Damaged",
            self::STOCK_MISSING   => "Missing",
            self::STOCK_EXPIRED   => "Expired",
            self::STOCK_RETURN    => "Returned",
            self::STOCK_OUT       => "Stock Out",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }


    // Blood Group
    public const BLOOD_GROUP_A_POSITIVE = 'A+';
    public const BLOOD_GROUP_A_NEGATIVE = 'A-';
    public const BLOOD_GROUP_B_POSITIVE = 'B+';
    public const BLOOD_GROUP_B_NEGATIVE = 'B-';
    public const BLOOD_GROUP_O_POSITIVE = 'O+';
    public const BLOOD_GROUP_O_NEGATIVE = 'O-';
    public const BLOOD_GROUP_AB_POSITIVE = 'AB+';
    public const BLOOD_GROUP_AB_NEGATIVE = 'AB-';

    public static function getBloodGroup(string $type = null)
    {
        $types = [
            self::BLOOD_GROUP_A_POSITIVE  => "A+",
            self::BLOOD_GROUP_A_NEGATIVE  => "A-",
            self::BLOOD_GROUP_B_POSITIVE  => "B+",
            self::BLOOD_GROUP_B_NEGATIVE  => "B-",
            self::BLOOD_GROUP_O_POSITIVE  => "O+",
            self::BLOOD_GROUP_O_NEGATIVE  => "O-",
            self::BLOOD_GROUP_AB_POSITIVE => "AB+",
            self::BLOOD_GROUP_AB_NEGATIVE => "AB-",
        ];

        return $type ? $types[$type] : $types;
    }
    // Post Type
    public const POST_TYPE_POLICY = 'policy';
    public const POST_TYPE_TRAINING = 'training';

    public static function getPostType(string $type = null)
    {
        $types = [
            self::POST_TYPE_POLICY   => "Policy",
            self::POST_TYPE_TRAINING => "Training",
        ];

        return $type ? $types[$type] : $types;
    }
}
