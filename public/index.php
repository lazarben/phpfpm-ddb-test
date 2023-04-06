<?php

    include '../aws.phar';

    use Aws\DynamoDb\DynamoDbClient;
    use Aws\Credentials\CredentialProvider;
    use Aws\Credentials\InstanceProfileProvider;
    use Aws\Credentials\AssumeRoleCredentialProvider;
    use Aws\Sts\StsClient;

    $profile = new InstanceProfileProvider();
    $ARN = "arn:aws:iam::048559620512:role/InstanceRoleDynamoDB";
    $sessionName = "ddb-session";

    $assumeRoleCredentials = new AssumeRoleCredentialProvider([
        'client' => new StsClient([
            'region' => 'us-east-1',
            'version' => 'latest',
            'credentials' => $profile
        ]),
        'assume_role_params' => [
            'RoleArn' => $ARN,
            'RoleSessionName' => $sessionName,
        ],
    ]);

    $provider = CredentialProvider::memoize($assumeRoleCredentials);

    $client = new DynamoDbClient([
        'region'  => 'us-east-1',
        'version' => 'latest',
        'credentials' => $provider
    ]);

    echo $client->listTables();
?>
