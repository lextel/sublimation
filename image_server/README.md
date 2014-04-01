### 上传 (暂停使用)
 * host 图片服务器
 * type 暂定如下
   * ad        :   横幅广告 用于幻灯片
   * item      :   商品图片
   * post      :   晒单图片
   * avatar    :   用户头像
   * item/desc : 商品详情图
 * url 形式 http://(host)/upload/(type)
 * 返回Json {code:'', msg:'', data:[]}  code 为1时失败 0 时成功并返回上传路径
    
    > 成功示例：{"code":0,"msg":"ok","data":["e\/c\/eccbc87e4b5ce2fe28308fd9f2a7baf3.jpg","a\/8\/a87ff679a2f3e71d9181a67b7542122c.jpg"]}


### 图片调用
 * host 图片服务器
 * type 同上
 * size 定义需要的缩略图 宽高 如：500x400
 * path1,path2,filename 数据库获取 
 * http://(host)/(type)/(size)/(path1)/(path2)/(filename)
 * 实现形式302跳转

  > 商品详情和横幅广告图直接显示原图

  > 图片服务器需要支持Imagick扩展


### Imagick安装方式
  [见wiki](https://github.com/lextel/sublimation/wiki/php5.5%E6%A8%A1%E5%9D%97-imagick-&-mcrypt-%E6%89%A9%E5%B1%95%E5%AE%89%E8%A3%85)
