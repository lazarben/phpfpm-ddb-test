
<?php

    include '../aws.phar';

    use Aws\DynamoDb\DynamoDbClient;
    use Aws\Credentials\CredentialProvider;
    var_dump(getenv());
    $provider = CredentialProvider::ecsCredentials();
    $memoizedProvider = CredentialProvider::memoize($provider);

    $client = new DynamoDbClient([
        'region'  => 'us-east-1',
        'version' => 'latest',
        'credentials' => $memoizedProvider
    ]);

    echo $client->listTables();
?>
