yii2-mongolog
====================

The **yii2-mongolog** is a Yii2 module for store web application user's activity log in the MongoDB.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

## Configuration

1. Add **mongolog** module into **modules** section of your config.
2. Set your MongoDB collection name for store log data.
3. Set correct **dsn** string to connect with right MongoDB instance and database.
4. Add **mongolog** module into **bootstrap** section of your config.

### Example

```php
'modules' => [
    // ...
    'mongolog' => [
        'class' => 'pythagor\mongolog\Module',
        'logCollection' => 'YourCollectionName',
        'components' => [
            'db_log' => [
                'class' => 'yii\mongodb\Connection',
                'dsn' => 'mongodb://localhost:27017/YourDatabaseName',
            ],
        ],
    ],
],
'bootstrap' => [
    // ...
    'mongolog',
],
```
## License

**yii2-mongolog** is released under the MIT License.
