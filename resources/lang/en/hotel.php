<?php 


return [

    /*
    |--------------------------------------------------------------------------
    | Hotel Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the hotel library to build
    | the simple hotel links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */
    'main'      =>  [
                        'created' => 'Hotel Successfully created',
                        'updated' => 'Hotel Successfully updated',
                    ],

    'amenities' => [ 'added_success' => 'Successfully added' ],
    'room'      =>  [
                        'updated'   =>  'The Room data successfully updated',
                        'created'   =>  'The Room data successfully created',
                        'deleted'   =>  'The Room data successfully deleted',
                    ],

    'booking'   =>  [
                        'notenough' => 'sorry not enough free room',
                        'noemptyrooms' => 'Sorry! empty rooms are not available in this period'
                    ]

];