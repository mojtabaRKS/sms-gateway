# How to add new driver ?

create a new file in the `App/Support/SmsGateway/Drivers` folder

make sure your driver implements the `App/Support/SmsGateway/Contracts/SmsGatewayInterface`

implement the methods `send`, `getResponseData`

add your driver credentials to the `sms-gateway.php` file like below:

````
'drivers' => [
    .
    .
    .

    'your_driver_name' => [
        'driver' => 'your_driver_namespace',
        'uri' => 'your_driver_uri',
        'credentials' => [
            'api-key' => 'your_driver_api_key',
            'from' => 'your_driver_sender',
            .
            .
            .
        ],
    ],
],
````

that's all !