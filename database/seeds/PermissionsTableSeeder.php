<?php

use Illuminate\Database\Seeder;
use App\Models\System\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * 后台首页
         */
        Permission::create([
            'id' => 1,
            'name' => 'admin',
            'label' => '首页',
            'parent_id' => 0,
            'icon' => 'am-icon-home',
            'sort_order' => 1
        ]);
        /**
         * 系统管理
         */
        Permission::create([
            'id' => 2,
            'name' => 'system',
            'label' => '系统管理',
            'parent_id' => 0,
            'icon' => 'am-icon-gear am-icon-spin',
            'sort_order' => 2
        ]);

        /**
         * 菜单与权限
         */
        Permission::create([
            'id' => 3,
            'name' => 'system.permission.index',
            'label' => '菜单与权限',
            'parent_id' => 2,
            'icon' => 'am-icon-lock',
            'sort_order' => 3
        ]);
        /*菜单与权限（删除）*/
        Permission::create([
            'id' => 4,
            'name' => 'system.permission.destroy',
            'label' => '删除',
            'parent_id' => 3,
        ]);
        /*菜单与权限（保存）*/
        Permission::create([
            'id' => 5,
            'name' => 'system.permission.store',
            'label' => '保存',
            'parent_id' => 3,
        ]);
        /*菜单与权限（新增）*/
        Permission::create([
            'id' => 6,
            'name' => 'system.permission.create',
            'label' => '新增',
            'parent_id' => 3,
        ]);
        /* 菜单与权限（编辑）*/
        Permission::create([
            'id' => 7,
            'name' => 'system.permission.edit',
            'label' => '编辑',
            'parent_id' => 3,
        ]);
        /*菜单与权限（更新）*/
        Permission::create([
            'id' => 8,
            'name' => 'system.permission.update',
            'label' => '更新',
            'parent_id' => 3,
        ]);
        /* 菜单与权限（排序）*/
        Permission::create([
            'id' => 9,
            'name' => 'system.permission.sort_order',
            'label' => '排序',
            'parent_id' => 3,
        ]);
        /**
         * 用户管理
         */
        Permission::create([
            'id' => 10,
            'name' => 'system.user.index',
            'label' => '用户管理',
            'parent_id' => 2,
            'icon' => 'am-icon-user',
            'sort_order' => 4
        ]);
        /*用户管理（删除）*/
        Permission::create([
            'id' => 11,
            'name' => 'system.user.destroy',
            'label' => '删除',
            'parent_id' => 10,
        ]);
        /*用户管理（保存）*/
        Permission::create([
            'id' => 12,
            'name' => 'system.user.store',
            'label' => '保存',
            'parent_id' => 10,
        ]);
        /*用户管理（新增）*/
        Permission::create([
            'id' => 13,
            'name' => 'system.user.create',
            'label' => '新增',
            'parent_id' => 10,
        ]);
        /* 用户管理（编辑）*/
        Permission::create([
            'id' => 14,
            'name' => 'system.user.edit',
            'label' => '编辑',
            'parent_id' => 10,
        ]);
        /*用户管理（更新）*/
        Permission::create([
            'id' => 15,
            'name' => 'system.user.update',
            'label' => '更新',
            'parent_id' => 10,
        ]);

        /**
         * 用户组管理
         */
        Permission::create([
            'id' => 16,
            'name' => 'system.role.index',
            'label' => '用户组管理',
            'parent_id' => 2,
            'icon' => 'am-icon-users',
            'sort_order' => 5
        ]);
        /*用户组管理（删除）*/
        Permission::create([
            'id' => 17,
            'name' => 'system.role.destroy',
            'label' => '删除',
            'parent_id' => 16,
        ]);
        /*用户组管理（保存）*/
        Permission::create([
            'id' => 18,
            'name' => 'system.role.store',
            'label' => '保存',
            'parent_id' => 16,
        ]);
        /*用户组管理（新增）*/
        Permission::create([
            'id' => 19,
            'name' => 'system.role.create',
            'label' => '新增',
            'parent_id' => 16,
        ]);
        /* 用户组管理（编辑）*/
        Permission::create([
            'id' => 20,
            'name' => 'system.role.edit',
            'label' => '编辑',
            'parent_id' => 16,
        ]);
        /*用户组管理（更新）*/
        Permission::create([
            'id' => 21,
            'name' => 'system.role.update',
            'label' => '更新',
            'parent_id' => 16,
        ]);
        /**
         * 系统设置
         */
        Permission::create([
            'id' => 22,
            'name' => 'system.config.edit',
            'label' => '系统设置',
            'parent_id' => 2,
            'icon' => 'am-icon-desktop',
            'sort_order' => 6
        ]);
        /*系统设置（更新）*/
        Permission::create([
            'id' => 23,
            'name' => 'system.config.update',
            'label' => '更新',
            'parent_id' =>22,
        ]);

        /**
         * 缓存管理
         */
        Permission::create([
            'id' => 24,
            'name' => 'system.cache.index',
            'label' => '缓存管理',
            'parent_id' => 2,
            'icon' => 'am-icon-refresh am-icon-spin',
            'sort_order' => 8
        ]);
        /*缓存管理（删除）*/
        Permission::create([
            'id' => 25,
            'name' => 'system.cache.destroy',
            'label' => '删除',
            'parent_id' => 24,
        ]);

        /**
         * 文件管理
         */
        Permission::create([
            'id' => 26,
            'name' => 'system.photo.index',
            'label' => '文件管理',
            'parent_id' => 2,
            'icon' => 'am-icon-file-image-o',
            'sort_order' => 7
        ]);
        /*文件管理（上传网站图标）*/
        Permission::create([
            'id' => 27,
            'name' => 'system.photo.upload_icon',
            'label' => '上传网站图标',
            'parent_id' => 26,
        ]);
        /*文件管理（上传网站背景图）*/
        Permission::create([
            'id' => 28,
            'name' => 'system.photo.upload_background_img',
            'label' => '上传网站背景图',
            'parent_id' => 26,
        ]);
        /*文件管理（上传文件）*/
        Permission::create([
            'id' => 29,
            'name' => 'system.photo.upload',
            'label' => '上传文件',
            'parent_id' => 26,
        ]);
        /*文件管理（读取文件）*/
        Permission::create([
            'id' => 30,
            'name' => 'system.photo.get_contents',
            'label' => '读取文件',
            'parent_id' => 26,
        ]);
        /*文件管理（上传公共文件）*/
        Permission::create([
            'id' => 31,
            'name' => 'system.photo.upload_public',
            'label' => '上传公共文件',
            'parent_id' => 26,
        ]);
        /*文件管理（删除文件）*/
        Permission::create([
            'id' => 32,
            'name' => 'system.photo.destroy_file',
            'label' => '删除文件',
            'parent_id' => 26,
        ]);
        /*文件管理（更新文件）*/
        Permission::create([
            'id' => 33,
            'name' => 'system.photo.update_file',
            'label' => '更新文件',
            'parent_id' => 26,
        ]);
        /*文件管理（上传图片文件）*/
        Permission::create([
            'id' => 34,
            'name' => 'system.photo.upload_img',
            'label' => '上传图片文件',
            'parent_id' => 26,
        ]);

        /*用户管理（更新属性）*/
        Permission::create([
            'id' => 35,
            'name' => 'system.user.is_something',
            'label' => '更新属性',
            'parent_id' => 10,
        ]);

        /**
         * 内容管理
         */
        Permission::create([
            'id' => 36,
            'name' => 'cms',
            'label' => '内容管理',
            'parent_id' => 0,
            'icon' => 'am-icon-paper-plane',
        ]);
        /*
         * 文章管理
         */
        Permission::create([
            'id' => 37,
            'name' => 'cms.article.index',
            'label' => '文章管理',
            'parent_id' => 36,
            'icon' => 'am-icon-code-fork',
        ]);
        /*文章管理（新增）*/
        Permission::create([
            'id' => 38,
            'name' => 'cms.article.create',
            'label' => '新增',
            'parent_id' => 37,
        ]);
        /*文章管理（保存）*/
        Permission::create([
            'id' => 39,
            'name' => 'cms.article.store',
            'label' => '保存',
            'parent_id' => 37,
        ]);
        /*文章管理（更新属性）*/
        Permission::create([
            'id' => 40,
            'name' => 'cms.article.is_something',
            'label' => '更新属性',
            'parent_id' => 37,
        ]);
        /*文章管理（编辑）*/
        Permission::create([
            'id' => 41,
            'name' => 'cms.article.edit',
            'label' => '编辑',
            'parent_id' => 37,
        ]);
        /*文章管理（更新）*/
        Permission::create([
            'id' => 42,
            'name' => 'cms.article.update',
            'label' => '更新',
            'parent_id' => 37,
        ]);
        /*文章管理（软删除）*/
        Permission::create([
            'id' => 43,
            'name' => 'cms.article.destroy',
            'label' => '软删除',
            'parent_id' => 37,
        ]);
        /*文章管理（多选软删除）*/
        Permission::create([
            'id' => 44,
            'name' => 'cms.article.destroy_checked',
            'label' => '多选软删除',
            'parent_id' => 37,
        ]);
        /*文章管理（回收站）*/
        Permission::create([
            'id' => 45,
            'name' => 'cms.article.trash',
            'label' => '回收站',
            'parent_id' => 37,
        ]);
        /*文章管理（恢复）*/
        Permission::create([
            'id' => 46,
            'name' => 'cms.article.restore',
            'label' => '恢复',
            'parent_id' => 37,
        ]);
        /*文章管理（多选恢复）*/
        Permission::create([
            'id' => 47,
            'name' => 'cms.article.restore_checked',
            'label' => '多选恢复',
            'parent_id' => 37,
        ]);
        /*文章管理（删除）*/
        Permission::create([
            'id' => 48,
            'name' => 'cms.article.force_destroy',
            'label' => '删除',
            'parent_id' => 37,
        ]);
        /*文章管理（多选删除）*/
        Permission::create([
            'id' => 49,
            'name' => 'cms.article.force_destroy_checked',
            'label' => '多选删除',
            'parent_id' => 37,
        ]);
        /*
       * 栏目管理
       */
        Permission::create([
            'id' => 50,
            'name' => 'cms.category.index',
            'label' => '栏目管理',
            'parent_id' => 36,
            'icon' => 'am-icon-code-fork',
        ]);
        /*栏目管理（新增）*/
        Permission::create([
            'id' => 51,
            'name' => 'cms.category.create',
            'label' => '新增',
            'parent_id' => 50,
        ]);
        /*栏目管理（保存）*/
        Permission::create([
            'id' => 52,
            'name' => 'cms.category.store',
            'label' => '保存',
            'parent_id' => 50,
        ]);
        /*栏目管理（更新属性）*/
        Permission::create([
            'id' => 53,
            'name' => 'cms.category.is_something',
            'label' => '更新属性',
            'parent_id' => 50,
        ]);
        /*栏目管理（编辑）*/
        Permission::create([
            'id' => 54,
            'name' => 'cms.category.edit',
            'label' => '编辑',
            'parent_id' => 50,
        ]);
        /*栏目管理（更新）*/
        Permission::create([
            'id' => 55,
            'name' => 'cms.category.update',
            'label' => '更新',
            'parent_id' => 50,
        ]);
        /*栏目管理（删除）*/
        Permission::create([
            'id' => 56,
            'name' => 'cms.category.destroy',
            'label' => '删除',
            'parent_id' => 50,
        ]);

        /*文章管理（查看）*/
        Permission::create([
            'id' => 57,
            'name' => 'cms.article.show',
            'label' => '多选删除',
            'parent_id' => 37,
        ]);


        /**
         * 商城管理
         */
        Permission::create([
            'id' => 58,
            'name' => 'shop',
            'label' => '商城管理',
            'parent_id' => 0,
            'icon' => 'am-icon-paper-plane',
        ]);
        /*
         * 商品管理
         */
        Permission::create([
            'id' => 59,
            'name' => 'shop.product.index',
            'label' => '商品管理',
            'parent_id' => 58,
            'icon' => 'am-icon-code-fork',
        ]);
        /*商品管理（新增）*/
        Permission::create([
            'id' => 60,
            'name' => 'shop.product.create',
            'label' => '新增',
            'parent_id' => 59,
        ]);
        /*商品管理（保存）*/
        Permission::create([
            'id' => 61,
            'name' => 'shop.product.store',
            'label' => '保存',
            'parent_id' => 59,
        ]);
        /*商品管理（更新属性）*/
        Permission::create([
            'id' => 62,
            'name' => 'shop.product.is_something',
            'label' => '更新属性',
            'parent_id' => 59,
        ]);
        /*商品管理（编辑）*/
        Permission::create([
            'id' => 63,
            'name' => 'shop.product.edit',
            'label' => '编辑',
            'parent_id' => 59,
        ]);
        /*商品管理（更新）*/
        Permission::create([
            'id' => 64,
            'name' => 'shop.product.update',
            'label' => '更新',
            'parent_id' => 59,
        ]);
        /*商品管理（软删除）*/
        Permission::create([
            'id' => 65,
            'name' => 'shop.product.destroy',
            'label' => '软删除',
            'parent_id' => 59,
        ]);
        /*商品管理（多选软删除）*/
        Permission::create([
            'id' => 66,
            'name' => 'shop.product.destroy_checked',
            'label' => '多选软删除',
            'parent_id' => 59,
        ]);
        /*商品管理（回收站）*/
        Permission::create([
            'id' => 67,
            'name' => 'shop.product.trash',
            'label' => '回收站',
            'parent_id' => 59,
        ]);
        /*商品管理（恢复）*/
        Permission::create([
            'id' => 68,
            'name' => 'shop.product.restore',
            'label' => '恢复',
            'parent_id' => 59,
        ]);
        /*商品管理（多选恢复）*/
        Permission::create([
            'id' => 69,
            'name' => 'shop.product.restore_checked',
            'label' => '多选恢复',
            'parent_id' => 59,
        ]);
        /*商品管理（删除）*/
        Permission::create([
            'id' => 70,
            'name' => 'shop.product.force_destroy',
            'label' => '删除',
            'parent_id' => 59,
        ]);
        /*商品管理（多选删除）*/
        Permission::create([
            'id' => 71,
            'name' => 'shop.product.force_destroy_checked',
            'label' => '多选删除',
            'parent_id' => 59,
        ]);
        /*商品管理（删除相册图片）*/
        Permission::create([
            'id' => 72,
            'name' => 'shop.product.destroy_gallery',
            'label' => '删除相册图片',
            'parent_id' => 59,
        ]);
        /*商品管理（更新库存）*/
        Permission::create([
            'id' => 107,
            'name' => 'shop.product.change_stock',
            'label' => '更新库存',
            'parent_id' => 59,
        ]);


        /*
       * 栏目管理
       */
        Permission::create([
            'id' => 73,
            'name' => 'shop.category.index',
            'label' => '栏目管理',
            'parent_id' => 58,
            'icon' => 'am-icon-code-fork',
        ]);
        /*栏目管理（新增）*/
        Permission::create([
            'id' => 74,
            'name' => 'shop.category.create',
            'label' => '新增',
            'parent_id' => 73,
        ]);
        /*栏目管理（保存）*/
        Permission::create([
            'id' => 75,
            'name' => 'shop.category.store',
            'label' => '保存',
            'parent_id' => 73,
        ]);
        /*栏目管理（更新属性）*/
        Permission::create([
            'id' => 76,
            'name' => 'shop.category.is_something',
            'label' => '更新属性',
            'parent_id' => 73,
        ]);
        /*栏目管理（排序）*/
        Permission::create([
            'id' => 77,
            'name' => 'shop.category.sort_order',
            'label' => '排序',
            'parent_id' => 73,
        ]);
        /*栏目管理（编辑）*/
        Permission::create([
            'id' => 78,
            'name' => 'shop.category.edit',
            'label' => '编辑',
            'parent_id' => 73,
        ]);
        /*栏目管理（更新）*/
        Permission::create([
            'id' => 79,
            'name' => 'shop.category.update',
            'label' => '更新',
            'parent_id' => 73,
        ]);
        /*栏目管理（删除）*/
        Permission::create([
            'id' => 80,
            'name' => 'shop.category.destroy',
            'label' => '删除',
            'parent_id' => 73,
        ]);

        /*
     * 品牌管理
     */
        Permission::create([
            'id' => 81,
            'name' => 'shop.brand.index',
            'label' => '品牌管理',
            'parent_id' => 58,
            'icon' => 'am-icon-code-fork',
        ]);
        /*品牌管理（新增）*/
        Permission::create([
            'id' => 82,
            'name' => 'shop.brand.create',
            'label' => '新增',
            'parent_id' => 81,
        ]);
        /*品牌管理（保存）*/
        Permission::create([
            'id' => 83,
            'name' => 'shop.brand.store',
            'label' => '保存',
            'parent_id' => 81,
        ]);
        /*品牌管理（更新属性）*/
        Permission::create([
            'id' => 84,
            'name' => 'shop.brand.is_something',
            'label' => '更新属性',
            'parent_id' => 81,
        ]);
        /*品牌管理（排序）*/
        Permission::create([
            'id' => 85,
            'name' => 'shop.brand.sort_order',
            'label' => '排序',
            'parent_id' => 81,
        ]);
        /*品牌管理（编辑）*/
        Permission::create([
            'id' => 86,
            'name' => 'shop.brand.edit',
            'label' => '编辑',
            'parent_id' => 81,
        ]);
        /*品牌管理（更新）*/
        Permission::create([
            'id' => 87,
            'name' => 'shop.brand.update',
            'label' => '更新',
            'parent_id' => 81,
        ]);
        /*品牌管理（删除）*/
        Permission::create([
            'id' => 88,
            'name' => 'shop.brand.destroy',
            'label' => '删除',
            'parent_id' => 81,
        ]);

        /*
         * 物流运费
         */
        Permission::create([
            'id' => 89,
            'name' => 'shop.express.index',
            'label' => '物流运费',
            'parent_id' => 58,
            'icon' => 'am-icon-code-fork',
        ]);
        /*物流运费（新增）*/
        Permission::create([
            'id' => 90,
            'name' => 'shop.express.create',
            'label' => '新增',
            'parent_id' => 89,
        ]);
        /*物流运费（保存）*/
        Permission::create([
            'id' => 91,
            'name' => 'shop.express.store',
            'label' => '保存',
            'parent_id' => 89,
        ]);
        /*物流运费（更新属性）*/
        Permission::create([
            'id' => 92,
            'name' => 'shop.express.is_something',
            'label' => '更新属性',
            'parent_id' => 89,
        ]);
        /*物流运费（排序）*/
        Permission::create([
            'id' => 93,
            'name' => 'shop.express.sort_order',
            'label' => '排序',
            'parent_id' => 89,
        ]);
        /*物流运费（编辑）*/
        Permission::create([
            'id' => 94,
            'name' => 'shop.express.edit',
            'label' => '编辑',
            'parent_id' => 89,
        ]);
        /*物流运费（更新）*/
        Permission::create([
            'id' => 95,
            'name' => 'shop.express.update',
            'label' => '更新',
            'parent_id' => 89,
        ]);
        /*物流运费（删除）*/
        Permission::create([
            'id' => 96,
            'name' => 'shop.express.destroy',
            'label' => '删除',
            'parent_id' => 89,
        ]);

        /*
       * 订单管理
       */
        Permission::create([
            'id' => 97,
            'name' => 'shop.order.index',
            'label' => '订单管理',
            'parent_id' => 58,
            'icon' => 'am-icon-code-fork',
        ]);
        /*订单管理（新增）*/
        Permission::create([
            'id' => 98,
            'name' => 'shop.order.create',
            'label' => '新增',
            'parent_id' => 97,
        ]);
        /*订单管理（保存）*/
        Permission::create([
            'id' => 99,
            'name' => 'shop.order.store',
            'label' => '保存',
            'parent_id' => 97,
        ]);
        /*订单管理（配货）*/
        Permission::create([
            'id' => 100,
            'name' => 'shop.order.picking',
            'label' => '配货',
            'parent_id' => 97,
        ]);
        /*订单管理（发货）*/
        Permission::create([
            'id' => 101,
            'name' => 'shop.order.shipping',
            'label' => '发货',
            'parent_id' => 97,
        ]);
        /*订单管理（完成）*/
        Permission::create([
            'id' => 102,
            'name' => 'shop.order.finish',
            'label' => '完成',
            'parent_id' => 97,
        ]);
        /*订单管理（编辑）*/
        Permission::create([
            'id' => 103,
            'name' => 'shop.order.edit',
            'label' => '编辑',
            'parent_id' => 97,
        ]);
        /*订单管理（更新）*/
        Permission::create([
            'id' => 104,
            'name' => 'shop.order.update',
            'label' => '更新',
            'parent_id' => 97,
        ]);
        /*订单管理（删除）*/
        Permission::create([
            'id' => 105,
            'name' => 'shop.order.destroy',
            'label' => '删除',
            'parent_id' => 97,
        ]);

        /*
     * 会员管理
     */
        Permission::create([
            'id' => 106,
            'name' => 'shop.customer.index',
            'label' => '会员管理',
            'parent_id' => 58,
            'icon' => 'am-icon-code-fork',
        ]);

        /**
         * 广告管理
         */
        Permission::create([
            'id' => 108,
            'name' => 'ads',
            'label' => '广告管理',
            'parent_id' => 0,
            'icon' => 'am-icon-paper-apple',
        ]);
        /*
         * 广告管理
         */
        Permission::create([
            'id' => 109,
            'name' => 'ads.ad.index',
            'label' => '广告管理',
            'parent_id' => 108,
            'icon' => 'am-icon-code-fork',
        ]);
        /*广告管理（新增）*/
        Permission::create([
            'id' => 110,
            'name' => 'ads.ad.create',
            'label' => '新增',
            'parent_id' => 109,
        ]);
        /*广告管理（保存）*/
        Permission::create([
            'id' => 111,
            'name' => 'ads.ad.store',
            'label' => '保存',
            'parent_id' => 109,
        ]);
        /*广告管理（更新属性）*/
        Permission::create([
            'id' => 112,
            'name' => 'ads.ad.is_something',
            'label' => '更新属性',
            'parent_id' => 109,
        ]);
        /*广告管理（编辑）*/
        Permission::create([
            'id' => 113,
            'name' => 'ads.ad.edit',
            'label' => '编辑',
            'parent_id' => 109,
        ]);
        /*广告管理（更新）*/
        Permission::create([
            'id' => 114,
            'name' => 'ads.ad.update',
            'label' => '更新',
            'parent_id' => 109,
        ]);
        /*广告管理（软删除）*/
        Permission::create([
            'id' => 115,
            'name' => 'ads.ad.destroy',
            'label' => '软删除',
            'parent_id' => 109,
        ]);
        /*广告管理（多选软删除）*/
        Permission::create([
            'id' => 116,
            'name' => 'ads.ad.destroy_checked',
            'label' => '多选软删除',
            'parent_id' => 109,
        ]);
        /*广告管理（回收站）*/
        Permission::create([
            'id' => 117,
            'name' => 'ads.ad.trash',
            'label' => '回收站',
            'parent_id' => 109,
        ]);
        /*广告管理（恢复）*/
        Permission::create([
            'id' => 118,
            'name' => 'ads.ad.restore',
            'label' => '恢复',
            'parent_id' => 109,
        ]);
        /*广告管理（多选恢复）*/
        Permission::create([
            'id' => 119,
            'name' => 'ads.ad.restore_checked',
            'label' => '多选恢复',
            'parent_id' => 109,
        ]);
        /*广告管理（删除）*/
        Permission::create([
            'id' => 120,
            'name' => 'ads.ad.force_destroy',
            'label' => '删除',
            'parent_id' => 109,
        ]);
        /*广告管理（多选删除）*/
        Permission::create([
            'id' => 121,
            'name' => 'ads.ad.force_destroy_checked',
            'label' => '多选删除',
            'parent_id' => 109,
        ]);

        /*广告管理（多选删除）*/
        Permission::create([
            'id' => 130,
            'name' => 'ads.ad.sort_order',
            'label' => '排序',
            'parent_id' => 109,
        ]);

        /*
       * 广告栏目管理
       */
        Permission::create([
            'id' => 122,
            'name' => 'ads.category.index',
            'label' => '栏目管理',
            'parent_id' => 108,
            'icon' => 'am-icon-code-fork',
        ]);
        /*栏目管理（新增）*/
        Permission::create([
            'id' => 123,
            'name' => 'ads.category.create',
            'label' => '新增',
            'parent_id' => 122,
        ]);
        /*栏目管理（保存）*/
        Permission::create([
            'id' => 124,
            'name' => 'ads.category.store',
            'label' => '保存',
            'parent_id' => 122,
        ]);
        /*栏目管理（更新属性）*/
        Permission::create([
            'id' => 125,
            'name' => 'ads.category.is_something',
            'label' => '更新属性',
            'parent_id' => 122,
        ]);
        /*栏目管理（排序）*/
        Permission::create([
            'id' => 126,
            'name' => 'ads.category.sort_order',
            'label' => '排序',
            'parent_id' => 122,
        ]);
        /*栏目管理（编辑）*/
        Permission::create([
            'id' => 127,
            'name' => 'ads.category.edit',
            'label' => '编辑',
            'parent_id' => 122,
        ]);
        /*栏目管理（更新）*/
        Permission::create([
            'id' => 128,
            'name' => 'ads.category.update',
            'label' => '更新',
            'parent_id' => 122,
        ]);
        /*栏目管理（删除）*/
        Permission::create([
            'id' => 129,
            'name' => 'ads.category.destroy',
            'label' => '删除',
            'parent_id' => 122,
        ]);
    }
}
