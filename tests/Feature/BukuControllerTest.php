<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class BukuControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_menambahkan_buku_baru(): void
    {
        $response = $this->post(route('buku.createOrUpdate'), [
            'judul' => 'Pemrograman Laravel',
            'pengarang' => 'Mabi',
            'penerbit' => 'Informatika',
            'tanggal_terbit' => '2026-01-01',
            'isbn' => '1234567890123',
        ]);

        $response->assertRedirect(route('buku.index'));
        $response->assertSessionHas(
            'success',
            'Data buku berhasil ditambahkan.'
        );

        $this->assertDatabaseHas('bukus', [
            'judul' => 'Pemrograman Laravel',
            'isbn' => '1234567890123',
        ]);
    }

    public function test_memperbarui_buku(): void
    {
        $buku = Buku::create([
            'judul' => 'Judul Lama',
            'pengarang' => 'Pengarang Lama',
            'penerbit' => 'Penerbit Lama',
            'tanggal_terbit' => '2025-01-01',
            'isbn' => '1234567890123',
        ]);

        $response = $this->post(route('buku.createOrUpdate'), [
            'id' => $buku->id,
            'judul' => 'Judul Baru',
            'pengarang' => 'Pengarang Baru',
            'penerbit' => 'Penerbit Baru',
            'tanggal_terbit' => '2026-01-01',
            'isbn' => '1234567890123',
        ]);

        $response->assertRedirect(route('buku.index'));

        $response->assertSessionHas(
            'success',
            'Data buku berhasil diperbarui.'
        );

        $this->assertDatabaseHas('bukus', [
            'id' => $buku->id,
            'judul' => 'Judul Baru',
        ]);
    }

    public function test_validasi_gagal_saat_data_buku_tidak_lengkap(): void
    {
        $response = $this->post(route('buku.createOrUpdate'), [
            'judul' => '',
            'pengarang' => '',
            'penerbit' => '',
            'tanggal_terbit' => '',
            'isbn' => '',
        ]);

        $response->assertSessionHasErrors([
            'judul',
            'pengarang',
            'penerbit',
            'tanggal_terbit',
            'isbn',
        ]);
    }

    public function test_buku_dapat_dihapus_jika_tidak_digunakan(): void
    {
        $buku = Buku::create([
            'judul' => 'Buku Hapus',
            'pengarang' => 'Mabi',
            'penerbit' => 'Informatika',
            'tanggal_terbit' => '2026-01-01',
            'isbn' => '1234567890123',
        ]);

        $response = $this->delete(
            route('buku.delete', $buku->id)
        );

        $response->assertSessionHas(
            'success',
            'Data buku berhasil dihapus.'
        );

        $this->assertDatabaseMissing('bukus', [
            'id' => $buku->id,
        ]);
    }

    public function test_buku_tidak_dapat_dihapus_jika_digunakan_transaksi(): void
    {
        $buku = Buku::create([
            'judul' => 'Buku Dipinjam',
            'pengarang' => 'Mabi',
            'penerbit' => 'Informatika',
            'tanggal_terbit' => '2026-01-01',
            'isbn' => '1234567890123',
        ]);

        Transaksi::create([
            'buku_id' => $buku->id,
            // isi field Transaksi lainnya sesuai model lu
        ]);

        $response = $this->delete(
            route('buku.delete', $buku->id)
        );

        $response->assertSessionHas(
            'error',
            'Data buku sedang digunakan.'
        );

        $this->assertDatabaseHas('bukus', [
            'id' => $buku->id,
        ]);
    }
}