<?php

namespace App\Livewire\Admin;

use App\Models\AuditTrail;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Project;
use App\Models\Visitor;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public string $visitorRange = '7';

    #[Computed]
    public function visitorStats(): array
    {
        if (! Schema::hasTable('visitors')) {
            return [];
        }

        $days = (int) $this->visitorRange;
        $endDate = now()->endOfDay();
        $startDate = now()->subDays($days - 1)->startOfDay();

        $rawStats = Visitor::query()
            ->whereBetween('visited_at', [$startDate, $endDate])
            ->selectRaw('DATE(visited_at) as date, COUNT(*) as total, COUNT(DISTINCT ip_address) as unique_visitors')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $stats = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateKey = $date->format('Y-m-d');
            $dayStats = $rawStats->get($dateKey);

            $stats[] = [
                'date' => $dateKey,
                'date_label' => $date->translatedFormat('d M'),
                'total' => (int) ($dayStats?->total ?? 0),
                'unique' => (int) ($dayStats?->unique_visitors ?? 0),
            ];
        }

        return $stats;
    }

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
