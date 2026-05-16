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
                'title_id' => 'Perancangan REST API yang Scalable dan Maintainable',
                'title_en' => 'Designing Scalable and Maintainable REST APIs',
                'content_id' => '<p>API yang baik bukan hanya yang berfungsi, tapi yang bisa dipahami dan dikembangkan oleh tim dalam jangka panjang. Saya punya prinsip: API contract lebih penting dari implementasi.</p><p>Saya selalu mulai dengan OpenAPI specification sebelum menulis satu baris kode pun. Ini memaksa saya untuk memikirkan edge cases, error responses, dan versioning strategy sejak awal.</p><h3>Prinsip Desain API</h3><ul><li><strong>Konsistensi:</strong> Gunakan resource naming convention yang konsisten dan plural (users, orders, products)</li><li><strong>Filtering dan pagination:</strong> Selalu sediakan mekanisme filter, sort, dan pagination standar</li><li><strong>Error handling:</strong> Respons error harus informatif dengan format JSON yang konsisten</li><li><strong>Rate limiting:</strong> Lindungi endpoint dari abuse dengan throttle yang masuk akal</li></ul><p>Tools seperti Postman collections dan API documentation auto-generated dari OpenAPI menjadi investasi yang sangat berharga.</p>',
                'content_en' => '<p>A good API is not just one that works, but one that can be understood and developed by the team in the long term. I have a principle: the API contract is more important than the implementation.</p><p>I always start with an OpenAPI specification before writing a single line of code. This forces me to think about edge cases, error responses, and versioning strategy from the beginning.</p><h3>API Design Principles</h3><ul><li><strong>Consistency:</strong> Use consistent resource naming conventions and plural forms (users, orders, products)</li><li><strong>Filtering and pagination:</strong> Always provide standard filter, sort, and pagination mechanisms</li><li><strong>Error handling:</strong> Error responses must be informative with a consistent JSON format</li><li><strong>Rate limiting:</strong> Protect endpoints from abuse with sensible throttling</li></ul><p>Tools like Postman collections and API documentation auto-generated from OpenAPI are very valuable investments.</p>',
                'category' => 'Sistem Informasi',
                'tags' => ['API', 'REST', 'Laravel', 'System Analyst'],
                'published_at' => '2024-10-08 09:30:00',
            ],
            [
                'title_id' => 'Cara Saya Menggunakan Claude Code untuk Accelerate Delivery',
                'title_en' => 'How I Use Claude Code to Accelerate Delivery',
                'content_id' => '<p>Claude Code bukan sekadar chatbot coding. Bagi saya, ini adalah pair programmer yang available 24/7 dan tidak pernah lelah. Penggunaan yang tepat bisa mempercepat delivery 2-3x lipat.</p><p>Workflow saya terdiri dari tiga fase: <strong>Discover</strong>, <strong>Design</strong>, dan <strong>Build</strong>. Di setiap fase, Claude Code membantu dengan cara berbeda.</p><h3>Fase Discover</h3><p>Saya menggunakan Claude untuk melakukan requirement analysis awal. Upload dokumen, spesifikasi, atau screenshot, lalu minta Claude mengidentifikasi ambiguitas dan edge cases yang mungkin saya lewatkan.</p><h3>Fase Design</h3><p>ERD, flow diagram, dan API contract design menjadi jauh lebih cepat. Claude bisa generate migration files, model relationships, dan bahkan OpenAPI spec dari deskripsi functional.</p><h3>Fase Build</h3><p>Ini di mana magic terjadi. Dengan context window yang besar, Claude memahami codebase existing dan bisa melakukan refactoring kompleks, implementasi fitur baru, atau debugging dengan sangat efisien.</p><p>Yang terpenting: AI adalah multiplier, bukan pengganti. Keputusan arsitektur dan review kode tetap di tangan manusia.</p>',
                'content_en' => '<p>Claude Code is not just a coding chatbot. For me, it is a pair programmer available 24/7 that never gets tired. Proper usage can accelerate delivery by 2-3x.</p><p>My workflow consists of three phases: <strong>Discover</strong>, <strong>Design</strong>, and <strong>Build</strong>. At each phase, Claude Code helps in different ways.</p><h3>Discover Phase</h3><p>I use Claude for initial requirement analysis. Upload documents, specifications, or screenshots, then ask Claude to identify ambiguities and edge cases that I might miss.</p><h3>Design Phase</h3><p>ERDs, flow diagrams, and API contract design become much faster. Claude can generate migration files, model relationships, and even OpenAPI specs from functional descriptions.</p><h3>Build Phase</h3><p>This is where the magic happens. With a large context window, Claude understands the existing codebase and can perform complex refactoring, new feature implementation, or debugging very efficiently.</p><p>The most important thing: AI is a multiplier, not a replacement. Architectural decisions and code review remain in human hands.</p>',
                'category' => 'Teknologi',
                'tags' => ['System Analyst', 'Artificial Intelligence', 'Laravel'],
                'published_at' => '2025-02-14 09:00:00',
            ],
            [
                'title_id' => 'Powerful Sekali User Story untuk PRD, Task Detail, dan Testing',
                'title_en' => 'How User Stories Power PRDs, Detailed Tasks, and Testing',
                'content_id' => '<p>Setelah beralih ke pendekatan User Story, delivery menjadi jauh lebih cepat dan defect berkurang drastis. Satu kalimat User Story yang tepat bisa menggantikan 5 halaman spesifikasi yang membingungkan.</p><h3>Struktur User Story yang Saya Gunakan</h3><p>Saya tidak pakai template yang rumit. Cukup format klasik dari Mike Cohn:</p><blockquote><p>Sebagai [peran], saya ingin [fitur], agar [manfaat].</p></blockquote><p>Tapi yang membuat beda adalah <strong>Acceptance Criteria</strong> yang ditulis dalam format <strong>Given-When-Then</strong>. Ini memaksa saya untuk memikirkan skenario positif, negatif, dan edge cases sejak awal.</p><h3>Dari User Story ke Markdown Task</h3><p>Saya biasanya breakdown satu User Story menjadi task-task kecil dalam format markdown. Contoh nyata dari project terakhir:</p><pre><code>- [ ] **US-042: Sebagai admin, saya ingin export laporan ke Excel**
    - [ ] Given: user di halaman Report, When: klik "Export", Then: muncul dialog pilih rentang tanggal
    - [ ] Given: rentang tanggal valid, When: klik "Download", Then: file Excel ter-generate dalam 5 detik
    - [ ] Given: rentang tanggal > 1 tahun, When: klik "Download", Then: tampilkan error "Maksimal rentang 1 tahun"
    - [ ] Backend: endpoint `GET /api/reports/export` dengan query param `from` dan `to`
    - [ ] Frontend: komponen DateRangePicker dengan validasi client-side
    - [ ] QA: test case untuk skenario happy path + 3 edge cases di atas</code></pre><p>Dengan struktur ini, developer tahu persis scope kerjanya. QA tahu apa yang harus di-test. Stakeholder tahu kapan story dianggap "done".</p><h3>User Story sebagai Living Documentation</h3><p>Yang saya suka dari User Story: dia bisa jadi <strong>living documentation</strong>. Saat fitur berubah, update story-nya. Tidak perlu maintain dokumen terpisah yang cepat outdated.</p><p>Saya simpan semua story dalam file markdown di repo project, di folder `docs/stories/`. Setiap story punya ID unik yang di-refer dari commit message. Jadi dari `git log`, saya bisa trace fitur mana yang sedang dikerjakan.</p><h3>Kesimpulan</h3><p>User Story bukan cuma "cerita user". Dia adalah fondasi dari PRD, task breakdown, test case, dan dokumentasi. Satu kalimat yang ditulis dengan benar bisa menghemat puluhan jam meeting dan refactoring di kemudian hari.</p>',
                'content_en' => '<p>After switching to a User Story approach, delivery became much faster and defects dropped dramatically. One well-crafted User Story can replace 5 pages of confusing specifications.</p><h3>The User Story Structure I Use</h3><p>I do not use complicated templates. Just the classic format from Mike Cohn:</p><blockquote><p>As a [role], I want [feature], so that [benefit].</p></blockquote><p>But what makes the difference is the <strong>Acceptance Criteria</strong> written in <strong>Given-When-Then</strong> format. This forces me to think about positive scenarios, negative scenarios, and edge cases from the start.</p><h3>From User Story to Markdown Task</h3><p>I usually break down one User Story into small tasks in markdown format. A real example from a recent project:</p><pre><code>- [ ] **US-042: As an admin, I want to export reports to Excel**
  - [ ] Given: user on Report page, When: click "Export", Then: dialog appears to select date range
  - [ ] Given: valid date range, When: click "Download", Then: Excel file generates within 5 seconds
  - [ ] Given: date range > 1 year, When: click "Download", Then: show error "Maximum range is 1 year"
  - [ ] Backend: `GET /api/reports/export` endpoint with `from` and `to` query params
  - [ ] Frontend: DateRangePicker component with client-side validation
  - [ ] QA: test case for happy path + 3 edge cases above</code></pre><p>With this structure, developers know exactly what to build. QA knows what to test. Stakeholders know when a story is considered "done".</p><h3>User Story as Living Documentation</h3><p>What I love about User Stories: they can become <strong>living documentation</strong>. When a feature changes, update the story. No need to maintain separate documents that quickly become outdated.</p><p>I store all stories in markdown files in the project repo, under `docs/stories/`. Each story has a unique ID referenced from commit messages. So from `git log`, I can trace which feature is being worked on.</p><h3>Conclusion</h3><p>A User Story is not just a "user\'s story." It is the foundation of PRDs, task breakdowns, test cases, and documentation. One properly written sentence can save dozens of hours of meetings and refactoring later.</p>',
                'category' => 'Teknologi',
                'tags' => ['System Analyst', 'User Story', 'PRD', 'Testing'],
                'published_at' => '2025-04-28 08:00:00',
            ],
            [
                'title_id' => 'Sinkronisasi Headless: Mengatur Ritme Kerja Backend dan Frontend',
                'title_en' => 'Headless Synchronization: Managing Backend and Frontend Workflow',
                'content_id' => '<p>Beralih ke arsitektur headless (decoupled) seringkali menjadi pedang bermata dua. Di satu sisi, fleksibilitas meningkat drastis. Di sisi lain, risiko desinkronisasi antara Backend (BE) dan Frontend (FE) menjadi tantangan harian.</p><p>Masalah klasik yang sering saya temui: tim FE terhambat karena menunggu endpoint API selesai, atau tim BE mengubah struktur respons tanpa pemberitahuan. Ini adalah inefisiensi yang harus dieliminasi.</p><h3>API-First: Kontrak di Atas Segalanya</h3><p>Tips pertama adalah berhenti membangun kode sebelum membangun kontrak. Saya selalu mewajibkan pembuatan dokumentasi OpenAPI/Swagger di awal. Dengan kontrak yang jelas, tim FE bisa mulai bekerja menggunakan <strong>mock server</strong> (seperti Prism atau Mockoon) tanpa harus menunggu logic BE selesai.</p><h3>Tips Mengatur Task</h3><ul><li><strong>Definisikan DTO (Data Transfer Object):</strong> Pastikan format request dan response sudah disepakati di Jira/Trello. Perubahan properti sekecil apapun harus dikomunikasikan lewat diskusi teknis, bukan langsung di kode.</li><li><strong>Pecah Task Secara Paralel (Parallel Decomposition):</strong> Jangan buat task FE dependen pada penyelesaian task BE. Di papan Kanban, bagi task FE menjadi pembuatan komponen UI terlebih dahulu menggunakan data statis (fixtures), sementara BE fokus pada core logic dan query database. Keduanya baru bertemu di satu task integrasi akhir.</li><li><strong>Validasi Sentral di Backend (Single Source of Truth):</strong> Hindari *double work* dengan menduplikasi aturan validasi di FE dan BE. Tetapkan prinsip bahwa backend adalah satu-satunya penjaga gerbang validitas data. Tim FE tidak perlu menulis ulang logika validasi yang rumit; mereka cukup fokus menangkap response error (seperti HTTP Status 422) dari BE dan menampilkan pesan kesalahannya secara dinamis ke user. Ini memotong waktu development FE secara signifikan.</li></ul><p>Kesuksesan headless development bukan terletak pada kecanggihan stack-nya, tapi pada seberapa kuat "jembatan" komunikasi yang dibangun lewat dokumentasi.</p>',
                'content_en' => '<p>Moving to a headless (decoupled) architecture is often a double-edged sword. On one hand, flexibility increases drastically. On the other, the risk of desynchronization between Backend (BE) and Frontend (FE) becomes a daily challenge.</p><p>A classic problem I often encounter: the FE team is blocked waiting for API endpoints to be finished, or the BE team changes the response structure without notice. This is an inefficiency that must be eliminated.</p><h3>API-First: Contract Above All</h3><p>The first tip is to stop building code before building the contract. I always mandate the creation of OpenAPI/Swagger documentation at the beginning. With a clear contract, the FE team can start working using <strong>mock servers</strong> (like Prism or Mockoon) without waiting for the BE logic to be completed.</p><h3>Task Management Tips</h3><ul><li><strong>Define DTOs (Data Transfer Objects):</strong> Ensure request and response formats are agreed upon in Jira/Trello. Even the smallest property changes must be communicated through technical discussions, not directly in the code.</li><li><strong>Parallel Task Decomposition:</strong> Do not make FE tasks dependent on BE completion. On the Kanban board, split FE tasks into UI component development using static data (fixtures) first, while BE focuses on core logic and database queries. The two should only meet in a final integration task.</li><li><strong>Centralized Backend Validation (Single Source of Truth):</strong> Avoid double work by duplicating validation rules on both FE and BE. Establish the principle that the backend is the sole gatekeeper of data validity. The FE team does not need to rewrite complex validation logic; they just focus on catching error responses (like HTTP Status 422) from the BE and rendering the error messages dynamically to the user. This significantly cuts down FE development time.</li></ul><p>The success of headless development lies not in how sophisticated the stack is, but in how strong the communication "bridge" built through documentation is.</p>',
                'category' => 'Sistem Informasi',
                'tags' => ['Headless', 'API', 'System Analyst', 'Project Management'],
                'published_at' => '2026-05-16 11:00:00',
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

            $tagIds = $allTags->whereIn('name_id', $postData['tags'])->pluck('id')->toArray();
            $post->tags()->attach($tagIds);
        }
    }
}
