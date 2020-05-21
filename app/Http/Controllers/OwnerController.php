<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = $this->getOwners();
        return view('pages.owner', compact('owners'));
    }

    public function getOwners()
    {
        $owners = [
            [
                'name'          => 'Ahmad Saugi',
                'avatar'        => 'https://scontent.fcgk1-1.fna.fbcdn.net/v/t1.0-9/p960x960/94120104_2741905005935296_4514988832667467776_o.jpg?_nc_cat=102&_nc_sid=85a577&_nc_eui2=AeGUF8cVqroyWUL-Mpb3N0aYrybxREIzAq6vJvFEQjMCrg0iubmG8oolu9yBG4QRyqA059TApj_tC8QOosTkVeqw&_nc_ohc=RQA7PH2VDBoAX8deLz7&_nc_ht=scontent.fcgk1-1.fna&_nc_tp=6&oh=253f4167ef78f91b78f2880879631888&oe=5EEA96A9',
                'description'    => \Illuminate\Foundation\Inspiring::quote(),
                'skills'        => ['Fullstack Web']
            ],
            [
                'name'          => 'Muhammad Fauzan',
                'avatar'        => 'https://scontent.fcgk1-1.fna.fbcdn.net/v/t1.0-9/p960x960/94702648_222186895756278_6539845550844411904_o.jpg?_nc_cat=105&_nc_sid=7aed08&_nc_eui2=AeE90Bpgnz8jXikxKxfUyrVY7Q23DLrOf6_tDbcMus5_r8Bp46-zBUqhh3VyknIJ13dCy2JCRV0DsiKp33yAR-3a&_nc_ohc=kVIeytitN-wAX81LDHA&_nc_ht=scontent.fcgk1-1.fna&_nc_tp=6&oh=ef35d413cd7273efdb4dfc52e04002c5&oe=5EED6894',
                'description'    => \Illuminate\Foundation\Inspiring::quote(),
                'skills'        => ['Fullstack Web']
            ],
            [
                'name'          => 'Mrezkys Rezky',
                'avatar'        => 'https://scontent.fcgk1-1.fna.fbcdn.net/v/t1.0-9/p960x960/94443019_2830770090369561_2906798767460057088_o.jpg?_nc_cat=107&_nc_sid=85a577&_nc_eui2=AeHPZUwM9n9SL8PK8tzOhTWhuHXZkmEQdhi4ddmSYRB2GAM5l6pJOlnLDWhgwoeEs7jKm8eqFTYTjv5fVmhvo4om&_nc_ohc=dne6FbGLzwcAX8_9mkn&_nc_ht=scontent.fcgk1-1.fna&_nc_tp=6&oh=f23de8ddd80e73b3673f68132da28db9&oe=5EEAE7F2',
                'description'    => \Illuminate\Foundation\Inspiring::quote(),
                'skills'        => ['Graphic Designer']
            ],
            [
                'name'          => 'Yudistira Arya',
                'avatar'        => 'https://scontent.fcgk1-1.fna.fbcdn.net/v/t1.0-9/p960x960/96390021_262605901609703_3369416553974988800_o.jpg?_nc_cat=101&_nc_sid=85a577&_nc_eui2=AeGIWNwGW3cS4Nb_Nkh5Cu5ZHGUeqz782eocZR6rPvzZ6onT3OSZodrSZ0fy89GU0bm1W0bKw5s3hqg8al9F6pzC&_nc_ohc=jo0KCJZA_OcAX_rzxHC&_nc_ht=scontent.fcgk1-1.fna&_nc_tp=6&oh=f0681de67f2f31504b459ce184e0a032&oe=5EEC049C',
                'description'    => \Illuminate\Foundation\Inspiring::quote(),
                'skills'        => ['Frontend Web']
            ]
        ];

        return $owners;
    }
}
