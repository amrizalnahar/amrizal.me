<?php

namespace App\Livewire\Admin;

use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class CertificateForm extends Component
{
    use WithFileUploads;

    public ?Certificate $certificate = null;

    public string $title_id = '';
    public ?string $title_en = '';
    public string $issuer_name = '';
    public $issuer_logo = null;
    public ?string $existingIssuerLogo = null;
    public string $description_id = '';
    public ?string $description_en = '';
    public $certificate_image = null;
    public ?string $existingCertificateImage = null;
    public ?string $issued_at = '';
    public ?string $expired_at = '';
    public ?string $verify_url = '';
    public string $status = 'draft';
    public int $sort_order = 0;

    public function mount(?Certificate $certificate = null): void
    {
        $this->certificate = $certificate;

        if ($certificate) {
            $this->title_id = $certificate->title_id;
            $this->title_en = $certificate->title_en ?? '';
            $this->issuer_name = $certificate->issuer_name;
            $this->existingIssuerLogo = $certificate->issuer_logo;
            $this->description_id = $certificate->description_id ?? '';
            $this->description_en = $certificate->description_en ?? '';
            $this->existingCertificateImage = $certificate->certificate_image;
            $this->issued_at = $certificate->issued_at?->format('Y-m-d');
            $this->expired_at = $certificate->expired_at?->format('Y-m-d');
            $this->verify_url = $certificate->verify_url ?? '';
            $this->status = $certificate->status;
            $this->sort_order = $certificate->sort_order;
        }
    }

    protected function rules(): array
    {
        return [
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'issuer_name' => ['required', 'string', 'max:255'],
            'issuer_logo' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpg,jpeg,png,webp',
            ],
            'description_id' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'certificate_image' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpg,jpeg,png,webp',
            ],
            'issued_at' => ['required', 'date'],
            'expired_at' => [
                'nullable',
                'date',
                'after_or_equal:issued_at',
            ],
            'verify_url' => ['nullable', 'url', 'max:255'],
            'status' => ['required', 'in:draft,publish'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ];
    }

    protected function messages(): array
    {
        return [
            'title_id.required' => 'Judul sertifikat (ID) wajib diisi.',
            'issuer_name.required' => 'Nama penerbit wajib diisi.',
            'issued_at.required' => 'Tanggal terbit wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'sort_order.required' => 'Urutan wajib diisi.',
            'expired_at.after_or_equal' => 'Tanggal kedaluwarsa harus setelah atau sama dengan tanggal terbit.',
            'verify_url.url' => 'URL verifikasi harus berupa URL yang valid.',
            'issuer_logo.image' => 'File harus berupa gambar.',
            'issuer_logo.max' => 'Ukuran gambar maksimal 2MB.',
            'issuer_logo.mimes' => 'Gambar harus berformat jpg, png, atau webp.',
            'certificate_image.image' => 'File harus berupa gambar.',
            'certificate_image.max' => 'Ukuran gambar maksimal 2MB.',
            'certificate_image.mimes' => 'Gambar harus berformat jpg, png, atau webp.',
        ];
    }

    public function save(): void
    {
        $data = $this->validate();

        $issuerLogoPath = $this->existingIssuerLogo;
        $certificateImagePath = $this->existingCertificateImage;

        if ($this->issuer_logo) {
            if ($this->existingIssuerLogo) {
                Storage::disk('public')->delete($this->existingIssuerLogo);
            }
            $issuerLogoPath = $this->issuer_logo->store('certificates', 'public');
        }

        if ($this->certificate_image) {
            if ($this->existingCertificateImage) {
                Storage::disk('public')->delete($this->existingCertificateImage);
            }
            $certificateImagePath = $this->certificate_image->store('certificates', 'public');
        }

        Certificate::updateOrCreate(
            ['id' => $this->certificate?->id],
            [
                'title_id' => $this->title_id,
                'title_en' => $this->title_en ?: null,
                'issuer_name' => $this->issuer_name,
                'issuer_logo' => $issuerLogoPath,
                'description_id' => $this->description_id ?: null,
                'description_en' => $this->description_en ?: null,
                'certificate_image' => $certificateImagePath,
                'issued_at' => $this->issued_at,
                'expired_at' => $this->expired_at ?: null,
                'verify_url' => $this->verify_url ?: null,
                'status' => $this->status,
                'sort_order' => $this->sort_order,
            ]
        );

        $this->dispatch('notify', type: 'success', message: $this->certificate ? 'Sertifikat berhasil diperbarui.' : 'Sertifikat berhasil ditambahkan.');
        $this->redirectRoute('admin.certificates');
    }

    public function render()
    {
        return view('livewire.admin.certificate-form');
    }
}
