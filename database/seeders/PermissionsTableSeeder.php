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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 34,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 35,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 36,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 37,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 38,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 39,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 40,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 41,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 42,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 43,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 44,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 45,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 46,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 47,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 48,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 49,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 50,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 51,
                'title' => 'transaction_access',
            ],
            [
                'id'    => 52,
                'title' => 'transaction_type_create',
            ],
            [
                'id'    => 53,
                'title' => 'transaction_type_edit',
            ],
            [
                'id'    => 54,
                'title' => 'transaction_type_access',
            ],
            [
                'id'    => 55,
                'title' => 'test_create',
            ],
            [
                'id'    => 56,
                'title' => 'test_edit',
            ],
            [
                'id'    => 57,
                'title' => 'test_show',
            ],
            [
                'id'    => 58,
                'title' => 'test_delete',
            ],
            [
                'id'    => 59,
                'title' => 'test_access',
            ],
            [
                'id'    => 60,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
