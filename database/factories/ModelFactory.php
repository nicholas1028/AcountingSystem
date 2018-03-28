<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$autoIncrement = autoIncrement();

use Jenssegers\Optimus\Optimus;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use Laravolt\Avatar\Facade as Avatar;

$factory->define(\App\UserContact::class, function (Faker\Generator $faker) use ($autoIncrement) {

    $autoIncrement->next();

    $optimus                = new Optimus(1985855171, 1276010987, 448363082);
    $encrypt_id             = $optimus->encode($autoIncrement->current());
    $contact_images_folder  = storage_path('app/public/contacts/images/');
    $avatar                 = Avatar::create($faker->company)->toBase64();
    $img                    = Image::make($avatar);

    // resize the image to a width of 300 and constrain aspect ratio (auto height)
    $img->resize(150, null, function ($constraint) {
        $constraint->aspectRatio();
    });

    // save file as jpg with medium quality
    //$img->save($contact_images_folder . $encrypt_id . '.png', 90);


    return [

        'team_id' => 1, //$faker->numberBetween(1,2),

        'open_id' => $autoIncrement->current(),

        'name' => $faker->company,
        'email' => $faker->safeEmail,
        'image' => "/storage/contacts/images/" . $encrypt_id . ".png",

        'phone' => $faker->phoneNumber,

        'contact1' => $faker->name,
        'contact2' => $faker->name,

        'currency_id' => 840,
        'payment_terms' => 15,

        'bill_address1' => $faker->streetAddress,
        'bill_address2' => $faker->secondaryAddress,
        'bill_city' => $faker->city,
        'bill_state' => $faker->state,
        'bill_postal_code' => $faker->postcode,
        'bill_country_id' => $faker->countryCode,

        'ship_phone' => $faker->phoneNumber,
        'ship_contact' => $faker->name,
        'ship_address1' => $faker->streetAddress,
        'ship_address2' => $faker->secondaryAddress,
        'ship_city' => $faker->city,
        'ship_state' => $faker->state,
        'ship_postal_code' => $faker->postcode,
        'ship_country_id' => $faker->countryCode,
        'instructions' => str_random(20),

        'account_no' => $faker->numberBetween(100000,99999),
        'id_no' => $faker->numberBetween(100000,99999),
        'vat_no' => $faker->numberBetween(100000,99999),
        'gst_code' => $faker->numberBetween(100000,99999),
        'fax_no' => $faker->phoneNumber,
        'mobile_no' => $faker->phoneNumber,
        'toll_free_no' => $faker->phoneNumber,
        'website' => $faker->domainName,

    ];
});

function autoIncrement()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}
