# app-restful-api-demo

> Laravel5.4 entrust + auth + dingo api + JWT + swagger + rsa aes加解密，app api加密传输demo



##业务流程：

####前端：
1. 生成随机字符串做aes加密字符串，使用rsa公钥加密 生成rsa_aes字符串
2. 组装header信息如时间戳 版本号 设备ID 身份token等，使用aes加密字符串进行aes加密得到 aes_header字符串
3. post等提交的信息也使用aes加密字符串加密 得到aes_body字符串

提交给api接口的信息只要这3个 rsa_aes,aes_header,aes_body(提交数据时)

####后端：
0. api接口使用decrypt中间件 对接收的rsa_aes,aes_header,aes_body进行解密操作 
注意 这个中间件要在jwt中间件前面，不然jwt无法读取token 需要的decrypt中间件先解密
1. 使用rsa私钥解密rsa_aes得到随机的aes加密字符串
2. 使用aes加密字符串对aes_header和aes_body进行解密 并写回request


####文档：
api文档使用swagger    
访问地址 项目地址/public/Swagger-UI/

####存储：
使用了redis，要先配置好环境 或者注释掉缓存模块的代码
