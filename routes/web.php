<?php

use App\Http\Controllers\Auth\PublicKeyController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PortfolioController;
use App\Http\Controllers\Public\ProjectController;
use App\Http\Controllers\Public\RssController;
use App\Http\Controllers\Public\SitemapController;
use App\Livewire\Admin\AuditLogTable;
use App\Livewire\Admin\BeritaDetail;
use App\Livewire\Admin\BeritaForm;
use App\Livewire\Admin\BeritaTable;
use App\Livewire\Admin\CertificateForm;
use App\Livewire\Admin\CertificateTable;
use App\Livewire\Admin\ContactDetail;
use App\Livewire\Admin\ContactTable;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EducationForm;
use App\Livewire\Admin\EducationTable;
use App\Livewire\Admin\EmailTester;
use App\Livewire\Admin\ExperienceForm;
use App\Livewire\Admin\ExperienceTable;
use App\Livewire\Admin\KategoriManager;
use App\Livewire\Admin\ProfileForm;
use App\Livewire\Admin\ProjectForm;
use App\Livewire\Admin\ProjectTable;
use App\Livewire\Admin\QueueMonitor;
use App\Livewire\Admin\RoleManager;
use App\Livewire\Admin\ScheduleTaskManager;
use App\Livewire\Admin\SiteSettingsForm;
use App\Livewire\Admin\SkillCategoryManager;
use App\Livewire\Admin\SystemLogViewer;
use App\Livewire\Admin\TagManager;
use App\Livewire\Admin\UserForm;
use App\Livewire\Admin\UserProfile;
use App\Livewire\Admin\UserTable;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::middleware(\App\Http\Middleware\AllowIndexing::class)
    ->group(function () {
        Route::get('/', HomeController::class)->name('home');
        Route::get('/about', AboutController::class)->name('about');
        Route::get('/blog', [BeritaController::class, 'index'])->name('blog.index');
        Route::get('/blog/{slug}', [BeritaController::class, 'show'])->name('blog.show');

        Route::get('/berita', fn () => redirect()->route('blog.index'));
        Route::get('/berita/{slug}', fn ($slug) => redirect()->route('blog.show', $slug));

        Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
        Route::get('/portfolio/{slug}', [ProjectController::class, 'show'])->name('portfolio.show');

        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

        Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
        Route::get('/feed.xml', RssController::class)->name('rss');

        Route::post('/locale', function () {
            $locale = request('locale');
            if (! in_array($locale, ['id', 'en'])) {
                return response()->json(['success' => false], 400);
            }

            session(['locale' => $locale]);
            app()->setLocale($locale);

            return response()->json(['success' => true, 'locale' => $locale]);
        })->name('locale.switch');

        Route::get('/auth/public-key', PublicKeyController::class)
            ->middleware('throttle:10,1')
            ->name('auth.public-key');

        Route::get('/robots.txt', function () {
            $robots = file_get_contents(resource_path('views/robots.txt'));

            // Replace APP_URL placeholder
            $robots = str_replace('{{APP_URL}}', config('app.url'), $robots);

            // Replace CRAWL_DELAY placeholder
            $robots = str_replace('{{CRAWL_DELAY}}', config('seo.robots.crawl_delay', 10), $robots);

            // Build Disallow lines from config
            $disallowLines = '';
            foreach (config('seo.robots.disallow', ['/admin/', '/login/']) as $path) {
                $disallowLines .= 'Disallow: '.trim($path)."\n";
            }
            $robots = str_replace('{{DISALLOW_PATHS}}', $disallowLines, $robots);

            return response($robots)
                ->header('Content-Type', 'text/plain');
        })->name('robots.txt');
    });

Route::get('/admin', function () {
    return auth()->check()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('login');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin Routes
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', Dashboard::class)
            ->middleware('permission:dashboard-access')
            ->name('dashboard');

        Route::get('/profil-pengguna', UserProfile::class)
            ->name('profil-pengguna');

        Route::get('/kategori', KategoriManager::class)
            ->middleware('permission:categories-list')
            ->name('kategori');
        Route::get('/tags', TagManager::class)
            ->middleware('permission:tags-list')
            ->name('tags');

        Route::get('/blog', BeritaTable::class)
            ->middleware('permission:posts-list')
            ->name('blog');
        Route::get('/blog/create', BeritaForm::class)
            ->middleware('permission:posts-create')
            ->name('blog.create');
        Route::get('/blog/{post}', BeritaDetail::class)
            ->middleware('permission:posts-list')
            ->name('blog.show');
        Route::get('/blog/{post}/edit', BeritaForm::class)
            ->middleware('permission:posts-edit')
            ->name('blog.edit');

        Route::get('/profile', ProfileForm::class)
            ->name('profile');

        Route::get('/experiences', ExperienceTable::class)
            ->name('experiences');
        Route::get('/experiences/create', ExperienceForm::class)
            ->name('experiences.create');
        Route::get('/experiences/{experience}/edit', ExperienceForm::class)
            ->name('experiences.edit');

        Route::get('/educations', EducationTable::class)
            ->name('educations');
        Route::get('/educations/create', EducationForm::class)
            ->name('educations.create');
        Route::get('/educations/{education}/edit', EducationForm::class)
            ->name('educations.edit');

        Route::get('/skills', SkillCategoryManager::class)
            ->name('skills');

        Route::get('/projects', ProjectTable::class)
            ->name('projects');
        Route::get('/projects/create', ProjectForm::class)
            ->name('projects.create');
        Route::get('/projects/{project}/edit', ProjectForm::class)
            ->name('projects.edit');

        Route::get('/certificates', CertificateTable::class)
            ->name('certificates');
        Route::get('/certificates/create', CertificateForm::class)
            ->name('certificates.create');
        Route::get('/certificates/{certificate}/edit', CertificateForm::class)
            ->name('certificates.edit');

        Route::get('/contacts', ContactTable::class)
            ->name('contacts');
        Route::get('/contacts/{contact}', ContactDetail::class)
            ->name('contacts.show');

    });

// Super Admin Only Routes
Route::middleware(['auth', 'role:super-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/users', UserTable::class)
            ->middleware('permission:users-list')
            ->name('users');
        Route::get('/users/create', UserForm::class)
            ->middleware('permission:users-create')
            ->name('users.create');
        Route::get('/users/{user}/edit', UserForm::class)
            ->middleware('permission:users-edit')
            ->name('users.edit');

        Route::get('/roles', RoleManager::class)
            ->middleware('permission:roles-list')
            ->name('roles');

        Route::get('/pengaturan', SiteSettingsForm::class)
            ->middleware('permission:settings-list')
            ->name('pengaturan');

        Route::get('/audit-logs', AuditLogTable::class)
            ->middleware('permission:audit-logs-list')
            ->name('audit-logs');

        Route::get('/system-logs', SystemLogViewer::class)
            ->middleware('permission:system-logs-list')
            ->name('system-logs');

        Route::get('/email-tester', EmailTester::class)
            ->middleware('permission:system-email-tester')
            ->name('email-tester');

        Route::get('/queue-monitor', QueueMonitor::class)
            ->middleware('permission:system-queue-monitor')
            ->name('queue-monitor');

        Route::get('/schedule-tasks', ScheduleTaskManager::class)
            ->middleware('permission:schedule-tasks-list')
            ->name('schedule-tasks');
    });

// Fallback 404 — must be last route; ensures web middleware (SetLocale) runs on 404 pages
Route::fallback(function () {
    if (str_starts_with(request()->path(), 'admin')) {
        return response()->view('errors.404-admin', [], 404);
    }
    return response()->view('errors.404', [], 404);
});

require __DIR__.'/auth.php';
