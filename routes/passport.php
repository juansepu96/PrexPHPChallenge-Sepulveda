<?php 

use Laravel\Passport\Passport;

Route::group([
    'prefix' => 'oauth',
    'namespace' => 'Laravel\Passport\Http\Controllers',
], function () {
    // Issue a token
    Route::post('/token', [
        'uses' => 'AccessTokenController@issueToken',
        'as' => 'passport.token',
    ]);

    // Revoke all tokens
    Route::post('/tokens/revoke', [
        'uses' => 'TransientTokenController@revoke',
        'as' => 'passport.tokens.revoke',
    ]);

    // Other Passport routes can be added here
});

Passport::routes(null, ['prefix' => 'oauth']);
