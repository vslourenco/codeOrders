<?php
return [
    'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => [
        'description' => 'Handles payment types',
        'collection' => [
            'description' => 'Collection of PaymentTypes',
            'GET' => [
                'description' => 'Lis all payment types',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes"
       },
       "first": {
           "href": "/ptypes?page={page}"
       },
       "prev": {
           "href": "/ptypes?page={page}"
       },
       "next": {
           "href": "/ptypes?page={page}"
       },
       "last": {
           "href": "/ptypes?page={page}"
       }
   }
   "_embedded": {
       "ptypes": [
           {
               "_links": {
                   "self": {
                       "href": "/ptypes[/:ptypes_id]"
                   }
               }
              "name": ""
           }
       ]
   }
}',
            ],
            'POST' => [
                'description' => 'Create a new payment type',
                'request' => '{
   "name": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
  "id":"id of payment type",
   "name": ""
}',
            ],
        ],
        'entity' => [
            'description' => 'PaymentType Entity',
            'GET' => [
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
   "id":"Id",
   "name": ""
}',
                'description' => 'Returns payment type',
            ],
            'PATCH' => [
                'description' => 'Update partialy a payment type',
                'request' => '{
   "name": ""
}',
            ],
        ],
    ],
];
