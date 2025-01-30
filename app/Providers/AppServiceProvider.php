<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


     public function boot()
     {
         View::composer('*', function ($view) {
             $currentUser = Auth::user();
            /** @var User $currentUser */
             if ($currentUser && ($currentUser->hasRole('super-admin') || $currentUser->hasRole('employee'))) {
                 // Fetch all announcement IDs that are used in notifications
                 $announcementIds = $currentUser->notifications->filter(function ($notification) {
                     if (isset($notification->data['link'])) {
                         return last(explode('/', $notification->data['link']));
                     }
                     return null;
                 })->pluck('data.link')
                   ->map(function ($link) {
                       return last(explode('/', $link)); // Extracts the ID
                   });
     
                 // Get announcements in a single query
                 $announcements = \App\Models\Announcement::whereIn('id', $announcementIds)->get()->keyBy('id');
     
                 // Filter notifications to check if the announcement exists in the collection
                 $notifications = $currentUser->notifications->filter(function ($notification) use ($announcements) {
                     if (isset($notification->data['link'])) {
                         $announcementId = last(explode('/', $notification->data['link']));
                         return $announcements->has($announcementId);
                     }
                     return false;
                 });
     
                 $unreadNotificationCount = $currentUser->unreadNotifications->filter(function ($notification) use ($announcements) {
                     if (isset($notification->data['link'])) {
                         $announcementId = last(explode('/', $notification->data['link']));
                         return $announcements->has($announcementId);
                     }
                     return false;
                 })->count();
     
                 $view->with([
                     'notifications' => $notifications,
                     'unreadNotificationCount' => $unreadNotificationCount,
                 ]);
             } else {
                 $view->with([
                     'notifications' => [],
                     'unreadNotificationCount' => 0,
                 ]);
             }
         });
     }
     
}
