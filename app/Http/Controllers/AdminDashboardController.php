<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;

class AdminDashboardController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }


    public function index()
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        $categoryCount = Category::count();
        $cityCount = City::count();
        $companyCount = Company::count();

        $topCompanies = Company::withCount('announcements')
        ->orderByDesc('announcements_count')
        ->take(5)
        ->get();

        $leastCompanies = Company::withCount('announcements')
        ->orderBy('announcements_count') 
        ->take(5)
        ->get();

        if ($currentUser->hasRole('super-admin')) {
            $announcements = Announcement::count();
            $announcementCount = Announcement::where('status', 'approved')->count();
            $canceledAnnouncements = Announcement::where('status', 'canceled')->count();
            $expiredAnnouncements = Announcement::where('status', 'expired')->get();
            $expiredAnnouncementsCount = Announcement::where('status', 'expired')->count();
            $pendingAnnouncements = Announcement::where('status', 'pending')->count();
        } elseif ($currentUser->hasRole('employee')) {
            $announcements = Announcement::where('user_id', $currentUser->id)->count();
            $announcementCount = Announcement::where('status', 'approved')
                ->where('user_id', $currentUser->id)
                ->count();
            $canceledAnnouncements = Announcement::where('status', 'canceled')
                ->where('user_id', $currentUser->id)
                ->count();
            $expiredAnnouncements = Announcement::where('status', 'expired')
                ->where('user_id', $currentUser->id)->get();
            $expiredAnnouncementsCount = Announcement::where('status', 'expired')
                ->where('user_id', $currentUser->id)
                ->count();
            $pendingAnnouncements = Announcement::where('status', 'pending')
                ->where('user_id', $currentUser->id)
                ->count();
        }

        return view('admin.dashboard.index', compact(
            'categoryCount',
            'cityCount',
            'companyCount',
            'announcements',
            'announcementCount',
            'canceledAnnouncements',
            'expiredAnnouncements',
            'expiredAnnouncementsCount',
            'pendingAnnouncements',
            'topCompanies',
            'leastCompanies'
        ));
    }



    public function notifications()
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'You must be logged in to view notifications.');
        }

        $notifications = $currentUser->notifications->filter(function ($notification) {
            if (isset($notification->data['link'])) {
                $announcementId = last(explode('/', $notification->data['link']));
                return \App\Models\Announcement::find($announcementId) !== null;
            }
            return false;
        });

        return view('admin.dashboard.notifications', [
            'notifications' => $notifications,
        ]);
    }

    public function markNotificationsAsRead()
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        // Mark all unread notifications as read
        $currentUser->unreadNotifications->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notifications marked as read',
            'unreadCount' => $currentUser->unreadNotifications->count()
        ]);
    }
}
