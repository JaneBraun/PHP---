<?php
header('Content-Type: text/html; charset=utf-8');
include_once './lib/fun.php';
//检查登录
if(!checkLogin())
{
    msg(2,'请登录','login.php');
}

$goodsId = isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']):'';

//如果id不存在，跳转到商品列表
if (!$goodsId)
{
    msg(2,'参数非法','index.php');
}

//根据商品id查询信息
$con = mysqlInit('127.0.0.1','root', 'root', 'image_text');

$sql = "SELECT 'id' FROM im_goods WHERE id = '{$goodsId}'";
$obj = mysql_query($sql);

//当根据id查询信息为空 跳转列表页
if(!$goods = mysql_fetch_assoc($obj))
{
    msg(2,'东西不存在','index.php');
}

//删除操作
$sql = "DELETE FROM im_goods WHERE id = {$goodsId} LIMIT 1";

if ($result = mysql_query($sql))
{
    //mysql_affected_rows()
    msg(1,'删除成功','index.php');
}
else
{
    msg(2,'删除失败','index.php');
}

//注意项
//1、项目中 不会真正删除商品 而是更新商品表中的status 1:正常操作 -1：删除操作
//2、增加商品编辑时 update_time


