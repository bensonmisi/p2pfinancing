<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use App\Models\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::share('app.name',config('app.name'));
        Inertia::share('errors',function(){
          return session()->get('errors') ? session()->get('errors')->getBag('default')->getMessages() :(object)[];
        });
        Inertia::share('successMessage',function(){
            return session()->get('successMessage') ? session()->get('successMessage') : null;
        });
        Inertia::share('errorMessage',function(){
            return session()->get('errorMessage') ? session()->get('errorMessage') : null;
        });
        Inertia::share('status',function(){
            return session()->get('status') ? session()->get('status') : null;
        });
        Inertia::share('user',function(Request $request){
         return $request->user() ? $request->user()->only('id','name','surname','email') : null;
        });
        Inertia::share('modules',function (Request $request){

            $modules=[];
            if(!is_null($request->user())) {
                $user = User::whereid($request->user()->id)->with('role.modules')->first();
                if (!is_null($user)) {
                    if (!is_null($user->role)) {
                        if (count($user->role->modules) > 0) {
                            foreach ($user->role->modules as $key => $value) {
                                $modules[] = array("id" => $value->id, "icon" => $value->icon, 'name' => $value->name, 'link' => $value->link);
                            }
                        }
                    }
                }
            }
          return $modules;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
