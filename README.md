# reactphp-vk

Асинхронный VK API клиент построенный на ReactPHP

```composer require catferq/reactphp-vk```

Это экспериментальная библиотека. На текущий момент не рекомендуется её использовать в реальных проектах.<br/>
Если ты знаком с ReactPHP, то я готов получить по жепке за допущенные ошибки и спорные моменты.<br/>
Есть идеи? Пиши в [личку](vk.com/catferq).<br/>

На данный момент тут реализовано:
* Обращение к API через сгенерированную SDK (5.122)
* Прямые запросы к API
* Система троттлинга, дабы не зафлудить и не получить ошибку #6 (слишком много запросов в секунду)
* Обработчик LongPoll
* Всякие Enum'ы
* Ну ещё мета сгенирировал, чтобы были хоть какие-то подсказки при прямых запросах

### Пример обычных запросов через SDK
```php
<?php

use ReactPHPVK\Client\AVKClient;
use ReactPHPVK\LongPoll\LongPollClient;
use React\EventLoop\Factory;

require_once __DIR__ . '/vendor/autoload.php';

$accessToken = 'f1a6c1f8f0f1a21f8f0f1a2c6b1ba6c1f8f0f1a2c6b1b11e6';

$loop = Factory::create();
$avk = new AVKClient($loop, $accessToken);

$method = $avk->messages()->send();
$method->setMessage('Hello world');
$method->setUserId(283776198);
$method->execute()->then(
    fn ($response) => var_dump($response)
);

$loop->run();
```

### Пример обработки LP
```php
<?php

use ReactPHPVK\Client\AVKClient;
use ReactPHPVK\LongPoll\LongPollClient;
use React\EventLoop\Factory;

require_once __DIR__ . '/vendor/autoload.php';

$accessToken = 'f1a6c1f8f0f1a21f8f0f1a2c6b1ba6c1f8f0f1a2c6b1b11e6';
$groupId = 185142265;

$loop = Factory::create();
$avk = new AVKClient($loop, $accessToken);
$lp = new LongPollClient($avk, $groupId);

$lp->handle(
    fn ($update) => var_dump($update) // выведет событие (неожиданно, согласен)
);

$loop->run();
```
