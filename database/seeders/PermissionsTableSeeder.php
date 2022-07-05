<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 34,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 35,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 36,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 37,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 38,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 39,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 40,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 41,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 42,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 43,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 44,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 45,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 46,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 47,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 48,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 49,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 50,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 51,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 52,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 53,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 54,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 55,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 56,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 57,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 58,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 59,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 60,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 61,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 62,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 63,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 64,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 65,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 66,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 67,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 68,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 69,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 70,
                'title' => 'review_create',
            ],
            [
                'id'    => 71,
                'title' => 'review_edit',
            ],
            [
                'id'    => 72,
                'title' => 'review_show',
            ],
            [
                'id'    => 73,
                'title' => 'review_delete',
            ],
            [
                'id'    => 74,
                'title' => 'review_access',
            ],
            [
                'id'    => 75,
                'title' => 'order_create',
            ],
            [
                'id'    => 76,
                'title' => 'order_edit',
            ],
            [
                'id'    => 77,
                'title' => 'order_show',
            ],
            [
                'id'    => 78,
                'title' => 'order_delete',
            ],
            [
                'id'    => 79,
                'title' => 'order_access',
            ],
            [
                'id'    => 80,
                'title' => 'transaction_create',
            ],
            [
                'id'    => 81,
                'title' => 'transaction_edit',
            ],
            [
                'id'    => 82,
                'title' => 'transaction_show',
            ],
            [
                'id'    => 83,
                'title' => 'transaction_delete',
            ],
            [
                'id'    => 84,
                'title' => 'transaction_access',
            ],
            [
                'id'    => 85,
                'title' => 'blog_management_access',
            ],
            [
                'id'    => 86,
                'title' => 'blog_create',
            ],
            [
                'id'    => 87,
                'title' => 'blog_edit',
            ],
            [
                'id'    => 88,
                'title' => 'blog_show',
            ],
            [
                'id'    => 89,
                'title' => 'blog_delete',
            ],
            [
                'id'    => 90,
                'title' => 'blog_access',
            ],
            [
                'id'    => 91,
                'title' => 'type_create',
            ],
            [
                'id'    => 92,
                'title' => 'type_edit',
            ],
            [
                'id'    => 93,
                'title' => 'type_show',
            ],
            [
                'id'    => 94,
                'title' => 'type_delete',
            ],
            [
                'id'    => 95,
                'title' => 'type_access',
            ],
            [
                'id'    => 96,
                'title' => 'chat_create',
            ],
            [
                'id'    => 97,
                'title' => 'chat_edit',
            ],
            [
                'id'    => 98,
                'title' => 'chat_show',
            ],
            [
                'id'    => 99,
                'title' => 'chat_delete',
            ],
            [
                'id'    => 100,
                'title' => 'chat_access',
            ],
            [
                'id'    => 101,
                'title' => 'setting_create',
            ],
            [
                'id'    => 102,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 103,
                'title' => 'setting_show',
            ],
            [
                'id'    => 104,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 105,
                'title' => 'setting_access',
            ],
            [
                'id'    => 106,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
