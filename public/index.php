<?php

    include '../aws.phar';

    use Aws\DynamoDb\DynamoDbClient;
    use Aws\Credentials\CredentialProvider;
    use Aws\Credentials\InstanceProfileProvider;
    use Aws\Credentials\AssumeRoleCredentialProvider;
    use Aws\Sts\StsClient;

    $ARN = "arn:aws:iam::048559620512:role/InstanceRoleDynamoDB";
    $sessionName = "ddb-session";
    
    $stsClient = new StsClient([
        'region' => 'us-east-1',
        'version' => 'latest'
    ]);
    
    $result = $stsClient->AssumeRole([
          'RoleArn' => $ARN,
          'RoleSessionName' => $sessionName,
    ]);

    $client = new DynamoDbClient([
        'region'  => 'us-east-1',
        'version' => 'latest',
        'credentials' =>  [
            'key'    => $result['Credentials']['AccessKeyId'],
            'secret' => $result['Credentials']['SecretAccessKey'],
            'token'  => $result['Credentials']['SessionToken']
        ]
    ]);

    echo $client->listTables();
?>
