<?php
namespace App\Services;

use Illuminate\Support\Str;
use App\Services\Interfaces\SubscriptionInterface;
use App\Models\WebPortal;
use DB;

// class WebPortalService implements SubscriptionInterface
class WebPortalService 
{
    public function create($data=[]): WebPortal
    {
        $WebPortal = new WebPortal();

        $WebPortal->portal_name = $data['portal_name'];
        $WebPortal->status = '1';
        $WebPortal->secret_key = Str::random(64);

        $WebPortal->save();
        return $WebPortal;
    }

    public function getActivePortalByKey($secretKey)
    {
        $WebPortal = WebPortal::where('status', '1')->where('secret_key', $secretKey)->first();

        return $WebPortal;
    }

}
