<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@example.com')->first();
        $editorUser = User::where('email', 'editor@example.com')->first();
        $authorId = $adminUser?->id ?? $editorUser?->id ?? 1;

        $postCategories = Category::byModule('post')->get();
        $allTags = Tag::all();

        $posts = [
            [
                'title_id' => 'Dari Spreadsheet ke Dashboard: Redesign Laporan Operasional',
                'title_en' => 'From Spreadsheet to Dashboard: Redesigning Operational Reports',
                'content_id' => '<p>Selama dua tahun, tim operasional menghabiskan hampir 2 hari per minggu hanya untuk menggabungkan dan memformat laporan Excel. Proses manual ini rentan error dan lambat.</p><p>Saya mengidentifikasi pain point utama: data tersebar di berbagai sumber, tidak ada single source of truth, dan setiap divisi punya format laporan yang berbeda.</p><h3>Proses Analisis</h3><p>Tahap pertama adalah wawancara mendalam dengan stakeholders. Dari situ saya memetakan data flow dan menentukan KPI yang benar-benar dibutuhkan vs yang hanya "nice to have".</p><p>Tahap kedua: perancangan arsitektur data. Kami memilih Laravel sebagai backend dengan MySQL untuk data warehouse sederhana, dan Vue.js untuk frontend dashboard.</p><h3>Hasil</h3><p>Waktu reporting turun dari 16 jam/minggu menjadi real-time. Stakeholder bisa langsung melihat metrics terkini tanpa menunggu akhir pekan.</p>',
                'content_en' => '<p>For two years, the operations team spent almost 2 days per week just merging and formatting Excel reports. This manual process was error-prone and slow.</p><p>I identified the main pain points: data scattered across various sources, no single source of truth, and each department had different report formats.</p><h3>Analysis Process</h3><p>The first step was in-depth interviews with stakeholders. From there I mapped the data flow and determined which KPIs were truly needed vs those that were just "nice to have".</p><p>Second step: data architecture design. We chose Laravel as the backend with MySQL for a simple data warehouse, and Vue.js for the dashboard frontend.</p><h3>Results</h3><p>Reporting time dropped from 16 hours/week to real-time. Stakeholders can now see current metrics instantly without waiting for the weekend.</p>',
                'category' => 'Sistem Informasi',
                'tags' => ['Laravel', 'MySQL', 'System Analyst'],
                'published_at' => '2024-04-22 10:00:00',
            ],
            [
                'title_id' => 'Kenapa System Analyst Perlu Bisa Coding di 2026',
                'title_en' => 'Why System Analysts Need to Code in 2026',
                'content_id' => '<p>Peran System Analyst sedang bertransformasi drastis. Di era AI tools seperti Cursor, Claude Code, dan Copilot, gap antara analisis dan implementasi semakin menipis.</p><p>Saya sendiri merasakan perubahan ini. Dulu, setelah merancang ERD dan flow diagram, saya menyerahkan spesifikasi ke developer. Sekarang, dengan bantuan AI, saya bisa langsung mengeksekusi solusi yang saya rancang.</p><h3>Keuntungan Bisa Coding</h3><ul><li><strong>Validasi feasibilitas:</strong> Rancangan yang terlihat bagus di kertas bisa jadi tidak praktis di kode. Dengan bisa coding, saya langsung tahu constraint teknisnya.</li><li><strong>Komunikasi lebih efektif:</strong> Developer lebih menghargai spesifikasi yang datang dari orang yang paham kode.</li><li><strong>Iterasi lebih cepat:</strong> Prototyping functional jauh lebih powerful daripada mockup statis.</li></ul><p>Bukan berarti SA harus jadi senior developer. Cukup paham satu stack utama dan mampu membangun MVP sederhana.</p>',
                'content_en' => '<p>The role of System Analyst is transforming drastically. In the era of AI tools like Cursor, Claude Code, and Copilot, the gap between analysis and implementation is narrowing.</p><p>I have experienced this change myself. Previously, after designing ERDs and flow diagrams, I would hand over specifications to developers. Now, with AI assistance, I can directly execute the solutions I design.</p><h3>Benefits of Being Able to Code</h3><ul><li><strong>Feasibility validation:</strong> Designs that look good on paper may not be practical in code. Being able to code, I immediately know the technical constraints.</li><li><strong>More effective communication:</strong> Developers appreciate specifications coming from someone who understands code.</li><li><strong>Faster iteration:</strong> Functional prototyping is far more powerful than static mockups.</li></ul><p>This does not mean an SA must become a senior developer. Just understand one main stack and be able to build a simple MVP.</p>',
                'category' => 'Karir',
                'tags' => ['System Analyst', 'PHP', 'DevOps'],
                'published_at' => '2024-05-10 09:00:00',
            ],
            [
                'title_id' => 'Membangun ERP dengan Laravel dan Livewire',
                'title_en' => 'Building an ERP with Laravel and Livewire',
                'content_id' => '<p>ERP sering diasosiasikan dengan teknologi enterprise yang berat dan mahal. Namun dengan Laravel dan Livewire, kami berhasil membangun modul ERP yang lightweight namun powerful untuk UKM.</p><p>Stack yang kami gunakan: Laravel 11, Livewire 3, Tailwind CSS, dan Spatie Permission untuk RBAC. Semua berjalan di single VPS dengan biaya operasional minimal.</p><h3>Arsitektur Modular</h3><p>Setiap modul ERP (inventory, procurement, finance, HR) di-package sebagai Laravel package tersendiri. Ini memungkinkan klien untuk mengaktifkan hanya modul yang dibutuhkan.</p><p>Livewire memungkinkan kami membangun interaktivitas kompleks tanpa memisahkan frontend dan backend secara drastis. Development jadi lebih cepat dan maintenance lebih mudah.</p>',
                'content_en' => '<p>ERP is often associated with heavy and expensive enterprise technology. However, with Laravel and Livewire, we successfully built a lightweight yet powerful ERP module for SMEs.</p><p>The stack we used: Laravel 11, Livewire 3, Tailwind CSS, and Spatie Permission for RBAC. Everything runs on a single VPS with minimal operational costs.</p><h3>Modular Architecture</h3><p>Each ERP module (inventory, procurement, finance, HR) is packaged as a separate Laravel package. This allows clients to activate only the modules they need.</p><p>Livewire enabled us to build complex interactivity without drastically separating frontend and backend. Development became faster and maintenance easier.</p>',
                'category' => 'Pemrograman',
                'tags' => ['Laravel', 'PHP', 'ERP', 'System Analyst'],
                'published_at' => '2024-08-12 06:00:00',
            ],
            [
                'title_id' => 'Perancangan REST API yang Scalable dan Maintainable',
                'title_en' => 'Designing Scalable and Maintainable REST APIs',
                'content_id' => '<p>API yang baik bukan hanya yang berfungsi, tapi yang bisa dipahami dan dikembangkan oleh tim dalam jangka panjang. Saya punya prinsip: API contract lebih penting dari implementasi.</p><p>Saya selalu mulai dengan OpenAPI specification sebelum menulis satu baris kode pun. Ini memaksa saya untuk memikirkan edge cases, error responses, dan versioning strategy sejak awal.</p><h3>Prinsip Desain API</h3><ul><li><strong>Konsistensi:</strong> Gunakan resource naming convention yang konsisten dan plural (users, orders, products)</li><li><strong>Filtering dan pagination:</strong> Selalu sediakan mekanisme filter, sort, dan pagination standar</li><li><strong>Error handling:</strong> Respons error harus informatif dengan format JSON yang konsisten</li><li><strong>Rate limiting:</strong> Lindungi endpoint dari abuse dengan throttle yang masuk akal</li></ul><p>Tools seperti Postman collections dan API documentation auto-generated dari OpenAPI menjadi investasi yang sangat berharga.</p>',
                'content_en' => '<p>A good API is not just one that works, but one that can be understood and developed by the team in the long term. I have a principle: the API contract is more important than the implementation.</p><p>I always start with an OpenAPI specification before writing a single line of code. This forces me to think about edge cases, error responses, and versioning strategy from the beginning.</p><h3>API Design Principles</h3><ul><li><strong>Consistency:</strong> Use consistent resource naming conventions and plural forms (users, orders, products)</li><li><strong>Filtering and pagination:</strong> Always provide standard filter, sort, and pagination mechanisms</li><li><strong>Error handling:</strong> Error responses must be informative with a consistent JSON format</li><li><strong>Rate limiting:</strong> Protect endpoints from abuse with sensible throttling</li></ul><p>Tools like Postman collections and API documentation auto-generated from OpenAPI are very valuable investments.</p>',
                'category' => 'Sistem Informasi',
                'tags' => ['API', 'REST', 'Laravel', 'System Analyst'],
                'published_at' => '2024-10-08 09:30:00',
            ],
            [
                'title_id' => 'Docker untuk Development Environment Laravel',
                'title_en' => 'Docker for Laravel Development Environment',
                'content_id' => '<p>"Works on my machine" adalah masalah klasik yang menghabiskan waktu berharga. Docker menyelesaikan masalah ini dengan mendefinisikan environment yang identik untuk semua developer di tim.</p><p>Saya menggunakan Laravel Sail sebagai starting point, namun menyesuaikan beberapa hal: menambahkan Redis untuk queue dan cache, Meilisearch untuk full-text search, dan Mailpit untuk email testing lokal.</p><h3>Docker Compose Setup</h3><p>Konfigurasi docker-compose.yml kami mendefinisikan service terpisah untuk app, web server, database, dan queue worker. Ini memungkinkan developer untuk menjalankan hanya service yang dibutuhkan.</p><p>Selain konsistensi, Docker juga memudahkan onboarding developer baru. Clone repo, run <code>docker-compose up</code>, dan dalam 5 menit environment siap digunakan.</p>',
                'content_en' => '<p>"Works on my machine" is a classic problem that wastes valuable time. Docker solves this by defining an identical environment for all developers on the team.</p><p>I use Laravel Sail as a starting point, but customize a few things: adding Redis for queue and cache, Meilisearch for full-text search, and Mailpit for local email testing.</p><h3>Docker Compose Setup</h3><p>Our docker-compose.yml configuration defines separate services for app, web server, database, and queue worker. This allows developers to run only the services they need.</p><p>Besides consistency, Docker also makes onboarding new developers easier. Clone the repo, run <code>docker-compose up</code>, and within 5 minutes the environment is ready to use.</p>',
                'category' => 'Pemrograman',
                'tags' => ['Docker', 'Laravel', 'PHP', 'DevOps'],
                'published_at' => '2024-12-05 07:30:00',
            ],
            [
                'title_id' => 'Cara Saya Menggunakan Claude Code untuk Accelerate Delivery',
                'title_en' => 'How I Use Claude Code to Accelerate Delivery',
                'content_id' => '<p>Claude Code bukan sekadar chatbot coding. Bagi saya, ini adalah pair programmer yang available 24/7 dan tidak pernah lelah. Penggunaan yang tepat bisa mempercepat delivery 2-3x lipat.</p><p>Workflow saya terdiri dari tiga fase: <strong>Discover</strong>, <strong>Design</strong>, dan <strong>Build</strong>. Di setiap fase, Claude Code membantu dengan cara berbeda.</p><h3>Fase Discover</h3><p>Saya menggunakan Claude untuk melakukan requirement analysis awal. Upload dokumen, spesifikasi, atau screenshot, lalu minta Claude mengidentifikasi ambiguitas dan edge cases yang mungkin saya lewatkan.</p><h3>Fase Design</h3><p>ERD, flow diagram, dan API contract design menjadi jauh lebih cepat. Claude bisa generate migration files, model relationships, dan bahkan OpenAPI spec dari deskripsi functional.</p><h3>Fase Build</h3><p>Ini di mana magic terjadi. Dengan context window yang besar, Claude memahami codebase existing dan bisa melakukan refactoring kompleks, implementasi fitur baru, atau debugging dengan sangat efisien.</p><p>Yang terpenting: AI adalah multiplier, bukan pengganti. Keputusan arsitektur dan review kode tetap di tangan manusia.</p>',
                'content_en' => '<p>Claude Code is not just a coding chatbot. For me, it is a pair programmer available 24/7 that never gets tired. Proper usage can accelerate delivery by 2-3x.</p><p>My workflow consists of three phases: <strong>Discover</strong>, <strong>Design</strong>, and <strong>Build</strong>. At each phase, Claude Code helps in different ways.</p><h3>Discover Phase</h3><p>I use Claude for initial requirement analysis. Upload documents, specifications, or screenshots, then ask Claude to identify ambiguities and edge cases that I might miss.</p><h3>Design Phase</h3><p>ERDs, flow diagrams, and API contract design become much faster. Claude can generate migration files, model relationships, and even OpenAPI specs from functional descriptions.</p><h3>Build Phase</h3><p>This is where the magic happens. With a large context window, Claude understands the existing codebase and can perform complex refactoring, new feature implementation, or debugging very efficiently.</p><p>The most important thing: AI is a multiplier, not a replacement. Architectural decisions and code review remain in human hands.</p>',
                'category' => 'Teknologi',
                'tags' => ['System Analyst', 'DevOps', 'Laravel'],
                'published_at' => '2025-02-14 09:00:00',
            ],
        ];

        foreach ($posts as $postData) {
            $category = $postCategories->firstWhere('name', $postData['category']);
            $post = Post::create([
                'title_id' => $postData['title_id'],
                'title_en' => $postData['title_en'],
                'slug' => Str::slug($postData['title_id']),
                'content_id' => $postData['content_id'],
                'content_en' => $postData['content_en'],
                'category_id' => $category?->id,
                'status' => 'published',
                'published_at' => $postData['published_at'],
                'author_id' => $authorId,
            ]);

            $tagIds = $allTags->whereIn('name', $postData['tags'])->pluck('id')->toArray();
            $post->tags()->attach($tagIds);
        }
    }
}
