协程版 MySQL 查询器
----

待解决的问题:
1. Transaction 重构（剥离上下文对象）；
2. last_id 的获取；
3. 测试过程中发现连接池导致当前协程不退出；