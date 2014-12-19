### 骨架(Skeleton)生成器

skeleton 用来为准备测试的类生成测试脚本的骨架，让你可以不用一直写 test* 方法。

首先我们需要安装 [skeleton](https://github.com/sebastianbergmann/phpunit-skeleton-generator)

使用第1种安装方法
```
wget https://phar.phpunit.de/phpunit-skelgen.phar
chmod +x phpunit-skelgen.phar
mv phpunit-skelgen.phar /usr/local/bin/phpunit-skelgen

// 运行结果
[root@localhost library]# phpunit-skelgen --test Subject
phpunit-skelgen 2.0.1 by Sebastian Bergmann.
  [InvalidArgumentException]
  Command "Subject" is not defined.
// 好像命令有误
[root@localhost library]# phpunit-skelgen -help
phpunit-skelgen 2.0.1 by Sebastian Bergmann.

phpunit-skelgen version 2.0.1

Usage:
  [options] command [arguments]

Options:
  --help           -h Display this help message.
  --quiet          -q Do not output any message.
  --verbose        -v|vv|vvv Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
  --version        -V Display this application version.
  --ansi              Force ANSI output.
  --no-ansi           Disable ANSI output.
  --no-interaction -n Do not ask any interactive question.

Available commands:
  generate-class   Generate a class based on a test class
  generate-test    Generate a test class based on a class
  help             Displays help for a command
  list             Lists commands
```

OK，知道了命令，继续
```
[root@localhost library]# phpunit-skelgen generate-test Calculate
[root@localhost library]# phpunit-skelgen generate-test Calculate Calculate.php
[root@localhost library]# phpunit-skelgen generate-test "library/Calculate" "/data/phpunitLearn/code/library/Calculate.php"
//所有的运行结果都是
phpunit-skelgen 2.0.1 by Sebastian Bergmann.
  [RuntimeException]
  Neither "Calculate.php" nor "Calculate.php" could be opened.

generate-test [--bootstrap="..."] class [class-source] [test-class] [test-source]
```

失败，还找不到帮助，伤心地走了……