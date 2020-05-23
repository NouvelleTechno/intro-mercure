<?php

function mercurePost(string $topic, array $data = []){
    define('JWT', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InN1YnNjcmliZSI6WyIqIl0sInB1Ymxpc2giOlsiKiJdfX0.M1yJUov4a6oLrigTqBZQO_ohWUsg3Uz1bnLD4MIyWLo');

    $postData = http_build_query([
        'topic' => $topic,
        'data' => json_encode($data)
    ]);

    echo file_get_contents('http://localhost:3000/.well-known/mercure', false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Bearer ".JWT,
            'content' => $postData
        ]
    ]));
}