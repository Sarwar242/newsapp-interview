import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        laravel([
            'resources/js/app.js',
            'resources/admin_assets/js/select2.js',

            //Admin Main
            'resources/admin_assets/sass/app.scss',
            'resources/admin_assets/js/app.js',

            // Public
            'resources/admin_assets/js/public/pages/inOut/index.js',

            // Address
            'resources/admin_assets/js/pages/address/autofill.js',
            'resources/admin_assets/js/pages/address/index.js',

            // AMS
            'resources/admin_assets/js/pages/ams/category/index.js',

            'resources/admin_assets/js/pages/ams/category_type/index.js',

            'resources/admin_assets/js/pages/ams/product/create.js',
            'resources/admin_assets/js/pages/ams/product/index.js',

            'resources/admin_assets/js/pages/ams/room/index.js',

            'resources/admin_assets/js/pages/ams/stock/index.js',
            'resources/admin_assets/js/pages/ams/stock/create.js',
            'resources/admin_assets/js/pages/ams/stock/edit.js',

            'resources/admin_assets/js/pages/ams/stock_assign/index.js',
            'resources/admin_assets/js/pages/ams/stock_assign/create.js',

            'resources/admin_assets/js/pages/ams/stock_testing/index.js',
            'resources/admin_assets/js/pages/ams/stock_testing/show.js',

            'resources/admin_assets/js/pages/ams/stock_transfer/index.js',
            'resources/admin_assets/js/pages/ams/stock_transfer/create.js',

            'resources/admin_assets/js/pages/ams/supplier/index.js',

            // All Attendance
            'resources/admin_assets/js/pages/attendance/index.js',
            'resources/admin_assets/js/pages/attendance/alert.js',

            // Block User
            'resources/admin_assets/js/pages/block_user/index.js',
            'resources/admin_assets/js/pages/block_user/create.js',

            // Client Profile Visiting
            'resources/admin_assets/js/pages/client_profile_visiting_history/index.js',

            // Config
            'resources/admin_assets/js/pages/config/alert/index.js',

            'resources/admin_assets/js/pages/config/dropdown/index.js',
            'resources/admin_assets/js/pages/config/dropdown/list.js',

            'resources/admin_assets/js/pages/config/email/index.js',

            'resources/admin_assets/js/pages/config/email_signature/index.js',
            'resources/admin_assets/js/pages/config/email_signature/update.js',

            'resources/admin_assets/js/pages/config/email_template/index.js',
            'resources/admin_assets/js/pages/config/email_template/update.js',

            'resources/admin_assets/js/pages/config/role/index.js',

            'resources/admin_assets/js/pages/config/service/create.js',
            'resources/admin_assets/js/pages/config/service/index.js',

            'resources/admin_assets/js/pages/config/location/index.js',

            //===== Employee Start ======//
            'resources/admin_assets/js/pages/employee/index.js',
            'resources/admin_assets/js/pages/employee/create.js',
            'resources/admin_assets/js/pages/employee/update.js',
            'resources/admin_assets/js/pages/employee/show.js',
            'resources/admin_assets/js/pages/employee/ticket/index.js',
            // Employee Attachment
            'resources/admin_assets/js/pages/employee/attachment/index.js',
            // Employee Attendance
            'resources/admin_assets/js/pages/employee/attendance/index.js',
            // Employee Certificates
            'resources/admin_assets/js/pages/employee/certificates/index.js',
            // Employee Post
            'resources/admin_assets/js/pages/employee/post/index.js',
            // Employee Ticket
            'resources/admin_assets/js/pages/employee/ticket/index.js',

            'resources/admin_assets/js/jquery.easing.js',
            //===== Employee End ======//

            // Event
            // 'resources/admin_assets/js/pages/event/index.js',
            // 'resources/admin_assets/js/pages/event/create.js',

            // Expense
            'resources/admin_assets/js/pages/expense/index.js',
            'resources/admin_assets/js/pages/expense/create.js',
            'resources/admin_assets/js/pages/expense/salary/index.js',
            'resources/admin_assets/js/pages/expense/salary/create.js',

            // FAQ
            // 'resources/admin_assets/js/pages/faq/index.js',

            // Logs
            'resources/admin_assets/js/pages/logs/activity_log.js',
            'resources/admin_assets/js/pages/logs/login_history.js',
            'resources/admin_assets/js/pages/logs/email_history.js',

            //========== Member Start ============//
            'resources/admin_assets/js/pages/member/index.js',
            'resources/admin_assets/js/pages/member/create.js',
            'resources/admin_assets/js/pages/member/update.js',
            'resources/admin_assets/js/pages/member/show.js',
            //Client Attachment
            'resources/admin_assets/js/pages/member/attachment/index.js',
            // Client alert
            'resources/admin_assets/js/pages/member/client_alert/index.js',
            // Client Family Tree
            'resources/admin_assets/js/pages/member/family/index.js',
            'resources/admin_assets/js/pages/member/family/familyTree.js',
            // Client Hauora Plan
            'resources/admin_assets/js/pages/member/hauora_plan/index.js',
            'resources/admin_assets/js/pages/member/hauora_plan/create.js',
            'resources/admin_assets/js/pages/member/hauora_plan/show.js',
            //Client house Hold
            'resources/admin_assets/js/pages/member/house_hold/index.js',
            //Client Immunization
            'resources/admin_assets/js/pages/member/immunization/index.js',
            'resources/admin_assets/js/pages/member/immunization/create.js',
            'resources/admin_assets/js/pages/member/immunization/show.js',
            //Client Medication
            'resources/admin_assets/js/pages/member/medication/index.js',
            'resources/admin_assets/js/pages/member/medication/create.js',
            //Client prescription
            'resources/admin_assets/js/pages/member/prescription/create.js',
            'resources/admin_assets/js/pages/member/prescription/update.js',
            // Client Referral
            'resources/admin_assets/js/pages/member/referral/index.js',
            'resources/admin_assets/js/pages/member/referral/create.js',
            'resources/admin_assets/js/pages/member/referral/update.js',
            'resources/admin_assets/js/pages/member/referral/show.js',
            //========== Member End ============//

            // Notifications
            'resources/admin_assets/js/pages/notification/index.js',
            'resources/admin_assets/js/pages/notification/create.js',

             // Post
            'resources/admin_assets/js/pages/post/create.js',
            'resources/admin_assets/js/pages/post/index.js',
            'resources/admin_assets/js/pages/post/show.js',
            'resources/admin_assets/js/pages/post/update.js',

            //Profile
            'resources/admin_assets/js/pages/profile/all_nofification.js',

            // Admin Referral
            'resources/admin_assets/js/pages/referral/index.js',

            // Tickets
            'resources/admin_assets/js/pages/ticket/index.js',
            'resources/admin_assets/js/pages/ticket/create.js',
            'resources/admin_assets/js/pages/ticket/show.js',

            // Report
            'resources/admin_assets/js/pages/report/user.js',
            'resources/admin_assets/js/pages/report/referral.js',
            'resources/admin_assets/js/pages/report/ams.js',
            'resources/admin_assets/js/pages/report/note.js',
            'resources/admin_assets/js/pages/report/contact.js',
            'resources/admin_assets/js/pages/report/referral_list.js',
            'resources/admin_assets/js/pages/report/alert.js',

            // ************************************************
            //                  Employee Panel
            // ************************************************
            // Employee Dashboard
            'resources/employee_assets/js/index.js',
            'resources/employee_assets/js/create.js',
            'resources/employee_assets/js/update.js',
            'resources/employee_assets/js/show.js',

            // Employee Attachment
            'resources/employee_assets/js/attachment/index.js',
            // Employee Attendance
            'resources/employee_assets/js/attendance/index.js',
            // Employee Certificates
            'resources/employee_assets/js/certificates/index.js',
            // Employee Post
            'resources/employee_assets/js/post/index.js',
            // Employee Ticket
            'resources/employee_assets/js/ticket/index.js',
            'resources/employee_assets/js/ticket/create.js',
            'resources/employee_assets/js/ticket/show.js',
            'resources/employee_assets/js/ticket/assigned.js',

            // Employee Notification
            'resources/employee_assets/js/notification/index.js',

            // REFERRALS
            'resources/employee_assets/js/referral/index.js',
            'resources/employee_assets/js/referral/show.js',
            'resources/employee_assets/js/ams/stock_assign/index.js',

            // Member-> IMMUNIZATION
            'resources/employee_assets/js/member/immunization/show.js',

        ]),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js',
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '@': '/resources/js',
        }
    },
    build: {
        rollupOptions: {
            output: {
                assetFileNames: (asset) => {
                    let typePath = 'styles'
                    const type = asset.name.split('.').at(1)
                    if (/png|jpe?g|webp|svg|gif|tiff|bmp|ico/i.test(type)) {
                        typePath = 'images'
                    }
                    return `${typePath}/[name]-[hash][extname]`
                },
                chunkFileNames: 'scripts/chunks/[name]-[hash].js',
                entryFileNames: 'scripts/[name]-[hash].js',
            },
        },
    },
});
