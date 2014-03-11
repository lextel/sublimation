### 上传
 * host 图片服务器
 * type 暂定如下
   * banners:   横幅广告 用于幻灯片
   * items  :   商品图片
   * shares :   晒单图片
   * avatars:   用户头像
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

  > 图片服务器需要支持Imagick扩展


### Imagick安装方式