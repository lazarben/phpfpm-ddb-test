<?php

    include '../aws.phar';

    use Aws\DynamoDb\DynamoDbClient;


    $client = new DynamoDbClient([
        'region'  => 'us-east-1',
        'version' => 'latest'
    ]);

    echo $client->listTables();
?>
