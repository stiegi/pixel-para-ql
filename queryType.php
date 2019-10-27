<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$parameterType = new ObjectType([
    'name' => 'Parameter',
    'fields' => [
        'parameter' => [
            'type' => Type::nonNull(Type::string()),
            'description' => 'URL parameter'
        ],
        'key' => [
            'type' => Type::string(),
            'description' => 'The key that is used in the Webtrek V3/4 instance or in the object of the wts.push argument'
        ],
        'descDe' => [
            'type' => Type::string(),
            'description' => 'German description'
        ],
        'frontendDe' => [
            'type' => Type::string(),
            'description' => 'German description of where to find in the frontend'
        ],
        'descEn' => [
            'type' => Type::string(),
            'description' => 'English description'
        ],
        'frontendEn' => [
            'type' => Type::string(),
            'description' => 'English description of where to find in the frontend'
        ],
        'type' => [
            'type' => Type::nonNull(Type::string()),
            'description' => 'General Type which can be used to filter'
        ],
    ]
]);

$queryType = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'parameter' => [
            'type' => Type::listOf($parameterType),
            'description' => 'URL parameter in trackrequests, how to set them, where to find the tracked data in frontend',
            'args' => [
                'type' => Type::string(),
            ],
            'resolve' => function ($root, $args) {
                
                $rows = array_map(function($row) { return str_getcsv($row, '|'); }, file('./dataSource/parameterData.csv'));
                $header = array_shift($rows);
                $parameter_data = array();
                foreach($rows as $row) {
                    if(array_key_exists("type", $args)) {
                        if($args['type'] == $row[6])
                            $parameter_data[] = array_combine($header, $row);   
                    } else
                        $parameter_data[] = array_combine($header, $row);
                }
                return $parameter_data;
            }
        ]
    ],
]);

?>