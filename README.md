###使用说明
```angular2
自定义类，日常的改bug的积累
```
##安装
```angular2
composer require shengxiaoweimo/helper
```

####tokenHelper使用
```angular2
use shengxiaoweimo\helper\TokenHelper;

//初始化,需要传入加密字符串
TokenHelper::init('sig_key');

//获取token，
//$data {array} 需要需要加密的数据
TokenHelper::getToken($data);

//检测token是否有效
TokenHelper::checkToken($token);

//token解密,返回加密时传入的数据
TokenHelper::getTokenData($token);

//重置token
TokenHelper::refreshToken($token);
```

####headerHelper使用
```angular2
//解决跨域问题
//$option  {array}  允许访问的域名响应的域名,默认全部
HeaderHelper::setCoreHeader($option);

// 导出文件header头设置
// @param string $fileName 导出的文件名称，文件后缀为.txt和.csv可以直接导出，其他格式还需处理
// @param string $type     导出文件类型 txt , excle , 默认txt
HeaderHelper::setExportHeader($fileName , $type);
``` 

####XssFilterHelper使用
```angular2
//过滤xss攻击
XssFilterHelper::dataXssFilter($data);
``` 

####PhpQrCodeHelper使用
```angular2
//生成png后缀的带参数二维码
PhpQrCodeHelper::createPng('http://www.baidu.com' , './img/test.png' , 1 , 0 , 0);
//图片合并
PhpQrCodeHelper::opentow($backgrounUrl , $disSrcUrl , './img/test.png');
``` 

####PhpExcelHelper使用
```angular2
//生成png后缀的带参数二维码
PhpQrCodeHelper::createPng('http://www.baidu.com' , './img/test.png' , 1 , 0 , 0);
//图片合并
PhpQrCodeHelper::opentow($backgrounUrl , $disSrcUrl , './img/test.png');
``` 