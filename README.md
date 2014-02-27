# Что это

Надстройка над api S3, которая упращает загрузку-получение файлов, если bucket всего 
один.

# Установка

```bash
composer require bubujka/s4=dev-master
```

# Использование

```php
<?php
$_SERVER['AWS_ACCESS_KEY_ID'] = "....................";
$_SERVER['AWS_SECRET_KEY'] = "........................................";

$s3client = s4(); # для использования всех остальных методов

s4_bucket('...........');

s4_put('hello.txt', 'Hello, Wrld!', 'text/plain');
echo s4_url('hello.txt');
echo s4_get('hello.txt');
s4_delete('hello.txt');

s4_put_file('my_key', '~/.ssh/id_rsa', 'text/plain'); # тип - опционален.

foreach(s4_list() as $obj)
  echo $obj['Key'].'<br>';

foreach(s4_list('images/') as $obj)
  echo $obj['Key'].'<br>';
```
