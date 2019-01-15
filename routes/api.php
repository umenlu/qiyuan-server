<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array', 'bindings', 'change-locale']
], function ($api) {

    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        // 短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');
        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');
        // 图片验证码
        $api->post('captchas', 'CaptchasController@store')
            ->name('api.captchas.store');

        // 第三方登录
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
            ->name('api.socials.authorizations.store');
        // 登录
        $api->post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        // 小程序登录
        $api->post('weapp/authorizations', 'AuthorizationsController@weappStore')
            ->name('api.weapp.authorizations.store');
        // 小程序注册
        $api->post('weapp/users', 'UsersController@weappStore')
            ->name('api.weapp.users.store');
        // 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');
    });

    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
        // 游客可以访问的接口
        $api->get('categories', 'CategoriesController@index')
            ->name('api.categories.index');
        // 异业合作列表
        $api->get('topics', 'TopicsController@index')
            ->name('api.topics.index');
        // 根据id找列表
        $api->get('list', 'TopicsController@list')
            ->name('api.topics.list');
        // 精选banner
        $api->get('banner', 'TopicsController@banner')
            ->name('api.topics.banner');
        // 服务banner
        $api->get('bannerservice', 'TopicsController@bannerservice')
            ->name('api.topics.bannerservice');
        // 文章banner
        $api->get('bannerarticle', 'TopicsController@bannerarticle')
            ->name('api.topics.bannerarticle');
        // 提供服务列表
        $api->get('service', 'TopicsController@service')
            ->name('api.topics.service');
        // 提供资讯列表
        $api->get('article', 'TopicsController@article')
            ->name('api.topics.article');
        // 话题详情
        $api->get('topics/{topic}', 'TopicsController@show')
            ->name('api.topics.show');
        // 某个用户发布的话题
        $api->get('users/{user}/topics', 'TopicsController@userIndex')
            ->name('api.users.topics.index');
        // 话题回复列表
        $api->get('topics/{topic}/replies', 'RepliesController@index')
            ->name('api.topics.replies.index');
        // 某个用户的回复列表
        $api->get('users/{user}/replies', 'RepliesController@userIndex')
            ->name('api.users.replies.index');
        // 资源推荐
        $api->get('links', 'LinksController@index')
            ->name('api.links.index');
        // 活跃用户
        $api->get('actived/users', 'UsersController@activedIndex')
            ->name('api.actived.users.index');

        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 获取小程序码
            $api->get('codes', 'UsersController@codes')
                ->name('api.user.codes');
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
            // 编辑登录用户信息
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');
            $api->put('user', 'UsersController@update')
                ->name('api.user.update');
            // 图片资源
            $api->post('images', 'ImagesController@store')
                ->name('api.images.store');
            // 发布话题
            $api->post('topics', 'TopicsController@store')
                ->name('api.topics.store');
            // 修改话题
            $api->patch('topics/{topic}', 'TopicsController@update')
                ->name('api.topics.update');
            // 删除话题
            $api->delete('topics/{topic}', 'TopicsController@destroy')
                ->name('api.topics.destroy');
            $api->get('user/topics', 'TopicsController@myIndex')
                ->name('api.user.topics.index');
            // 发布回复
            $api->post('topics/{topic}/replies', 'RepliesController@store')
                ->name('api.topics.replies.store');
            // 删除回复
            $api->delete('topics/{topic}/replies/{reply}', 'RepliesController@destroy')
                ->name('api.topics.replies.destroy');
            // 通知列表
            $api->get('user/notifications', 'NotificationsController@index')
                ->name('api.user.notifications.index');
            // 通知统计
            $api->get('user/notifications/stats', 'NotificationsController@stats')
                ->name('api.user.notifications.stats');
            // 标记消息通知为已读
            $api->patch('user/read/notifications', 'NotificationsController@read')
                ->name('api.user.notifications.read');
            // 当前登录用户权限
            $api->get('user/permissions', 'PermissionsController@index')
                ->name('api.user.permissions.index');
        });
    });
});