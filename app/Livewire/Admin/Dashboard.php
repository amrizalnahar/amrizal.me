<?php

namespace App\Livewire\Admin;

use App\Models\AuditTrail;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'posts' => 0,
            'projects' => 0,
            'certificates' => 0,
            'unreadContacts' => 0,
        ];

        $latestActivities = collect();
        $recentContacts = collect();
        $recentPosts = collect();

        if (Schema::hasTable('posts')) {
            $stats['posts'] = Post::where('status', 'published')->count();
            $recentPosts = Post::where('status', 'published')->latest()->take(5)->get();
        }
        if (Schema::hasTable('projects')) {
            $stats['projects'] = Project::count();
        }
        if (Schema::hasTable('certificates')) {
            $stats['certificates'] = Certificate::count();
        }
        if (Schema::hasTable('contacts')) {
            $stats['unreadContacts'] = Contact::unread()->count();
            $recentContacts = Contact::latest()->take(5)->get();
        }
        if (Schema::hasTable('audit_trails')) {
            $latestActivities = AuditTrail::with('user')->latest()->limit(10)->get();
        }

        return view('livewire.admin.dashboard', compact('stats', 'latestActivities', 'recentContacts', 'recentPosts'));
    }
}
