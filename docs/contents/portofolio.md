# 📁 Portfolio — System Analyst

> Kumpulan proyek yang mencerminkan kompetensi dalam analisis sistem, perancangan arsitektur, dan dokumentasi teknis end-to-end di domain Retail/e-Commerce dan Logistik.

---

## 🛒 Proyek 1 — Pengembangan Platform Omnichannel E-Commerce

**Domain:** Retail / e-Commerce
**Peran:** Lead System Analyst
**Durasi:** 6 Bulan (Jan 2024 – Jun 2024)
**Tim:** 1 System Analyst, 2 Backend Developer, 1 Frontend Developer, 1 QA Engineer

### Deskripsi Proyek

Perusahaan retail fashion lokal dengan 40+ toko fisik menghadapi tantangan terputusnya data antara kanal penjualan online dan offline. Stok produk tidak tersinkronisasi secara real-time, menyebabkan overselling di platform digital dan penumpukan stok di gudang. Proyek ini bertujuan membangun platform e-commerce terintegrasi yang menyatukan kanal penjualan online (web & mobile app), Point of Sale (POS) toko fisik, dan sistem manajemen gudang dalam satu ekosistem data yang konsisten.

Sebagai System Analyst, saya memimpin proses requirement gathering dari stakeholder lintas departemen — mulai dari tim operasional toko, tim warehouse, hingga divisi IT — dan menerjemahkannya menjadi cetak biru sistem yang siap dieksekusi oleh tim pengembang.

### Deliverables yang Dihasilkan

| Dokumen | Deskripsi |
|---|---|
| **Business Requirements Document (BRD)** | Mendokumentasikan kebutuhan bisnis, pain point, tujuan proyek, dan success metrics dari perspektif stakeholder non-teknis |
| **Functional Specification Document (FSD)** | Penjabaran fitur secara mendetail: manajemen produk & kategori, keranjang belanja, checkout multi-payment, loyalty program, dan dashboard merchant |
| **System Architecture Blueprint** | Desain arsitektur microservices dengan komponen: API Gateway, Product Service, Order Service, Inventory Service, Notification Service, dan integrasi payment gateway pihak ketiga |
| **Entity Relationship Diagram (ERD)** | Perancangan skema basis data relasional untuk entitas produk, varian SKU, stok multi-gudang, transaksi, dan pelanggan |
| **Use Case Diagram & Use Case Specification** | 24 use case yang mencakup alur pembeli, merchant, admin, dan sistem kurir |
| **Data Flow Diagram (DFD) Level 0 & Level 1** | Visualisasi aliran data antar subsistem: POS, e-Commerce, Warehouse Management, dan CRM |
| **Integration Specification Document** | Spesifikasi teknis integrasi dengan payment gateway (Midtrans), ekspedisi (Raja Ongkir), dan sistem ERP eksisting |
| **User Acceptance Testing (UAT) Plan** | Skenario pengujian berbasis use case untuk memastikan setiap fitur memenuhi kriteria penerimaan yang disepakati |

### Arsitektur Sistem (Ringkasan)

```
┌─────────────────────────────────────────────────────────┐
│                     CLIENT LAYER                        │
│        Web App (Next.js)   │   Mobile App (Flutter)     │
│        POS Terminal        │   Admin Dashboard          │
└─────────────────┬───────────────────────────────────────┘
                  │ HTTPS / REST
┌─────────────────▼───────────────────────────────────────┐
│                    API GATEWAY                          │
│         Auth (JWT)  │  Rate Limiting  │  Load Balancer  │
└────┬──────────┬──────────┬──────────┬───────────────────┘
     │          │          │          │
┌────▼───┐ ┌───▼────┐ ┌───▼────┐ ┌───▼──────────┐
│Product │ │ Order  │ │Invntry │ │Notification  │
│Service │ │Service │ │Service │ │  Service     │
└────┬───┘ └───┬────┘ └───┬────┘ └──────────────┘
     │          │          │
┌────▼──────────▼──────────▼────────────────────┐
│           Message Broker (RabbitMQ)           │
└───────────────────────────────────────────────┘
     │                        │
┌────▼────────────┐   ┌───────▼──────────────┐
│  PostgreSQL DB  │   │  Payment Gateway     │
│  Redis Cache    │   │  Shipping API        │
└─────────────────┘   └──────────────────────┘
```

### Hasil & Dampak Bisnis

- Sinkronisasi stok real-time antar 40+ toko dan platform online berhasil dicapai dengan latensi < 2 detik
- Menghilangkan kasus overselling yang sebelumnya terjadi rata-rata 3–5 kali per minggu
- Waktu proses order fulfillment berkurang dari rata-rata 4 jam menjadi 45 menit
- Fondasi arsitektur mendukung skalabilitas hingga 10x volume transaksi tanpa perubahan infrastruktur signifikan

---

## 📦 Proyek 2 — Sistem Manajemen Inventori & Pergudangan (WMS)

**Domain:** Retail / Logistik Internal
**Peran:** System Analyst
**Durasi:** 4 Bulan (Jul 2024 – Okt 2024)
**Tim:** 1 System Analyst, 1 Business Analyst, 3 Developer, 1 QA Engineer

### Deskripsi Proyek

Distributor FMCG (Fast-Moving Consumer Goods) dengan 3 gudang regional mengoperasikan proses penerimaan, penyimpanan, dan pengiriman barang secara manual menggunakan spreadsheet. Ketidakakuratan data stok mencapai 12–15% per kuartal, dan proses stock opname membutuhkan waktu 3 hari penuh dengan menghentikan operasional. Proyek ini membangun Warehouse Management System (WMS) berbasis web yang mencakup proses inbound, putaway, picking, packing, dan outbound secara terotomasi dengan dukungan barcode scanning.

Fokus utama peran System Analyst adalah memetakan alur kerja gudang eksisting (*as-is process*), mengidentifikasi bottleneck, dan merancang alur kerja yang dioptimasi (*to-be process*) sebelum proses pengembangan dimulai.

### Deliverables yang Dihasilkan

| Dokumen | Deskripsi |
|---|---|
| **Business Requirements Document (BRD)** | Identifikasi masalah operasional, kebutuhan bisnis tiap divisi (gudang, procurement, finance), dan KPI target post-implementasi |
| **Functional Specification Document (FSD)** | Spesifikasi lengkap modul: Inbound (GR), Putaway, Stock Inquiry, Picking & Packing, Outbound, Stock Opname, dan Reporting |
| **As-Is & To-Be Process Flow (BPMN)** | Diagram alur proses bisnis dalam notasi BPMN 2.0 untuk 8 proses utama pergudangan sebelum dan sesudah sistem diterapkan |
| **System Architecture Blueprint** | Arsitektur monolitik modular berbasis web dengan pertimbangan offline-first untuk kondisi jaringan gudang yang tidak stabil |
| **Database Design (ERD + Data Dictionary)** | Desain 34 tabel mencakup master data produk, lokasi rak (bin), batch/lot tracking, dan histori mutasi stok |
| **Barcode & Device Integration Spec** | Spesifikasi integrasi barcode scanner Zebra dan printer label ZPL untuk proses GR dan picking |
| **Non-Functional Requirements (NFR) Document** | Dokumen yang mendefinisikan SLA performa, ketersediaan sistem, keamanan data, dan kapasitas concurrent user |
| **Traceability Matrix** | Pemetaan dari kebutuhan bisnis → fitur → test case untuk memastikan tidak ada requirement yang terlewat |

### Alur Proses Utama (BPMN Summary)

```
INBOUND FLOW
─────────────────────────────────────────────────────────
Truck Tiba → Scan DO → Verifikasi Qty/Kondisi
    → Cetak Label GR → Input ke Sistem → Putaway ke Bin
    → Update Stok Real-time → Notifikasi Procurement ✓

OUTBOUND FLOW
─────────────────────────────────────────────────────────
Sales Order Masuk → Generate Picking List
    → Scan Lokasi Bin → Scan Produk → Verifikasi Qty
    → Packing & Seal → Cetak Surat Jalan
    → Update Stok → Serah ke Kurir ✓
```

### Hasil & Dampak Bisnis

- Akurasi data stok meningkat dari 85% menjadi 99.3% setelah 2 bulan go-live
- Durasi stock opname berkurang dari 3 hari menjadi 4 jam tanpa menghentikan operasional
- Produktivitas picking meningkat 35% karena sistem mengarahkan rute picking yang optimal (zone picking)
- Eliminasi penggunaan 15+ spreadsheet yang sebelumnya dikelola secara manual oleh 8 staf gudang

---

## 🚚 Proyek 3 — Sistem Manajemen Pengiriman Last-Mile & Tracking Real-Time

**Domain:** Logistik / Supply Chain
**Peran:** System Analyst
**Durasi:** 5 Bulan (Nov 2024 – Mar 2025)
**Tim:** 1 System Analyst, 1 Project Manager, 4 Developer, 1 UX Designer, 1 QA Engineer

### Deskripsi Proyek

Perusahaan logistik last-mile lokal yang melayani 500+ pengirim korporat menghadapi tantangan visibilitas pengiriman yang rendah. Pelanggan tidak dapat memantau posisi paket secara real-time, dan pengemudi masih menerima manifest pengiriman dalam bentuk cetak. Tingkat komplain akibat paket "tidak terlacak" mencapai 18% dari total pengiriman per bulan. Proyek ini membangun ekosistem sistem pengiriman yang terdiri dari: Dispatch Management System (web), Driver Mobile App (Android), dan Customer Tracking Portal, yang semuanya terhubung melalui backend terpusat.

Peran System Analyst mencakup pemetaan end-to-end journey dari paket masuk di hub hingga tiba di tangan penerima, serta perancangan kontrak data antara ketiga aplikasi melalui spesifikasi API.

### Deliverables yang Dihasilkan

| Dokumen | Deskripsi |
|---|---|
| **Business Requirements Document (BRD)** | Analisis kebutuhan dari tiga perspektif: pengirim korporat, internal dispatcher, dan pengemudi lapangan |
| **Functional Specification Document (FSD)** | Spesifikasi detail untuk Dispatch Console (web), Driver App (Android), dan Customer Tracking Page |
| **System Architecture Blueprint** | Arsitektur event-driven dengan WebSocket untuk live tracking, integrasi Google Maps API, dan push notification FCM |
| **API Specification Document (OpenAPI 3.0)** | Dokumentasi 38 endpoint REST API yang menjadi kontrak antara backend, web dispatcher, dan mobile driver app |
| **Sequence Diagram** | Diagram urutan interaksi sistem untuk 6 skenario kritis: assign order ke driver, update status pengiriman, gagal antar (retur), proof of delivery, dan eskalasi komplain |
| **State Diagram — Lifecycle Paket** | Diagram state yang mendefinisikan 12 status paket dari "Created" hingga "Delivered" / "Returned", beserta transisi dan trigger yang diizinkan |
| **Data Privacy & Security Specification** | Analisis data sensitif (lokasi pengemudi, data penerima) dan spesifikasi kontrol akses berbasis role (RBAC) |
| **Go-Live & Rollout Plan** | Strategi implementasi bertahap (pilot 3 hub → full rollout) beserta rencana mitigasi risiko dan rollback |

### State Diagram — Lifecycle Status Paket (Ringkasan)

```
[Created] ──→ [Assigned to Driver] ──→ [Picked Up]
                                              │
                                              ▼
                                       [In Transit]
                                              │
                            ┌─────────────────┼─────────────────┐
                            ▼                 ▼                 ▼
                    [Out for Delivery]  [Held at Hub]    [Failed Attempt]
                            │                                    │
                            ▼                                    ▼
                       [Delivered] ◄──────────────────── [Re-scheduled]
                            │
                      [POD Confirmed]                    [Returned to Sender]
```

### Hasil & Dampak Bisnis

- Tingkat komplain "paket tidak terlacak" turun dari 18% menjadi 1.2% dalam 60 hari setelah go-live
- Dispatcher dapat mengelola rata-rata 1.200 order/hari dari sebelumnya hanya mampu 400 order/hari dengan proses manual
- Rata-rata waktu assign order ke pengemudi berkurang dari 35 menit menjadi < 2 menit (otomasi berbasis zona)
- Pengemudi tidak lagi membutuhkan manifest cetak, menghemat ~800 lembar kertas/hari di seluruh jaringan hub

---

## 🧰 Ringkasan Kompetensi

| Kompetensi | Tools & Metode |
|---|---|
| Requirements Elicitation | Interview, Workshop, Observation, Questionnaire |
| Dokumentasi Bisnis | BRD, Use Case Specification, BPMN 2.0 |
| Dokumentasi Teknis | FSD, SRS, API Spec (OpenAPI 3.0), NFR Document |
| Pemodelan Sistem | ERD, DFD, Sequence Diagram, State Diagram, Architecture Blueprint |
| Process Analysis | As-Is/To-Be Process Mapping, Gap Analysis, Root Cause Analysis |
| Tools | draw.io, Lucidchart, Notion, Confluence, Postman, MySQL Workbench |
| Metodologi | Agile Scrum, Waterfall (hybrid), UAT Facilitation |

---

*Dokumen ini merupakan ringkasan portofolio. Detail lengkap setiap deliverable tersedia atas permintaan.*