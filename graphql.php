<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'queryType.php';

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

$schema = new Schema([
    'query' => $queryType
]);


$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
$query = $input['query'];
$variableValues = isset($input['variables']) ? $input['variables'] : null;

try {
    $rootValue = null;
    $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
    $output = $result->toArray();
} catch (\Exception $e) {
    $output = [
        'errors' => [
            [
                'message' => $e->getMessage()
            ]
        ]
    ];
}
header('Content-Type: application/json');
echo json_encode($output);
