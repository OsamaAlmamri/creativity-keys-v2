<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\GalleryItem;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;

class ManageController extends Controller
{


  public function artisan(string $command)
    {
        $blocked = [
            'migrate:fresh',
            'migrate:refresh',
            'migrate:reset',
            'db:wipe',
            'queue:flush',
            'tinker',
            'env',
            'down',
            'key:generate',
            'passport:keys',
        ];

        foreach ($blocked as $block) {

            if (str_starts_with($command, $block)) {

                abort(403, 'Blocked command');

                return 'Blocked command';
            }
        }

        Artisan::call($command);

        return Artisan::output();
    }

    public function migrate()
    {

        Artisan::call('migrate');
        //  Artisan::call('migrate --database=old_sys_db --path=database/migrations/old_db');

        return 'migrate success';

    }


}
