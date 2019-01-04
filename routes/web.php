<?php

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
// 前台首页
// Route::resource('/', 'Index\IndexController');


// 后台登录
Route::resource('/adminlogin','Admin\AdminLoginControllrt');
// 后台控制器
Route::group(['middleware'=>'login'],function(){
	// 后台首页
	// Route::get('/admin','Admin\AdminController@index');
	Route::resource('/admin123','Admin\AdminController');
	// 后台管理员权限
	Route::resource('/admins','Admin\AdminsController');
	// 分配管理员角色
	Route::get('/adminsrole/{id}','Admin\AdminsController@rolelist');
	// 保存角色
	Route::post('/adminsaverole','Admin\AdminsController@saverole');
	// 角色管理
	Route::resource('/role','Admin\RoleController');
	//角色状态修改
	Route::get('/adminstus','Admin\RoleController@status');
	// 分配权限
	Route::get('/adminsauth/{id}','Admin\RoleController@auth');
	// 保存权限
	Route::post('/saveauth','Admin\RoleController@saveauth');
	// 添加权限
	Route::resource('/nodeauth','Admin\NodeAuthController');
	// 修改权限状态
	Route::get('/nodesta','Admin\NodeAuthController@status');
	// 会员管理
	Route::resource('/user','Admin\UserController');
	// 获取会员收货地址
	Route::get('/address/{id}','Admin\UserController@address');
	//ajax地址删除
	Route::get('/redel','Admin\UserController@del');
	// 公告管理
	Route::resource('/notice','Admin\NoticeController');
	// ajax删除 表notice
	Route::get('/nodel','Admin\NoticeController@del');
	// 批量删除notice表
	Route::get('/pdel','Admin\NoticeController@pdel');
	// 公告状态修改
	Route::get('/nostatus','Admin\NoticeController@status');


	// 分类管理
	Route::resource('/cate','Admin\CateController');
	//分类管理ajax修改状态display
	Route::get('/cateedit','Admin\CateController@cateedit');
	// 商品管理
	Route::resource('/goods','Admin\GoodsController');
	//商品管理ajax修改状态static
	Route::get('/goodsedit','Admin\GoodsController@goodsedit');
	//商品管理ajax修改状态recom
	Route::get('/goodsedits','Admin\GoodsController@goodsedits');
	//商品管理ajax删除
	Route::get('/goodsdel','Admin\GoodsController@goodsdel');
	//商品规格添加
	Route::get('/sizeadd/{id}','Admin\GoodsController@sizeadd');
	Route::post('/sizedoadd','Admin\GoodsController@sizedoadd');
	//商品规格删除
	Route::get('/sizedel','Admin\GoodsController@sizedel');
	//商品规格修改
	Route::get('/sizeedit/{id}','Admin\GoodsController@sizeedit');
	//商品规格执行修改
	Route::post('/sizedoedit','Admin\GoodsController@sizedoedit');
	// 收藏管理
	Route::resource('/collects','Admin\CollectController');

	//品牌管理
	Route::resource('/brand','Admin\GoodbrandController');
	// 轮播图管理
	Route::resource('/banner',"Admin\BannerController");
	// 友情连接管理
	Route::resource('/link','Admin\LinkController');
	// 广告管理
	Route::resource('/advertisement','Admin\AdvertisementController');
	// 公告管理
	Route::resource('/notice','Admin\NoticeController');
	// 商品评论管理
	Route::resource('/judge','Admin\JudgeController');
	// 站内信管理
	Route::resource('/letter','Admin\LetterController');


	// 后台友情链接ajax删除
	Route::get('/adminlinkdel','Admin\LinkController@del');
	// 后台友情链接ajax修改状态
	Route::get('/adminlinkdoedit','Admin\LinkController@doedit');
	// 后台轮播图ajax删除
	Route::get('/adminbannerdel','Admin\BannerController@del');
	// 后台轮播图ajax修改状态
	Route::get('/adminbannerdoedit','Admin\BannerController@doedit');
	// 后台广告ajax删除
	Route::get('/adminadvertisementdel','Admin\AdvertisementController@del');
	// 后台广告ajax修改状态
	Route::get('/adminadvertisementdoedit','Admin\AdvertisementController@doedit');
	// 后台评论ajax删除
	Route::get('/judjedel','Admin\JudgeController@del');

	// 订单详情管理
	Route::resource('/order','Admin\OrderController');
	// 订单状态修改
	Route::get('/orderstatus/{id}/{status}','Admin\OrderController@status');
	// 反馈意见管理
	Route::get('/adminfeedback','Admin\FeedbackController@index');
	
});

/*----前台模块-----*/
		//前台首页
	Route::resource('/','Index\IndexController');
		// 前台登录
	Route::resource('/login','Login\HomeLoginController');
	// 密码找回
	Route::get('/forget','Login\HomeLoginController@forget');
	//验证输入的用户
	Route::get('/doforget','Login\HomeLoginController@doforget');
	// 找回密码邮箱发送成功
	Route::get('gdforget','Login\HomeLoginController@gdforget');
	// 加载重置密码模板
	Route::get('/reset','Login\HomeLoginController@reset');
	// 执行密码修改
	Route::get('/doreset','Login\HomeLoginController@doreset');
	// 修改成功视图
	Route::get('/success','Login\HomeLoginController@success');
	// 前台用户注册
	Route::resource('/register','Login\RegisterController');
	// 验证邮箱是否已经注册
	Route::get('/emails','Login\RegisterController@emails');
		// 激活用户
	Route::get('/jihuo','Login\RegisterController@jihuo');
	// 验证码视图测试
	Route::get('/code','Login\RegisterController@code');

	//前台控制器
	Route::group([],function(){

	//商品详情
	Route::resource('/detail','Index\DetailController');
	//ajax查询数据
	Route::get('/getdetail','Index\DetailController@getDetail');
	//商品列表
	Route::resource('/list','Index\ListController');
	//排序
	Route::get('/getfunc/{typeid}-{order}','Index\ListController@getfunc');
	//收藏列表
	Route::resource('/collect','Index\CollectController');
	//ajax收藏修改 (加入收藏)
	Route::get('/getCollect','Index\CollectController@getCollect');
	//ajax收藏修改 (移除收藏)
	Route::get('/outCollect','Index\CollectController@outCollect');

	// 前台友情链接管理
	Route::resource('/indexlink','Index\LinkController');
	// 前台友情链接表单验证
	Route::get('/linkphone','Index\LinkController@phone');
	// 前台评论管理
	Route::resource('/indexjudge','Index\JudgeController');
	// 前台站内信管理
	Route::resource('/indexletter','Index\LetterController');
	// 修改站内信的状态
	Route::get('/lettersta','Index\LetterController@status');
	// ajax判断账号是否正确
	Route::get('/lettersender','Index\LetterController@sender');
	// 反馈页面
	Route::get('/feedback','Index\IndexController@feedback');
	Route::post('/feedbackform','Index\IndexController@feedbackforms');
	//前台抽奖
	Route::get('/indexcj',function(){
		return view('Index.Choujiang.cj');
	});

	// 购物车页
	Route::resource('/shopcart','Index\ShopcartController');
	// 购物车添加session数据
	Route::get('/sessionadd/{ids}/{goodid}/{nums}','Index\ShopcartController@add');
	// 购物车添加操作
	Route::get('/shopcartjia/{id}','Index\ShopcartController@jia');
	// 购物车减少操作
	Route::get('/shopcartjian/{id}','Index\ShopcartController@jian');
	// Route::get('/shopadd','Index\ShopcartController@sadd');
	// 购物车删除操作
	Route::get('/shopcartdel','Index\ShopcartController@del');
	// 删除购物车单个商品操作
	Route::get('/shopcartdelone','Index\ShopcartController@delone');

	// 订单确认页
	Route::resource('/indexorder','Index\OrderController');
	// 订单地址添加
	Route::get('/orderaddress','Index\OrderController@orderaddress');
	// 订单地址地址执行添加
	Route::post('/orderdoadd','Index\OrderController@orderdoadd');
	// 订单地址删除
	Route::get('/deladdress/{id}','Index\OrderController@deladdress');
	// 订单地址一级导航
	Route::get('/orderyiji','Index\OrderController@yiji');
	// 前端支付窗口
	Route::get('/paymoney/{id}','Index\OrderdetailsController@paymoney');
	//支付窗口回调函数
	Route::get('/returnpay','Index\OrderdetailsController@returnpay');

	
});
	//**************用户中心——>地址 用户信息/
	Route::group(['middleware'=>'home'],function(){
	// 公共模板
	Route::resource('/public','User\PublicController');
	//修改头像
	Route::post('/editpic','User\PublicController@editpic');
	// 修改密码
	Route::resource('/userchange','User\UserChangeController');
	// 我的收货地址
	Route::resource('/useraddres','User\AddressController');
	//三级联动地址
	Route::get('/addr','User\AddressController@address');
	// 提交地址
	Route::post('/addre','User\AddressController@addre');
	// ajax删除地址
	Route::get('/addrdel','User\AddressController@delete');
	// ajax地址默认地址切换
	Route::get('/addajx','User\AddressController@addajax');
	// 会员中心-》个人中心
	Route::resource('/userinfo','User\UserinfoController');
	//信息修改
	Route::get('/infoedit','User\UserinfoController@editfo');

	// 个人中心 我的订单
	Route::resource('/orderuser','Index\OrderdetailsController');
	// 前端订单状态修改
	Route::get('/indexorderstatus/{id}/{status}','Index\OrderdetailsController@status');
	// 订单删除
	Route::get('/delone','Index\OrderdetailsController@del');
	// 订单详情
	Route::get('/orderinfo/{id}','Index\OrderdetailsController@orderinfo');
	


});




