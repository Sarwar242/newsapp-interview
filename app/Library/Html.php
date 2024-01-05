<?php

namespace App\Library;

class Html
{
    public static function linkBack(string $route)
    {
        return '<a href="' . $route . '" class="btn btn-sm btn2-secondary btn-back "><i class="fas fa-long-arrow-alt-left"></i> Back</a>';
    }

    public static function linkAdd(string $route, string $label, string $size = 'btn-sm')
    {
        return '<a href="' . $route . '" class="btn btn-sm btn2-secondary ' . $size . '"><i class="fas fa-plus"></i> ' . $label . '</a>';
    }

    public static function btnSubmit($size = '')
    {
        return '<button type="submit" class="btn mr-3 my-3 btn2-secondary ' . $size . '"><i class="fas fa-save"></i> Save</button>';
    }

    public static function btnReset()
    {
        return '<button type="reset" class="btn mr-3 my-3 btn2-light-secondary"><i class="fas fa-sync-alt"></i> Reset</button>';
    }

    public static function btnClose()
    {
        return '<button type="button" class="btn btn2-light-secondary mr-3 btn-close" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>';
    }

    public static function btnSignIN($size = '')
    {
        return '<button type="submit" class="btn mr-3 my-3 btn2-secondary ' . $size . '"><i class="fa-solid fa-right-to-bracket"></i> Sign In </button>';
    }

    public static function btnSignOut($size = '')
    {
        return '<button type="submit" class="btn mr-3 my-3 btn2-danger-active ' . $size . '"><i class="fa-solid fa-right-from-bracket"></i> Sign Out </button>';
    }

    public static function stockStatusBadge($status)
    {
        $class = [
            Enum::STOCK_AVAILABLE => 'btn2-secondary',
            Enum::STOCK_ASSIGNED  => 'btn-primary',
            Enum::STOCK_WARRANTY  => 'btn-secondary',
            Enum::STOCK_DAMAGED   => 'btn-warning',
            Enum::STOCK_MISSING   => 'btn-dark',
            Enum::STOCK_EXPIRED   => 'btn-danger',
            Enum::STOCK_RETURN    => 'btn2-secondary',
            Enum::STOCK_OUT       => 'btn2-secondary',
        ];

        return '<span class="badge ' . $class[$status] . '">' . Enum::getStockStatus($status) . '</span>';
    }

    public static function ReferralStatusBadge($status)
    {
        $class = [
            Enum::REFERRAL_STATUS_ENROLLED  => 'badge-success',
            Enum::REFERRAL_STATUS_DECLINED  => 'badge-danger',
            Enum::REFERRAL_STATUS_DISCHARGE => 'badge-info',
            'Re-refer'                      => 'badge-warning',
        ];

        return '<div class="badge ' . $class[$status] . '">' . ucwords($status) . '</div>';
    }
    
    public static function ReferralStatusClass($status)
    {
        $class = [
            Enum::REFERRAL_STATUS_ENROLLED  => 'success',
            Enum::REFERRAL_STATUS_DECLINED  => 'danger',
            Enum::REFERRAL_STATUS_DISCHARGE => 'info',
            'Re-refer'                      => 'warning',
        ];

        return $class[$status];
    }

    public static function AcknoledgementStatus($status)
    {
        if($status == 1) {
            $badge = '<div class="badge btn2-secondary"> Accept </div>';
        } else {
            $badge = '<div class="badge badge-danger">Pending</div>';
        }

        return $badge;
    }

    public static function ImmunizationStatus($status)
    {
        if($status == Enum::IMMUNIZATION_STATUS_COMPLETE) {
            $badge = '<div class="badge btn2-secondary"> Complete </div>';
        } elseif($status == Enum::IMMUNIZATION_STATUS_PENDING) {
            $badge = '<div class="badge badge-warning">Pending</div>';
        } else {
            $badge = '<div class="badge badge-danger">Canceled</div>';
        }

        return $badge;
    }

}
